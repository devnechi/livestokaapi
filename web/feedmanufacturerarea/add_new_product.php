<?php
ob_start();
session_start();

   include("../../includes/layouts/main_fm_header_layout.php");
    require_once '../../includes/DbOperation.php';
    require_once '../../includes/validations_functions.php';
    //getting the dboperation class



?>
<?php confirm_logged_in(); ?>
<?php $layout_context = "feed_manufacturer"; ?>
<?php
   $next_day_update = date("d-m-Y", strtotime(" +1 months"));
$errors = array();
$message = " ";
$ppmessage = " ";
$rmmessage = " ";

?>
<?php
  if ($_SESSION['loggedIn'] != TRUE) {
  	// code...
		//SET UR ID AND THE USEREMAIL
		$message = "<div class=\"alert alert-danger\" role=\"alert\">
			<strong>Log in Again</strong> <a href=\"#\" class=\"alert-link\">Seems like we failed to authenticate you</a> Try login again.
		</div>";
          redirect_to("/mydroids/livestokaapi/web/login_area.php");
  } else{
  	// code...
    //user session details
		$logged_user_id = $_SESSION['user_log_id'];
		$logged_user_email = $_SESSION['user_log_email'];
		$logged_user_usertype = $_SESSION['user_log_usertype'];
			//
		  if ($logged_user_usertype != "feed manufacturer") {
        // user is not of feed manufacturer type...
        //usertype is different
				  redirect_to("/mydroids/livestokaapi/web/login_area.php");
		  } else {

                // logged in user is of feed manufacturer

                //TODO: update last_login status in database

                //get the corresponding feed manufacturer.
                $db = new DbOperation();
                // json response array
                $user_id = $logged_user_id;
                $response = array("error" => false);
                if (isset($user_id)) {
                    // receiving the post params
                $manufacturer = $db->getFeedManufacturerDetails($user_id);
                if ($manufacturer != false) {
                    // use is found
                    $response["error"] = false;
                    $response["mfuid"] = $manufacturer["feed_manufactures_unique_id"];
                    $response["manufacturer"]["feed_manufactures_id"] = $manufacturer["feed_manufactures_id"];
                    $response["manufacturer"]["user_id"] = $manufacturer["user_id"];
                    $response["manufacturer"]["companyname"] = $manufacturer["companyname"];
                    $response["manufacturer"]["year_established"] = $manufacturer["year_established"];
                    $response["manufacturer"]["cert_of_incorporation_num"] = $manufacturer["cert_of_incorporation_num"];
                    $response["manufacturer"]["feedbussiness_permit_num"] = $manufacturer["feedbussiness_permit_num"];
                    $response["manufacturer"]["premise_cert_num"] = $manufacturer["premise_cert_num"];
                    $response["manufacturer"]["gmp_cert_num"] = $manufacturer["gmp_cert_num"];
                    $response["manufacturer"]["association_affiliation"] = $manufacturer["association_affiliation"];
                    $response["manufacturer"]["country"] = $manufacturer["country"];
                    $response["manufacturer"]["region"] = $manufacturer["region"];
                    $response["manufacturer"]["district"] = $manufacturer["district"];
                    $response["manufacturer"]["address"] = $manufacturer["address"];
                    $response["manufacturer"]["pobox"] = $manufacturer["pobox"];
                    $response["manufacturer"]["phonenumber"] = $manufacturer["phonenumber"];
                    $response["manufacturer"]["websiteurl"] = $manufacturer["websiteurl"];
                    $response["manufacturer"]["contact_person"] = $manufacturer["contact_person"];
                    $response["manufacturer"]["production_capacity"] = $manufacturer["production_capacity"];
                    $response["manufacturer"]["storage_capacity"] = $manufacturer["storage_capacity"];
                    $response["manufacturer"]["num_products_produced"] = $manufacturer["num_products_produced"];
                    $response["manufacturer"]["man_power"] = $manufacturer["man_power"];
                    $response["manufacturer"]["plant_manager"] = $manufacturer["plant_manager"];
                    $response["manufacturer"]["created_at"] = $manufacturer["created_at"];
                    $response["manufacturer"]["updated_at"] = $manufacturer["updated_at"];

                    //echo json_encode($response);

                    $feed_manufacture_name = $manufacturer["companyname"];
                    $feed_manufacture_id =  $manufacturer["feed_manufactures_id"];

                } else {
                    // user is not found with the credentials
                    $response["error"] = true;
                    $response["error_msg"] = "Can not find user. Please try again later!";
                    //echo json_encode($response);
                }
            } else {
                // required post params is missing
                $response["error"] = true;
                $response["error_msg"] = "Required user ID is missing!";
                //echo json_encode($response);
            }
		  }
  }
 ?>
<?php

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
      // $creator_id = $_POST['user_id'];
       $creator_id = $logged_user_id;
       $feed_manu_id = $feed_manufacture_id;
      $product_name = $_POST['product_name'];
      $brand_name = $_POST['brand_name'];
      $product_type = $_POST['product_type'];
      $protein_level = $_POST['protein_level'];
      $product_purpose_statement =$_POST['product_purpose_statement'];
      $product_description = $_POST['product_description'];

      // * product production
      $quantity_produced  = $_POST['monthly_qty_production'];
      $quantity_measurements  = $_POST['quantity_measurements'];
      $current_quantity_instorage  = $_POST['current_quantinty_instorage'];
      $product_manu_capacity  = $_POST['product_manu_capacity'];
      $next_day_update  = $_POST['next_update_day'];

      //validations
      $fields_required= array("product_name", "protein_level");
      foreach($fields_required as $field){
        $value = trim($_POST[$field]);
        if(!has_presence($value)){

          $message = "<div class=\"alert alert-danger\" role=\"alert\">
            <strong>Oh snap!</strong> <a href=\"#\" class=\"alert-link\">Change a few things up</a> and try submitting again.
          </div>";

           $errors[$field] = ucfirst($field) . " can't be blank";

        }
      }


     //  //check if the values are numeric
     //  $fields_required= array("gmp_cert_num", "feedbussiness_permit_num", "cert_of_incorporation_num", "", "premise_cert_num", "man_power", "num_products_produced", "storage_capacity", "production_capacity", "phonenumber");
     //  foreach($fields_required as $field){
     //    $value = trim($_POST[$field]);
     //    if(!is_numeric($value)){
     //
     //      $message = "<div class=\"alert alert-info\" role=\"alert\">
     //        <strong>Oh snap!</strong> <a href=\"#\" class=\"alert-link\">make sure values are numeric </a> and try submitting again.
     //      </div>";
     //
     //       $errors[$field] = ucfirst($field) . " should be numeric";
     //
     //    }
     //  }
     //
     //
     // // Using assoc. arrays
     // $fields_with_max_lengths = array("plant_manager" => 30, "premise_cert_num" => 8);
     //  validate_max_length($fields_with_max_lengths);
     if (empty($errors)) {
       // feed manufacturer adds new product
       $feeds_product = $db->manufactureAddNewProduct($creator_id, $feed_manu_id, $product_name, $brand_name, $product_type,  $protein_level, $product_purpose_statement, $product_description);
       if ($feeds_product) {
           // user stored successfully
           $response["error"] = false;
           $response["npuid"] = $feeds_product["feeds_products_unique_id"];
           $response["feeds_product"]["feed_product_id"] = $feeds_product["feed_product_id"];
           $response["feeds_product"]["creator_id"] = $feeds_product["creator_id"];
           $response["feeds_product"]["product_name"] = $feeds_product["product_name"];
           $response["feeds_product"]["brand_name"] = $feeds_product["brand_name"];
           $response["feeds_product"]["product_type"] = $feeds_product["product_type"];
           $response["feeds_product"]["protein_level"] = $feeds_product["protein_level"];
           $response["feeds_product"]["product_purpose_statement"] = $feeds_product["product_purpose_statement"];
           $response["feeds_product"]["product_description"] = $feeds_product["product_description"];
           $response["feeds_product"]["created_at"] = $feeds_product["created_at"];
           $response["feeds_product"]["updated_at"] = $feeds_product["updated_at"];

           $feeds_product_id = $feeds_product["feed_product_id"];;
           $pcreator_id  = $feeds_product["creator_id"];;


           // feed manufacturer adds product production data
           $product_production = $db->manufactureProductProduction($feeds_product_id, $pcreator_id,  $quantity_produced, $quantity_measurements, $current_quantity_instorage, $product_manu_capacity, $next_day_update);
           if ($product_production) {
               // user stored successfully
               $response["error"] = false;
               $response["npuid"] = $product_production["feed_production_unique_id"];
               $response["product_production"]["products_production_id"] = $product_production["products_production_id"];
               $response["product_production"]["feeds_product_id"] = $product_production["feeds_product_id"];
               $response["product_production"]["creator_id"] = $product_production["creator_id"];
               $response["product_production"]["quantity_produced"] = $product_production["quantity_produced"];
               $response["product_production"]["quantity_measurements"] = $product_production["quantity_measurements"];
               $response["product_production"]["current_quantity_instorage"] = $product_production["current_quantity_instorage"];
               $response["product_production"]["product_manu_capacity"] = $product_production["product_manu_capacity"];
               $response["product_production"]["next_day_update"] = $product_production["next_day_update"];
               $response["product_production"]["date_created"] = $product_production["date_created"];
               $response["product_production"]["date_updated"] = $product_production["date_updated"];


           $message = "<div class=\"alert alert-success\" role=\"alert\">
             <strong>Well done!</strong> You successfully! <a href=\"#\" class=\"alert-link\">added a new feeds Product that you manufacturer</a>.
           </div>";

       } else {
           // user failed to store
           $response["error"] = true;
           $response["error_msg"] = "Unknown error occurred while creating a new product!";
           echo json_encode($response);
       }

      } else {
      $response["error"] = true;
      $response["error_msg"] = "Required parameters (user id or product name) is missing!";
      echo json_encode($response);
      }

     }else{
  // $username = "";
  $message = "<div class=\"alert alert-info\" role=\"alert\">
    <strong>Take note!</strong> <a href=\"#\" class=\"alert-link\">When registering</a> please fill all the relevant details.
  </div>";
   }
 }
   ?>

<div class="container-fluid">
              <div class="row">
                          <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header" data-background-color="orange">
                                    <h4 class="title">Add New Product that you Manufacture</h4>
                                    <p class="category">This product will appear as what you produce</p>
                                </div>
                                <div class="card-content table-responsive">
                                  <!-- <h2> Welcome back, <small><?php //echo $logged_user_email  ; ?></small></h2>
                                  <h2> With userr_id, <small><?php //echo $logged_user_id  ; ?></small></h2>

                                  <h2> Feed Manufacturer Name, <small><?php //echo $feed_manufacture_name; ?></small></h2>

                                    <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                                    <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p> -->

                                 <br />

                                <div class="container">

                                  <?php echo $message; ?>
                                  <?php echo form_errors($errors); ?>
                                  <br />
                                <form action="add_new_product.php" method="post">
                                  <div class="panel panel-default">
                                    <div class="panel-heading card-header">
                                      <h3 class="panel-title title">Product Description</h3>
                                    </div>
                                    <div class="panel-body">
                                      <div class="form-group col-md-6">
                                        <label for="formGroupProductName">Product Name</label>
                                        <input type="text" class="form-control" id="product_name" name="product_name" value="<?= isset($_POST['product_name']) ? $_POST['product_name'] : ''; ?>" placeholder="">
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label for="formGroupExampleInput">Brand Name</label>
                                        <input type="text" class="form-control"  id="brand_name" name="brand_name" value="<?= isset($_POST['brand_name']) ? $_POST['brand_name'] : ''; ?>" placeholder="">
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label for="formGroupExampleInput">Protein Levels</label>
                                        <input type="text" class="form-control"  id="protein_levels" name="protein_level" value="<?= isset($_POST['protein_levels']) ? $_POST['protein_levels'] : ''; ?>" placeholder="">
                                      </div>

                                      <div class="form-group  col-md-6">
                                        <label for="exampleFormControlSelect1">Product Type</label>
                                        <select class="form-control"  id="product_type" name="product_type" value="<?= isset($_POST['product_type']) ? $_POST['product_type'] : ''; ?>">
                                          <option>SELECT</option>
                                          <option>Mash</option>
                                          <option>Pellets</option>

                                        </select>
                                      </div>
                                      <div class="form-group  col-md-6">
                                        <label for="exampleFormControlTextarea1">Product Purpose Statement</label>
                                        <textarea class="form-control"  id="product_purpose_statement" name="product_purpose_statement" value="<?= isset($_POST['product_purpose_statement']) ? $_POST['product_purpose_statement'] : ''; ?>" rows="3"></textarea>
                                      </div>
                                      <div class="form-group  col-md-6">
                                        <label for="exampleFormControlTextarea1">Product Description</label>
                                        <textarea class="form-control"  id="product_description" name="product_description" value="<?= isset($_POST['product_description']) ? $_POST['product_description'] : ''; ?>" rows="3"></textarea>
                                      </div>
                                    </div>

                                  </div>
                                  <br />



                                  <div class="panel panel-default">
                                    <div class="panel-heading card-header">
                                      <h3 class="panel-title title">Product Production Details</h3>
                                    </div>
                                    <div class="panel-body">
                                  <div class="form-group  col-md-6">
                                    <label for="formGroupExampleInput">Est. of Monthly Quantity Produced. <small>every month</small></label>
                                    <input type="text" class="form-control" id="monthly_qty_production"  id="monthly_qty_production" name="monthly_qty_production" value="<?= isset($_POST['monthly_qty_production']) ? $_POST['monthly_qty_production'] : ''; ?>" placeholder="">
                                  </div>

                                  <div class="form-group  col-md-6">
                                    <label for="exampleFormControlSelect1">Quantity is measured in</label>
                                    <select class="form-control"  id="quantity_measurements" name="quantity_measurements" value="<?= isset($_POST['quantity_measurements']) ? $_POST['quantity_measurements'] : ''; ?>">
                                      <option>SELECT</option>
                                      <option>KG</option>
                                      <option>TONS</option>

                                    </select>
                                  </div>

                                  <div class="form-group  col-md-6">
                                    <label for="formGroupExampleInput">Current Product Manufacturing Capacity</label>
                                    <input type="text" class="form-control"  id="product_manu_capacity" name="product_manu_capacity" value="<?= isset($_POST['product_manu_capacity']) ? $_POST['product_manu_capacity'] : ''; ?>" placeholder="">
                                  </div>

                                  <div class="form-group  col-md-6">
                                    <label for="formGroupExampleInput">Current Product Quantinty in Storage.<small>as of Today.</small></label>
                                    <input type="text" class="form-control" id="current_quantinty_instorage" name="current_quantinty_instorage" value="<?= isset($_POST['current_quantinty_instorage']) ? $_POST['current_quantinty_instorage'] : ''; ?>" placeholder="">
                                  </div>

                                </div>
                              </div>
                              <br />
                              <div class="panel panel-default">
                                <div class="panel-heading card-header">
                                  <h3 class="panel-title title">Production Timeline</h3>
                                </div>
                                <div class="panel-body">

                                  <div class="form-group  col-md-6">
                                    <label for="formGroupExampleInput">day to update.</label>
                                    <input type="text" class="form-control" readonly id="next_day_update" name="next_day_update" value="<?php echo $next_day_update; ?>"  placeholder="">

                                    <small id="emailHelp" class="form-text text-muted">You will receive notifications to update info on this date.</small>
                                  </div>
                                  </div>

                                </div>
                              </div>
                                <button type="submit" name="submit" class="btn btn-primary btn-lg"  value="Submit">Add new Product</button>
                                </form>


                              </div>
                          </div>
                  </div>
               </div>
              </div>
             </div>
          </body>
          </html>
