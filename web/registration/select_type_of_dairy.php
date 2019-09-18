
<?php
   include('../../includes/layouts/public_layout_header.php');
   ?>
<!------ Include the above in your HEAD tag ---------->
<style>

.carousel-fade .carousel-inner .item {
  opacity: 0;
  -webkit-transition-property: opacity;
  -moz-transition-property: opacity;
  -o-transition-property: opacity;
  transition-property: opacity;
}
.carousel-fade .carousel-inner .active {
  opacity: 1;
}
.carousel-fade .carousel-inner .active.left,
.carousel-fade .carousel-inner .active.right {
  left: 0;
  opacity: 0;
  z-index: 1;

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
    <!-- <link rel="stylesheet" href="../../web/css/style2.css"> -->
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
>>>>>>> 8551d076b3db7c31eb5b07a3fdd8f2c4a670c1d3
}
.carousel-fade .carousel-inner .next.left,
.carousel-fade .carousel-inner .prev.right {
  opacity: 1;
}
.carousel-fade .carousel-control {
  z-index: 2;
}
.fade-carousel {
    position: relative;
    height: 100vh;
}
.fade-carousel .carousel-inner .item {
    height: 100vh;
}
.fade-carousel .carousel-indicators > li {
    margin: 0 2px;
    background-color: #f39c12;
    border-color: #f39c12;
    opacity: .7;
}
.fade-carousel .carousel-indicators > li.active {
  width: 10px;
  height: 10px;
  opacity: 1;
}

/********************************/
/*          Hero Headers        */
/********************************/
.hero {
    position: absolute;
    top: 50%;
    left: 50%;
    z-index: 3;
    color: #fff;
    text-align: center;

    text-shadow: 1px 1px 0 rgba(0,0,0,.75);
      -webkit-transform: translate3d(-50%,-50%,0);
         -moz-transform: translate3d(-50%,-50%,0);
          -ms-transform: translate3d(-50%,-50%,0);
           -o-transform: translate3d(-50%,-50%,0);
              transform: translate3d(-50%,-50%,0);
}
.hero h1 {
    font-size: 6em;
    font-weight: bold;
    margin: 0;
    padding: 0;
}

.fade-carousel .carousel-inner .item .hero {
    opacity: 0;
    -webkit-transition: 4s all ease-in-out .2s;
       -moz-transition: 4s all ease-in-out .2s;
        -ms-transition: 4s all ease-in-out .2s;
         -o-transition: 4s all ease-in-out .2s;
            transition: 4s all ease-in-out .2s;
}
.fade-carousel .carousel-inner .item.active .hero {
    opacity: 1;
    -webkit-transition: 4s all ease-in-out .2s;
       -moz-transition: 4s all ease-in-out .2s;
        -ms-transition: 4s all ease-in-out .2s;
         -o-transition: 4s all ease-in-out .2s;
            transition: 4s all ease-in-out .2s;
}

/********************************/
/*            Overlay           */
/********************************/
.overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    z-index: 2;

}

/********************************/
/*          Custom Buttons      */
/********************************/
.btn.btn-lg {padding: 10px 40px;}
.btn.btn-hero,
.btn.btn-hero:hover,
.btn.btn-hero:focus {
    color: #f5f5f5;
    background-color: #1abc9c;
    border-color: #1abc9c;
    outline: none;
    margin: 20px auto;
}

/********************************/
/*       Slides backgrounds     */
/********************************/
.fade-carousel .slides .slide-1,
.fade-carousel .slides .slide-2,
.fade-carousel .slides .slide-3,
.fade-carousel .slides .slide-4,
.fade-carousel .slides .slide-5 {
  height: 100vh;
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
}
.fade-carousel .slides .slide-1 {
  background-image: url(../../web/images/dairy/meat-1030729_1920.jpg);
}
.fade-carousel .slides .slide-2 {
  background-image: url(../../web/images/dairy/cows-2641195_1920.jpg);
}
.fade-carousel .slides .slide-3 {
  background-image: url(../../web/images/dairy/milk-3518891_1920.jpg);
}
.fade-carousel .slides .slide-4 {
  background-image: url(../../web/images/dairy/cow-2790134_1920.jpg);
}
.fade-carousel .slides .slide-5 {
  background-image: url(../../web/images/dairy/meat-3195334_1920.jpg);
}
/********************************/
/*          Media Queries       */
/********************************/
@media screen and (min-width: 980px){
    .hero { width: 980px; }
}
@media screen and (max-width: 640px){
    .hero h1 { font-size: 4em; }
}

.navbar{

      background-color: rgba(255, 255, 255, 0.1);
    position: absolute;
    width: 100%;
    z-index: 2;
    border:none;
    color:white;
}
#login-dp{
    min-width: 250px;
    padding: 14px 14px 0;
    overflow:hidden;
    background-color:rgba(255,255,255,.8);
}
#login-dp .help-block{
    font-size:12px
}
#login-dp .bottom{
    background-color:rgba(255,255,255,.8);
    border-top:1px solid #ddd;
    clear:both;
    padding:14px;
}
#login-dp .social-buttons{
    margin:12px 0
}
#login-dp .social-buttons a{
    width: 49%;
}
#login-dp .form-group {
    margin-bottom: 10px;
}
.btn-fb{
    color: #fff;
    background-color:#3b5998;
}
.btn-fb:hover{
    color: #fff;
    background-color:#496ebc
}
.btn-tw{
    color: #fff;
    background-color:#55acee;
}
.btn-tw:hover{
    color: #fff;
    background-color:#59b5fa;
}
@media(max-width:768px){
    #login-dp{
        background-color: inherit;
        color: #fff;
    }
    #login-dp .bottom{
        background-color: inherit;
        border-top:0 none;
    }
}

nav a{
  color:white;
}
.icon-bar{
  background-color:black;
}


</style>

<nav class="navbar navbar-top fixed-top  " role="navigation" style="background-color:rgba(255,255,255,0.1);  position:absolute;">
  <div class="container-fluid" >
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Login dropdown</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


      <ul class="nav navbar-nav navbar-right">
        <li><p class="navbar-text">Already have an account</p></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
			<ul id="login-dp" class="dropdown-menu">
				<li>
					 <div class="row">
							<div class="col-md-12">

								<div class="social-buttons">
									<a href="#" class="btn btn-fb"><i class="fa fa-facebook"></i> Facebook</a>
									<a href="#" class="btn btn-tw"><i class="fa fa-twitter"></i> Twitter</a>
                  <a href="#" class="btn btn-tw"><i class="fa fa-twitter"></i> Google</a>
								</div>
                                Enter
								 <form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
										<div class="form-group">
											 <label class="sr-only" for="exampleInputEmail2">Email address</label>
											 <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email address" required>
										</div>
										<div class="form-group">
											 <label class="sr-only" for="exampleInputPassword2">Password</label>
											 <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
                                             <div class="help-block text-right"><a href="">Forget the password ?</a></div>
										</div>
										<div class="form-group">
											 <button type="submit" class="btn btn-primary btn-block">Sign in</button>
										</div>
										<div class="checkbox">
											 <label>
											 <input type="checkbox"> keep me logged-in
											 </label>
										</div>
								 </form>
							</div>
							<div class="bottom text-center">
								New here ? <a href="#"><b>Join Us</b></a>
							</div>
					 </div>
				</li>
			</ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="carousel fade-carousel carousel-fade slide" style="top:0%;" data-ride="carousel" data-interval="8000" id="bs-carousel">

  <div class="overlay">   <div class="hero">
        <hgroup>
            <h1>Get Started</h1>
            <h3>Get start by registering  your  field</h3>
        </hgroup>
        <span > <select class=" btn btn-hero btn-lg "  id="register" >
                    <option>Register As</option>
                    <option value="1">Milk processor Unit</option>
                       <option value="2">Beef Cattle Farm</option>
                     <option value="3">Meat Processor</option>
                       <option value="4">Cattle Traders</option>


                     </select></span>
      </div>
                     </div>

  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#bs-carousel" data-slide-to="0" class="active"></li>
    <li data-target="#bs-carousel" data-slide-to="1"></li>
    <li data-target="#bs-carousel" data-slide-to="2"></li>
    <li data-target="#bs-carousel" data-slide-to="4"></li>
    <li data-target="#bs-carousel" data-slide-to="5"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item slides active">
      <div class="slide-1"></div>

    </div>
    <div class="item slides">
      <div class="slide-2"></div>

    </div>
    <div class="item slides">
      <div class="slide-3"></div>

    </div>
    <div class="item slides">
      <div class="slide-4"></div>

    </div>
    <div class="item slides">
      <div class="slide-5"></div>

    </div>
  </div>
</div>

 <!-- <script>

$("#register").on('change', function() {
  window.location=$(this).val()
  //set isopen to opposite so next  time  when use clicked select  box
  //it wont trigger this event


});
</script> -->


<?php

include('../../includes/layouts/public_ly_footer.php');?>
