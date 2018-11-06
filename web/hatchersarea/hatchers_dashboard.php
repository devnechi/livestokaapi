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
          redirect_to("/mydroids/livestokaapi/web/login_area.php");
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
				  redirect_to("/mydroids/livestokaapi/web/login_area.php");
		  } else {
		  	// logged in user is of feed manufacturer

        //TODO: update last_login status in database

        //

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
									<div class="col-md-6">
										<div class="card">
											<div class="card-header" data-background-color="orange">
													<h4 class="title">Recent industry updates and Trends</h4>
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
