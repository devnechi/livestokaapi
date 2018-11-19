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

       $creator_id = $logged_user_id;
       $feeds_manufacturer_id = $feed_manufacture_id;
       $total_man_power = $_POST['total_man_power'];
       $total_products_produced = $_POST['total_products_produced'];
       $measurements = $_POST['measurements'];
       $current_stock_instorage = $_POST['current_stock_instorage'];
       $storage_qty_measurements = $_POST['storage_qty_measurements'];
       $raw_materials_consumed = $_POST['raw_materials_consumed'];
       $num_raw_materials_used = $_POST['number_of_rawmaterials_used'];
       $current_raw_materials_instorage = $_POST['current_raw_materials_instorage'];
       $raw_materials_measurements = $_POST['raw_materials_measurements'];
       $next_day_update = $_POST['next_day_update'];

        // $next_day_update = date("d/m/Y", strtotime(" +1 months"));

       //validations
       $fields_required= array("total_products_produced", "current_stock_instorage", "raw_materials_consumed");
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
       // $fields_required= array("gmp_cert_num", "feedbussiness_permit_num", "cert_of_incorporation_num", "", "premise_cert_num", "man_power", "num_products_produced", "storage_capacity", "production_capacity", "phonenumber");
       // foreach($fields_required as $field){
       //   $value = trim($_POST[$field]);
       //   if(!is_numeric($value)){
       //
       //     $message = "<div class=\"alert alert-info\" role=\"alert\">
       //       <strong>Oh snap!</strong> <a href=\"#\" class=\"alert-link\">make sure values are numeric </a> and try submitting again.
       //     </div>";
       //
       //      $errors[$field] = ucfirst($field) . " should be numeric";
       //
       //   }
       // }
       //

  if (empty($errors)) {
    // feed manufacturer adds new product
    $manuoperation = $db->feedManufacturerIndustryData($feeds_manufacturer_id, $creator_id, $total_man_power, $total_products_produced, $measurements, $current_stock_instorage, $storage_qty_measurements, $num_raw_materials_used, $raw_materials_consumed, $current_raw_materials_instorage, $raw_materials_measurements, $next_day_update);
    if ($manuoperation) {
        // user stored successfully
        $response["error"] = false;
        $response["miduid"] = $manuoperation["operation_unique_id"];
        $response["manuoperation"]["manufacturing_operation_id"] = $manuoperation["manufacturing_operation_id"];
        $response["manuoperation"]["feeds_manufacturer_id"] = $manuoperation["feeds_manufacturer_id"];
        $response["manuoperation"]["creator_id"] = $manuoperation["creator_id"];
        $response["manuoperation"]["total_man_power"] = $manuoperation["total_man_power"];
        $response["manuoperation"]["total_products_produced"] = $manuoperation["total_products_produced"];
        $response["manuoperation"]["measurements"] = $manuoperation["measurements"];
        $response["manuoperation"]["current_stock_instorage"] = $manuoperation["current_stock_instorage"];
        $response["manuoperation"]["storage_qty_measurements"] = $manuoperation["storage_qty_measurements"];
        $response["manuoperation"]["number_of_rawmaterials_used"] = $manuoperation["number_of_rawmaterials_used"];
        $response["manuoperation"]["raw_materials_consumed"] = $manuoperation["raw_materials_consumed"];
        $response["manuoperation"]["raw_materials_measurements"] = $manuoperation["raw_materials_measurements"];
        $response["manuoperation"]["next_day_update"] = $manuoperation["next_day_update"];
        $response["manuoperation"]["date_created"] = $manuoperation["date_created"];
        $response["manuoperation"]["date_updated"] = $manuoperation["date_updated"];

        $message = "<div class=\"alert alert-success\" role=\"alert\">
          <strong>Well done!</strong> You successfully! <a href=\"#\" class=\"alert-link\">inserted feed manufacturer industry data</a>.
        </div>";


          } else {
              // user failed to store
              $response["error"] = true;
              $response["error_msg"] = "Unknown error occurred while creating a new Raw Material!";
              // echo json_encode($response);
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
                      <h4 class="title">Update Overall data</h4>
                      <p class="category">This product will appear as what you produce</p>
                  </div>
                  <div class="card-content table-responsive">
                      <p>With the use of the form below Overall Grouped data is collected, such as all production, ram material and stock levels for that month is collected here.</p>
                      <?php echo $message; ?>
                      <?php echo form_errors($errors); ?>
                      <br />
                      <br />
                       <div class="panel panel-default">
                         <div class="panel-heading card-header">
                           <h3 class="panel-title title">Previous Month Entered Data</h3>
                           <p>This is your data from the precious month</p>
                       </div>
                       <div class="panel-body">
                           <!-- <div class="form-group  col-md-6">
                             <h2>Products Produced Last Month</h2>
                             <h2>Total Products in Storage </h2>
                           </div>
                           <div class="form-group  col-md-6">
                             <h2>Total Raw Materials Used</h2>
                             <h2>Total Man Power</h2>
                           </div> -->
                         </div>
                       </div>
                       <br />

                       <form action="update_overall_data.php" method="post">
                         <div class="panel panel-default">
                           <div class="panel-heading card-header">
                             <h3 class="panel-title title">Update Current Month Production Data</h3>
                           </div>
                           <div class="panel-body">
                             <div class="row">
                               <div class="form-group col-md-3">
                                 <label for="formGroupExampleInput">Total Man Power</label>
                                 <input type="text" class="form-control" id="total_man_power" name="total_man_power" value="<?= isset($_POST['total_man_power']) ? $_POST['total_man_power'] : ''; ?>" placeholder="">
                               </div>
                             </div>
                            <div class="row">
                             <div class="form-group col-md-6 col-md-8">
                               <label for="formGroupExampleInput">Total Products Produced</label>
                               <input type="text" class="form-control" id="total_products_produced" name="total_products_produced" value="<?= isset($_POST['total_products_produced']) ? $_POST['total_products_produced'] : ''; ?>" placeholder="">
                             </div>
                             <div class="form-group  col-md-6 col-md-4">
                               <label for="exampleFormControlSelect1">Total Product Measuments</label>
                               <select class="form-control" id="measurements" name="measurements" value="<?= isset($_POST['measurements']) ? $_POST['measurements'] : ''; ?>">
                                 <option>SELECT</option>
                                 <option>KG</option>
                                 <option>TONS</option>
                               </select>
                             </div>
                             <div class="form-group col-md-6 col-md-8">
                               <label for="formGroupExampleInput">Current Product Stock in Storage</label>
                               <input type="text" class="form-control" id="current_stock_instorage" name="current_stock_instorage" value="<?= isset($_POST['current_stock_instorage']) ? $_POST['current_stock_instorage'] : ''; ?>" placeholder="">
                             </div>
                             <div class="form-group  col-md-6 col-md-4">
                               <label for="exampleFormControlSelect1">Total Product in-storage Measuments</label>
                               <select class="form-control" id="storage_qty_measurements" name="storage_qty_measurements" value="<?= isset($_POST['storage_qty_measurements']) ? $_POST['storage_qty_measurements'] : ''; ?>">
                                 <option>SELECT</option>
                                 <option>KG</option>
                                 <option>TONS</option>
                               </select>
                             </div>
                             <div class="form-group col-md-6">
                               <label for="formGroupExampleInput">Number of Raw Materials Used</label>
                               <input type="text" class="form-control" id="number_of_rawmaterials_used" name="number_of_rawmaterials_used" value="<?= isset($_POST['number_of_rawmaterials_used']) ? $_POST['number_of_rawmaterials_used'] : ''; ?>" placeholder="">
                             </div>
                             <div class="col-md-9">
                             </div>
                             <div class="form-group col-md-6">
                               <label for="formGroupExampleInput">Total Raw Materials Used</label>
                               <input type="text" class="form-control" id="raw_materials_consumed" name="raw_materials_consumed" value="<?= isset($_POST['raw_materials_consumed']) ? $_POST['raw_materials_consumed'] : ''; ?>" placeholder="">
                             </div>
                             <div class="form-group  col-md-4">
                               <label for="exampleFormControlSelect1">Quantity is measured in</label>
                               <select class="form-control" id="raw_materials_measurements" name="raw_materials_measurements" value="<?= isset($_POST['raw_materials_measurements']) ? $_POST['raw_materials_measurements'] : ''; ?>" placeholder="">
                                 <option>SELECT</option>
                                 <option>KG</option>
                                 <option>TONS</option>
                               </select>
                             </div>
                             <div class="form-group col-md-6">
                               <label for="formGroupExampleInput">Current Quantity Raw Materials in Storage</label>
                               <input type="text" class="form-control" id="current_raw_materials_instorage" name="current_raw_materials_instorage" value="<?= isset($_POST['current_raw_materials_instorage']) ? $_POST['current_raw_materials_instorage'] : ''; ?>" placeholder="">
                             </div>
                             <div class="form-group  col-md-4">
                               <label for="exampleFormControlSelect1">Quantity is measured in</label>
                               <select class="form-control" id="raw_materials_measurements" name="raw_materials_measurements" value="<?= isset($_POST['raw_materials_measurements']) ? $_POST['raw_materials_measurements'] : ''; ?>" placeholder="">
                                 <option>SELECT</option>
                                 <option>KG</option>
                                 <option>TONS</option>
                               </select>
                             </div>
                             <div class="form-group col-md-8 col-md-12">
                               <label for="exampleFormControlTextarea1">Your Monthly Industry Assesment </label>
                               <textarea class="form-control" id="industry_assessment" name="industry_assessment" value="<?= isset($_POST['industry_assessment']) ? $_POST['industry_assessment'] : ''; ?>" rows="3"></textarea>
                             </div>
                             <div class="form-group col-md-8 col-md-12">
                               <label for="exampleFormControlTextarea1">Comments </label>
                               <textarea class="form-control" id="industry_comments" name="industry_comments" value="<?= isset($_POST['industry_comments']) ? $_POST['industry_comments'] : ''; ?>" rows="3"></textarea>
                             </div>
                             <div class="form-group  col-md-3">
                               <label for="exampleFormControlSelect1">Next Update</label>
                               <input type="text" class="form-control"id="next_day_update" name="next_day_update" value="<?php echo $next_day_update; ?>" placeholder="">
                               <small id="emailHelp" class="form-text text-muted">You will receive notifications to update info on this day next month.</small>
                             </div>
                             <div class="form-group  col-md-8">
                             <button type="submit" name="submit" class="btn btn-primary btn-lg"  value="Submit">Update Data</button>
                           </form>
                          </div>
                        </div>
                      </div>
                    </div>
                   <br />
                  </div>
                </div>
               </div>
            </div>
          </div>
         </body>
       </html>
