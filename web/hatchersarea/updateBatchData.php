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

<div class="container-fluid">
	<div class="row">

									<div class="col-md-12">
										<div class="card">
											<div class="card-header" data-background-color="orange">
													<h4 class="title">Update Batch Data</h4>
													<p class="category">As of Last week, 2018</p>
											</div>
											<div class="card-content table-responsive spcbelow"  >
													<p>Select a batch to update.</p>

                          <div class="row">
                            <div class="form-group col-lg-offset-2 col-md-6 input-group-lg">
                                 <label for="exampleFormControlSelect1" class="control-label">select below:</label>
                                 <select class="form-control" aria-label="Large"  id="exampleFormControlSelect1" aria-describedby="inputGroup-sizing-sm">
                                   <option>Select</option>
                                   <option>Service</option>
                                   <option>Training</option>
                                    <option>Seminar</option>
                                    <option>Other</option>
                                 </select>
                               </div>

                          </div>
												</div>
											</div>
											</div>
								</div>
                <?php
                include("../../includes/layouts/hatchery_main_footer.php");

                ?>
