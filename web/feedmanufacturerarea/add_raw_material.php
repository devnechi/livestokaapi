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
      $manufacturer_id = $feed_manufacture_id;
      $raw_material_title = $_POST['raw_material_title'];
      $raw_material_desc = $_POST['raw_material_desc'];
      $purpose_statement = $_POST['purpose_statement'];

      // raw material consumption $params

      $use_of_material = $_POST['purpose_statement'];;
      $total_raw_materials_consumed = $_POST['total_raw_materials_consumed'];
      $measurements = $_POST['measurements'];
      $current_instorage = $_POST['current_instorage'];
      $instorage_measurement =$_POST['instorage_measurement'];
      $next_day_update = $_POST['next_day_update'];

       // $next_day_update = date("d/m/Y", strtotime(" +1 months"));

      //validations
      $fields_required= array("raw_material_title", "total_raw_materials_consumed");
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
   // feed manufacturer adds new raw material
   $rawmaterial = $db->manuAddNewRawMaterial($creator_id, $manufacturer_id, $raw_material_title, $raw_material_desc, $purpose_statement);
   if ($rawmaterial) {
       // user stored successfully
       $response["error"] = false;
       $response["rmuid"] = $rawmaterial["raw_material_unique_id"];
       $response["rawmaterial"]["raw_material_id"] = $rawmaterial["raw_material_id"];
       $response["rawmaterial"]["creator_id"] = $rawmaterial["creator_id"];
       $response["rawmaterial"]["manufacturer_id"] = $rawmaterial["manufacturer_id"];
       $response["rawmaterial"]["raw_material_title"] = $rawmaterial["raw_material_title"];
       $response["rawmaterial"]["raw_material_desc"] = $rawmaterial["raw_material_desc"];
       $response["rawmaterial"]["purpose_statement"] = $rawmaterial["purpose_statement"];
       $response["rawmaterial"]["date_created"] = $rawmaterial["date_created"];
       $response["rawmaterial"]["date_updated"] = $rawmaterial["date_updated"];


         $raw_material_id = $rawmaterial["raw_material_id"];
         $feed_manufacturer_id = $rawmaterial["manufacturer_id"];
         // feed manufacturer adds new product
         $rawmaterialconsumption = $db->manuRawMaterialConsumption($feed_manufacturer_id, $raw_material_id, $creator_id,  $use_of_material, $total_raw_materials_consumed, $measurements, $current_instorage, $instorage_measurement, $next_day_update);
         if ($rawmaterialconsumption) {
             // user stored successfully
             $response["error"] = false;
             $response["rmcuid"] = $rawmaterialconsumption["consumption_unique_id"];
             $response["rawmaterialconsumption"]["consumption_id"] = $rawmaterialconsumption["consumption_id"];
             $response["rawmaterialconsumption"]["feed_manufacturer_id"] = $rawmaterialconsumption["feed_manufacturer_id"];
             $response["rawmaterialconsumption"]["raw_material_id"] = $rawmaterialconsumption["raw_material_id"];
             $response["rawmaterialconsumption"]["creator_id"] = $rawmaterialconsumption["creator_id"];
             $response["rawmaterialconsumption"]["use_of_material"] = $rawmaterialconsumption["use_of_material"];
             $response["rawmaterialconsumption"]["total_raw_materials_consumed"] = $rawmaterialconsumption["total_raw_materials_consumed"];
             $response["rawmaterialconsumption"]["measurements"] = $rawmaterialconsumption["measurements"];
             $response["rawmaterialconsumption"]["current_instorage"] = $rawmaterialconsumption["current_instorage"];
             $response["rawmaterialconsumption"]["instorage_measurement"] = $rawmaterialconsumption["instorage_measurement"];
             $response["rawmaterialconsumption"]["next_day_update"] = $rawmaterialconsumption["next_day_update"];
             $response["rawmaterialconsumption"]["date_created"] = $rawmaterialconsumption["date_created"];
             $response["rawmaterialconsumption"]["date_updated"] = $rawmaterialconsumption["date_updated"];

             $message = "<div class=\"alert alert-success\" role=\"alert\">
               <strong>Well done!</strong> You successfully! <a href=\"#\" class=\"alert-link\">added a new raw material that you use </a>.
             </div>";

         } else {
             // user failed to store
             $response["error"] = true;
             $response["error_msg"] = "Unknown error occurred while creating a raw material consumption record!";
             // echo json_encode($response);
         }

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
                                    <h4 class="title">Add New Raw Material that you started using</h4>
                                    <p class="category">Here you will add raw materials that you use. </p>
                                </div>
                                <div class="card-content table-responsive">
                                    <p>With the form below one can enter Raw materials used to produce feed products.</p>
                                    <p>This information helps keep track of raw material consumption and later determines the industry insights.</p>



                                     <br />
                                <div class="container-fluid">
                                  <?php echo $message; ?>
                                  <?php echo form_errors($errors); ?>
                                  <br />
                                <form action="add_raw_material.php" method="post">
                                  <div class="panel panel-default">
                                    <div class="panel-heading card-header">
                                      <h3 class="panel-title title">Raw Material Details</h3>
                                    </div>
                                    <div class="panel-body">
                                  <div class="form-group">
                                    <label for="formGroupExampleInput">Raw Material Title</label>
                                    <input type="text" class="form-control" id="raw_material_title" name="raw_material_title" value="<?= isset($_POST['raw_material_title']) ? $_POST['raw_material_title'] : ''; ?>" placeholder="">
                                  </div>

                                  <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Raw Material Description</label>
                                    <textarea class="form-control" id="raw_material_desc" name="raw_material_desc" value="<?= isset($_POST['raw_material_desc']) ? $_POST['raw_material_desc'] : ''; ?>" placeholder="" rows="5"></textarea>
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Raw Material Purpose Statement</label>
                                    <textarea class="form-control" id="purpose_statement" name="purpose_statement" value="<?= isset($_POST['purpose_statement']) ? $_POST['purpose_statement'] : ''; ?>" placeholder="" rows="5"></textarea>
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label for="formGroupExampleInput">Quantity Estimate Used Every Month. <small>in TONS </small></label>
                                    <input type="text" class="form-control" id="total_raw_materials_consumed" name="total_raw_materials_consumed" value="<?= isset($_POST['total_raw_materials_consumed']) ? $_POST['total_raw_materials_consumed'] : ''; ?>" placeholder="">
                                  </div>
                                  <div class="form-group  col-md-6">
                                    <label for="exampleFormControlSelect1">Quantity is measured in</label>
                                    <select class="form-control" id="measurements" name="measurements" value="<?= isset($_POST['measurements']) ? $_POST['measurements'] : ''; ?>">
                                      <option>SELECT</option>
                                      <option>KG</option>
                                      <option>TONS</option>

                                    </select>
                                  </div>

                                  <div class="form-group  col-md-6">
                                    <label for="formGroupExampleInput">Raw Material Total Quantity in the Storage</label>
                                    <input type="text" class="form-control"id="current_instorage" name="current_instorage" value="<?= isset($_POST['current_instorage']) ? $_POST['current_instorage'] : ''; ?>" placeholder="">
                                  </div>


                                  <div class="form-group  col-md-6">
                                    <label for="exampleFormControlSelect1">Quantity is measured in</label>
                                    <select class="form-control" id="instorage_measurement" name="instorage_measurement" value="<?= isset($_POST['instorage_measurement']) ? $_POST['instorage_measurement'] : ''; ?>">
                                      <option>SELECT</option>
                                      <option>KG</option>
                                      <option>TONS</option>

                                    </select>
                                  </div>

                                  <div class="form-group  col-md-6">
                                    <label for="exampleFormControlSelect1">Next Update</label>
                                    <input type="text" class="form-control" readonly id="next_day_update" name="next_day_update" value="<?php echo $next_day_update; ?>"  placeholder="">
                                    <small id="emailHelp" class="form-text text-muted">You will receive notifications to update info on this date.</small>

                                  </div>
                                  <div class="form-group  col-md-8">
                                  <button type="submit"  name="submit" class="btn btn-primary btn-lg"  value="Submit">Add new Raw Material</button>
                                </div>
                                </div>
                              </div>
                                </form>


                              </div>
                          </div>
          </div>
        </div>
      </div>
    </div>

    <?php
    include("../../includes/layouts/main_fm_footer_layout.php");

    ?>
