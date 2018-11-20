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
													<h4 class="title text-center">Update Batch Data</h4>
													<p class="category text-center">As of Last week, 2018</p>
											</div>
											<div class="card-content table-responsive spcbelow"  >
													<p class="text-center">Select a batch to update.</p>

                          <div class="row">
                            <div class="form-group col-lg-offset-2 col-md-6 input-group-lg">
                                 <!-- <label for="exampleFormControlSelect1" class="control-label">select below:</label> -->
                                 <select class="form-control" aria-label="Large"  id="exampleFormControlSelect1" aria-describedby="inputGroup-sizing-sm">
                                   <option>Select</option>
                                   <option>imported-12-12-83-40-batch</option>
                                   <option>local-11-2-18-230-batch</option>
                                    <option>exporter-1-12-18-450-batch</option>
                                    <option>outgrowers-12-22-8-500-batch</option>
                                 </select>
                               </div>

                          </div>
                          <div class="row">
                            <div class="form-group col-lg-offset-2 col-md-6 input-group-lg">
                                 <label for="exampleFormControlSelect1" class="control-label">batchid:</label>
                                  <label for="exampleFormControlSelect1" class="control-label">egg source:</label>
                                   <label for="exampleFormControlSelect1" class="control-label">date created:</label>
                                    <label for="exampleFormControlSelect1" class="control-label">other info:</label>

                          </div>
												</div>
											</div>
											</div>
								</div>
              </div>


         <!-- display panels depending on the stage of the batch selected  -->
            <!-- stage 2 -->
            <div class="container-fluid">
            	<div class="row">
								<div class="col-md-12">
									<div class="card">
										<div class="card-header" data-background-color="orange">
                        <div class="row">
                          <div class="col-sm-3">
                            <h4 class="title">Batch Data</h4>
                           <p class="category">As of Last updated at</p>
                           <p> 12-Nov-2018</p>
                          </div>
                          <div class="col-sm-4">
                            <h4 class="title">Candling Report</h4>
                            <p class="category">Updating batch to stage</p>
                          </div>
                          <div class="col-sm-3">
                            <h4 class="title" style="font-size: 70px;">2</h4>
                            <!-- <p class="category">going to stage 3 </p> -->

                          </div>
                        </div>
										</div>
										<div class="card-content table-responsive spcbelow"  >
												<p>Candling Report.</p>

                         <hr>
                          <p class="category">Clear Eggs</p>
                          <form>
                          <div class="row">
                              <div class="form-group col-md-6">
                                <label for="formGroupProductName">Number of clear eggs</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" value="<?= isset($_POST['product_name']) ? $_POST['product_name'] : ''; ?>" placeholder="">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="formGroupProductName">Percentage <small>%</small></label>
                                <input type="text" class="form-control" id="product_name" name="product_name" value="<?= isset($_POST['product_name']) ? $_POST['product_name'] : ''; ?>" placeholder="">
                              </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                              <label for="formGroupProductName">Rots</label>
                              <input type="text" class="form-control" id="product_name" name="product_name" value="<?= isset($_POST['product_name']) ? $_POST['product_name'] : ''; ?>" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                              <label for="formGroupProductName">Fertility <small>%</small></label>
                              <input type="text" class="form-control" id="product_name" name="product_name" value="<?= isset($_POST['product_name']) ? $_POST['product_name'] : ''; ?>" placeholder="">
                            </div>
                      </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                              <label for="formGroupProductName">Candling Temperature</label>
                              <input type="text" class="form-control" id="product_name" name="product_name" value="<?= isset($_POST['product_name']) ? $_POST['product_name'] : ''; ?>" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                              <label for="formGroupProductName">Candling Humidity</label>
                              <input type="text" class="form-control" id="product_name" name="product_name" value="<?= isset($_POST['product_name']) ? $_POST['product_name'] : ''; ?>" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                              <label for="exampleFormControlTextarea1">Next upcoming batch update</label>
                              <input type="text" class="form-control" readonly id="next_day_updatep" name="next_day_updatep" value="<?php echo $next_day_update; ?>"  placeholder="">
                              <small id="emailHelp" class="form-text text-muted">You will receive notifications to update info on this date.</small>
                            </div>
                            <div class="form-group col-md-6">
                            <button type="button" class="btn btn-success btn-lg pull-right">update batch</button>
                            </div>
                          </div>
                       </form>
										</div>
									</div>
								</div>
              </div>
            </div>
              <!-- end of stage 2: candling report -->
              <!-- stage 3 -->
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-header" data-background-color="orange">
                          <div class="row">
                            <div class="col-sm-3">
                              <h4 class="title">Batch Data</h4>
                             <p class="category">As of Last updated at</p>
                             <p> 12-Nov-2018</p>
                            </div>
                            <div class="col-sm-4">
                              <h4 class="title">Hatching Report</h4>
                              <p class="category">Updating batch to stage</p>
                            </div>
                            <div class="col-sm-3">
                              <h4 class="title" style="font-size: 70px;">3</h4>
                              <!-- <p class="category">going to stage 3 </p> -->

                            </div>
                          </div>
                      </div>
                      <div class="card-content table-responsive spcbelow"  >
                          <p>Update hatching report.</p>
                          <p class="category">Hatchability</p>
                          <form>
                          <div class="row">
                              <div class="form-group col-md-6">
                                <label for="formGroupProductName">Number of chicks Hatched</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" value="<?= isset($_POST['product_name']) ? $_POST['product_name'] : ''; ?>" placeholder="">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="formGroupProductName">Number of culls</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" value="<?= isset($_POST['product_name']) ? $_POST['product_name'] : ''; ?>" placeholder="">
                              </div>
                         </div>
                         <div class="row">
                            <div class="form-group col-md-6">
                              <label for="formGroupProductName">Dead Culls</label>
                              <input type="text" class="form-control" id="product_name" name="product_name" value="<?= isset($_POST['product_name']) ? $_POST['product_name'] : ''; ?>" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                              <label for="formGroupProductName">Dead culls<small> %</small></label>
                              <input type="text" class="form-control" id="product_name" name="product_name" value="<?= isset($_POST['product_name']) ? $_POST['product_name'] : ''; ?>" placeholder="">
                            </div>
                         </div>
                         <div class="row">
                            <div class="form-group col-md-6">
                              <label for="formGroupProductName">Number of Saleable chicks</label>
                              <input type="text" class="form-control" id="product_name" name="product_name" value="<?= isset($_POST['product_name']) ? $_POST['product_name'] : ''; ?>" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                              <label for="formGroupProductName">Hatcherbility<small> %</small></label>
                              <input type="text" class="form-control" id="product_name" name="product_name" value="<?= isset($_POST['product_name']) ? $_POST['product_name'] : ''; ?>" placeholder="">
                            </div>
                         </div>
                         <div class="row">
                            <div class="form-group col-md-6">
                              <label for="exampleFormControlTextarea1">Next upcoming batch update</label>
                              <input type="text" class="form-control" readonly id="next_day_updatep" name="next_day_updatep" value="<?php echo $next_day_update; ?>"  placeholder="">
                              <small id="emailHelp" class="form-text text-muted">You will receive notifications to update info on this date.</small>
                            </div>
                            <div class="form-group col-md-6">
                            <button type="button" class="btn btn-success btn-lg pull-right">update batch</button>
                            </div>
                          </div>
                         </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
               <!-- end of stage 3: hatching report -->

                <!-- stage 4 -->
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                        <div class="card-header" data-background-color="orange">
                            <div class="row">
                              <div class="col-sm-3">
                                <h4 class="title">Batch Data</h4>
                               <p class="category">As of Last updated at</p>
                               <p> 12-Nov-2018</p>
                              </div>
                              <div class="col-sm-4">
                                <h4 class="title">Sales Update report </h4>
                                <p class="category">Updating batch to stage</p>
                              </div>
                              <div class="col-sm-3">
                                <h4 class="title" style="font-size: 70px;">4</h4>
                                <!-- <p class="category">going to stage 3 </p> -->

                              </div>
                            </div>
                        </div>
                        <div class="card-content table-responsive spcbelow">
                            <p>Update sales report.</p>
                            <p class="category">Clear Eggs</p>
                            <form>
                              <div class="row">
                                <div class="form-group col-md-6">
                                  <label for="formGroupProductName">Buyers Name: </label>
                                  <input type="text" class="form-control" id="product_name" name="product_name" value="<?= isset($_POST['product_name']) ? $_POST['product_name'] : ''; ?>" placeholder="">
                                </div>
                                <div class="form-group col-md-6">
                                   <label for="exampleFormControlSelect1" class="control-label">Buyer type</label>
                                   <select class="form-control" id="exampleFormControlSelect1">
                                     <option>Select</option>
                                     <option>Individual</option>
                                     <option>Company</option>
                                   </select>
                                 </div>
                              </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                  <label for="formGroupProductName">Number of chicks sold</label>
                                  <input type="text" class="form-control" id="product_name" name="product_name" value="<?= isset($_POST['product_name']) ? $_POST['product_name'] : ''; ?>" placeholder="">
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="formGroupProductName">Price per chick <small>in TZS</small></label>
                                  <input type="text" class="form-control" id="product_name" name="product_name" value="<?= isset($_POST['product_name']) ? $_POST['product_name'] : ''; ?>" placeholder="">
                                </div>

                            </div>

                            <div class="row">
                              <div class="form-group col-md-6">
                                <label for="formGroupProductName">Total Cocks</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" value="<?= isset($_POST['product_name']) ? $_POST['product_name'] : ''; ?>" placeholder="">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="formGroupProductName">Total Layers</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" value="<?= isset($_POST['product_name']) ? $_POST['product_name'] : ''; ?>" placeholder="">
                              </div>
                            </div>
                              <div class="row">
                              <div class="form-group col-md-6">
                                <label for="formGroupProductName">Remain number of chicks</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" value="<?= isset($_POST['product_name']) ? $_POST['product_name'] : ''; ?>" placeholder="">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="formGroupProductName">Total Selling Price <small>(in TZshillings)</small></label>
                                <input type="text" class="form-control" id="product_name" name="product_name" value="<?= isset($_POST['product_name']) ? $_POST['product_name'] : ''; ?>" placeholder="">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="exampleFormControlTextarea1">Next upcoming batch update</label>
                                <input type="text" class="form-control" readonly id="next_day_updatep" name="next_day_updatep" value="<?php echo $next_day_update; ?>"  placeholder="">
                                <small id="emailHelp" class="form-text text-muted">You will receive notifications to update info on this date.</small>
                              </div>
                              <div class="form-group col-md-6">
                              <button type="button" class="btn btn-success btn-lg pull-right">update batch</button>
                              </div>
                            </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php
                include("../../includes/layouts/hatchery_main_footer.php");

                ?>
