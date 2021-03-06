<?php

include('class.password.php');

class User extends Password{

    private $db;
    private  $errors = array();

    public function getErrors() { 
        return $this->errors; 
    }
	
	function __construct($db){
		parent::__construct();
		$this->_db = $db;
	}

	public function is_logged_in(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			return true;
		}		
	}

	private function get_user_hash($username){	

		try {

			$stmt = $this->_db->prepare('SELECT password FROM users WHERE username = :username');
			$stmt->execute(array('username' => $username));
			
			$row = $stmt->fetch();
			return $row['password'];

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
	}

	
	public function login($username,$password){	

		$hashed = $this->get_user_hash($username);
		
		if($this->password_verify($password,$hashed) == 1){

		    $_SESSION['username'] = $username;
		    $_SESSION['loggedin'] = true;
            $_SESSION['user']=$username; 
		    return true;
		}		
	}
	
		
	public function logout(){
		session_destroy();
	}


	/**
     * handles the entire registration process. checks all error possibilities, and creates a new user in the database if
     * everything is fine
     */
    public function registerNewUser($user_name, $user_email, $user_password, $user_password_repeat, $card, $firstName, $lastName)
    {
        // we just remove extra space on username and email
        $user_name  = trim($user_name);
        $user_email = trim($user_email);
        $firstName = trim($firstName);
        $lastName = trim($lastName);
        $cardnumber = trim($card);
        $flag = True;
        // check provided data validity
        // TODO: check for "return true" case early, so put this first
        if (empty($user_name)) {
            $this->errors[] = "Username is empty";
            $flag = False;
        }
        if (empty($user_password) || empty($user_password_repeat)) {
            $this->errors[] = "Password is empty";
            $flag = False;
        }
        if(empty($firstName)){
            $this->errors[] = "Please write your first name.";
            $flag = False;
        }
        if(empty($lastName)){
            $this->errors[] = "Please write your last name.";
            $flag = False;
        }
        if ($user_password !== $user_password_repeat) {
            $this->errors[] = "Wrong password confirmation";
            $flag = False;
        }
        if (strlen($user_password) < 6) {
            $this->errors[] = "Password is too short";
            $flag = False;
        }
        if (strlen($user_name) > 64 || strlen($user_name) < 2) {
            $this->errors[] = "username should be longer than 2 characters and shorter than 64";
            $flag = False;
        }
        if (!preg_match('/^[a-z\d]{2,64}$/i', $user_name)) {
            $this->errors[] = "Wrong username format. should contain /^[a-z\d]{2,64}$/i";
            $flag = False;
        }
        if (empty($user_email)) {
            $this->errors[] = "Email is empty";
            $flag = False;
        }
        if (strlen($user_email) > 64) {
            $this->errors[] = "Email is too long";
            $flag = False;
        }
        if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Invalid Email format";
            $flag = False;
        // finally if all the above checks are ok
        }
        $numCount = 0;
        $num =(int) $cardnumber;
        while($num > 0)
        {
            if($num > 0)
            {
                $numCount++;
                $num =(int) $num/10;
            }
        }
        if($numCount < 0)
        {
            $this->errors[] = "card Number must be 20 integers";
            $flag = False;
        }
        if(!is_numeric($num))
        {
            $this->errors[] = "card Number cannot contain chars";   
            $flag = False;
        }
        if ($this->_db && $flag) {
            // check if username or email already exists
            $query_check_user_name = $this->_db->prepare('SELECT username, email FROM users WHERE username=:user_name OR email=:user_email');
            $query_check_user_name->bindValue(':user_name', $user_name, PDO::PARAM_STR);
            $query_check_user_name->bindValue(':user_email', $user_email, PDO::PARAM_STR);
            $query_check_user_name->execute();
            $result = $query_check_user_name->fetchAll();
            // if username or/and email find in the database
            // TODO: this is really awful!
            if (count($result) > 0) {
                for ($i = 0; $i < count($result); $i++) {
                    $this->errors[] = ($result[$i]['username'] == $user_name) ? "Username already exists" : "Email already exists";
                }
            } else {
                $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);
                // write new users data into database
                $query_new_user_insert = $this->_db->prepare('INSERT INTO users (username, password, email, cardnumber, firstName, lastName) VALUES(:user_name, :user_password_hash, :user_email, :user_card, :firstName, :lastName)');
                $query_new_user_insert->bindValue(':user_name', $user_name, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':firstName', $firstName, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':lastName', $lastName, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_password_hash', $user_password_hash, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_email', $user_email, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_card', $card, PDO::PARAM_STR);
                $query_new_user_insert->execute();
                // id of new user
                $user_id = $this->_db->lastInsertId();

                if (!$query_new_user_insert) {
                    $this->errors[] = "Registration failed";
                    session_destroy();
                }
                else{
                	session_destroy();
                	return true;
                }
            }
        }
    }

    Public function editUserInfo($user_name, $user_email, $user_password, $user_password_repeat, $card, $firstName, $lastName, $avatar)
    {
        $user_name  = trim($user_name);
        $user_email = trim($user_email);
        if (empty($user_name)) {
            $this->errors[] = "Username is empty";
        }
        if ($user_password !== $user_password_repeat) {
            $this->errors[] = "Wrong password confirmation";
        }
        if (strlen($user_password) < 6) {
            $this->errors[] = "Password is too short";
        }
        if (strlen($user_name) > 64 || strlen($user_name) < 2) {
            $this->errors[] = "username should be longer than 2 characters and shorter than 64";
        }
        if (empty($user_email)) {
            $this->errors[] = "Email is empty";
        }
        if (strlen($user_email) > 64) {
            $this->errors[] = "Email is too long";
        }
        if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Invalid Email format";
        }
        $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);
        $query_edit = $this->_db->prepare("UPDATE Users Set  email = :email , cardnumber = :cardnumber , password = :user_password_hash, firstName = :firstName, lastName = :lastName , avatar = :avatar where username = :username");
        $query_edit->bindValue(':username', $user_name, PDO::PARAM_STR);
        $query_edit->bindValue(':firstName', $firstName, PDO::PARAM_STR);
        $query_edit->bindValue(':lastName', $lastName, PDO::PARAM_STR);
        $query_edit->bindValue(':avatar', $avatar, PDO::PARAM_STR);
        $query_edit->bindValue(':user_password_hash', $user_password_hash, PDO::PARAM_STR);
        $query_edit->bindValue(':email', $user_email, PDO::PARAM_STR);
        $query_edit->bindValue(':cardnumber', $card, PDO::PARAM_STR);
        $query_edit->execute();
        $user_id = $this->_db->lastInsertId();
    }
	
}


?>