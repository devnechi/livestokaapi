<?php
ob_start();
    //getting the dboperation class
    require_once '../includes/DbOperation.php';
      require_once '../includes/session.php';
    require_once '../includes/validations_functions.php';

    //function validating all the paramters are available
    //we will pass the required parameters to this function
    function isTheseParametersAvailable($params)
    {
        //assuming all parameters are available
        $available = true;
        $missingparams = "";

        foreach ($params as $param) {
            if (!isset($_POST[$param]) || strlen($_POST[$param])<=0) {
                $available = false;
                $missingparams = $missingparams . ", " . $param;
            }
        }

        //if parameters are missing
        if (!$available) {
            $response = array();
            $response['error'] = true;
            $response['message'] = 'Parameters ' . substr($missingparams, 1, strlen($missingparams)) . ' missing';

            //displaying error
            echo json_encode($response);

            //stopping further execution
            die();
        }
    }

   $db = new DbOperation();
    //an array to display response
    $response = array();
    $errors = array();
    $message = " ";
    $email = "";
if (isset($_POST['submit'])) {
    // process users entry on the form

    $email = $_POST['email'];
    $password = $_POST['password'];

    //validations
    $fields_required= array("email", "password");
    foreach ($fields_required as $field) {
        $value = trim($_POST[$field]);
        if (!has_presence($value)) {
            $message = "<div class=\"alert alert-danger\" role=\"alert\">
    <strong>Oh snap!</strong> <a href=\"#\" class=\"alert-link\">Change a few things up</a> and try submitting again.
  </div>";

            $errors[$field] = ucfirst($field) . " can't be blank";
        }
    }

    // if no errors detected
    if (empty($errors)) {
        // get the user by email and password
        $user = $db->attempt_login($email, $password);
        if ($user != false) {
            // use is found

            $response["error"] = false;
            $response["uid"] = $user["user_unique_id"];
            $response["user"]["user_id"] = $user["user_id"];
            $response["user"]["usertype"] = $user["usertype"];
            $response["user"]["encrypted_password"] = $user["encrypted_password"];
            $response["user"]["email"] = $user["email"];
            $response["user"]["account_status"] = $user["account_status"];
            $response["user"]["created_at"] = $user["created_at"];
            $response["user"]["updated_at"] = $user["updated_at"];

             $logger_id = $user["user_id"];
             $logger_usertype = $user["email"];
            // $_SESSION["user_id"] = user["user_id"];
            // $_SESSION["email"] = user["email"];
            $_SESSION['loggedIn'] = TRUE;

            if ($user["usertype"] == "Hatchery User") {
              // code...
              $_SESSION['user_log_id'] = $user["user_id"];
              $_SESSION['user_log_email'] = $user["email"];
              $_SESSION['user_log_usertype'] = $user["usertype"];

                // redirect_to(hatchersarea/hatchers_dashboard.php);
                 header('Location: ../web/hatchersarea/hatchers_dashboard.php');
            } elseif ($user["usertype"] == "feed manufacturer") {
              // code...
              $_SESSION['user_log_id'] = $user["user_id"];
              $_SESSION['user_log_email'] = $email;
              $_SESSION['user_log_usertype'] = $user["usertype"];
               // redirect_to(feedmanufacturerarea/feed_manufacturer_dashboard.php);
                header('location: ../web/feedmanufacturerarea/feed_manufacturer_dashboard.php');

            } else{

               $_SESSION["message"] = "Username /password not found.";
              $message = "<div class=\"alert alert-danger\" role=\"alert\">
                <strong>Oh snap!</strong> <a href=\"#\" class=\"alert-link\">Seems like we failed to authenticate you</a> Try login again.
              </div>";

            }
        //echo json_encode($response);
        } else {
            // user is not found with the credentials
            $response["error"] = true;
            $response["error_msg"] = "Login credentials are wrong. Please try again!";
            $message = "<div class=\"alert alert-warning\" role=\"alert\">
              <strong>Problem Occured!</strong> <a href=\"#\" class=\"alert-link\">Login credentials are wrong.</a> and try submitting again.
            </div>";

            //echo json_encode($response);
        }
    } else {
        // if the form has errors
        // required post params is missing

        $response["error"] = true;
        $response["error_msg"] = "Required parameters email or password is missing!";
        $message = "<div class=\"alert alert-info\" role=\"alert\">
          <strong>Oh snap!</strong> <a href=\"#\" class=\"alert-link\">Something is missing</a> check your inputs and try again.
        </div>";

        //echo json_encode($response);
    }
    } else {
        // code...
      //this is probably a GET request
      // redirect_to("login_area.php");
    }

 ?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" href="http://v4-alpha.getbootstrap.com/favicon.ico"> -->

    <title>Livestoka | Login </title>

    <!-- Bootstrap core CSS -->
    <link href="http://v4-alpha.getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://v4-alpha.getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>

    <!-- Custom styles for this template -->
    <link href="http://v4-alpha.getbootstrap.com/examples/carousel/carousel.css" rel="stylesheet">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">

<style>
.carousel-item > img{
  min-width: 100%;
height: 90rem;
}

#login_area {
    height: 100%;
    background-repeat: no-repeat;
background: rgb(185,210,224); /* Old browsers */
background: -moz-radial-gradient(center, ellipse cover,  rgba(185,210,224,1) 0%, rgba(187,214,228,1) 0%, rgba(186,211,225,1) 15%, rgba(186,211,225,1) 38%, rgba(169,199,215,1) 68%, rgba(169,199,215,1) 68%, rgba(169,199,215,1) 82%, rgba(158,191,208,1) 100%); /* FF3.6-15 */
background: -webkit-radial-gradient(center, ellipse cover,  rgba(185,210,224,1) 0%,rgba(187,214,228,1) 0%,rgba(186,211,225,1) 15%,rgba(186,211,225,1) 38%,rgba(169,199,215,1) 68%,rgba(169,199,215,1) 68%,rgba(169,199,215,1) 82%,rgba(158,191,208,1) 100%); /* Chrome10-25,Safari5.1-6 */
background: radial-gradient(ellipse at center,  rgba(185,210,224,1) 0%,rgba(187,214,228,1) 0%,rgba(186,211,225,1) 15%,rgba(186,211,225,1) 38%,rgba(169,199,215,1) 68%,rgba(169,199,215,1) 68%,rgba(169,199,215,1) 82%,rgba(158,191,208,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b9d2e0', endColorstr='#9ebfd0',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */

}


.login_box{
    background:#f7f7f7;
    border:3px solid #F4F4F4;
    padding-left: 15px;
    margin-bottom:25px;
    }
.input_title{
    color:rgba(164, 164, 164, 0.9);
    padding-left:3px;
        margin-bottom: 2px;
    }

hr{
    width:100%;
}

.welcome{
    font-family: "myriad-pro",sans-serif;
    font-style: normal;
    font-weight: 100;
    color:#073f5a;
    margin-bottom:25px;
    margin-top:50px;

}

.login_title{
    font-family: "myriad-pro",sans-serif;
    font-style: normal;
    font-weight: 100;
    color:#073f5a;
}

.card-container.card {
    max-width: 450px;

}

.btn {
    font-weight: 700;
    height: 36px;
    -moz-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    cursor: default;
    border-radius:0;
    background:#43A6EB;
    height: 55px;
    margin-bottom:10px;
}

/*
 * Card component
 */
.card {
    background-color: #FFFFFF;
    /* just in case there no content*/
    padding: 1px 25px 30px;
    margin: 0 auto 25px;
    margin-top: 15%x;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}

.profile-img-card {
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}

/*
 * Form styles
 */
.profile-name-card {
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    margin: 10px 0 0;
    min-height: 1em;
}

.reauth-email {
    display: block;
    color: #404040;
    line-height: 2;
    margin-bottom: 10px;
    font-size: 14px;
    text-align: center;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin #inputEmail,
.form-signin #inputPassword {
    direction: ltr;
    height: 44px;
    font-size: 16px;
}

.form-signin input[type=email],
.form-signin input[type=password],
.form-signin input[type=text],
.form-signin button {
    width: 100%;
    display: block;

    z-index: 1;
    position: relative;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin .form-control:focus {
    border-color: rgb(104, 145, 162);
    outline: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
}

.btn.btn-signin {
    /*background-color: #4d90fe; */
    background-color: rgb(104, 145, 162);
    /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
    padding: 0px;
    font-weight: 700;
    font-size: 14px;
    height: 36px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    border: none;
    -o-transition: all 0.218s;
    -moz-transition: all 0.218s;
    -webkit-transition: all 0.218s;
    transition: all 0.218s;
}

.btn.btn-signin:hover,
.btn.btn-signin:active,
.btn.btn-signin:focus {
    background-color: rgb(12, 97, 33);
}

.forgot-password {
    color: rgb(104, 145, 162);
}

.forgot-password:hover,
.forgot-password:active,
.forgot-password:focus{
    color: rgb(12, 97, 33);
}
</style>

  </head>
  <body>
    <nav class="navbar navbar-default navbar-static-top">
      <a href="index.php" class="navbar-brand">Back To Livestoka</a>
      <!-- <ul class="nav nav-pills">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">FAQ's</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="registration/hatcher_registry.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Login</a>
        </li>
      </ul> -->
    </nav>

    <section id="login_area">
      <div class="container">
<h1 class="welcome text-center">Welcome to <br> <strong>Livestoka</strong></h1>
    <div class="card card-container">
    <h2 class='login_title text-center'>Members Login</h2>

    <hr>

        <form class="form-signin" action="login_area.php" method="post">
            <span id="reauth-email" class="reauth-email"></span>
            <p class="input_title">Email</p>
            <input type="text" id="email" class="login_box" name="email" value="<?php echo htmlentities($email);?>" placeholder="member@livestoka.com" required autofocus>
            <p class="input_title">Password</p>
            <input type="password" id="password" class="login_box" name="password" value="" placeholder="******" required>
            <div id="remember" class="checkbox">
                <label>
                  <input type="checkbox" name="remember" value="1"> Remember me</input>

                </label>
            </div>
            <button class="btn btn-lg btn-primary" type="submit" name="submit" value="Submit">Login</button>
        </form><!-- /form -->
    </div><!-- /card-container -->
</div><!-- /container -->
</section>


        <script src="https://use.typekit.net/ayg4pcz.js"></script>
           <script>try{Typekit.load({ async: true });}catch(e){}</script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>
