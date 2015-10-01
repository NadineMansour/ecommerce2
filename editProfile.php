<!DOCTYPE html>
<html>
<head>
    <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>profile</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <!-- Custom CSS -->

</head>
</head>

<body>
    <div class="container">
        <h1>Edit Profile</h1>
        <hr>

        <div class="row well">
            <div class="col-md-3">
                <div class="text-center">
                    <img alt="avatar" class="avatar img-circle" src=
                    "//placehold.it/100">

                    <h6>Upload a different photo...</h6><input class=
                    "form-control" type="file">
                </div>
            </div>

            <div class="col-md-9 personal-info">
                <div class="alert alert-info alert-dismissable">
                    <a class="panel-close close" data-dismiss="alert">×</a>
                    <i class="fa fa-coffee"></i>This is an
                    <strong>.alert</strong>. Use this to show important
                    messages to the user.
                </div>

                <h3>Personal info</h3>

                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-lg-3 control-label">First
                        name:</label>

                        <div class="col-lg-8">
                            <input class="form-control" type="text" value=
                            "Jane">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Last
                        name:</label>

                        <div class="col-lg-8">
                            <input class="form-control" type="text" value=
                            "Bishop">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Company:</label>

                        <div class="col-lg-8">
                            <input class="form-control" type="text" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Email:</label>

                        <div class="col-lg-8">
                            <input class="form-control" type="text" value=
                            "janesemail@gmail.com">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Time
                        Zone:</label>

                        <div class="col-lg-8">
                            <div class="ui-select">
                                <select class="form-control" id=
                                "user_time_zone">
                                    <option value="Hawaii">
                                        (GMT-10:00) Hawaii
                                    </option>

                                    <option value="Alaska">
                                        (GMT-09:00) Alaska
                                    </option>

                                    <option value=
                                    "Pacific Time (US &amp; Canada)">
                                        (GMT-08:00) Pacific Time (US &amp;
                                        Canada)
                                    </option>

                                    <option value="Arizona">
                                        (GMT-07:00) Arizona
                                    </option>

                                    <option value=
                                    "Mountain Time (US &amp; Canada)">
                                        (GMT-07:00) Mountain Time (US &amp;
                                        Canada)
                                    </option>

                                    <option selected="selected" value=
                                    "Central Time (US &amp; Canada)">
                                        (GMT-06:00) Central Time (US &amp;
                                        Canada)
                                    </option>

                                    <option value=
                                    "Eastern Time (US &amp; Canada)">
                                        (GMT-05:00) Eastern Time (US &amp;
                                        Canada)
                                    </option>

                                    <option value="Indiana (East)">
                                        (GMT-05:00) Indiana (East)
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Username:</label>

                        <div class="col-md-8">
                            <input class="form-control" type="text" value=
                            "janeuser">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Password:</label>

                        <div class="col-md-8">
                            <input class="form-control" type="password" value=
                            "11111122333">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Confirm
                        password:</label>

                        <div class="col-md-8">
                            <input class="form-control" type="password" value=
                            "11111122333">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>

                        <div class="col-md-8">
                            <input class="btn btn-primary" type="button" value=
                            "Save Changes"> <span></span><input class=
                            "btn btn-default" type="reset" value="Cancel">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr>
    <script src=
    "https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>