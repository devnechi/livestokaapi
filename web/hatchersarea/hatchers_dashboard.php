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
$dataPointshist = array(
	array("x"=> 10, "y"=> 41),
	array("x"=> 20, "y"=> 35, "indexLabel"=> "Lowest"),
	array("x"=> 30, "y"=> 50),
	array("x"=> 40, "y"=> 45),
	array("x"=> 50, "y"=> 52),
	array("x"=> 60, "y"=> 68),
	array("x"=> 70, "y"=> 38),
	array("x"=> 80, "y"=> 71, "indexLabel"=> "Highest"),
	array("x"=> 90, "y"=> 52),
	array("x"=> 100, "y"=> 60),
	array("x"=> 110, "y"=> 36),
	array("x"=> 120, "y"=> 49),
	array("x"=> 130, "y"=> 41)
);


$dataPointsPie = array(
	array("label"=> "Broiler Starter", "y"=> 590),
	array("label"=> "Growers Mash", "y"=> 261),
	array("label"=> "Layers Mash", "y"=> 158),
	array("label"=> "Broiler Finisher", "y"=> 72),
	array("label"=> "Breeder Mash", "y"=> 191),
	array("label"=> "Dairy Meal", "y"=> 573),
	array("label"=> "Pig Feed", "y"=> 126)
);

$dataPointsPieHatchingPurpose = array(
	array("label"=> "Utility Chicks", "y"=> 590),
	array("label"=> "Grandparent stock chicks", "y"=> 261),
	array("label"=> "Parent stock chicks", "y"=> 158)
	// array("label"=> "Broiler Finisher", "y"=> 72),
	// array("label"=> "Breeder Mash", "y"=> 191),
	// array("label"=> "Dairy Meal", "y"=> 573),
	// array("label"=> "Pig Feed", "y"=> 126)
);

//source of hatching Eggs
$dataPointsPieSourceOfHatchingEggs = array(
	array("label"=> "Imported Eggs", "y"=> 291),
	array("label"=> "Owners of Breeder flock farm", "y"=> 591),
	array("label"=> "Out-growers", "y"=> 158),
  array("label"=> "Other local farms", "y"=> 458)
	// array("label"=> "Broiler Finisher", "y"=> 72),
	// array("label"=> "Breeder Mash", "y"=> 191),
	// array("label"=> "Dairy Meal", "y"=> 573),
	// array("label"=> "Pig Feed", "y"=> 126)
);

$dataPointsPieBreedingPurpose = array(
	array("label"=> "Broilers ", "y"=> 126),
	array("label"=> "Layers ", "y"=> 361),
	array("label"=> "Dual Purpose", "y"=> 450),
	// array("label"=> "Broiler Finisher", "y"=> 72),
	// array("label"=> "Breeder Mash", "y"=> 191),
	// array("label"=> "Dairy Meal", "y"=> 573),
	// array("label"=> "Pig Feed", "y"=> 126)
);


 // poultry types
 $dataPointsHatcheryPoultryTypes = array(
 	array("label"=> "Turkey ", "y"=> 361),
 	array("label"=> "Ducks", "y"=> 450),
 	array("label"=> "Quails", "y"=> 232),
  array("label"=> "Chicken ", "y"=> 673),
 	array("label"=> "Ostrich", "y"=> 191),
 	array("label"=> "Geese", "y"=> 210),
 	array("label"=> "Guinea fowls", "y"=> 113)

 );


$dataPointsTwoLines = array(
	array("label"=> 1992, "y"=>105),
	array("label"=> 1993, "y"=>130),
	array("label"=> 1994, "y"=>158),
	array("label"=> 1995, "y"=>192),
	array("label"=> 1996, "y"=>309),
	array("label"=> 1997, "y"=>422),
	array("label"=> 1998, "y"=>566),
	array("label"=> 1999, "y"=>807),
	array("label"=> 2000, "y"=>1250),
	array("label"=> 2001, "y"=>1615),
	array("label"=> 2002, "y"=>2069),
	array("label"=> 2003, "y"=>2635),
	array("label"=> 2004, "y"=>3723),
	array("label"=> 2005, "y"=>5112),
	array("label"=> 2006, "y"=>6660),
	array("label"=> 2007, "y"=>9183),
	array("label"=> 2008, "y"=>15844),
	array("label"=> 2009, "y"=>23185),
	array("label"=> 2010, "y"=>40336),
	array("label"=> 2011, "y"=>70469),
	array("label"=> 2012, "y"=>100504),
	array("label"=> 2013, "y"=>138856),
	array("label"=> 2014, "y"=>178391),
	array("label"=> 2015, "y"=>229300),
	array("label"=> 2016, "y"=>302300),
	array("label"=> 2017, "y"=>368000)
);




$dataPointsGrowthVsNUmEggs = array(
	array("label"=> 1992, "y"=>105),
	array("label"=> 1993, "y"=>130),
	array("label"=> 1994, "y"=>158),
	array("label"=> 1995, "y"=>192),
	array("label"=> 1996, "y"=>309),
	array("label"=> 1997, "y"=>422),
	array("label"=> 1998, "y"=>566),
	array("label"=> 1999, "y"=>807),
	array("label"=> 2000, "y"=>1250),
	array("label"=> 2001, "y"=>1615),
	array("label"=> 2002, "y"=>2069),
	array("label"=> 2003, "y"=>2635),
	array("label"=> 2004, "y"=>3723),
	array("label"=> 2005, "y"=>5112),
	array("label"=> 2006, "y"=>6660),
	array("label"=> 2007, "y"=>9183),
	array("label"=> 2008, "y"=>15844),
	array("label"=> 2009, "y"=>23185),
	array("label"=> 2010, "y"=>40336),
	array("label"=> 2011, "y"=>70469),
	array("label"=> 2012, "y"=>100504),
	array("label"=> 2013, "y"=>138856),
	array("label"=> 2014, "y"=>178391),
	array("label"=> 2015, "y"=>229300),
	array("label"=> 2016, "y"=>302300),
	array("label"=> 2017, "y"=>368000)
);


//$dataPointsChickVsEggsprices

$dataPointsChickVsEggsprices = array(
	array("label"=> 1992, "y"=>105),
	array("label"=> 1993, "y"=>130),
	array("label"=> 1994, "y"=>158),
	array("label"=> 1995, "y"=>192),
	array("label"=> 1996, "y"=>309),
	array("label"=> 1997, "y"=>422),
	array("label"=> 1998, "y"=>566),
	array("label"=> 1999, "y"=>807),
	array("label"=> 2000, "y"=>1250),
	array("label"=> 2001, "y"=>1615),
	array("label"=> 2002, "y"=>2069),
	array("label"=> 2003, "y"=>2635),
	array("label"=> 2004, "y"=>3723),
	array("label"=> 2005, "y"=>5112),
	array("label"=> 2006, "y"=>6660),
	array("label"=> 2007, "y"=>9183),
	array("label"=> 2008, "y"=>15844),
	array("label"=> 2009, "y"=>23185),
	array("label"=> 2010, "y"=>40336),
	array("label"=> 2011, "y"=>70469),
	array("label"=> 2012, "y"=>100504),
	array("label"=> 2013, "y"=>138856),
	array("label"=> 2014, "y"=>178391),
	array("label"=> 2015, "y"=>229300),
	array("label"=> 2016, "y"=>302300),
	array("label"=> 2017, "y"=>368000)
);


?>



<div class="container-fluid">
	<div class="row">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header" data-background-color="orange">
											<h4 class="title">Current User Details</h4>
											<p class="category">As of Last Month February, 2018</p>
									</div>
									<div class="card-content table-responsive">
											<!-- <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
											<p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p> -->


												 <h2> Welcome back, <small><?php echo $logged_user_email; ?></small></h2>


										</div>
									</div>
									</div>
                  <!-- end of shortcuts -->
                  <div class="col-lg-6 col-md-12">
                      <div class="card">
                          <div class="card-header" data-background-color="orange">
                              <h4 class="title">Breeds Hatched By Hatchery</h4>
                              <p class="category">As of Last Month February, 2018</p>
                          </div>
                          <div class="card-content table-responsive">
                            <div class="form-group">
                              <button type="button" onclick="location.href='updateBatchData.php';" class="btn btn-lg btn-warning" name="button">Add a new breed</button>
                           </div>
                              <?php

                                  echo "<table class=\"table table-hover\">
                                          <thead class=\"text-warning\">
                                            <tr>
                                              <th scope=\"col\">#</th>
                                              <th scope=\"col\">Hatchery ID</th>
                                              <th scope=\"col\">Breed Unique id</th>
                                              <th scope=\"col\">Breed Title</th>
                                              <th scope=\"col\">date created</th>
                                            </tr>
                                          </thead>
                                          <tbody>";


                               ?>
                               <?php

                               // $creator_id  = $_POST['user_id'];
                                 $db = new DbOperation();

                                 if ($logged_hatchery_id) {
                                   $hatchery_id  = $logged_hatchery_id;

                                     // $hatchery_id  = 46;
                                     // // feed manufacturer adds new product
                                     // $manufacturer_id = $_POST['manufacturer_id'];
                                     $response['error'] = false;
                                     $response['message'] = 'Request successfully completed';
                                     $response['hacthery_breeds'] = $db->getallHatcheryBreeds($hatchery_id);
                                     // echo json_encode($response['rawmaterials']);

                                     $hatcheryBreeds = json_encode($response['hacthery_breeds'] );
                                     $hatcheryBreeedsObj = json_decode($hatcheryBreeds);
                                     foreach ($hatcheryBreeedsObj as $key => $value) {

                                         echo "
                                           <tr>
                                             <th scope=\"row\">" . $value->hatchery_breed_id . "</th>
                                             <td>" . $value->hatchery_id . "</td>
                                             <td>" . $value->breed_unique_id . "</td>
                                             <td>" . $value->breed_title . "</td>
                                             <td>" . $value->created_at . "</td>
                                             <td>" . $value->updated_at . "</td>

                                           </tr>";
                                         //$selectedpyp = $value->feed_product_id;
                                         // echo $selectedpp;
                                     }
                                 } else {
                                     // user failed to store
                                     $response["error"] = true;
                                     $response["error_msg"] = "Your dont have breeds in productions!";
                                     // echo json_encode($response);

                                     $ppmessage = "<div class=\"alert alert-danger\" role=\"alert\">
                                    <strong>Ops!</strong> <a href=\"add_new_product.php\" class=\"alert-link\">Seems like you haven't created a product</a> Create one now.
                                  </div>";
                                 }

                                     echo "</tbody>
                                    </table>";
                                    ?>
                          </div>
                      </div>
                  </div>

								</div>
               <!-- end of breed produced summary -->
               <div class="row">
                 <div class="col-md-6">
                   <div class="card">
                     <div class="card-header" data-background-color="orange">
                         <h4 class="title">Industry Hatching Activities</h4>
                         <p class="category">all hatching activities as of Dec, 2018</p>
                     </div>
                     <div class="card-content table-responsive">
                              <h1> TIH <small>at 100 %</small></h1>
                              <h1> TIC <small>at 25,000</small></h1>
                              <h1> Total num of breeds <small> 6</small></h1>

                        </div>
                     </div>
                 </div>
                 <!-- hatching activities -->
                 <div class="col-md-6">
                   <div class="card">
                     <div class="card-header" data-background-color="orange">
                         <h4 class="title">Industry Hatching Production</h4>
                         <p class="category">all hatching data as of Dec, 2018</p>
                     </div>
                     <div class="card-content table-responsive">
                              <h1> ACP <small>@150 TZS</small></h1>
                              <h1> Avg. Eggs Price <small>@ 100 TZS</small></h1>
                              <h1> Most Produced <small> Chicken</small></h1>


                        </div>
                     </div>
                 </div>
                 <div class="col-md-6">
                   <div class="card">
                     <div class="card-header" data-background-color="orange">
                         <h4 class="title">Industry Prices Comparison</h4>
                         <p class="category">industry Chick graph, 2018</p>
                     </div>
                     <div class="card-content table-responsive">
                        <!-- chartContainerGrowthVsNumOfEggs -->
                        <div id="chartContainerChickPrices" style="height: 370px; width: 100%;"></div>

                        </div>
                     </div>
                 </div>
                 <!-- end of hathcing growth comparison -->

                 <!-- end of the industry hatching activities -->
                 <div class="col-md-6">
                   <div class="card">
                     <div class="card-header" data-background-color="orange">
                         <h4 class="title">Industry Hatching Growth</h4>
                         <p class="category">industry growth graph, 2018</p>
                     </div>
                     <div class="card-content table-responsive">
                        <!-- chartContainerGrowthVsNumOfEggs -->
                        <div id="chartContainerGrowthVsNumOfEggs" style="height: 370px; width: 100%;"></div>

                        </div>
                     </div>
                 </div>
                 <!-- end of hathcing growth vs number of eggs -->


                 <div class="col-md-6">
                   <div class="card">
                     <div class="card-header" data-background-color="orange">
                         <h4 class="title">Industry Hatching Activities</h4>
                         <p class="category">most preferred hatching activities are as of Dec, 2018</p>
                     </div>
                     <div class="card-content table-responsive">
                       <div id="chartPieHatchingPurpose" style="height: 370px; width: 100%;"></div>


                        </div>
                     </div>
                 </div>
                 <!-- end of hatching purposes -->



                 <div class="col-md-6">
                  <div class="card">
                    <div class="card-header" data-background-color="orange">
                        <h4 class="title">Hatching Breed Types</h4>
                        <p class="category">Type of breed most produced as of Dec, 2018</p>
                    </div>
                    <div class="card-content table-responsive">
                        <!-- chartPieBreedingPurpose -->
                        <div id="chartPieBreedingPurpose" style="height: 370px; width: 100%;"></div>

                       </div>
                    </div>
                    </div>
               </div>
               <!-- end of hatching breed specialisation -->

               <div class="row">
                 <div class="col-md-6">
                   <div class="card">
                     <div class="card-header" data-background-color="orange">
                         <h4 class="title">Industry Poultry Types</h4>
                         <p class="category">breakdown of poultry types, 2018</p>
                     </div>
                     <div class="card-content table-responsive">
                           <!-- chartPiePoultrytypes -->
                           <div id="chartPiePoultrytypes" style="height: 370px; width: 100%;"></div>

                        </div>
                     </div>
                 </div>
                 <!-- end of the industry hatched poultry types -->

                 <div class="col-md-6">
                  <div class="card">
                    <div class="card-header" data-background-color="orange">
                        <h4 class="title">Hatching egg source</h4>
                        <p class="category">Breakdown of hatching egg sources, 2018</p>
                    </div>
                    <div class="card-content table-responsive">
                          <!-- chartPieHatchingEggsSources -->
                          <div id="chartPieHatchingEggsSources" style="height: 370px; width: 100%;"></div>

                       </div>
                    </div>
                    </div>
               </div>

              <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header" data-background-color="orange">
                            <h4 class="title">Popular Breeds Hatched in Pie Chart</h4>
                            <p class="category">As of Last Month February, 2018</p>
                        </div>

                        <div class="card-content table-responsive">
                            <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                            <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>


                    <div id="chartContainerPie" style="height: 370px; width: 100%;"></div>

                        </div>

                    </div>
                </div>



                          <div class="col-md-6">
                                    <div class="card">
                                      <div class="card-header" data-background-color="orange">
                                          <h4 class="title">Hatchery Production Capacity Monthly Comparison</h4>
                                          <p class="category">As of Last Month February, 2018</p>
                                       </div>
                                       <div class="card-content table-responsive">
                                        <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                                      <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>


                                   <div id="chartContainerTwoLines" style="height: 370px; width: 100%;"></div>

                                  </div>

                </div>
            </div>
        </div
        <div class="row">

            <div class="col-md-6">
              <div class="card">
                  <div class="card-header" data-background-color="orange">
                      <h4 class="title">Hatchery Production Capacity Monthly Comparison</h4>
                      <p class="category">As of Last Month February, 2018</p>
                  </div>
                  <div class="card-content table-responsive">
                      <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                      <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>


                   <div id="chartContainerhist" style="height: 370px; width: 100%;"></div>

                  </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" data-background-color="orange">
                        <h4 class="title">Hatchery Information</h4>
                        <p class="category">As of Last Month February, 2018</p>
                    </div>
                    <div class="card-content table-responsive">
                        <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                        <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="orange">
                        <h4 class="title">Simple Sidebar</h4>
                        <p class="category">As of Last Month February, 2018</p>
                    </div>
                    <div class="card-content table-responsive">
                        <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                        <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="orange">
                        <h4 class="title">Breeds Hatched By Hatchery</h4>
                        <p class="category">As of Last Month February, 2018</p>
                    </div>
                    <div class="card-content table-responsive">
                        <table class="table table-hover">
                            <thead class="text-warning">
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>broiler starter</td>
                                    <td>pellet</td>
                                    <td>200 TONS</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Broiler Finisher</td>
                                    <td>mash</td>
                                    <td>500 TONS</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Growers</td>
                                    <td>mash</td>
                                    <td>200 TONS</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>layer</td>
                                    <td>pellet</td>
                                    <td>200 TONS</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

            </div>
            <!-- /#page-content-wrapper -->
        </div>
        <!-- /#wrapper -->
    </div>
<?php
include("../../includes/layouts/hatchery_main_footer.php");

?>
