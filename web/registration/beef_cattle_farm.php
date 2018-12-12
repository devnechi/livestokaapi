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
            $usertype = "dairy ";
            $account_status = "pending approval";
            $phoneNumber = $_POST['phonenumbers'];
            $owners_full_name = $_POST['owners_full_name'];

            $farm_name = $_POST['farm_name'];
            $type_of_ownership = $_POST['type_of_ownership'];
            $date_established = $_POST['date_established'];
            $reg_number = $_POST['reg_number'];
            $owners_full_name = $_POST['owners_full_name'];
     
              // beef
             $typeofbeefs = $_POST['typeofbeef'];

             //contact
             $websiteurl = $_POST['websiteurl'];
             $contact_person = $_POST['contact_person'];
             $country = $_POST['country'];
             $region = $_POST['region'];
             $district = $_POST['district'];
             $address = $_POST['address'];
             $pobox = $_POST['pobox'];
             $phonenumber = $_POST['phonenumber'];




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
                    $user = $db->registerUser( $email, $password, $usertype, $account_status);

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
                    $beef = $db->registerNewBeefFarm(
                $user_id,
                $beef_farm_name,
                $year_established,                
                $reg_number,                
                $owners_full_name,
                $affiliation,
                $country,
                $region,
                $district,
                $pobox,
                $websiteurl,
                $address,
                $typeofbeef
                
                );
                    // register new manufacturer
                    if ($beef) {
                        // user stored successfully
                        $response["error"] = false;
                        $response["htuid"] = $beef["beef_unique_id"];
                        $response["beef"]["beef_id"] = $beef["beef_id"];
                        $response["beef"]["user_id"] = $beef["user_id"];
                        $response["beef"]["beef_farm_name"] = $beef["beef_name"];
                        $response["beef"]["year_established"] = $beef["year_established"];
                        $response["beef"]["reg_number"] = $beef["reg_number"];
                        $response["beef"]["owner_full_name"] = $beef["owner_full_name"];
                        $response["beef"]["country"] = $beef["country"];
                        $response["beef"]["region"] = $beef["region"];
                        $response["beef"]["district"] = $beef["district"];
                        $response["beef"]["pobox"] = $beef["pobox"];
                        $response["beef"]["address"] = $beef["address"];
                        $response["beef"]["phone_number[]"] = $beef["phone_number[]"];
                       
                        $message = "<div class=\"alert alert-success\" role=\"alert\">
                <strong>Well done!</strong> You successfully registered <a href=\"#\" class=\"alert-link\">a new beef</a>.
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

    <title>Livestoka | beef Owners Registration </title>

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
        <h1>Beef Farm Registration Area</h1>
        <p class="lead"> Please fill all the required Fields.</p>
      </div>
      <!--register section -->
      <section id="manufacturersReg">
        <!-- <form action="feed_manufacture_registry.php" method="post"> -->

   <?php //echo $message; ?>
       <?php
        //echo form_errors($errors);
         ?>
        <form action="beef_reg.php" method="post">
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
            
                    
                      

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="farm_name">Farm Name</label>
                        <input type="text" class="form-control" id="farm_name" name="farm_name" value="<?= isset($_POST['farm_name']) ? $_POST['farm_name'] : ''; ?>" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Type of Ownership</label>
                         <select class="form-control" id="type_of_ownership" name="type_of_ownership" value="<?= isset($_POST['type_of_ownership']) ? $_POST['type_of_ownership'] : ''; ?>">
                           <option >SELECT</option>
                           <option value="Sole">Sole Proprietorship (individual or family)</option>
                           <option value="liabilityco">Liability Company</option>
                           <option value="noneliabilityco">Non-Liability (NGO, Government, project etc)</option>
                         </select>

                      </div>
                    </div>
                  </div>

                <div class="row">
                  <div class="col-md-6">
                    <!-- <div class="form-group">
                      <label for="lblyear_established">Date of Establishment<small> (dd/mm/yy)</small></label>
                      <input type="text" class="form-control" id="year_established" onblur="yearValidation(this.value,event)" onkeypress="yearValidation(this.value,event" name="year_established"  value="<?= isset($_POST['year_established']) ? $_POST['year_established'] : ''; ?>" placeholder="">
                    </div> -->
                    <label for="lblyear_established">Date of Establishment<small> (dd/mm/yy)</small></label>
                    <div class="form-group input-group datetimepicker">
                        <input type="text" class="form-control"  id="date_established" name="date_established" value="<?= isset($_POST['date_established']) ? $_POST['date_established'] : ''; ?>">
                        <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="breed_reg_number">Registration Number</label>
                      <input type="text" class="form-control " id="breed_reg_number" name="breed_reg_number"  value="<?= isset($_POST['breed_reg_number']) ? $_POST['breed_reg_number'] : ''; ?>" placeholder="">
                    </div>
                  </div>
                </div>

              <div class="form-group">
                <label for="lbl_owners_full_name">Owner's Full Name <small>(individual, corporate body, etc)</small></label>
                <input type="text" class="form-control" id="owners_full_name"  name="owners_full_name"  value="<?= isset($_POST['owners_full_name']) ? $_POST['owners_full_name'] : ''; ?>" placeholder="">
              </div>
              <div class="form-group col-md-6">
                <div class="form-group multiple-form-group" data-max=6>
                  <label for="formGroupExampleInput2">breeder Affiliations. <small>(e.g TPBA, TCPA, CTA, CTI)</small></label>
                  <div class="form-group input-group">
                    <input type="text" name="affiliation[]" class="form-control">
                      <span class="input-group-btn"><button type="button" class="btn btn-default btn-add">+
                      </button></span>
                  </div>
                </div>
              </div>
            
            
                        <div class="form-group">
                          <label for="address"><strong>Farm  Address and Location</strong></label>
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
                        <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="formGroupExampleInput"><strong>farm Capacity</strong></label>
                            <hr>
                          </div>
                        </div>
                        <div class="col-md-9">
                          <div class="form-group">
                            <label for="lbl_maximum_flock_size">Maximum Flock Size</label>
                            <input type="text" class="form-control" id="maximum_flock_size" name="maximum_flock_size" value="<?= isset($_POST['maximum_flock_size']) ? $_POST['maximum_flock_size'] : ''; ?>" placeholder=" ">
                          </div>
                          <div class="form-group">
                            <label for="lbltotal_peryear_capacity">Total Per Year Capacity</label>
                            <input type="text" class="form-control" id="total_peryear_capacity" name="total_peryear_capacity" value="<?= isset($_POST['total_peryear_capacity']) ? $_POST['total_peryear_capacity'] : ''; ?>" placeholder=" ">
                          </div>
                        </div>
                        <div class="form-group multiple-form-group" data-max=6>
                                   <label for="formGroupExampleInput2">Beef <small>(e.g. sosage, haifer, nundu)</small></label>
                                   <div class="form-group input-group">
                                     <input type="text" name="typeofbeef[]" id="typeofbeef" class="form-control" >
                                       <span class="input-group-btn"><button type="button" class="btn btn-default btn-add">+
                                       </button></span>
                                   </div>
                               </div>
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
