<?php
ob_start();
session_start();


include("../../includes/layouts/breeder_header_layout.php");
require_once '../../includes/DbOperation.php';
require_once '../../includes/validations_functions.php';
?>
<?php confirm_logged_in(); ?>
<?php $layout_context = "Breeder"; ?>
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
		  if ($logged_user_usertype != "breeder User") {
        // user is not of feed manufacturer type...
        //usertype is different
        header('Location: ../../web/login_area.php');
		  } else {
		  	// logged in user is of feed manufacturer



                // <!-- get hatchery details -->
                //get hatchery details depending with
                $db = new DbOperation();
                // json response array
                $user_id = $logged_user_id;
                $response = array("error" => false);
                if (isset($user_id)) {
                    // receiving the post params
                    $breeder_farm = $db->getBreederFarmMainDetails($user_id);
                if ($breeder_farm != false) {
                    // use is found
                    $response["error"] = false;
                    $response["bffuid"] = $breeder_farm["breeder_unique_id"];
                    $response["breeder_farm"]["breeders_id"] = $breeder_farm["breeders_id"];
                    $response["breeder_farm"]["user_id"] = $breeder_farm["user_id"];
                    $response["breeder_farm"]["farm_name"] = $breeder_farm["farm_name"];
                    $response["breeder_farm"]["date_established"] = $breeder_farm["date_established"];
                    $response["breeder_farm"]["type_of_ownership"] = $breeder_farm["type_of_ownership"];
                    $response["breeder_farm"]["maximum_flock_size"] = $breeder_farm["maximum_flock_size"];
                    $response["breeder_farm"]["total_peryear_capacity"] = $breeder_farm["total_peryear_capacity"];
                    $response["breeder_farm"]["contact_person"] = $breeder_farm["contact_person"];
                    $response["breeder_farm"]["created_at"] = $breeder_farm["created_at"];
                    $response["breeder_farm"]["updated_at"] = $breeder_farm["updated_at"];

                    //echo json_encode($response);
                    $logged_breeder_farm_name = $breeder_farm["farm_name"];
                    $logged_breeder_farm_id =  $breeder_farm["breeders_id"];

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

<div class="container-fluid user-dashboard">
              <div class="row">
                          <div class="col-lg-12">

                                <div class="card-header" data-background-color="orange">
                                    <h4 class="title">Details of the Cattle</h4>
                                    <p class="category">This product will appear as what you produce</p>
                                </div>




                                <form action="add_new_product.php" method="post">
                                  <div class="panel  panel-default">
                                    <div class="panel-heading card-header">
                                      <h3 class="panel-title title">Breed Description</h3>
                                    </div>
                                    <div class="panel-body">
                                    <div class="form-group ">
                                        <label for="formGroupExampleInput">Total Number of livestok</label>
                                        <input type="text" class="form-control"  id="brand_name" name="brand_name"  placeholder="">
                                      </div>
                                      <div class="form-group ">
                                        <label for="formGroupExampleInput">Type of livestock</label>
                                        <select class="form-control" id="country" name="country" >
                                          <option>SELECT</option>
                                          <option>Chicken</option>
                                          <option>Turkey</option>
                                          <option>Lamb</option>
                                          <option>Goats</option>
                                          <option>Fish</option>
                                        </select>
                                      </div>

                                      <div class="form-group ">
                                        <label for="formGroupExampleInput">Type of Breed</label>
                                        <select class="form-control" id="country" name="country" >
                                          <option>SELECT</option>
                                          <option>Bloiler</option>
                                          <option>hybrid</option>
                                          <option>Local</option>
                                          <option>for hachery</option>
                                          <option>for eggs</option>
                                        </select>
                                      </div>
                                      <div class="form-group ">
                                        <label for="formGroupProductName">Barcode/Registration number</label>
                                        <input type="text" class="form-control" id="product_name" name="product_name"  placeholder="">
                                      </div>
                                      <div class="form-group ">
                                        <label for="formGroupExampleInput">How many</label>
                                        <input type="text" class="form-control"  id="brand_name" name="brand_name"  placeholder="">
                                      </div>

                                      <div class="form-group ">
                                        <label for="exampleFormControlTextarea1">Breed Purpose Statement</label>
                                        <textarea class="form-control"  id="product_purpose_statement" name="product_purpose_statement" value="<?= isset($_POST['product_purpose_statement']) ? $_POST['product_purpose_statement'] : ''; ?>" rows="3"></textarea>
                                      </div>
                                      <div class="form-group ">
                                        <label for="exampleFormControlTextarea1">Breed Description</label>
                                        <textarea class="form-control"  id="product_description" name="product_description" value="<?= isset($_POST['product_description']) ? $_POST['product_description'] : ''; ?>" rows="3"></textarea>
                                      </div>
                                    </div>

                                  </div>
                                  <br />



                                  <div class="panel panel-default">
                                    <div class="panel-heading card-header">
                                      <h3 class="panel-title title">Breed Production Details</h3>
                                    </div>
                                    <div class="panel-body">
                                  <div class="form-group  ">
                                    <label for="formGroupExampleInput">Est. of Monthly Quantity Produced. <small>every month</small></label>
                                    <input type="text" class="form-control" id="monthly_qty_production"  id="monthly_qty_production" name="monthly_qty_production" value="<?= isset($_POST['monthly_qty_production']) ? $_POST['monthly_qty_production'] : ''; ?>" placeholder="">
                                  </div>

                                  <div class="form-group  ">
                                    <label for="exampleFormControlSelect1">Quantity is measured in</label>
                                    <select class="form-control"  id="quantity_measurements" name="quantity_measurements" value="<?= isset($_POST['quantity_measurements']) ? $_POST['quantity_measurements'] : ''; ?>">
                                      <option>Weight</option>
                                      <option>Numbers</option>
                                      <option>Flocks</option>

                                    </select>
                                  </div>

                                  <div class="form-group  ">
                                    <label for="formGroupExampleInput">Current Product Manufacturing Capacity</label>
                                    <input type="text" class="form-control"  id="product_manu_capacity" name="product_manu_capacity" value="<?= isset($_POST['product_manu_capacity']) ? $_POST['product_manu_capacity'] : ''; ?>" placeholder="">
                                  </div>

                                  <div class="form-group  ">
                                    <label for="formGroupExampleInput">Current Product Quantinty in Storage.<small>as of Today.</small></label>
                                    <input type="text" class="form-control" id="current_quantinty_instorage" name="current_quantinty_instorage" value="<?= isset($_POST['current_quantinty_instorage']) ? $_POST['current_quantinty_instorage'] : ''; ?>" placeholder="">
                                  </div>
                                  <div class="form-group">
                                    <label for="formGroupExampleInput">Breeder Flock/batch Source</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
                                  </div>
                                </div>
                              </div>
                              <br />
                              <div class="panel panel-default">
                                <div class="panel-heading card-header">
                                  <h3 class="panel-title title">Production Timeline</h3>
                                </div>
                                <div class="panel-body">

                                  <div class="form-group  ">
                                    <label for="formGroupExampleInput">day to update.</label>
                                    <input type="text" class="form-control" readonly id="next_day_update" name="next_day_update"   placeholder="">

                                    <small id="emailHelp" class="form-text text-muted">You will receive notifications to update info on this date.</small>
                                  </div>
                                  </div>

                                </div>





                                  <button type="submit" class="btn btn-primary btn-lg">Create New Batch</button>

                                </form>


                              </div>
                          </div>
          </div>
        </div>


          </body>
          </html>
