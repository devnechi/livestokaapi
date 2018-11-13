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
            //$lname = $_POST['last_name'];

            //user details
            $email = $_POST['contact_email'];
            $password = $_POST['password'];
            //TYPE OF BREEDING ACTIVITIES
            $usertype = "Breed User";
            $account_status = "pending approval";
            $phone_number = $_POST['phone_number'];
            $owners_full_name = $_POST['owners_full_name'];


            $farm_name = $_POST['farm_name'];
            $type_of_ownership = $_POST['type_of_ownership'];
            $date_established = $_POST['date_established'];
            $hatch_reg_number = $_POST['hatch_reg_number'];
            $owners_full_name = $_POST['owners_full_name'];
            //$breed_affiliation[]
            $affiliation = $_POST['breed_affiliation'];
            $breed_manager = $_POST['breed_manager'];
            $breed_veterinarian = $_POST['breed_veterinarian'];
            $vet_reg_number = $_POST['vet_reg_number'];

            // breeding purposes
            
            $grandparent_stock_chicks = $_POST['grandparent_stock_chicks'];
            $parent_stock_chicks = $_POST['parent_stock_chicks'];

            //type of breed
            $broiler = $_POST['broiler'];
            $layers =  $_POST['layers'];
            $dual_purpose = $_POST['dual_purpose'];

              // Breed
             $typeofbreeds = $_POST['typeofBreed'];

            //type of poultry hacthing
            $breeding_fowls = $_POST['breeding_chicken'];
            $breeding_turkey = $_POST['breeding_turkey'];
            $breeding_ducks = $_POST['breeding_ducks'];
            $breeding_geese = $_POST['breeding_geese'];
            $breeding_guinea_fowls = $_POST['breeding_guinea_fowls'];
            $breeding_quails = $_POST['breeding_quails'];
            $breeding_ostrich = $_POST['breeding_ostrich'];

            //source of eggs by the hatcher
            $local_source_parent_stock = $_POST['local_source_parent_stock'];
            $import_source_parent_stock = $_POST['import_source_parent_stock'];
            $local_source_grandparent_stock= $_POST['local_source_grandparent_stock'];
            $import_source_grandparent_stock = $_POST['import_source_grandparent_stock'];

            //breed Capacity
            $total_incubator_capacity = $_POST['maximumu_flock_size'];
            $total_hatcher_capacity = $_POST['total_breed_capacity'];

             //
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
                    $user = $db->registerBreederFarmUser($fname, $lname, $email, $password, $usertype, $account_status);

                    if ($user) {
                        $response["error"] = false;
                        $response["uid"] = $user["user_unique_id"];
                        $response["user"]["user_id"] = $user["user_id"];
                        $response["user"]["first_name"] = $user["first_name"];
                        $response["user"]["last_name"] = $user["last_name"];
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
                    $breed = $db->registerNewHatchery(
                $user_id,
                $breeder_farm_name,
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
                $contact_person,
                $maximum_flock_size,
                $total_peryear_capacity,
                $num_breeds_hatched,
                $vet_reg_number,
                $local_source_parent_stock[],
                $local_source_parent_stock[],
                $local_source_parent_stock[],
                $local_source_parent_stock[],
                $breed_veterinarian,
                $breed_manager,
                $typeofBreed[],
                $breeding_chicken,
                $breeding_turkey,
                $breeding_ducks,
                $breeding_quails,
                $breeding_ostrich,
                $broiler.
                $layers, 
                $dual_purpose,
                $grandparent_stock_chicks,
                $grandparent_stock_chicks
                );
                    // register new manufacturer
                    if ($breed) {
                        // user stored successfully
                        $response["error"] = false;
                        $response["htuid"] = $breed["breed_unique_id"];
                        $response["breed"]["breed_id"] = $breed["breed_id"];
                        $response["breed"]["user_id"] = $breed["user_id"];
                        $response["breed"]["breed_farm_name"] = $breed["breed_name"];
                        $response["breed"]["year_established"] = $breed["year_established"];
                        $response["breed"]["reg_number"] = $breed["reg_number"];
                        $response["breed"]["owner_full_name"] = $breed["owner_full_name"];
                        $response["breed"]["affiliation"] = $breed["affiliation"];
                        $response["breed"]["country"] = $breed["country"];
                        $response["breed"]["region"] = $breed["region"];
                        $response["breed"]["district"] = $breed["district"];
                        $response["breed"]["pobox"] = $breed["pobox"];
                        $response["breed"]["address"] = $breed["address"];
                        $response["breed"]["phone_number[]"] = $breed["phone_number[]"];
                        $response["breed"]["maximum_flock_size"] = $breed["maximum_flock_size"];
                        $response["breed"]["total_peryear_capacity"] = $breed["total_peryear_capacity"];                  
                        $response["breed"]["local_source_parent_stock[]"] = $breed["local_source_parent_stock[]"];
                        $response["breed"]["imported_source_parent_stock[]"] = $breed["imported_source_parent_stock[]"];
                        $response["breed"]["local_source_grandparent_stock[]"] = $breed["local_source_grandparent_stock[]"];
                        $response["breed"]["imported_source_grandparent_stock[]"] = $breed["imported_source_grandparent_stock[]"];
                        $response["breed"][" breed_manager"] = $breed["breed_manager"];
                        $response["breed"]["breed_veterinarian"] = $breed["breed_veterinarian"];
                        $response["breed"]["vet_reg_number"] = $breed["vet_reg_number"];
                      
                        $message = "<div class=\"alert alert-success\" role=\"alert\">
                <strong>Well done!</strong> You successfully registered <a href=\"#\" class=\"alert-link\">a new breed</a>.
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

    <title>Livestoka | Breeder Flock farm Registration </title>

    <!-- Bootstrap core CSS -->
    <link href="http://v4-alpha.getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://v4-alpha.getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>

    <!-- Custom styles for this template -->
    <link href="http://v4-alpha.getbootstrap.com/examples/carousel/carousel.css" rel="stylesheet">
    <link rel="stylesheet" href="../../web/css/style2.css">
    <link rel="stylesheet" href="../../web/css/bootstrap-datetimepicker.min.css">


    <style>
    .card {
         border: transparent;
    }

    /* The customcheck */
.customcheck {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default checkbox */
.customcheck input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border-radius: 5px;
}

/* On mouse-over, add a grey background color */
.customcheck:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.customcheck input:checked ~ .checkmark {
    background-color: #02cf32;
    border-radius: 5px;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.customcheck input:checked ~ .checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.customcheck .checkmark:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}


@import('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.0/css/bootstrap.min.css')

.funkyradio div {
  clear: both;
  overflow: hidden;
}

.funkyradio label {
  width: 100%;
  border-radius: 3px;
  border: 1px solid #D1D3D4;
  font-weight: normal;
}

.funkyradio input[type="radio"]:empty,
.funkyradio input[type="checkbox"]:empty {
  display: none;
}

.funkyradio input[type="radio"]:empty ~ label,
.funkyradio input[type="checkbox"]:empty ~ label {
  position: relative;
  line-height: 2.5em;
  text-indent: 3.25em;
  margin-top: 2em;
  cursor: pointer;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
}

.funkyradio input[type="radio"]:empty ~ label:before,
.funkyradio input[type="checkbox"]:empty ~ label:before {
  position: absolute;
  display: block;
  top: 0;
  bottom: 0;
  left: 0;
  content: '';
  width: 2.5em;
  background: #D1D3D4;
  border-radius: 3px 0 0 3px;
}

.funkyradio input[type="radio"]:hover:not(:checked) ~ label,
.funkyradio input[type="checkbox"]:hover:not(:checked) ~ label {
  color: #888;
}

.funkyradio input[type="radio"]:hover:not(:checked) ~ label:before,
.funkyradio input[type="checkbox"]:hover:not(:checked) ~ label:before {
  content: '\2714';
  text-indent: .9em;
  color: #C2C2C2;
}

.funkyradio input[type="radio"]:checked ~ label,
.funkyradio input[type="checkbox"]:checked ~ label {
  color: #777;
}

.funkyradio input[type="radio"]:checked ~ label:before,
.funkyradio input[type="checkbox"]:checked ~ label:before {
  content: '\2714';
  text-indent: .9em;
  color: #333;
  background-color: #ccc;
}

.funkyradio input[type="radio"]:focus ~ label:before,
.funkyradio input[type="checkbox"]:focus ~ label:before {
  box-shadow: 0 0 0 3px #999;
}

.funkyradio-default input[type="radio"]:checked ~ label:before,
.funkyradio-default input[type="checkbox"]:checked ~ label:before {
  color: #333;
  background-color: #ccc;
}

.funkyradio-primary input[type="radio"]:checked ~ label:before,
.funkyradio-primary input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #337ab7;
}

.funkyradio-success input[type="radio"]:checked ~ label:before,
.funkyradio-success input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #5cb85c;
}

.funkyradio-danger input[type="radio"]:checked ~ label:before,
.funkyradio-danger input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #d9534f;
}

.funkyradio-warning input[type="radio"]:checked ~ label:before,
.funkyradio-warning input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #f0ad4e;
}

.funkyradio-info input[type="radio"]:checked ~ label:before,
.funkyradio-info input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #5bc0de;
}
.entry:not(:first-of-type)
{
    margin-top: 10px;
}

.glyphicon
{
    font-size: 12px;
}
    </style>
  </head>
  <body>

    <nav class="navbar navbar-default navbar-static-top">
      <a href="../index.php" class="navbar-brand">Back To Livestoka</a>
    </nav>


    <div class="container">
      <div class="starter-template">
        <h1>Breeder Flock Farm Regitration</h1>
        <!-- <p class="lead">Owner's and operators of Feed Manufactures can Register Below.<br> Please fill all the required Fields.</p> -->
      </div>
      <!--register section -->
      <section id="manufacturersReg">
        <!-- <form action="feed_manufacture_registry.php" method="post"> -->

   <?php //echo $message;?>
       <?php
        //echo form_errors($errors);
         ?>
      
        <form action="breeder_flock_farm_reg.php" method="post">
    <!-- company information -->
            <div class="card">
              <div class="card-body">
                <div class="form-group">
                  <label for="formGroupExampleInput"><strong>Farm Description</strong></label>
                   <hr>
                </div>
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
                           <option>SELECT</option>
                           <option>Sole Proprietorship (individual or family)</option>
                           <option>Liability Company</option>
                           <option>Non-Liability (NGO, Government, project etc)</option>
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
                        <input type="text" class="form-control"  id="date_established" name="date_established" placeholder="date established">
                        <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="lblyear_established">Registration Number</label>
                      <input type="text" class="form-control" id="reg_number" name="reg_number"  value="<?= isset($_POST['reg_number']) ? $_POST['reg_number'] : ''; ?>" placeholder="">
                    </div>
                  </div>
                </div>

              <div class="form-group">
                <label for="lbl_owners_full_name">Owner's Full Name <small>(individual, corporate body, etc)</small></label>
                <input type="text" class="form-control" id="owner_full_name"  name="owner_full_name"  value="<?= isset($_POST['owner_full_name']) ? $_POST['owner_full_name'] : ''; ?>" placeholder="">
              </div>
              <div class="form-group ">
                <div class="form-group multiple-form-group" data-max=6>
                  <label for="formGroupExampleInput2"> Affiliations. <small>(e.g TPBA, TCPA, CTA, CTI)</small></label>
                  <div class="form-group input-group">
                    <input type="text" name="affiliation[]" class="form-control">
                      <span class="input-group-btn"><button type="button" class="btn btn-default btn-add">+
                      </button></span>
                  </div>
                </div>
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
                    <label for="formGroupExampleInput"><strong>Farm Address and Location</strong></label>
                  <hr>
                  </div>
                  <div class="form-group">
                    <label for="country">Country</label>
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
                    <input type="text" class="form-control" id="region" name="region" value="<?= isset($_POST['region']) ? $_POST['region'] : ''; ?>" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="formGroupExampleInput2">District</label>
                    <input type="text" class="form-control" id="district" name="district" value="<?= isset($_POST['district']) ? $_POST['district'] : ''; ?>" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="exampleTextarea">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3" value="<?= isset($_POST['address']) ? $_POST['address'] : ''; ?>"></textarea>
                  </div>

              <div class="form-group ">
                      <div class="form-group multiple-form-group" data-max=6>
                        <label for="formGroupExampleInput2">Office Phone Number:</label>
                        <div class="form-group input-group">
                          <input type="text" name="phone_number[]" class="form-control">
                            <span class="input-group-btn"><button type="button" class="btn btn-default btn-add">+
                            </button></span>
                        </div>
                    </div>
                  </div>

                <div class="form-group">
                  <label for="formGroupExampleInput"><strong>Key Personnel</strong></label>
                  <hr>
                </div>

                <div class="form-group ">
                  <label for="formGroupExampleInput2" class="control-label">Farm Manager:</label>
                  <input type="text" class="form-control" id="farm_manager" name="farm_manager" value="<?= isset($_POST['farm_manager']) ? $_POST['farm_manager'] : ''; ?>" placeholder=" ">
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="breed_veterinarian" class="control-label">Farm Veterinarian:</label>
                      <input type="text" class="form-control" id="breed_veterinarian" name="breed_veterinarian" value="<?= isset($_POST['breed_veterinarian']) ? $_POST['breed_veterinarian'] : ''; ?>" placeholder=" ">
                    </div>
                  </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="lbl_vet_reg_number" class="control-label">Vet Reg Number (Individual or Corporate):</label>
                        <input type="text" class="form-control" id="vet_reg_number" name="vet_reg_number" value="<?= isset($_POST['vet_reg_number']) ? $_POST['vet_reg_number'] : ''; ?>" placeholder=" ">
                      </div>
                    </div>
                </div>

               </div>
               </div>
               </div>
               <br />
                <br />
                <!-- company information -->
              <div class="container">
                <div class="card">
                  <div class="card-body">
                      <div class="form-group">
                        <label for="lblestablishment_activities"><strong>Establishment Activities</strong></label>
                        <hr>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <p>Type of Breeding Activities.</p>
                            <div class="form-check">
                               
                                <label class="customcheck" style="font-size: 18px;"> Grandparent stock chicks
                                  <input type="checkbox" name="grandparent_stock_chicks" id="grandparent_stock_chicks" value="grandparent_stock_chicks">
                                  <span class="checkmark"></span>
                                </label>
                                <label class="customcheck" style="font-size: 18px;"> Parent stock chicks
                                  <input type="checkbox" name="parent_stock_chicks" id="parent_stock_chicks" value="parent_stock_chicks">
                                  <span class="checkmark"></span>
                                </label>
                            </div>
                          </div>
                          </div>
                        </div>
                    <div class="form-group">
                      <!-- <label for="formGroupExampleInput"><strong>Establishment Focus.</strong></label> -->
                      <hr>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-6">
                             <label for="formGroupExampleInput2">Breeding Purpose.<small>(*click to select)</small></label>
                            <div class="form-check">
                                <label class="customcheck" style="font-size: 18px;">Broilers
                                  <input type="checkbox" checked="checked" name="broiler" id="broiler" value="broilers">
                                  <span class="checkmark"></span>
                                </label>
                                <label class="customcheck" style="font-size: 18px;"> Layers
                                  <input type="checkbox" name="layers" id="layers" value="layers">
                                  <span class="checkmark"></span>
                                </label>
                                <label class="customcheck" style="font-size: 18px;">Dual purpose
                                  <input type="checkbox" name="dual_purpose" id="dual_purpose" value="dual purpose">
                                  <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>

                       <div class="col-md-6">
                         <div class="form-group col-md-6">
                                 <div class="form-group multiple-form-group" data-max=6>
                                   <label for="formGroupExampleInput2">Breed <small>(e.g. Cobb 500, Sasso, Kruoiler)</small></label>
                                   <div class="form-group input-group">
                                     <input type="text" name="typeofBreed[]" id="typeofBreed" class="form-control">
                                       <span class="input-group-btn"><button type="button" class="btn btn-default btn-add">+
                                       </button></span>
                                   </div>
                               </div>
                             </div>
                           </div>
                         	</div>
                         </div>
                       </div>
                      </div>
                    </div>
                    <hr>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-6">
                             <label for="formGroupExampleInput2">Poultry Type(s) <small>(*click to select)</small></label>
                          <div class="form-check">
                              <label class="customcheck" style="font-size: 18px;">Chicken
                                <input type="checkbox" checked="checked" name="breeding_chicken" id="breeding_chicken" value="chicken">
                                <span class="checkmark"></span>
                              </label>
                              <label class="customcheck" style="font-size: 18px;"> Turkey
                                <input type="checkbox" name="breeding_turkey" id="breeding_turkey" value="turkey">
                                <span class="checkmark"></span>
                              </label>
                              <label class="customcheck" style="font-size: 18px;">Ducks
                                <input type="checkbox" name="breeding_ducks" id="breeding_ducks" value="ducks">
                                <span class="checkmark"></span>
                              </label>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-check" style="padding-top: 26px;">
                          <label class="customcheck" style="font-size: 18px;">Geese
                            <input type="checkbox" name="breeding_geese" id="breeding_geese" value="geese">
                            <span class="checkmark"></span>
                          </label>
                          <label class="customcheck" style="font-size: 18px;">Guinea fowls
                            <input type="checkbox" name="breeding_guinea_fowls" id="breeding_guinea_fowls" value="guinea_fowls">
                            <span class="checkmark"></span>
                          </label>
                          </div>

                        </div>
                        <div class="col-md-6">
                          <div class="form-check">
                          <label class="customcheck" style="font-size: 18px;">Quails
                            <input type="checkbox" name="breeding_quails" id="breeding_quails" value="quails">
                            <span class="checkmark"></span>
                          </label>
                          <label class="customcheck" style="font-size: 18px;">Ostrich
                            <input type="checkbox" name="breeding_ostrich" id="breeding_ostrich" value="ostrich">
                            <span class="checkmark"></span>
                          </label>
                          </div>
                        </div>

                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                               <label for="formGroupExampleInput2">Local Source Parent Stock <small>(*click to select)</small></label>
                               <div class="form-group multiple-form-group" data-max=6>
                                   <label for="formGroupExampleInput2">Breed <small>(e.g. Dar es Salaam, Arusha, Mbeya)</small></label>
                                   <div class="form-group input-group">
                                     <input type="text" name="local_source_parent_stock[]" id="typeofBreed" class="form-control">
                                       <span class="input-group-btn"><button type="button" class="btn btn-default btn-add">+
                                       </button></span>
                                   </div>
                               </div>
                          </div>
                          <div class="col-md-6">
                               <label for="formGroupExampleInput2">Imported source parent stock <small>(*click to select)</small></label>
                               <div class="form-group multiple-form-group" data-max=6>
                                   <label for="formGroupExampleInput2">Country <small>(e.g.  USA, Great Britain, India)</small></label>
                                   <div class="form-group input-group">
                                     <input type="text" name="imported_source_parent_stock[]" id="typeofBreed" class="form-control">
                                       <span class="input-group-btn"><button type="button" class="btn btn-default btn-add">+
                                       </button></span>
                                   </div>
                               </div>
                          </div>
                          </div>
                        </div>

 <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                               <label for="formGroupExampleInput2">Local Source Grand-Parent Stock <small>(*click to select)</small></label>
                               <div class="form-group multiple-form-group" data-max=6>
                                   <label for="formGroupExampleInput2">Region <small>(e.g. Dar es Salaam, Arusha, Mbeya)</small></label>
                                   <div class="form-group input-group">
                                     <input type="text" name="local_source_grandparent_stock[]" id="typeofBreed" class="form-control">
                                       <span class="input-group-btn"><button type="button" class="btn btn-default btn-add">+
                                       </button></span>
                                   </div>
                               </div>
                          </div>
                          <div class="col-md-6">
                               <label for="formGroupExampleInput2">Imported source Grand-parent stock <small>(*click to select)</small></label>
                               <div class="form-group multiple-form-group" data-max=6>
                                   <label for="formGroupExampleInput2">Country <small>(e.g. USA, Great Britain, India)</small></label>
                                   <div class="form-group input-group">
                                     <input type="text" name="imported_source_grandparent_stock[]" id="typeofBreed" class="form-control">
                                       <span class="input-group-btn"><button type="button" class="btn btn-default btn-add">+
                                       </button></span>
                                   </div>
                               </div>
                          </div>
                          </div>
                        </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="formGroupExampleInput"><strong>Breeding Capacity</strong></label>
                            <hr>
                          </div>
                        </div>
                        <div class="col-md-9">
                          <div class="form-group">
                            <label for="lbl_total_incubator_capacity">Maximum Flock Size</label>
                            <input type="text" class="form-control" id="total_incubator_capacity" name="maximum_flock_size" value="<?= isset($_POST['total_incubator_capacity']) ? $_POST['total_incubator_capacity'] : ''; ?>" placeholder=" ">
                          </div>
                          <div class="form-group">
                            <label for="lbltotal_hatcher_capacity">Total Egg Produced per year</label>
                            <input type="text" class="form-control" id="total_peryear_capacity" name="total_hatcher_capacity" value="<?= isset($_POST['total_hatcher_capacity']) ? $_POST['total_hatcher_capacity'] : ''; ?>" placeholder=" ">
                          </div>
                        </div>
                      </div>



                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="lbl_contacts_title"><strong>Contacts</strong></label>
                        <hr>
                      </div>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="formGroupExampleInput2">website</label>
                      <input type="text" class="form-control" id="websiteurl" name="websiteurl" value="<?= isset($_POST['websiteurl']) ? $_POST['websiteurl'] : ''; ?>" placeholder=" ">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="lbl_contact_person">contact person</label>
                      <input type="text" class="form-control" id="contact_person" name="contact_person" value="<?= isset($_POST['contact_person']) ? $_POST['contact_person'] : ''; ?>" placeholder=" ">
                    </div>
                     <div class="form-group col-md-6">
                       <label for="lbl_contact_email">Contact email</label>
                       <input type="email" class="form-control" id="contact_email" name="contact_email" value="<?= isset($_POST['contact_email']) ? $_POST['contact_email'] : ''; ?>" placeholder=" ">
                     </div>
                   </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                          <input type="password" class="form-control" id="password" name="password" value="<?= isset($_POST['password']) ? $_POST['password'] : ''; ?>" placeholder="Password" onkeyup='check();'>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                         <label for="exampleInputConfirmPassword2">Confirm Password</label>
                           <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="<?= isset($_POST['confirm_password']) ? $_POST['confirm_password'] : ''; ?>" placeholder="Password" onkeyup='check();'>
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
    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
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
<!-- para_utilitygrandpastock -->
    <script>
  $(document).ready(function(){
      $('#breeding_activity').on('change', function() {
        if ( this.value == '1')
        {
          $("#para_utilitya").show();
          $("#para_utilityb").show();
          $("#para_utilityc").show();

          $("#para_utility_parentstock").hide();
          $("#para_utilitygrandpastock").hide();

           }else if (this.value == '2') {
                   $("#para_utilitygrandpastock").show();

                   $("#para_utilitya").hide();
                   $("#para_utilityb").hide();
                   $("#para_utilityc").hide();
                   $("#para_utility_parentstock").hide();


          }else if (this.value == '3') {
                   $("#para_utility_parentstock").show();

                   $("#para_utilitya").hide();
                   $("#para_utilityb").hide();
                   $("#para_utilityc").hide();
                   $("#para_utilitygrandpastock").hide();

           }else {

                   $("#para_utilitya").hide();
                   $("#para_utilityb").hide();
                   $("#para_utilityc").hide();
                   $("#para_utility_parentstock").hide();
                   $("#para_utilitygrandpastock").hide();

          }
        });
        console.log("hellow");
    });
    </script>
<script>
(function ($) {
    $(function () {

        var addFormGroup = function (event) {
            event.preventDefault();

            var $formGroup = $(this).closest('.form-group');
            var $multipleFormGroup = $formGroup.closest('.multiple-form-group');
            var $formGroupClone = $formGroup.clone();

            $(this)
                .toggleClass('btn-default btn-add btn-danger btn-remove')
                .html('–');

            $formGroupClone.find('input').val('');
            $formGroupClone.insertAfter($formGroup);

            var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
            if ($multipleFormGroup.data('max') <= countFormGroup($multipleFormGroup)) {
                $lastFormGroupLast.find('.btn-add').attr('disabled', true);
            }
        };

        var removeFormGroup = function (event) {
            event.preventDefault();

            var $formGroup = $(this).closest('.form-group');
            var $multipleFormGroup = $formGroup.closest('.multiple-form-group');

            var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
            if ($multipleFormGroup.data('max') >= countFormGroup($multipleFormGroup)) {
                $lastFormGroupLast.find('.btn-add').attr('disabled', false);
            }

            $formGroup.remove();
        };

        var countFormGroup = function ($form) {
            return $form.find('.form-group').length;
        };

        $(document).on('click', '.btn-add', addFormGroup);
        $(document).on('click', '.btn-remove', removeFormGroup);

    });
})(jQuery);
</script>
<script>
$(document).ready(function (){
	$('.datetimepicker').datetimepicker();

});
</script>

  </body>
</html>
