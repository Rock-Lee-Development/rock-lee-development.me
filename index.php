
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
<!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">-->
<link href="css/bootstrap-grid.css" rel="stylesheet">
<link href="css/bootstrap-grid.min.css" rel="stylesheet">
<link href="css/bootstrap-reboot.css" rel="stylesheet">
<link href="css/bootstrap-reboot.min.css" rel="stylesheet">
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/Footer-with-button-logo.css" rel="stylesheet">

</head>

<body>
	<?php
			$servername = "rockleedb.cqkqw4vhznsx.us-east-1.rds.amazonaws.com";
			$username = "rocklee";
			$password = "lindenwood";


			$conn = new mysqli($servername, $username, $password);
			echo "connection";


			if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
			}
			echo "Connection Successful";
	?>
	<?php
	if(!empty($_POST["register-user"])) {
		/* Form Required Field Validation */
		foreach($_POST as $key=>$value) {
			if(empty($_POST[$key])) {
			$error_message = "All Fields are required";
			break;
			}
		}

		if(!isset($error_message)) {
			require_once("dbcontroller2.php");
			$db_handle = new DBController();
			$query = "INSERT INTO registered_user (Lu_ID, user_name, first_name, last_name, password, email) VALUES
			('" . $_POST["luID"] . "','" . $_POST["userName"] . "', '" . $_POST["firstName"] . "', '" . $_POST["lastName"] . "', '" . md5($_POST["password"]) . "', '" . $_POST["userEmail"] . "')";
			$result = $db_handle->insertQuery($query);
			if(!empty($result)) {
				$error_message = "";
				$success_message = "You have registered successfully!";
				unset($_POST);
			} else {
				$error_message = "Problem in registration. Try Again!";
			}
		}
	}
	?>
	<?php if(!empty($success_message)) { ?>
	<div class="success-message"><?php if(isset($success_message)) echo $success_message; ?></div>
	<?php } ?>
	<?php if(!empty($error_message)) { ?>
	<div class="error-message"><?php if(isset($error_message)) echo $error_message; ?></div>
	<?php } ?>
<div class="container">
  <div class ="row justify-content-center">
    <div class="col col-md-2">
    </div>
    <div class="col col-md-2 text-center">
      <img src="images/Logo.png" alt="lindenwood-library-logo" height="90%">
  </div>
  <div class="col col-md-2">
    </div>
</div>
   <div class="row justify-content-center" style="margin-bottom:15px;">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-login" style="background-color: #fff;">
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <form id="login-form" action="#" method="post" role="form" style="display: block;">
                <h2>LOGIN</h2>
                  <div class="form-group">
                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                  </div>
                <div class="col-xs-6 form-group">
                    <div class="row">
                    <div class="col">
                      <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input">
                                    <span class="custom-control-indicator"></span>
                                    <label for="rememberMe" class="label-primary">Remember Me</label>
                                </label>

                  </div>
                  <div class="col">
                      <a class="nav-item nav-link" href="#" data-toggle="modal" data-target="#forgotmodal" data-whatever="@mdo">Forgot Username/Password</a>
                  </div>
                  </div>
                </div>
                  <div class="col-xs-6 form-group">
                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In" onclick="validateLogin()">
                  </div>
              </form>
              <form id="register-form" action="" method="post" role="form" style="display: none;">
                <h2>REGISTER</h2>

                  <div class="form-group">
                     <div class="row">
                    <div class="col">
                     <input type="text" name="firstName" id="firstName" tabindex="1" class="form-control" placeholder="First Name" value="<?php if(isset($_POST['firstName'])) echo $_POST['firstName']; ?>">
                    </div>
                    <div class="col">
                     <input type="text" name="lastName" id="lastName" tabindex="1" class="form-control" placeholder="Last Name" value="<?php if(isset($_POST['lastName'])) echo $_POST['lastName']; ?>">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                    <input type="text" name="userName" id="username" tabindex="1" class="form-control" placeholder="Username" value="<?php if(isset($_POST['userName'])) echo $_POST['userName']; ?>">
                  </div>
                  <div class="form-group">
                    <input type="text" name="luID" id="studentID" tabindex="1" class="form-control" placeholder="Student ID" value="<?php if(isset($_POST['luID'])) echo $_POST['luID']; ?>">
                  </div>
                  <div class="form-group">
                    <input type="email" name="userEmail" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="<?php if(isset($_POST['userEmail'])) echo $_POST['userEmail']; ?>">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <input type="password" name="confirm_password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="register-user" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
                      </div>
                    </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-6 tabs" style="width:50%">
              <a href="#" class="active" id="login-form-link"><div class="login">LOGIN</div></a>
            </div>
            <div class="col-xs-6 tabs" style="width: 50%">
              <a href="#" id="register-form-link"><div class="register">REGISTER</div></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="forgotmodal" tabindex="-1" role="dialog" aria-labelledby="myModallabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">Enter the Email Address Associated With Your Account</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <div class="modal-body mx-3">
              <div class="md-form">
                  <input type="text" id="emailForm" class="form-control validate" placeholder="Email" value="">
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Submit</button>
        </div>
      </div>
   </div>
</div>
<footer id="footer">
  <div class="footer-top">
    <div class="container">

    </div>
  </div>

  <div class="container">
    <div class="copyright">
      &copy; 2018 <strong>ROCK LEE DEVELOPEMENT</strong>.ALL RIGHTS RESERVED.
    </div>
    <div class="credits">
      <!--
        All the links in the footer should remain intact.
        You can delete the links only if you purchased the pro version.
        Licensing information: https://bootstrapmade.com/license/
        Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Regna
      -->

    </div>
  </div>
</footer><!-- #footer -->
<!--/.Footer-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>


<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>


<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/loginV2.js"></script>


</body>
</html>
