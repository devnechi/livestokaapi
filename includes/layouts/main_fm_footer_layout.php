
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    </div>
</div>

            <!-- jQuery CDN -->
            <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
            <!-- Bootstrap Js CDN -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <!-- jQuery Custom Scroller CDN -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/en-gb.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css"></script>
            <link rel="stylesheet" type="text/css" href="../css/jquery.datetimepicker.css"/ >
             <script src="../web/css/jquery.js"></script>
             <script src="../web/css/jquery.datetimepicker.full.min.js"></script>
            <script src="../../web/js/moment.min.js"></script>
            <script src="../../web/js/bootstrap-datetimepicker.min.js"></script>
            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

            <script type="text/javascript">
                $(document).ready(function () {


                    $('#sidebarCollapse').on('click', function () {
                        $('#sidebar, #content').toggleClass('active');
                        $('.collapse.in').toggleClass('in');
                        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                    });
                });
      </script>

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
             		text: "Annual Hatching Chart Summary"
             	},
             	data: [{>
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
             		text: "Average Breeds Hatched Per Month  in Tanzania"
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
             		text: "Demand between Breed A and Breed B "
             	},
             	axisY:{
             		title: "Breed Hatching (in Mil)",
             		logarithmic: true,
             		titleFontColor: "#6D78AD",
             		gridColor: "#6D78AD",
             		labelFormatter: addSymbols
             	},
             	axisY2:{
             		title: "Breed Hatching (in Mil)",
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

      <script>
          $("#datetimepicker").datetimepicker();
      </script>
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
                    var chart = new CanvasJS.Chart("chartContainerPiePP", {
                    	animationEnabled: true,
                    	exportEnabled: true,
                    	title:{
                    		text: "Feeds Production distribution  in Tanzania"
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
                    		dataPoints: <?php echo json_encode($dataPointsPiepp, JSON_NUMERIC_CHECK); ?>
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

      //chartContainerPierawcon
      //raw materials consumption
      var chart = new CanvasJS.Chart("chartContainerPierawcon", {
       animationEnabled: true,
       exportEnabled: true,
       title:{
         text: "Average Feed Manufacturer Raw Material consumption  in Tanzania"
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
         dataPoints: <?php echo json_encode($dataPointsPieRawMaterialCon, JSON_NUMERIC_CHECK); ?>
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
