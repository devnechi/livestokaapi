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
       		text: "Annual CC activities Chart Summary"
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
       		text: "Average CC activities Per Month  in Tanzania"
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


<!-- Google charts -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Memory', 80],
          ['CPU', 55],
          ['Network', 68]
        ]);

        var options = {
          width: 400, height: 120,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

        chart.draw(data, options);

        setInterval(function() {
          data.setValue(0, 1, 40 + Math.round(60 * Math.random()));
          chart.draw(data, options);
        }, 13000);
        setInterval(function() {
          data.setValue(1, 1, 40 + Math.round(60 * Math.random()));
          chart.draw(data, options);
        }, 5000);
        setInterval(function() {
          data.setValue(2, 1, 60 + Math.round(20 * Math.random()));
          chart.draw(data, options);
        }, 26000);
      }
    </script>


<script>
google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawCurveTypes);

function drawCurveTypes() {
      var data = new google.visualization.DataTable();
      data.addColumn('number', 'X');
      data.addColumn('number', 'CC initiative');
      data.addColumn('number', 'CC strategies');

      data.addRows([
        [0, 0, 0],    [1, 10, 5],   [2, 23, 15],  [3, 17, 9],   [4, 18, 10],  [5, 9, 5],
        [6, 11, 3],   [7, 27, 19],  [8, 33, 25],  [9, 40, 32],  [10, 32, 24], [11, 35, 27],
        [12, 30, 22], [13, 40, 32], [14, 42, 34], [15, 47, 39], [16, 44, 36], [17, 48, 40],
        [18, 52, 44], [19, 54, 46], [20, 42, 34], [21, 55, 47], [22, 56, 48], [23, 57, 49],
        [24, 60, 52], [25, 50, 42], [26, 52, 44], [27, 51, 43], [28, 49, 41], [29, 53, 45],
        [30, 55, 47], [31, 60, 52], [32, 61, 53], [33, 59, 51], [34, 62, 54], [35, 65, 57],
        [36, 62, 54], [37, 58, 50], [38, 55, 47], [39, 61, 53], [40, 64, 56], [41, 65, 57],
        [42, 63, 55], [43, 66, 58], [44, 67, 59], [45, 69, 61], [46, 69, 61], [47, 70, 62],
        [48, 72, 64], [49, 68, 60], [50, 66, 58], [51, 65, 57], [52, 67, 59], [53, 70, 62],
        [54, 71, 63], [55, 72, 64], [56, 73, 65], [57, 75, 67], [58, 70, 62], [59, 68, 60],
        [60, 64, 56], [61, 60, 52], [62, 65, 57], [63, 67, 59], [64, 68, 60], [65, 69, 61],
        [66, 70, 62], [67, 72, 64], [68, 75, 67], [69, 80, 72]
      ]);

      var options = {
        hAxis: {
          title: 'Time'
        },
        vAxis: {
          title: 'Popularity'
        },
        series: {
          1: {curveType: 'function'}
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
</script>


<!-- monthly price comparison -->
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'CSOs', 'Members'],
          ['2004',  1000,      400],
          ['2005',  1170,      460],
          ['2006',  660,       1120],
          ['2007',  1030,      540]
        ]);

        var options = {
          title: 'CC Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
