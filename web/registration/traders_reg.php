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

        if (isset($_POST["submit"])) {
            // receiving the post params
            // user businessDetails$account_status = "pending approval";
            // $fname = $_POST['first_name'];
            //$lname = $_POST['year_established'];

            //user details
            $email = $_POST['contact_email'];
            $password = $_POST['password'];
            //TYPE OF PROCESSING ACTIVITIES
            $usertype = "Processor ";
            $account_status = "pending approval";
            $phoneNumber = $_POST['phonenumbers'];
            $owners_full_name = $_POST['owners_full_name'];

            $farm_name = $_POST['farm_name'];
            $type_of_ownership = $_POST['type_of_ownership'];
            $date_established = $_POST['date_established'];
            $reg_number = $_POST['reg_number'];
            $owners_full_name = $_POST['owners_full_name'];
     
              // trader
             $typeoftraders = $_POST['typeoftrader'];

             //contact
             $websiteurl = $_POST['websiteurl'];
             $contact_person = $_POST['contact_person'];
             $country = $_POST['country'];
             $region = $_POST['region'];
             $district = $_POST['district'];
             $address = $_POST['address'];
             $pobox = $_POST['pobox'];
             $phonenumber = $_POST['phonenumber'];





            if (isset($_POST['concerned'])) {
                $type_consern = $_POST['concerned'];

                echo "You chose the following color(s): <br>";
                foreach ($type_consern as $concerned) {
                    echo $concerned."<br />";
                }
            } // end brace for if(isset
            else {
                echo "You did not choose a color.";
            }

            // check if passwords match
            if ($password !=  $_POST['confirm_password']) {
                $message = "<div class=\"alert alert-info\" role=\"alert\">
        <strong>Match problem!</strong> <a href=\"#\" class=\"alert-link\">passwords don't match </a> and try submitting again.
      </div>";
            }

            if (empty($errors)) {
                // registerFeedManufacturers($user_id, $companyname, $year_established, $cert_of_incorporation_num, $feedbussiness_permit_num, $premise_cert_num, $gmp_cert_num, $association_affiliation, $country, $region, $district, $address, $pobox, $phonenumber, $websiteurl, $contact_person, $production_capacity, $storage_capacity, $num_products_produced, $man_power, $plant_manager);
                if ($db->doesUserEmailExist($email)) {
                    // user already existed
                    // $response["error"] = true;
                    // $response["error_msg"] = "User already exists with " . $email;
                    $message = "<div class=\"alert alert-info\" role=\"alert\">
             <strong>User Exists!</strong> <a href=\"#\" class=\"alert-link\">User with the " .$email. " </a> Already exists.
           </div>";
                // echo json_encode($response);
                } else {
                    $user = $db->registerProcessorFarmUser($fname, $lname, $email, $password, $usertype, $account_status);

                    if ($user) {
                        $response["error"] = false;
                        $response["uid"] = $user["user_unique_id"];
                        $response["user"]["user_id"] = $user["user_id"];
                        $response["user"]["first_name"] = $user["first_name"];
                        $response["user"]["year_established"] = $user["year_established"];
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

                    // create a new user
                    $trader = $db->registerNewProcessor(
                $user_id,
                $trader_farm_name,
                $year_established,                
                $reg_number,                
                $owners_full_name,
                $affiliation,
                $country,
                $region,
                $district,
                $pobox,
                $websiteurl,
                $address
                
                );
                    // register new manufacturer
                    if ($trader) {
                        // user stored successfully
                        $response["error"] = false;
                        $response["htuid"] = $trader["trader_unique_id"];
                        $response["trader"]["trader_id"] = $trader["trader_id"];
                        $response["trader"]["user_id"] = $trader["user_id"];
                        $response["trader"]["trader_farm_name"] = $trader["trader_name"];
                        $response["trader"]["year_established"] = $trader["year_established"];
                        $response["trader"]["reg_number"] = $trader["reg_number"];
                        $response["trader"]["owner_full_name"] = $trader["owner_full_name"];
                        $response["trader"]["country"] = $trader["country"];
                        $response["trader"]["region"] = $trader["region"];
                        $response["trader"]["district"] = $trader["district"];
                        $response["trader"]["pobox"] = $trader["pobox"];
                        $response["trader"]["address"] = $trader["address"];
                        $response["trader"]["phone_number[]"] = $trader["phone_number[]"];
                       
                        $message = "<div class=\"alert alert-success\" role=\"alert\">
                <strong>Well done!</strong> You successfully registered <a href=\"#\" class=\"alert-link\">a new trader</a>.
                </div>";
                    }
                }
            } else {
                $username = "";
                $message = "<div class=\"alert alert-info\" role=\"alert\">
         <strong>Take note!</strong> <a href=\"#\" class=\"alert-link\">When registering</a> please fill all the relevant details.
       </div>";
            }
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

    <title>Livestoka | trader Owners Registration </title>

    <!-- Bootstrap core CSS -->
    <link href="http://v4-alpha.getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://v4-alpha.getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>

    <!-- Custom styles for this template -->
    <link href="http://v4-alpha.getbootstrap.com/examples/carousel/carousel.css" rel="stylesheet">

    
  </head>
  <body>

    <nav class="navbar navbar-default navbar-static-top">
      <a href="/../../web/index.php" class="navbar-brand">Back To Livestoka</a>
    </nav>
    <div class="row">
   <div class="col-md-12">

    <div class="container">
      <div class="starter-template">
        <h1>Processor Farm Registration Area</h1>
        <p class="lead"> Please fill all the required Fields.</p>
      </div>
      <!--register section -->
      <section id="manufacturersReg">
        <!-- <form action="feed_manufacture_registry.php" method="post"> -->

   <?php //echo $message; ?>
       <?php
        //echo form_errors($errors);
         ?>
        <form action="trader_reg.php" method="post">
    <!-- company information -->
            <div class="card">
              <div class="card-body">
                <div class="form-group">
                  <label for="formGroupExampleInput"><strong>Farm particulars</strong></label>
                   <hr>
                </div>
               
                </div>
                      
              </div>
            
            <!-- end of company information -->
              <!-- <hr> -->
    
            <!-- company information -->
            
                    
                      
                      
                    <div class="form-group">
                    <label for="trader_farm_name">First Name</label>
                      <input type="text" class="form-control" id="trader_farm_name" name="trader_farm_name" value="<?= isset($_POST['trader_farm_name']) ? $_POST['first_name'] : ''; ?>" placeholder="trader_farm_name" onkeyup='check();'>
                    </div>
                  
                  
                    <div class="form-group">
                     <label for="year_established">year established</label>
                       <input type="text" class="form-control" id="las" name="year_established" value="<?= isset($_POST['year_established']) ? $_POST['year_established'] : ''; ?>" placeholder="year_established" onkeyup='check();'>
                      <!-- <span id='message'></span> -->
                     </div>
                     <div class="form-group">
                     <label for="reg_number">Registration Number</label>
                       <input type="text" class="form-control" id="reg_number" name="reg_number" value="<?= isset($_POST['reg_number']) ? $_POST['reg_number'] : ''; ?>" placeholder="reg_number" onkeyup='check();'>
                      <!-- <span id='message'></span> -->
                     </div>
                     <div class="form-group">
                     <label for="owner_full_name">owner_full_name"</label>
                       <input type="text" class="form-control" id="owner_full_name" name="owner_full_name" value="<?= isset($_POST['owner_full_name']) ? $_POST['owner_full_name"'] : ''; ?>" placeholder="owner_full_name" onkeyup='check();'>
                      <!-- <span id='message'></span> -->
                     </div>
                        <div class="form-group">
                          <label for="address"><strong>traders Address and Location</strong></label>
                        <hr>
                        </div>
                        <div class="form-group">
                          <label class="control-label" for="countryList">Country</label>
                           <select class="form-control" id="country" name="country" >
                             <option>SELECT</option>
                             <option>Tanzania</option>
                             <option>Uganda</option>
                             <option>Kenya</option>
                             <option>Rwanda</option>
                           </select>

                        </div>
                        <div class="form-group">
                          <label for="countryList">Region</label>
                           <select class="form-control" id="country" name="country" >
                             <option>SELECT</option>
                             <option>Dar es Salaam</option>
                             <option>Mwanza</option>
                             <option>Arusha</option>
                             <option>Mara</option>
                             <option>Mbeya</option>
                             <option>Pwani</option>
                           </select>

                        </div>
                        <div class="form-group">
                          <label for="countryList">District</label>
                           <select class="form-control" id="country" name="country" >
                             <option>SELECT</option>
                             <option>Ilala</option>
                             <option>Kinondoni</option>
                             <option>Temeke</option>
                             <option>Kigamboni</option>
                           </select>

                        </div>
                        <div class="form-group">
                          <label for="exampleTextarea">Address</label>
                          <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                        </div>
                      
                        <div class="form-group">
                                <label for="formGroupExampleInput2">P.O.Box</label>
                                <input type="text" class="form-control" id="pobox" name="poboxnum" placeholder="" >
                              </div>
                        <div class="form-group">
                                <label for="formGroupExampleInput2">Office Phone Number:</label>
                                <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder=" ">
                              </div>
                       
             
                     <div class="form-group">
                       <label for="formGroupExampleInput2">Contact email</label>
                       <input type="email" class="form-control" id="email" name="email"  placeholder=" ">
                     </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                          <input type="password" class="form-control" id="password" name="password"  placeholder="Password" onkeyup='check();'>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                         <label for="exampleInputConfirmPassword2">Confirm Password</label>
                           <input type="password" class="form-control" id="confirm_password" name="confirm_password"  placeholder="Password" onkeyup='check();'>
                           <span id='message'></span>
                         </div>
                      </div>
                    </div>
                      <div class="form-group">
                      <button type="submit"  name="submit" class="btn btn-primary btn-lg" value="Submit">Register</button>
                          </div>
                       </form>
                  </div>
                </div>
                <hr>
               </div>
      </section>

      <!--end of registeration section -->

    </div> <!-- /.container-->

    <!--scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
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
           document.getElementById('message').innerHTML = 'not matching';
       }
   }

    </script>
    <!-- jQuery first, then Bootstrap JS. -->
  
  </body>
</html>
