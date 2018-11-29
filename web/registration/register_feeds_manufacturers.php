<?php
    //getting the dboperation class
    require_once '../../includes/DbOperation.php';
    require_once '../../includes/validations_functions.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
//
//     require 'vendor/phpmailer/phpmailer/src/Exception.php';
// require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
// require 'vendor/phpmailer/phpmailer/src/SMTP.php';
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
   if(isset($_POST["submit"])){
     // receiving the post params
     //$user_id = $_POST['user_id'];
     $account_status = "pending approval";
     $email = trim($_POST['email']);
     $password = trim($_POST['password']);

     $usertype = "feed manufacturer";
     $companyname = trim($_POST['companyname']);
     $year_established = trim($_POST['year_established']);
     $premise_cert_num = trim($_POST['premise_cert_num']);
     $cert_of_incorporation_num = trim($_POST['cert_of_incorporation_num']);
     $feedbussiness_permit_num = trim($_POST['feedbussiness_permit_num']);
     $gmp_cert_num = trim($_POST['gmp_cert_num']);
     $association_affiliation = trim($_POST['association_affiliation']);
     $country = trim($_POST['country']);
     $region = trim($_POST['region']);
     $district = trim($_POST['district']);
     $address = trim($_POST['address']);
     $pobox = trim($_POST['pobox']);
     $phonenumber = trim($_POST['phonenumber']);
     $websiteurl = trim($_POST['websiteurl']);
     $contact_person = trim($_POST['contact_person']);
     $production_capacity = trim($_POST['production_capacity']);
     $storage_capacity = trim($_POST['storage_capacity']);
     $num_products_produced = trim($_POST['num_products_produced']);
     $man_power = trim($_POST['man_power']);
     $plant_manager = trim($_POST['plant_manager']);


  //validations
  $fields_required= array("plant_manager", "premise_cert_num", "password", "email", "contact_person");
  foreach($fields_required as $field){
    $value = trim($_POST[$field]);
    if(!has_presence($value)){

      $message = "<div class=\"alert alert-danger\" role=\"alert\">
        <strong>Oh snap!</strong> <a href=\"#\" class=\"alert-link\">Change a few things up</a> and try submitting again.
      </div>";

       $errors[$field] = ucfirst($field) . " can't be blank";

    }
  }


   //check if the values are numeric
   $fields_required= array("gmp_cert_num", "feedbussiness_permit_num", "cert_of_incorporation_num", "premise_cert_num", "man_power", "num_products_produced", "storage_capacity", "production_capacity", "phonenumber");
   foreach($fields_required as $field){
     $value = trim($_POST[$field]);
     if(!is_numeric($value)){

       $message = "<div class=\"alert alert-info\" role=\"alert\">
         <strong>Oh snap!</strong> <a href=\"#\" class=\"alert-link\">make sure values are numeric </a> and try submitting again.
       </div>";

        $errors[$field] = ucfirst($field) . " should be numeric";

     }
   }


  // Using assoc. arrays
  $fields_with_max_lengths = array("plant_manager" => 30, "premise_cert_num" => 8);
   validate_max_length($fields_with_max_lengths);
  if (empty($errors)) {
    // code...
    // if($username == "dennis" && $password == "qwerty"){
    //   //sucessful Logging
    //   redirect("first_page.php");
    // }else{
    //   // $username = $_POST["username"];
    //   // $message = "Logging in: {$username}";
    //   $message = "Username /password don't match ";

    //}
    // registerFeedManufacturers($user_id, $companyname, $year_established, $cert_of_incorporation_num, $feedbussiness_permit_num, $premise_cert_num, $gmp_cert_num, $association_affiliation, $country, $region, $district, $address, $pobox, $phonenumber, $websiteurl, $contact_person, $production_capacity, $storage_capacity, $num_products_produced, $man_power, $plant_manager);
    if ($db->doesUserEmailExist($email)){
        // user already existed
        // $response["error"] = true;
        // $response["error_msg"] = "User already exists with " . $email;
        $message = "<div class=\"alert alert-info\" role=\"alert\">
     <strong>User Exists!</strong> <a href=\"#\" class=\"alert-link\">User with the " .$email. " </a> Already exists.
   </div>";
        // echo json_encode($response);
    } else {

            $user = $db->registerUser($email, $password, $usertype, $account_status);

              if($user){

                $response["error"] = false;
                $response["uid"] = $user["user_unique_id"];
                $response["user"]["user_id"] = $user["user_id"];
                $response["user"]["email"] = $user["email"];
                $response["user"]["usertype"] = $user["usertype"];
                $response["user"]["encrypted_password"] = $user["encrypted_password"];
                $response["user"]["usertype"] = $user["usertype"];
                $response["user"]["account_status"] = $user["account_status"];
                $response["user"]["salt"] = $user["salt"];
                $response["user"]["created_at"] = $user["created_at"];
                $response["user"]["updated_at"] = $user["updated_at"];


              }


            $user_id = $user["user_id"];
          $feed_manufacturer = $db->registerFeedManufacturers($user_id, $companyname, $year_established, $cert_of_incorporation_num, $feedbussiness_permit_num, $premise_cert_num, $gmp_cert_num, $association_affiliation, $country, $region, $district, $address, $pobox, $phonenumber, $websiteurl, $contact_person, $production_capacity, $storage_capacity, $num_products_produced, $man_power, $plant_manager);
          // register new manufacturer
          if ($feed_manufacturer) {
              // user stored successfully
              $response["error"] = false;
              $response["mfuid"] = $feed_manufacturer["feed_manufactures_unique_id"];
              $response["feed_manufacturer"]["feed_manufactures_id"] = $feed_manufacturer["feed_manufactures_id"];
              $response["feed_manufacturer"]["user_id"] = $feed_manufacturer["user_id"];
              $response["feed_manufacturer"]["companyname"] = $feed_manufacturer["companyname"];
              $response["feed_manufacturer"]["cert_of_incorporation_num"] = $feed_manufacturer["cert_of_incorporation_num"];
              $response["feed_manufacturer"]["feedbussiness_permit_num"] = $feed_manufacturer["feedbussiness_permit_num"];
              $response["feed_manufacturer"]["premise_cert_num"] = $feed_manufacturer["premise_cert_num"];
              $response["feed_manufacturer"]["gmp_cert_num"] = $feed_manufacturer["gmp_cert_num"];
              $response["feed_manufacturer"]["association_affiliation"] = $feed_manufacturer["association_affiliation"];
              $response["feed_manufacturer"]["country"] = $feed_manufacturer["country"];
              $response["feed_manufacturer"]["region"] = $feed_manufacturer["region"];
              $response["feed_manufacturer"]["district"] = $feed_manufacturer["district"];
              $response["feed_manufacturer"]["address"] = $feed_manufacturer["address"];
              $response["feed_manufacturer"]["pobox"] = $feed_manufacturer["pobox"];
              $response["feed_manufacturer"]["phonenumber"] = $feed_manufacturer["phonenumber"];
              $response["feed_manufacturer"]["websiteurl"] = $feed_manufacturer["websiteurl"];
              $response["feed_manufacturer"]["contact_person"] = $feed_manufacturer["contact_person"];
              $response["feed_manufacturer"]["storage_capacity"] = $feed_manufacturer["storage_capacity"];
              $response["feed_manufacturer"]["num_products_produced"] = $feed_manufacturer["num_products_produced"];
              $response["feed_manufacturer"]["man_power"] = $feed_manufacturer["man_power"];
              $response["feed_manufacturer"]["plant_manager"] = $feed_manufacturer["plant_manager"];
              $response["feed_manufacturer"]["created_at"] = $feed_manufacturer["created_at"];
              $response["feed_manufacturer"]["updated_at"] = $feed_manufacturer["updated_at"];

              //
              // $message = "<div class=\"alert alert-success\" role=\"alert\">
              //   <strong>Well done!</strong> You successfully registered <a href=\"#\" class=\"alert-link\">a new hatchery</a>.
              // </div>";


              		        // $current_id = $feed_manufacturer["user_id"];
              		        // if(!empty($current_id)) {
              		        // $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."activate_account.php?id=" . $current_id;
              		        // $toEmail = $email;
              		        // $subject = "User Registration Activation Email";
              		        // $content = "Click this link to activate your account. <a href='" . $actual_link . "'>" . $actual_link . "</a>";
              		        // $mailHeaders = "From: Livestoka Admin\r\n";
              		        // if(mail($toEmail, $subject, $content, $mailHeaders)) {
              		        // $message = "<div class=\"alert alert-success\" role=\"alert\">
              		        // <strong>Well done!</strong> You successfully registered check you emails<a href=\"#\" class=\"alert-link\">to activate your account</a>.
              		        // </div>";
              		        // }
              		        // unset($_POST);
              		        // }

                          // now, compose the content of the verification email, it will be sent to the email provided during sign up
                              // generate verification code, acts as the "key"
                              $verificationCode = md5(uniqid("livestokamember", true));

                              // send the email verification
                              $verificationLink = "http://livestoka.com/activate_account.php?code=". $verificationCode;

                              $htmlStr = "";
                              $htmlStr .= "Hi " . $email . ",<br /><br />";

                              $htmlStr .= "Please click the button below to verify your subscription and verify your account <br /><br /><br />";
                              $htmlStr .= "<a href='{$verificationLink}' target='_blank' style='padding:1em; font-weight:bold; background-color:blue; color:#fff;'>VERIFY EMAIL</a><br /><br /><br />";

                              $htmlStr .= "Kind regards,<br />";
                              $htmlStr .= "<a href='http://livestoka.com/' target='_blank'>Industry and Data analytics platform</a><br />";


                              $name = "Industry and Data analytics platform";
                              $email_sender = "denniskilawilla@gmail.com";
                              $subject = "Verification Link | Members Account | Registration Confirmation";
                              $recipient_email = $email;

              //                 // $headers  = "MIME-Version: 1.0\r\n";
              //                 // $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
              //                 // $headers .= "From: {$name} <{$email_sender}> \n";

                                $body = $htmlStr;
                                // send email using the mail function, you can also use php mailer library if you want
                                $mail = NEW PHPMailer;
                                $mail->isSMTP();
                                  //Enable Smtp debug
                                  $mail->SMTPDebug = 2;
                                //Set the Hostname of the email
                                $mail->Host = 'smtp.gmail.com';
                                $mail->Port = 587;
                                $mail->SMTPSecure = 'tls';
                                $mail->SMTPAuth = true;
                                $email->Username = "denniskilawilla@gmail.com";
                                $mail->Password = "starada2dogs";
                                $mail->setFrom('denniskilawilla@gmail.com', 'Stint');
                                //  $mail->addReplyTo('denniskilawilla@gmail.com', 'Stint');
                                $mail->addAddress($email_receiver, 'New Member');
                                $mail->Subject = $subject;
                                $mail->Body = $body;
                                // if( mail($recipient_email, $subject, $body, $headers) ){
                               if($mail->send()){

                               $message = "<div class=\"alert alert-success\" role=\"alert\">
              		        <strong>Well done!</strong> You successfully registered check you emails<a href=\"#\" class=\"alert-link\">to activate your account</a>.
              		         </div>";

                              }else{

                               $message = "<div class=\"alert alert-warning\" role=\"alert\">
              		         <strong>Sorry!</strong> we cant seem to verify you account<a href=\"#\" class=\"alert-link\">click here to resend.</a>.
              		        </div>";
                               echo "Mail error:" . $mail->ErrorInfo;

                               }
          } else {
              // user failed to store
              $response["error"] = true;
              $response["error_msg"] = "Unknown error occurred in registration!";
              echo json_encode($response);
          }


    }

  }
   }else{
  // $username = "";
  $message = "<div class=\"alert alert-info\" role=\"alert\">
    <strong>Take note!</strong> <a href=\"#\" class=\"alert-link\">When registering</a> please fill all the relevant details.
  </div>";
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

    <title>Livestoka | Feed Manufactures Registration </title>

    <!-- Bootstrap core CSS -->
    <link href="http://v4-alpha.getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://v4-alpha.getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>

    <!-- Custom styles for this template -->
    <link href="http://v4-alpha.getbootstrap.com/examples/carousel/carousel.css" rel="stylesheet">

    <link rel="stylesheet" href="../../web/css/bootstrap-datetimepicker.min.css">

    <link rel="stylesheet" href="../../web/css/bootstrap-datetimepicker.min.css">

    <style>
    .card {
         border: transparent;
    }
    </style>
  </head>
  <body>

    <nav class="navbar navbar-default navbar-static-top">
      <a href="../index.php" class="navbar-brand">Back To Livestoka</a>
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
    <div class="container">
      <div class="starter-template">
        <h1>Feed Manufacturers Registration Area</h1>
        <p class="lead">Owner's and operators of Feed Manufactures can Register Below.<br> Please fill all the required Fields.</p>
      </div>
      <!--register section -->
      <section id="manufacturersReg">
        <!-- <form action="feed_manufacture_registry.php" method="post"> -->

   <?php echo $message; ?>
       <?php echo form_errors($errors); ?>
        <form action="register_feeds_manufacturers.php" method="post">
    <!-- company information -->
            <div class="card">
              <div class="card-body">
                <div class="form-group">
                  <label for="formGroupExampleInput"><strong>Company Institution/Manufactures Description</strong></label>
                   <hr>
                </div>

                      <div class="form-group">
                        <label for="lblcompany_name">Company Name</label>
                        <input type="text" class="form-control" id="companyname" name="companyname" value="<?= isset($_POST['companyname']) ? $_POST['companyname'] : ''; ?>" placeholder="">
                      </div>
                      <div class="form-group">
                        <label for="lblyear_established">Year of Establishment</label>
                        <input type="text" class="form-control" id="year_established" onblur="yearValidation(this.value,event)" onkeypress="yearValidation(this.value,event" name="year_established" value="<?= isset($_POST['year_established']) ? $_POST['year_established'] : ''; ?>" placeholder="">
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Certificate of Incoporation Number</label>
                        <input type="text" class="form-control" id="cert_of_incorporation_num"  name="cert_of_incorporation_num" value="<?= isset($_POST['cert_of_incorporation_num']) ? $_POST['cert_of_incorporation_num'] : ''; ?>" placeholder="">
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Feed Business Permit</label>
                        <input type="text" class="form-control" id="feedbussiness_permit_num" name="feedbussiness_permit_num" value="<?= isset($_POST['feedbussiness_permit_num']) ? $_POST['feedbussiness_permit_num'] : ''; ?>" placeholder="">
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Premise Certificate Number</label>
                        <input type="text" class="form-control" id="premise_cert_number" name="premise_cert_num" value="<?= isset($_POST['premise_cert_number']) ? $_POST['confirm_password'] : ''; ?>" placeholder="">
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">GMP certificate number</label>
                        <input type="text" class="form-control" id="gmp_cert_num" name="gmp_cert_num" value="<?= isset($_POST['gmp_cert_num']) ? $_POST['gmp_cert_num'] : ''; ?>" placeholder="">
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Company Association Affiliation. <small>e.g TAFMA, TCPA or TPBA</small></label>
                        <input type="text" class="form-control" id="association_affiliation" name="association_affiliation" value="<?= isset($_POST['association_affiliation']) ? $_POST['association_affiliation'] : ''; ?>" placeholder="">
                      </div>
              </div>
            </div>
            <!-- end of company information -->
              <!-- <hr> -->
            <br />
            <!-- company information -->
            <div class="container">
                    <div class="card">
                      <div class="card-body">

                        <div class="form-group">
                          <label for="formGroupExampleInput"><strong>Company Address and Location</strong></label>
                        <hr>
                        </div>
                        <div class="form-group">
                          <label for="formGroupExampleInput2">Country</label>
                           <select class="form-control" id="country" name="country" value="<?= isset($_POST['country']) ? $_POST['country'] : ''; ?>">
                             <option>SELECT</option>
                             <option>Tanzania</option>
                             <option>Uganda</option>
                             <option>Kenya</option>
                             <option>Rwanda</option>
                           </select>

                        </div>
                        <div class="form-group">
                          <label for="formGroupExampleInput2">Region</label>
                          <input type="text" class="form-control" id="region" name="region" value="<?= isset($_POST['country']) ? $_POST['country'] : ''; ?>" placeholder="">
                        </div>
                        <div class="form-group">
                          <label for="formGroupExampleInput2">District</label>
                          <input type="text" class="form-control" id="district" name="district" value="<?= isset($_POST['district']) ? $_POST['district'] : ''; ?>" placeholder="">
                        </div>
                        <div class="form-group">
                          <label for="exampleTextarea">Address 1</label>
                          <textarea class="form-control" id="address" name="address" rows="3" value="<?= isset($_POST['address']) ? $_POST['address'] : ''; ?>"></textarea>
                        </div>
                        <!-- <div class="form-group">
                          <label for="exampleTextarea">Address 2</label>
                          <textarea class="form-control" id="txt_address_two" name="" rows="3"></textarea>
                        </div> -->
                        <div class="form-group">
                                <label for="formGroupExampleInput2">P.O.Box</label>
                                <input type="text" class="form-control" id="pobox" name="pobox" value="<?= isset($_POST['pobox']) ? $_POST['pobox'] : ''; ?>" placeholder="">
                              </div>
                        <div class="form-group">
                                <label for="formGroupExampleInput2">Office Phone Number 1:</label>
                                <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="<?= isset($_POST['phonenumber']) ? $_POST['phonenumber'] : ''; ?>" placeholder=" ">
                              </div>
                        <!-- <div class="form-group">
                                <label for="formGroupExampleInput2">Office Phone Number 2</label>
                                <input type="text" class="form-control" id="txt_office_num_two" name="" placeholder=" ">
                              </div> -->


                               <div class="form-group">
                                 <label for="formGroupExampleInput2">website</label>
                                 <input type="text" class="form-control" id="websiteurl" name="websiteurl" value="<?= isset($_POST['websiteurl']) ? $_POST['websiteurl'] : ''; ?>" placeholder=" ">
                               </div>

                               <div class="form-group">
                                 <label for="formGroupExampleInput2">Contact Person</label>
                                 <input type="text" class="form-control" id="contact_person" name="contact_person" value="<?= isset($_POST['contact_person']) ? $_POST['contact_person'] : ''; ?>" placeholder=" ">
                               </div>
                         </div>
                      </div>
                    </div>
                     <br />
                      <hr>
                      <br />
                            <!-- company information -->
            <div class="container">
                <div class="card">
                  <div class="card-body">

                    <div class="form-group">
                      <label for="formGroupExampleInput"><strong>Plant Production Information</strong></label>
                    <hr>
                    </div>
                    <div class="form-group">
                      <label for="formGroupExampleInput">Production Capacity</label>
                      <input type="text" class="form-control" id="production_capacity" name="production_capacity" value="<?= isset($_POST['production_capacity']) ? $_POST['production_capacity'] : ''; ?>" placeholder="">
                    </div>
                    <div class="form-group">
                      <label for="formGroupExampleInput2">Storage Capacity</label>
                      <input type="text" class="form-control" id="storage_capacity" name="storage_capacity" value="<?= isset($_POST['storage_capacity']) ? $_POST['storage_capacity'] : ''; ?>" placeholder=" ">
                    </div>
                     <div class="form-group">
                          <label for="formGroupExampleInput2">Number of Products Produced</label>
                          <input type="text" class="form-control" id="num_products_produced" name="num_products_produced" value="<?= isset($_POST['num_products_produced']) ? $_POST['num_products_produced'] : ''; ?>" placeholder=" ">
                          <p>*The number of products entered will be update once a user is succesfully register and logged in. </p>

                        </div>

                        <div class="form-group">
                             <label for="formGroupExampleInput2">Man Power.[Number of Employees] as of Today</label>
                             <input type="text" class="form-control" id="man_power" name="man_power" value="<?= isset($_POST['man_power']) ? $_POST['man_power'] : ''; ?>" placeholder=" ">
                           </div>

                          <div class="form-group">
                                <label for="exampleInputEmail1">Office Email Address</label>
                               <input type="email" class="form-control" id="txt_office_email" name="email" aria-describedby="emailHelp" value="<?= isset($_POST['confirm_password']) ? $_POST['confirm_password'] : ''; ?>" placeholder="Enter email">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                              </div>
                           <div class="form-group">
                                <label for="formGroupExampleInput2">Plant Manager</label>
                                <input type="text" class="form-control" id="plant_manager" name="plant_manager" value="<?= isset($_POST['plant_manager']) ? $_POST['plant_manager'] : ''; ?>" placeholder=" ">

                              <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value="<?= isset($_POST['password']) ? $_POST['password'] : ''; ?>" placeholder="Password" onkeyup='check();'>

                                <label for="exampleInputConfirmPassword2">Confirm Password</label>
                                  <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="<?= isset($_POST['confirm_password']) ? $_POST['confirm_password'] : ''; ?>" placeholder="Confirm Password" onkeyup='check();'>
                                 <span id='message'></span>
                              </div>

                              <button type="submit"  name="submit" class="btn btn-primary btn-lg" value="Submit">Register</button>

                         </form>
                    </div>
                  </div>
                  <hr>
               </div>
      </section>

      <!--end of registeration section -->

    </div> <!-- /.container-->

    <!-- jQuery first, then Bootstrap JS. -->
    <!--scripts -->
    <script>
    function yearValidation(year,ev) {

  var text = /^[0-9]+$/;
  if(ev.type=="blur" || year.length==4 && ev.keyCode!=8 && ev.keyCode!=46) {
    if (year != 0) {
        if ((year != "") && (!text.test(year))) {

            alert("Please Enter Numeric Values Only");
            document.getElementById("year_established").focus();
            document.getElementById('year_established').value = '';
            return false;
        }

        if (year.length != 4) {
            alert("Year is not proper. Please check");
            document.getElementById("year_established").focus();
            document.getElementById('year_established').value = '';
            return false;

        }
        var current_year=new Date().getFullYear();
        if((year < 1920) || (year > current_year))
            {
            alert("Year should be in range 1920 to current year");
            document.getElementById("year_established").focus();
            document.getElementById('year_established').value = '';
            return false;

            }
        return true;
    } }
  }


  var check = function() {
       if (document.getElementById('password').value ==
           document.getElementById('confirm_password').value) {
           document.getElementById('message').style.color = 'green';
           document.getElementById('message').innerHTML = 'matching';
       } else {
          document.getElementById('message').style.color = 'red';
           document.getElementById('message').innerHTML = 'passwords dont match';
       }
   }

    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
  </body>
</html>
