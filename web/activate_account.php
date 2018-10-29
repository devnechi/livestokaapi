<?php
    //getting the dboperation class
    require_once '../includes/DbOperation.php';
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
    // json response array
    $response = array("error" => false);

    if (isset($_POST['user_id'])){
      // $db = new DbOperation();
      $user_id = $_POST['user_id'];
      $account_status = "active";

      if ($db->isAccountActive($user_id, $account_status)){
          // user already existed
          // $response["error"] = true;
          // $response["error_msg"] = "User already exists with " . $email;
          $response["error"] = true;
          $response["error_msg"] = "Account is already active ";
          //echo json_encode($response);
          $message = "<div class=\"alert alert-info\" role=\"alert\">
       <strong>Account!</strong> <a href=\"#\" class=\"alert-link\">Is already active, you can log in now.
     </div>";
          // echo json_encode($response);
      } else {
      $result = $db->activateUserAccount($user_id, $account_status);
      if($result){
      $response['error'] = false;
      $response['message'] = 'account activated successfully';
      //$response['heroes'] = $db->getHeroes();
      $message = "<div class=\"alert alert-success\" role=\"alert\">
   <strong>Success!</strong> <a href=\"#\" class=\"alert-link\">Your account is now active, you can log in now.
 </div>";


      }else{
      $response['error'] = true;
      $response['message'] = 'Some error occurred please try again';
      }
    }
     } else {
           $response["error"] = true;
           $response["error_msg"] = "Required parameters (user_id) is missing!";
           echo json_encode($response);
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
    <link rel="icon" href="http://v4-alpha.getbootstrap.com/favicon.ico">

    <title>Livestoka | Activating Account </title>

    <!-- Bootstrap core CSS -->
    <link href="http://v4-alpha.getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://v4-alpha.getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>

    <!-- Custom styles for this template -->
    <link href="http://v4-alpha.getbootstrap.com/examples/carousel/carousel.css" rel="stylesheet">

    <style>
    .card {
         border: transparent;
    }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="starter-template">
        <h1>Activating your account....</h1>
        <p class="lead">Once activated you can log in.<small>See you soon.</small></p>
      </div>
      <!--register section -->
      <section id="manufacturersReg">
        <!-- <form action="feed_manufacture_registry.php" method="post"> -->
       <?php echo $message; ?>
     </section>
     <!--end of registeration section -->
   </div> <!-- /.container-->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
 </body>
</html>
