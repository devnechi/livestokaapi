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
		  	// logged in user is of feed manufacturer

        //TODO: update last_login status in database

        //

		  }

  }

 ?>
<?php
$next_day_update = date("d-m-Y", strtotime(" +1 weeks"));

?>



<div class="container-fluid">
	<div class="row">

									<div class="col-md-12">
										<div class="card">
											<div class="card-header" data-background-color="orange">
													<h4 class="title">New Batch to be Hatched</h4>
													<p class="category">your last batch was created on February, 2018</p>
											</div>
											<div class="card-content table-responsive">
													<p>Enter the details required.</p>
                          <form action="hatchery_registration.php" method="post">
                            <div class="row">
                              <div class="col-md-6">
                                <h3>flock information <span class="badge badge-secondary">stage 1</span></h3>

                              </div>
                            </div>
                            <hr>
                            <p class="category">flocks source and date recorded</p>

                            <div class="row">
                                <div class="form-group col-md-6">
                                  <label for="formGroupProductName">Quantity of Eggs</label>
                                  <input type="text" class="form-control" id="quantity_of_eggs" name="quantity_of_eggs" value="<?= isset($_POST['quantity_of_eggs']) ? $_POST['quantity_of_eggs'] : ''; ?>" placeholder="">
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="colFormLabel" class="control-label">date recorded</label>
                                <div class="input-group datetimepicker">
                                  <input type="text" class="form-control"  id="date_recorded" placeholder="date recorded">
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
                                  <input type="text" class="form-control"  id="date_set" placeholder="date set">
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
                                      <button type="button" class="btn btn-success btn-lg">create new batch</button>
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
