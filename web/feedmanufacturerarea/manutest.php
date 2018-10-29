<?php
ob_start();
session_start();

include("../../includes/layouts/manufacturers_header_layout.php");
require_once '../../includes/DbOperation.php';
require_once '../../includes/validations_functions.php';
?>
<?php confirm_logged_in(); ?>
<?php $layout_context = "feed_manufacturer"; ?>

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
            $feed_manufacturer_id =  $manufacturer["feed_manufactures_id"];
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
  <div class=\"alert alert-danger\" role=\"alert\">
    <strong>About Current Data</strong> <a href=\"#\" class=\"alert-link\">This data displayed in the graph is test data </a>Once we have collected enough data it will replace this and create other more variables for insights.
  </div>
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


                        <h2> Welcome back, <small><?php echo $logged_user_email  ; ?></small></h2>
                        <h2> With userr_id, <small><?php echo $logged_user_id  ; ?></small></h2>

                        <h2> Feed Manufacturer Name, <small><?php echo $feed_manufacture_name; ?></small></h2>


										</div>
									</div>
									</div>
                  <div class="col-md-6">
                    		<div class="card">
                      <div class="panel-heading card-header">
                        <h3 class="panel-title title">Current Feed Manufacturer Products</h3>
                      </div>
                      <div class="panel-body">
                        <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Feed Product</th>
                                    <th scope="col">Last Month Quantity</th>
                                    <th scope="col">Last Month Stock in Storage</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                  </tr>
                                </tbody>
                              </table>

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
													<p>This data is of the previous month, its shared in an aggregated form of the entire cummunity on livestoka.</p>
												</div>
											</div>
											</div>
								</div>

              <div class="row">
                <div class="col-md-6">
                  <div class="card">
                      <div class="card-header" data-background-color="orange">
                          <h4 class="title">Industry Production Capacity Monthly Comparison</h4>
                          <p class="category">As of Last Month February, 2018</p>
                      </div>
                      <div class="card-content table-responsive">
                          <p>Comparision of production data in the feed manufucturer industry </p>


                       <div id="chartContainerhist" style="height: 370px; width: 100%;"></div>

                      </div>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header" data-background-color="orange">
                        <h4 class="title">Industry Production Capacity Monthly Comparison</h4>
                        <p class="category">As of Last Month February, 2018</p>
                     </div>
                     <div class="card-content table-responsive">
                      <p>THis Chart shows monthly comparisons of production capacity.</p>


                     <div id="chartContainerTwoLines" style="height: 370px; width: 100%;"></div>

                   </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" data-background-color="orange">
                        <h4 class="title">Industry Products in Pie Chart</h4>
                        <p class="category">As of Last Month February, 2018</p>
                    </div>

                    <div class="card-content table-responsive">
                        <p>This pie chart shows the products manufactured in TONS at any given moment.</p>


                <div id="chartContainerPie" style="height: 370px; width: 100%;"></div>

                    </div>

                </div>
            </div>
        </div>

        <div class="row">
           <div class="col-lg-6 col-md-12">
               <div class="card">
                   <div class="card-header" data-background-color="orange">
                       <h4 class="title">Stat Sidebar</h4>
                       <p class="category">As of Last Month February, 2018</p>
                   </div>
                   <div class="card-content table-responsive">
                       <p>More stats to come as we collect more data about the industry <code>#more-insights-below</code>.</p

                   </div>
               </div>
           </div>
         </div>
        <!-- <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" data-background-color="orange">
                        <h4 class="title">Plant Information</h4>
                        <p class="category">As of Last Month February, 2018</p>
                    </div>
                    <div class="card-content table-responsive">
                        <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                        <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>

                    </div>
                </div>
            </div>
        </div> -->
        <!-- <div class="row">
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
                        <h4 class="title">Products Produced By Plant</h4>
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
</div> -->

            </div>
            <!-- /#page-content-wrapper -->
        </div>
        <!-- /#wrapper -->
    </div>

<script>
$("#menu-toggle").click(function (e) {
           e.preventDefault();
           $("#wrapper").toggleClass("toggled");
       });

       function openNav() {
           document.getElementById("mySidenav").style.width = "310px";
       }

       function closeNav() {
           document.getElementById("mySidenav").style.width = "0";
       }

       window.onload = function () {

//histogram
       var chart = new CanvasJS.Chart("chartContainerhist", {
       	animationEnabled: true,
       	exportEnabled: true,
       	theme: "light1", // "light1", "light2", "dark1", "dark2"
       	title:{
       		text: "Annual Production Chart Summary"
       	},
       	data: [{
       		type: "column", //change type to bar, line, area, pie, etc
       		//indexLabel: "{y}", //Shows y value on all Data Points
       		indexLabelFontColor: "#5A5757",
       		indexLabelPlacement: "outside",
       		dataPoints: <?php echo json_encode($dataPointshist, JSON_NUMERIC_CHECK); ?>
       	}]
       });
       chart.render();

//pie chart
       var chart = new CanvasJS.Chart("chartContainerPie", {
       	animationEnabled: true,
       	exportEnabled: true,
       	title:{
       		text: "Average Products Produced Per Month  in Tanzania"
       	},
       	subtitles: [{
       		text: "Measurements Used: TONS (฿)"
       	}],
       	data: [{
       		type: "pie",
       		showInLegend: "true",
       		legendText: "{label}",
       		indexLabelFontSize: 16,
       		indexLabel: "{label} - #percent TONS",
       		yValueFormatString: "฿#,##0",
       		dataPoints: <?php echo json_encode($dataPointsPie, JSON_NUMERIC_CHECK); ?>
       	}]
       });
       chart.render();



//two lines
       var chart = new CanvasJS.Chart("chartContainerTwoLines", {
       	animationEnabled: true,
       	theme: "light2",
       	title:{
       		text: "Exponential Growth of Mash and Pellets "
       	},
       	axisY:{
       		title: "Feeds Production (in TONS)",
       		logarithmic: true,
       		titleFontColor: "#6D78AD",
       		gridColor: "#6D78AD",
       		labelFormatter: addSymbols
       	},
       	axisY2:{
       		title: "Feeds Production (in TONS)",
       		titleFontColor: "#51CDA0",
       		tickLength: 0,
       		labelFormatter: addSymbols
       	},
       	legend: {
       		cursor: "pointer",
       		verticalAlign: "top",
       		fontSize: 16,
       		itemclick: toggleDataSeries
       	},
       	data: [{
       		type: "line",
       		markerSize: 0,
       		showInLegend: true,
       		name: "Mash Scale",
       		yValueFormatString: "#,##0 MW",
       		dataPoints: <?php echo json_encode($dataPointsTwoLines, JSON_NUMERIC_CHECK); ?>
       	},
       	{
       		type: "line",
       		markerSize: 0,
       		axisYType: "secondary",
       		showInLegend: true,
       		name: "Pellet Scale",
       		yValueFormatString: "#,##0 MW",
       		dataPoints: <?php echo json_encode($dataPointsTwoLines, JSON_NUMERIC_CHECK); ?>
       	}]
       });
       chart.render();

       function addSymbols(e){
       	var suffixes = ["", "K", "M", "B"];

       	var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);
       	if(order > suffixes.length - 1)
       		order = suffixes.length - 1;

       	var suffix = suffixes[order];
       	return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
       }

       function toggleDataSeries(e){
       	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
       		e.dataSeries.visible = false;
       	}
       	else{
       		e.dataSeries.visible = true;
       	}
       	chart.render();
      }}
</script>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
