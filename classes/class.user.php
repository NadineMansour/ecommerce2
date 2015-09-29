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
    public function registerNewUser($user_name, $user_email, $user_password, $user_password_repeat, $card)
    {
        // we just remove extra space on username and email
        $user_name  = trim($user_name);
        $user_email = trim($user_email);
        // check provided data validity
        // TODO: check for "return true" case early, so put this first
        if (empty($user_name)) {
            $this->errors[] = "Username is empty";
        }
        if (empty($user_password) || empty($user_password_repeat)) {
            $this->errors[] = "Password is empty";
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
        if (!preg_match('/^[a-z\d]{2,64}$/i', $user_name)) {
            $this->errors[] = "Wrong username format. should contain /^[a-z\d]{2,64}$/i";
        }
        if (empty($user_email)) {
            $this->errors[] = "Email is empty";
        }
        if (strlen($user_email) > 64) {
            $this->errors[] = "Email is too long";
        }
        if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Invalid Email format";
        // finally if all the above checks are ok
        }
        if ($this->_db) {
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
                $query_new_user_insert = $this->_db->prepare('INSERT INTO users (username, password, email, cardnumber) VALUES(:user_name, :user_password_hash, :user_email, :user_card)');
                $query_new_user_insert->bindValue(':user_name', $user_name, PDO::PARAM_STR);
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
	
}


?>