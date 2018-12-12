<?php
ob_start();
session_start();


include("../../includes/layouts/main_hatchery_header.php");
require_once '../../includes/DbOperation.php';
require_once '../../includes/validations_functions.php';
?>
<?php confirm_logged_in(); ?>
<?php $layout_context = "Hatchery_user"; ?>

<?php
  if ($_SESSION['loggedIn'] != TRUE) {
  	// code...
		//SET UR ID AND THE USEREMAIL
		$message = "<div class=\"alert alert-danger\" role=\"alert\">
			<strong>Log in Again</strong> <a href=\"#\" class=\"alert-link\">Seems like we failed to authenticate you</a> Try login again.
		</div>";
    header('Location: ../../web/login_area.php');
  } else{
  	// code...
    //user session details
		$logged_user_id = $_SESSION['user_log_id'];
		$logged_user_email = $_SESSION['user_log_email'];
		$logged_user_usertype = $_SESSION['user_log_usertype'];
			//
		  if ($logged_user_usertype != "Hatchery User") {
        // user is not of feed manufacturer type...
        //usertype is different
        header('Location: ../../web/login_area.php');
		  } else {
		  	// logged in user is of hatchery


        // <!-- get hatchery details -->
        //get hatchery details depending with
        $db = new DbOperation();
        // json response array
        $user_id = $logged_user_id;
        $response = array("error" => false);
        if (isset($user_id)) {
            // receiving the post params
            $hatchery = $db->getHatcheryMainDetails($user_id);
        if ($hatchery != false) {
            // use is found
            $response["error"] = false;
            $response["hatuid"] = $hatchery["hatchery_unique_id"];
            $response["hatchery"]["hatchery_id"] = $hatchery["hatchery_id"];
            $response["hatchery"]["user_id"] = $hatchery["user_id"];
            $response["hatchery"]["hatchery_name"] = $hatchery["hatchery_name"];
            $response["hatchery"]["date_established"] = $hatchery["date_established"];
            $response["hatchery"]["type_of_ownership"] = $hatchery["type_of_ownership"];
            $response["hatchery"]["contact_person"] = $hatchery["contact_person"];
            $response["hatchery"]["phone_number"] = $hatchery["phone_number"];
            $response["hatchery"]["created_at"] = $hatchery["created_at"];
            $response["hatchery"]["updated_at"] = $hatchery["updated_at"];

            //echo json_encode($response);
            $logged_hatchery_name = $hatchery["hatchery_name"];
            $logged_hatchery_id =  $hatchery["hatchery_id"];

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
        //TODO: update last_login status in database


		  }
  }
 ?>
<?php
$next_day_update = date("d-m-Y", strtotime(" +1 weeks"));
?>

 <!-- process to insert new batch on submit -->
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
       // $creator_id, $hatchery_id, $quantity_of_eggs,
       //  $date_recorded, $egg_source_name, $eggs_age, $number_of_breaks,
       //  $number_of_eggs_set, $date_set, $number_of_setters, $setting_temperature,
       //  $setting_humidity, $next_upcoming_update, $stage_one

        $stage_one = "done";
        $creator_id = $logged_user_id;
        $hatchery_id = $logged_hatchery_id;
        $quantity_of_eggs = $_POST['quantity_of_eggs'];

        $date_recorded = $_POST['date_recorded'];
        $egg_source_name = $_POST['egg_source_name'];
        $eggs_age = $_POST['eggs_age'];
        $number_of_breaks = $_POST['number_of_breaks'];
        $number_of_eggs_set = $_POST['number_of_eggs_set'];
        $date_set  = $_POST['date_set'];
        $number_of_setters  = $_POST['number_of_setters'];
        $setting_temperature  = $_POST['setting_temperature'];
        $setting_humidity  = $_POST['setting_humidity'];
        $next_upcoming_update  = $_POST['next_upcoming_update'];

        $public_batch_id = $egg_source_name.$date_recorded.$quantity_of_eggs;

       //validations
       $fields_required= array("number_of_eggs_set", "quantity_of_eggs");
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
       $fields_required= array("quantity_of_eggs", "number_of_setters", "number_of_breaks");
       foreach($fields_required as $field){
         $value = trim($_POST[$field]);
         if(!is_numeric($value)){

           $message = "<div class=\"alert alert-info\" role=\"alert\">
             <strong>Oh snap!</strong> <a href=\"#\" class=\"alert-link\">make sure values are numeric </a> and try submitting again.
           </div>";

            $errors[$field] = ucfirst($field) . " should be numeric";

         }
       }

      //
      // // Using assoc. arrays
      // $fields_with_max_lengths = array("plant_manager" => 30, "premise_cert_num" => 8);
      //  validate_max_length($fields_with_max_lengths);
      if (empty($errors)) {
        // hatchery adds new batch
        $new_hatching_batch = $db->hatcheryCreateNewBatch($hatchery_id, $creator_id, $public_batch_id, $quantity_of_eggs, $date_recorded, $egg_source_name, $eggs_age, $number_of_breaks,
         $number_of_eggs_set, $date_set, $number_of_setters, $setting_temperature, $setting_humidity, $next_upcoming_update, $stage_one);
        if ($new_hatching_batch) {
            // new batch stored successfully
            $response["error"] = false;
            $response["npuid"] = $new_hatching_batch["batch_unique_id"];
            $response["new_hatching_batch"][" batch_id"] = $new_hatching_batch["batch_id"];
            $response["new_hatching_batch"]["hatchery_id"] = $new_hatching_batch["hatchery_id"];
            $response["new_hatching_batch"]["creator_id"] = $new_hatching_batch["creator_id"];
            $response["new_hatching_batch"]["public_batch_id"] = $new_hatching_batch["public_batch_id"];
            $response["new_hatching_batch"]["quantity_of_eggs"] = $new_hatching_batch["quantity_of_eggs"];
            $response["new_hatching_batch"]["date_recorded"] = $new_hatching_batch["date_recorded"];
            $response["new_hatching_batch"]["egg_source"] = $new_hatching_batch["egg_source"];
            $response["new_hatching_batch"]["age_of_eggs"] = $new_hatching_batch["age_of_eggs"];
            $response["new_hatching_batch"]["number_of_breaks"] = $new_hatching_batch["number_of_breaks"];
            $response["new_hatching_batch"]["number_of_eggs_on_setter"] = $new_hatching_batch["number_of_eggs_on_setter"];
            $response["new_hatching_batch"]["date_set"] = $new_hatching_batch["date_set"];
            $response["new_hatching_batch"]["number_of_setters"] = $new_hatching_batch["number_of_setters"];
            $response["new_hatching_batch"]["setting_temperature"] = $new_hatching_batch["setting_temperature"];
            $response["new_hatching_batch"]["setting_humidity"] = $new_hatching_batch["setting_humidity"];
            $response["new_hatching_batch"]["stage_one"] = $new_hatching_batch["stage_one"];
            $response["new_hatching_batch"]["date_created"] = $new_hatching_batch["date_created"];

            // $feeds_product_id = $feeds_product["feed_product_id"];;
            // $pcreator_id  = $feeds_product["creator_id"];;

             $created_batch_id = $new_hatching_batch["batch_id"];
             $ongoing_creator_id = $new_hatching_batch["creator_id"];
             $ongoing_public_batch = $new_hatching_batch["public_batch_id"];
             $ongoing_hatchery_id =  $new_hatching_batch["hatchery_id"];
             $ongoing_batch_status = "on going";
             $ongoing_batch_current_stage = "stage 1";
       //      // hatchery adds new batch to the on-going batcher
              $on_going_batches = $db->createOngoingBatch($ongoing_creator_id, $ongoing_hatchery_id, $ongoing_public_batch,
          $created_batch_id,  $ongoing_batch_current_stage, $ongoing_batch_status);
       //      if ($on_going_batches) {
       //          // user stored successfully
       //          $response["error"] = false;
       //          $response["ogbuid"] = $on_going_batches["unique_ongoing_batches"];
       //          $response["on_going_batches"]["ongoing_batches_id"] = $on_going_batches["ongoing_batches_id"];
       //          $response["on_going_batches"]["creator_id"] = $on_going_batches["creator_id"];
       //          $response["on_going_batches"]["hatchery_id"] = $on_going_batches["hatchery_id"];
       //          $response["on_going_batches"]["public_batch_id"] = $on_going_batches["public_batch_id"];
       //          $response["on_going_batches"]["created_batch_id"] = $on_going_batches["created_batch_id"];
       //          $response["on_going_batches"]["batch_current_stage"] = $on_going_batches["batch_current_stage"];
       //          $response["on_going_batches"]["batch_status"] = $on_going_batches["batch_status"];
       //          $response["on_going_batches"]["date_created"] = $on_going_batches["date_created"];
       //
       //
       //      $message = "<div class=\"alert alert-success\" role=\"alert\">
       //        <strong>Well done!</strong> You successfully! <a href=\"#\" class=\"alert-link\">created a new batch</a>.
       //      </div>";
       //
       //  } else {
       //      // user failed to store
       //      $response["error"] = true;
       //      $response["error_msg"] = "Unknown error occurred while creating a new batch!";
       //      echo json_encode($response);
       //  }

            $message = "<div class=\"alert alert-success\" role=\"alert\">
              <strong>Well done!</strong> You successfully! <a href=\"#\" class=\"alert-link\">created a new batch</a>.
            </div>";
            // header("Location: new_batch.php"); // redirect back to your contact form
            //    exit;
            $_POST = array();
       } else {
       $response["error"] = true;
       $response["error_msg"] = "Required parameters (user identification or hatchery number) is missing!";
       echo json_encode($response);
       }

      }else{
   // $username = "";
   $message = "<div class=\"alert alert-info\" role=\"alert\">
     <strong>Take note!</strong> <a href=\"#\" class=\"alert-link\">When creating a new batch</a> please fill all the relevant details.
   </div>";
    }
  }
    ?>

<div class="container-fluid">
	<div class="row">

									<div class="col-md-12">
										<div class="card">
											<div class="card-header" data-background-color="orange">
													<h4 class="title">New Batch to be Hatched</h4>
													<p class="category">your last batch was created on February, 2018</p>
                          <p class="category">
                            <?php echo $logged_hatchery_id; ?></p>
                            <p class="category">
                              <?php echo $logged_hatchery_name; ?></p>

                    	</div>
											<div class="card-content table-responsive">
													<p>Enter the details required.</p>
                          <form action="new_batch.php" method="post">
                            <div class="row">
                              <div class="col-md-6">
                                <h3>flock information <span class="badge badge-secondary">stage 1</span></h3>
                                <?php echo $message;?>
                                <?php
                                 echo form_errors($errors);
                                  ?>
                              </div>
                            </div>
                            <hr>
                            <p class="category">flocks source and date recorded</p>

                            <div class="row">
                                <div class="form-group col-md-6">
                                  <label for="formGroupProductName">Quantity of Eggs/ Number Recorded</label>
                                  <input type="text" class="form-control" id="quantity_of_eggs" name="quantity_of_eggs" value="<?= isset($_POST['quantity_of_eggs']) ? $_POST['quantity_of_eggs'] : ''; ?>" placeholder="">
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="colFormLabel" class="control-label">date recorded</label>
                                <div class="input-group datetimepicker">
                                  <input type="text" class="form-control"  id="date_recorded" name="date_recorded" placeholder="date recorded">
                                   <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                  </span>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                  <label for="formGroupProductName">Eggs Source</label>
                                  <input type="text" class="form-control" id="egg_source_name" name="egg_source_name" value="<?= isset($_POST['egg_source_name']) ? $_POST['egg_source_name'] : ''; ?>" placeholder="">
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="formGroupProductName">Age <small>(in weeks)</small></label>
                                  <input type="text" class="form-control" id="eggs_age" name="eggs_age" value="<?= isset($_POST['eggs_age']) ? $_POST['eggs_age'] : ''; ?>" placeholder="">
                                </div>
                            </div>
                            <hr>
                            <p class="category">eggs details</p>
                            <div class="row">
                                <div class="form-group col-md-6">
                                  <label for="formGroupProductName">Number of Breaks</label>
                                  <input type="text" class="form-control" id="number_of_breaks" name="number_of_breaks" value="<?= isset($_POST['number_of_breaks']) ? $_POST['number_of_breaks'] : ''; ?>" placeholder="">
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="formGroupProductName">Number of Eggs Set</label>
                                  <input type="text" class="form-control" id="number_of_eggs_set" name="number_of_eggs_set" value="<?= isset($_POST['number_of_eggs_set']) ? $_POST['number_of_eggs_set'] : ''; ?>" placeholder="">
                                </div>
                              </div>
                              <div class="row">
                                <div class="form-group col-md-6">
                                  <label for="colFormLabel" class="control-label">date set</label>
                                <div class="input-group datetimepicker">
                                  <input type="text" class="form-control"  id="date_set" name="date_set" placeholder="date set">
                                   <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                  </span>
                                </div>
                                </div>
                                  <div class="form-group col-md-6">
                                    <label for="formGroupProductName">number of Setters</label>
                                    <input type="text" class="form-control" id="number_of_setters" name="number_of_setters" value="<?= isset($_POST['number_of_setters']) ? $_POST['number_of_setters'] : ''; ?>" placeholder="">
                                  </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                      <label for="formGroupProductName">Setting Temperature</label>
                                      <input type="text" class="form-control" id="setting_temperature" name="setting_temperature" value="<?= isset($_POST['setting_temperature']) ? $_POST['setting_temperature'] : ''; ?>" placeholder="">
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label for="formGroupProductName">Setting Humidity</label>
                                      <input type="text" class="form-control" id="setting_humidity" name="setting_humidity" value="<?= isset($_POST['setting_humidity']) ? $_POST['setting_humidity'] : ''; ?>" placeholder="">
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label for="exampleFormControlTextarea1">Next upcoming batch update</label>
                                      <input type="text" class="form-control" readonly id="next_upcoming_update" name="next_upcoming_update" value="<?php echo $next_day_update; ?>"  placeholder="">
                                      <small id="emailHelp" class="form-text text-muted">You will receive notifications to update info on this date.</small>
                                    </div>
                                  </div>

                                  <div class="row">
                                      <div class="form-group col-md-6">

                                      </div>
                                      <div class="form-group col-md-6">
                                      <button type="submit"  name="submit" type="button" class="btn btn-success btn-lg" value="Submit">create new batch</button>
                                </div>
                              </div>
                            </div>
                        </form>
											</div>
										</div>
									</div>
								</div>
                <?php
                include("../../includes/layouts/hatchery_main_footer.php");

                ?>
