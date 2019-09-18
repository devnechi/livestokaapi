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
    $next_day_update = date("d-m-Y", strtotime(" +1 months"));
 $errors = array();
 $message = " ";
 $ppmessage = " ";
 $rmmessage = " ";

 ?>
 <?php
//selectedBatch
// $batchdetails = "";
// if(isset($_GET['selected_batch_id'])){
//  // $selected_batch_id = $_GET['selected_batch_id'];
//  // // $creator_id  = $_POST['user_id'];
//  //   $db = new DbOperation();
//  //   if ($selected_batch_id) {
//  //       $public_batch_id = $selected_batch_id;
//  //       // feed manufacturer adds new product
//  //       // $manufacturer_id = $_POST['manufacturer_id'];
//  //       $response['error'] = false;
//  //       $response['message'] = 'Request successfully completed';
//  //       $response['batch_details'] = $db->getBatchDetails($public_batch_id);
//  //       // echo json_encode($response['rawmaterials']);
//  //       $batchdetails = json_encode($response['batch_details']);
//  //
//  //
//  //   } else {
//  //       // user failed to store
//  //       $response["error"] = true;
//  //       $response["error_msg"] = "Your batches does not exist!";
//  //       // echo json_encode($response);
//  //
//  //       $ppmessage = "<div class=\"alert alert-danger\" role=\"alert\">
//  //      <strong>Ops!</strong> <a href=\"new_batch.php\" class=\"alert-link\">Seems like you haven't created any batches</a> Create one now.
//  //    </div>";
//  //   }
//    echo $_GET['selected_batch_id'];
//  }
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
         <?php echo $ppmessage; ?>

            <div class="row">
              <div class="form-group col-lg-offset-2 col-md-6 input-group-lg">
                   <!-- <label for="exampleFormControlSelect1" class="control-label">select below:</label> -->
                   <select class="form-control" aria-label="Large"  id="selectedBatch" name="selectedBatch" aria-describedby="inputGroup-sizing-sm">

                   <option>SELECT BATCH</option>
                   <?php
                   // $creator_id  = $_POST['user_id'];
                     $db = new DbOperation();
                     if ($logged_hatchery_id) {
                         $hatchery_id = $logged_hatchery_id;
                         // feed manufacturer adds new product
                         // $manufacturer_id = $_POST['manufacturer_id'];
                         $response['error'] = false;
                         $response['message'] = 'Request successfully completed';
                         $response['all_batches'] = $db->getAllHatcheryBatches($hatchery_id);
                         // echo json_encode($response['rawmaterials']);


                         $allhatcherybatches = json_encode($response['all_batches']);
                         $hbObj = json_decode($allhatcherybatches);
                         foreach ($hbObj as $key => $value) {
                             // echo "<option value='" . $value->batch_current_stage . "'> " . $value->public_batch_id . $value->date_created. "</option>";
                             echo "<option value='" . $value->batch_current_stage . "'> " . $value->public_batch_id . "</option>";

                             //$selectedpyp = $value->feed_product_id;
                             // echo $selectedpp;
                             // $sBatch_id =$value->batch_id;
                            }
                     } else {
                         // user failed to store
                         $response["error"] = true;
                         $response["error_msg"] = "Your batches does not exist!";
                         // echo json_encode($response);

                         $ppmessage = "<div class=\"alert alert-danger\" role=\"alert\">
                        <strong>Ops!</strong> <a href=\"new_batch.php\" class=\"alert-link\">Seems like you haven't created any batches</a> Create one now.
                      </div>";
                     }
                   ?>
                   </select>
                 </div>

            </div>

            <div class="row">

              <div class="form-group col-lg-offset-2 col-md-6 input-group-lg">
                   <label id="selected_batch_id" name="selected_batch_id" for="exampleFormControlSelect1" class="control-label">batchid:</label>
                    <?php
                    if(isset($_GET["selected_batch_id"])){
                       echo $_GET["selected_batch_id"];
                     }
                     ?>
            </div>
            <!-- <div class="form-group col-lg-offset-2 col-md-6 input-group-lg">
                 <label id="batch_id" name="batch_id" for="exampleFormControlSelect1" class="control-label">batchid: </label>


                  <?php
                //  if(isset($_GET["batch_id"])){

                  //   echo $_GET["batch_id"];
                //   }
                   ?>
                  <label for="exampleFormControlSelect1" class="control-label">SOMETHING</label>
                   <label for="exampleFormControlSelect1" class="control-label">date created:</label>
                    <label for="exampleFormControlSelect1" class="control-label">other info:</label>

          </div> -->
					</div>
				</div>
				</div>
	    </div>
  </div>


         <!-- display panels depending on the stage of the batch selected  -->
            <!--panel stage 2 candling report -->
            <div id="pnl_candling_report" class="panel panel-default" style="display: none;">
                <div class="panel-body">
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
                                <form method="post">
                                  <p class="category">Clear Eggs</p>
                                  <input type="hidden" name="candlingreportsubmit" value="yes" >
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
                </div>
              </div>


              <div id="pnl_hatching_report" class="panel panel-default" style="display: none;">
                  <div class="panel-body">
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
                  </div>
                </div>

                <div id="pnl_sales_report" class="panel panel-default" style="display: none;">
                    <div class="panel-body">

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
                    </div>
                  </div>

<!-- <div class="container-fluid">
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
								</div> -->
                <?php
                include("../../includes/layouts/hatchery_main_footer.php");

                ?>
