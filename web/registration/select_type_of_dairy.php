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
            //TYPE OF HATCHING ACTIVITIES
            $usertype = "Hatchery User";
            $account_status = "pending approval";
            $phoneNumber = $_POST['phonenumbers'];
            $owners_full_name = $_POST['owners_full_name'];


            $hatchery_name = $_POST['hatchery_name'];
            $type_of_ownership = $_POST['type_of_ownership'];
            $date_established = $_POST['date_established'];
            $hatch_reg_number = $_POST['hatch_reg_number'];
            $owners_full_name = $_POST['owners_full_name'];
            //$hatchery_affiliation[]
            $hatchery_affiliation = $_POST['hatchery_affiliation'];
            $hatchery_manager = $_POST['hatchery_manager'];
            $hatchery_veterinarian = $_POST['hatchery_veterinarian'];
            $vet_reg_number = $_POST['vet_reg_number'];

            // hatching purposes
            $utility_chicks = $_POST['utility_chicks'];
            $grandparent_stock_chicks = $_POST['grandparent_stock_chicks'];
            $parent_stock_chicks = $_POST['parent_stock_chicks'];

            //type of breed
            $broiler = $_POST['broiler'];
            $layers =  $_POST['layers'];
            $dual_purpose = $_POST['dual_purpose'];

              // Breed
             $typeofbreeds = $_POST['typeofBreed'];

            //type of poultry hacthing
            $hatching_fowls = $_POST['hatching_chicken'];
            $hatching_turkey = $_POST['hatching_turkey'];
            $hatching_ducks = $_POST['hatching_ducks'];
            $hatching_geese = $_POST['hatching_geese'];
            $hatching_guinea_fowls = $_POST['hatching_guinea_fowls'];
            $hatching_quails = $_POST['hatching_quails'];
            $hatching_ostrich = $_POST['hatching_ostrich'];

            //source of eggs by the hatcher
            $imported_eggs = $_POST['imported_eggs'];
            $other_local_farms = $_POST['other_local_farms'];
            $out_growers = $_POST['out_growers'];
            $owns_breeder_farm = $_POST['owns_breeder_farm'];

            //hatchery Capacity
            $total_incubator_capacity = $_POST['total_incubator_capacity'];
            $total_hatcher_capacity = $_POST['total_hatcher_capacity'];

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
                    $user = $db->registerHatcheryUser($fname, $lname, $email, $password, $usertype, $account_status);

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
                    $hatchery = $db->registerNewHatchery(
                $user_id,
                $hatchery_name,
                $year_established,
                $incorporation_number,
                $business_permit_number,
                $premise_certificate_number,
                $gmp_certificate_number,
                $hatcheries_owned,
                $association_affiliation,
                $country,
                $region,
                $district,
                $pobox,
                $websiteurl,
                $address,
                $contact_person,
                $total_hatchery_capacity,
                $total_incubation_capacity,
                $num_breeds_hatched,
                $total_man_power,
                $plant_manager
                );
                    // register new manufacturer
                    if ($hatchery) {
                        // user stored successfully
                        $response["error"] = false;
                        $response["htuid"] = $hatchery["hatchery_unique_id"];
                        $response["hatchery"]["hatchery_id"] = $hatchery["hatchery_id"];
                        $response["hatchery"]["user_id"] = $hatchery["user_id"];
                        $response["hatchery"]["hatchery_name"] = $hatchery["hatchery_name"];
                        $response["hatchery"]["year_established"] = $hatchery["year_established"];
                        $response["hatchery"]["incorporation_number"] = $hatchery["incorporation_number"];
                        $response["hatchery"]["business_permit_number"] = $hatchery["business_permit_number"];
                        $response["hatchery"]["premise_certificate_number"] = $hatchery["premise_certificate_number"];
                        $response["hatchery"]["gmp_certificate_number"] = $hatchery["gmp_certificate_number"];
                        $response["hatchery"]["hatcheries_owned"] = $hatchery["hatcheries_owned"];
                        $response["hatchery"]["association_affiliation"] = $hatchery["association_affiliation"];
                        $response["hatchery"]["country"] = $hatchery["country"];
                        $response["hatchery"]["region"] = $hatchery["region"];
                        $response["hatchery"]["district"] = $hatchery["district"];
                        $response["hatchery"]["pobox"] = $hatchery["pobox"];
                        $response["hatchery"]["address"] = $hatchery["address"];
                        $response["hatchery"]["contact_person"] = $hatchery["contact_person"];
                        $response["hatchery"]["total_hatchery_capacity"] = $hatchery["total_hatchery_capacity"];
                        $response["hatchery"]["total_incubation_capacity"] = $hatchery["total_incubation_capacity"];
                        $response["hatchery"]["total_man_power"] = $hatchery["total_man_power"];
                        $response["hatchery"]["plant_manager"] = $hatchery["plant_manager"];
                        $response["hatchery"]["created_at"] = $hatchery["created_at"];
                        $response["hatchery"]["updated_at"] = $hatchery["updated_at"];


                        $message = "<div class=\"alert alert-success\" role=\"alert\">
                <strong>Well done!</strong> You successfully registered <a href=\"#\" class=\"alert-link\">a new hatchery</a>.
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

    <title>Livestoka | Dairy farm Registration </title>

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

.card {
    display: inline-block;
    position: relative;
    width: 100%;
    margin: 25px 0;
    box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14);
    border-radius: 3px;
    color: rgba(0,0,0, 0.87);
    background: #fff;
}
.card .card-height-indicator {
    margin-top: 100%;
}
.card .title {
    margin-top: 0;
    margin-bottom: 5px;
}
.card .card-image {
    height: 60%;
    position: relative;
    overflow: hidden;
    margin-left: 15px;
    margin-right: 15px;
    margin-top: -30px;
    border-radius: 6px;
}
.card .card-image img {
    width: 100%;
    height: 100%;
    border-radius: 6px;
    pointer-events: none;
}
.card .card-image .card-title {
    position: absolute;
    bottom: 15px;
    left: 15px;
    color: #fff;
    font-size: 1.3em;
    text-shadow: 0 2px 5px rgba(33, 33, 33, 0.5);
}
.card .category:not([class*="text-"]) {
    color: #999999;
}
.card .card-content {
    padding: 15px 20px;
}
.card .card-content .category {
    margin-bottom: 0;
}
.card .card-header {
    box-shadow: 0 10px 30px -12px rgba(0, 0, 0, 0.42), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
    margin: -20px 15px 0;
    border-radius: 3px;
    padding: 15px;
    background-color: #999999;
}
.card .card-header .title {
    color: #FFFFFF;
}
.card .card-header .category {
    margin-bottom: 0;
    color: rgba(255, 255, 255, 0.62);
}
.card .card-header.card-chart {
    padding: 0;
    min-height: 160px;
}
.card .card-header.card-chart + .content h4 {
    margin-top: 0;
}
.card .card-header .ct-label {
    color: rgba(255, 255, 255, 0.7);
}
.card .card-header .ct-grid {
    stroke: rgba(255, 255, 255, 0.2);
}
.card .card-header .ct-series-a .ct-point, .card .card-header .ct-series-a .ct-line, .card .card-header .ct-series-a .ct-bar, .card .card-header .ct-series-a .ct-slice-donut {
    stroke: rgba(255, 255, 255, 0.8);
}
.card .card-header .ct-series-a .ct-slice-pie, .card .card-header .ct-series-a .ct-area {
    fill: rgba(255, 255, 255, 0.4);
}
.card .chart-title {
    position: absolute;
    top: 25px;
    width: 100%;
    text-align: center;
}
.card .chart-title h3 {
    margin: 0;
    color: #FFFFFF;
}
.card .chart-title h6 {
    margin: 0;
    color: rgba(255, 255, 255, 0.4);
}
.card .card-footer {
    margin: 0 20px 10px;
    padding-top: 10px;
    border-top: 1px solid #eeeeee;
}
.card .card-footer .content {
    display: block;
}
.card .card-footer div {
    display: inline-block;
}
.card .card-footer .author {
    color: #999999;
}
.card .card-footer .stats {
    line-height: 22px;
    color: #999999;
    font-size: 12px;
}
.card .card-footer .stats .material-icons {
    position: relative;
    top: 4px;
    font-size: 16px;
}
.card .card-footer h6 {
    color: #999999;
}
.card img {
    width: 100%;
    height: auto;
}
.card .category .material-icons {
    position: relative;
    top: 6px;
    line-height: 0;
}
.card .category-social .fa {
    font-size: 24px;
    position: relative;
    margin-top: -4px;
    top: 2px;
    margin-right: 5px;
}
.card .author .avatar {
    width: 30px;
    height: 30px;
    overflow: hidden;
    border-radius: 50%;
    margin-right: 5px;
}
.card .author a {
    color: #3C4858;
    text-decoration: none;
}
.card .author a .ripple-container {
    display: none;
}
.card .table {
    margin-bottom: 0;
}
.card .table tr:first-child td {
    border-top: none;
}
.card [data-background-color="orange"] {
    background: linear-gradient(60deg, #0e6155, #74f5e3);
   /*box-shadow: 0 12px 20px -5px #bfeaf6, 0 4px 20px 0px #bfeaf6, 0 7px 8px -5px #bfeaf6;
   */
}
.card [data-background-color] {
    color: #FFFFFF;
}
.card [data-background-color] a {
    color: #FFFFFF;
}
.card-stats .title {
    margin: 0;
}
.card-stats .card-header {
    float: left;
    text-align: center;
}
.card-stats .card-header i {
    font-size: 36px;
    line-height: 56px;
    width: 56px;
    height: 56px;
}
.card-stats .card-content {
    text-align: right;
    padding-top: 10px;
}
.card-nav-tabs .header-raised {
    margin-top: -30px;
}
.card-nav-tabs .nav-tabs {
    background: transparent;
    padding: 0;
}
.card-nav-tabs .nav-tabs-title {
    float: left;
    padding: 10px 10px 10px 0;
    line-height: 24px;
}
.card-plain {
    background: transparent;
    box-shadow: none;
}
.card-plain .card-header {
    margin-left: 0;
    margin-right: 0;
}
.card-plain .content {
    padding-left: 5px;
    padding-right: 5px;
}
.card-plain .card-image {
    margin: 0;
    border-radius: 3px;
}
.card-plain .card-image img {
    border-radius: 3px;
}

.navdropdown{
 background-color: #0488ae;
}

/* meant for the updateBatchData */
.spcbelow{
 padding-top: 50;
}
    </style>
  </head>
  <body>

    <nav class="navbar navbar-default navbar-static-top">
      <a href="../index.php" class="navbar-brand">Back To Livestoka</a>
    </nav>


    <div class="container">
      <div class="starter-template">
        <h1>Select Type of Dairy</h1>
        <!-- <p class="lead">Owner's and operators of Feed Manufactures can Register Below.<br> Please fill all the required Fields.</p> -->
      </div>
      <!--register section -->
      <section id="manufacturersReg">
        <!-- <form action="dairy_farm_registration.php" method="post"> -->
            <div class="container">
              <div class="row">
                    <div class="col-lg-3">
                      <div class="card">
                        <!-- <div class="card-header" data-background-color="orange">
                          <h4>Dairy Type</h4>
                            <p class="category">deals with dairy and milk products</p>
                        </div> -->
                        <div class="card-content table-responsive">
                               <div class="row">
                                 <div class="col-xs-3">
                                   <div class="card-content table-responsive">
                                     <img src="../images/dealers/hatchery.jpg">
                                      <h3>Dairy Breeding Farm</h3>
                                   </div>
                                 </div>
                                 <!-- <div class="col-xs-3">
                                   <div class="card-content table-responsive">
                                     <img src="../images/dealers/hatchery.jpg">
                                      <h3>Dairy Farm</h3>
                                   </div>
                                 </div>
                                 <div class="col-xs-3">
                                   <div class="card-content table-responsive">
                                     <img src="../images/dealers/hatchery.jpg">
                                      <h3>Milk Collection Center</h3>
                                   </div>
                                 </div> -->
                               </div>

                               <!-- <div class="row">
                                 <div class="col-xs-3">
                                   <div class="card-content table-responsive">
                                      <img src="../images/dealers/hatchery.jpg">
                                      <h3>Milk Processor</h3>
                                   </div>
                                 </div>
                                 <div class="col-xs-3">
                                   <div class="card-content table-responsive">
                                     <img src="../images/dealers/hatchery.jpg">
                                      <h3>Fodder Supplier</h3>
                                   </div>
                                 </div>
                                 <div class="col-xs-3">
                                   <div class="card-content table-responsive">
                                     <img src="../images/dealers/hatchery.jpg">
                                      <h3>Milk Trader</h3>
                                   </div>
                                 </div>
                               </div> -->
                           </div>
                        </div>
                    </div>

                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header" data-background-color="orange">
                      <h4>Beef Type</h4>
                        <p class="category">deals with meat products</p>
                    </div>
                    <div class="card-content table-responsive">
                      <div class="row">
                        <div class="col-xs-3">
                          <div class="card-content table-responsive">
                                     <img src="../images/dealers/hatchery.jpg">
                             <h3>Multiplication Unit</h3>
                          </div>
                        </div>
                        <div class="col-xs-3">
                          <div class="card-content table-responsive">
                                     <img src="../images/dealers/hatchery.jpg">
                             <h3>Beef Cattle Farm</h3>
                          </div>
                        </div>
                        <div class="col-xs-3">
                          <div class="card-content table-responsive">
                                     <img src="../images/dealers/hatchery.jpg">
                             <h3>Meat Processor</h3>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-3">
                          <div class="card-content table-responsive">
                           <img src="../images/dealers/hatchery.jpg">
                             <h3>Cattle Trader</h3>
                          </div>
                        </div>

                      </div
                       </div>
                    </div>
                </div>
                <!-- end of beef types card -->
              </div>
              <!-- end of row -->
            </div>
                 <!-- end of container -->
            </section>
          </div>
        <!-- </div>
      <hr>
   </div> -->
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
      $('#hatching_activity').on('change', function() {
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
