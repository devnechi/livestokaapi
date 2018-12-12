<?php
include("../../includes/layouts/dairy_header_layout.php");
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
	
	array("label"=> "Beef", "y"=> 261),
	array("label"=> "Turkey", "y"=> 24),
	array("label"=> "Dairy Milk", "y"=> 280),
	array("label"=> "Chicken", "y"=> 191),
	array("label"=> "Pork", "y"=> 80),
	array("label"=> "Others", "y"=> 12),
);


$dataPointsTwoLines = array(
	array("label"=> "January", "y"=>105),
	array("label"=> "February", "y"=>130),
	array("label"=> "March", "y"=>158),
	array("label"=> "April", "y"=>192),
	array("label"=> "May", "y"=>309),
	array("label"=> "June", "y"=>422),
	array("label"=> "July", "y"=>566),
	array("label"=> "August", "y"=>807),
	array("label"=> "September", "y"=>1250),
	array("label"=> "October", "y"=>1615),
	array("label"=> "November", "y"=>2069),
	array("label"=> "December", "y"=>2635)
	
);

?>

<div class="container-fluid">
	<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header" data-background-color="orange">
											<h4 class="title">Current User Details</h4>
											<p class="category">As of Last Month  2018</p>
									</div>
									<div class="card-content table-responsive">
											<!-- <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
											<p>Make sure to keep all page content within the </p> -->


												 <h2> Welcome back, </h2>


										</div>
									</div>
									
								
										<div class="card">
											<div class="card-header" data-background-color="orange">
													<h4 class="title">Recent industry updates and Trends</h4>
													<p class="category">As of Last Month , 2018</p>
											</div>
											<div class="card-content table-responsive">
													<p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
													<p>Make sure to keep all page content within the </p>
												</div>
											</div>
											
								

								
              
    
                    <div class="card">
                        <div class="card-header" data-background-color="orange">
                            <h4 class="title">Meat Consuption in Pie Chart</h4>
                            <p class="category">As of Last Month  2018</p>
                        </div>

                        <div class="card-content table-responsive">
                            <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                            <p>Make sure to keep all page content within the </p>


                    <div id="chartContainerPie" style="height: 370px; width: 100%;"></div>

                        </div>

                    </div>
                



                          
                                    <div class="card">
                                      <div class="card-header" data-background-color="orange">
                                          <h4 class="title"> Production Capacity Monthly Comparison</h4>
                                          <p class="category">As of Last Month 2018</p>
                                       </div>
                                       <div class="card-content table-responsive">
                                        <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                                      <p>Make sure to keep all page content within the </p>


                                   <div id="chartContainerTwoLines" style="height: 370px; width: 100%;"></div>

                                  </div>

                </div>
         
        

            
              <div class="card">
                  <div class="card-header" data-background-color="orange">
                      <h4 class="title"> Production Capacity Monthly Comparison</h4>
                      <p class="category">As of Last Month  2018</p>
                  </div>
                  <div class="card-content table-responsive">
                      <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                      <p>Make sure to keep all page content within the </p>


                   <div id="chartContainerhist" style="height: 370px; width: 100%;"></div>

                  </div>
                </div>
            
        
        
            
                <div class="card">
                    <div class="card-header" data-background-color="orange">
                        <h4 class="title">Information</h4>
                        <p class="category">As of Last Month  2018</p>
                    </div>
                    <div class="card-content table-responsive">
                        <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                        <p>Make sure to keep all page content within the </p>

                    </div>
                </div>
            
        
       
            
                <div class="card">
                    <div class="card-header" data-background-color="orange">
                        <h4 class="title">Simple Sidebar</h4>
                        <p class="category">As of Last Month  2018</p>
                    </div>
                    <div class="card-content table-responsive">
                        <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                        <p>Make sure to keep all page content within the </p>

                    </div>
              
            
                <div class="card">
                    <div class="card-header" data-background-color="orange">
                        <h4 class="title">Breeds produced By Breeder</h4>
                        <p class="category">As of Last Month  2018</p>
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
                                    <td>Haifer</td>
                                    <td>Cow</td>
                                    <td>200 </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Hybrid</td>
                                    <td>cow</td>
                                    <td>500 </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Local</td>
                                    <td>Cow</td>
                                    <td>200 </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Imported</td>
                                    <td>cow</td>
                                    <td>200 </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


            </div>
            <!-- /#page-content-wrapper -->
       
<?php
include("../../includes/layouts/public_ly_footer.php");
?>
<script>

console.log("found yoo");
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
       		text: "Annual Dairy Chart Summary"
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
       		text: "Average Yield Per Month  in Tanzania"
       	},
       	subtitles: [{
       		text: "Measurements Used: Mil(฿)"
       	}],
       	data: [{
       		type: "pie",
       		showInLegend: "true",
       		legendText: "{label}",
       		indexLabelFontSize: 16,
       		indexLabel: "{label} - #percent Mil",
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
       		text: "Demand between Milk and Beef "
       	},
       	axisY:{
       		title: "Dairy Milk (in Litre)",
       		logarithmic: true,
       		titleFontColor: "#6D78AD",
       		gridColor: "#6D78AD",
       		labelFormatter: addSymbols
       	},
       	axisY2:{
       		title: "Dairy Beef (in Kgs)",
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
       		name: "Breed A Scale",
       		yValueFormatString: "#,##0 MW",
       		dataPoints: <?php echo json_encode($dataPointsTwoLines, JSON_NUMERIC_CHECK); ?>
       	},
       	{
       		type: "line",
       		markerSize: 0,
       		axisYType: "secondary",
       		showInLegend: true,
       		name: "Breed B Scale",
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

</body>
</html>

























