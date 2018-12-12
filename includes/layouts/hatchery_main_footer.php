
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
            <script src="../../web/js/moment.min.js"></script>
            <script src="../../web/js/bootstrap-datetimepicker.min.js"></script>
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
             	theme: "light2", // "light1", "light2", "dark1", "dark2"
             	title:{
             		text: "Annual Hatching Chart Summary"
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

             //pie chart
             //hatching purpose pie chart
                    var chart = new CanvasJS.Chart("chartPieHatchingPurpose", {
                     animationEnabled: true,
                     exportEnabled: true,
                     title:{
                       text: "Industry Hatching Purpose"
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
                       dataPoints: <?php echo json_encode($dataPointsPieHatchingPurpose, JSON_NUMERIC_CHECK); ?>
                     }]
                    });
                    chart.render();


                    //hatching purpose pie chart
                           var chart = new CanvasJS.Chart("chartPieBreedingPurpose", {
                            animationEnabled: true,
                            exportEnabled: true,
                            title:{
                              text: "Industry Breed Purpose"
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
                              dataPoints: <?php echo json_encode($dataPointsPieBreedingPurpose, JSON_NUMERIC_CHECK); ?>
                            }]
                           });
                           chart.render();


                           // poultry Types
                          //  $dataPointsHatcheryPoultryTypes

                          var chart = new CanvasJS.Chart("chartPiePoultrytypes", {
                           animationEnabled: true,
                           exportEnabled: true,
                           title:{
                             text: "Industry Poultry Types"
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
                             dataPoints: <?php echo json_encode($dataPointsHatcheryPoultryTypes, JSON_NUMERIC_CHECK); ?>
                           }]
                          });
                          chart.render();

           // source of hatching eggs
           var chart = new CanvasJS.Chart("chartPieHatchingEggsSources", {
            animationEnabled: true,
            exportEnabled: true,
            title:{
              text: "Hatching Egg Sources"
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
              dataPoints: <?php echo json_encode($dataPointsPieSourceOfHatchingEggs, JSON_NUMERIC_CHECK); ?>
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

             //egg prices lines
             var chart = new CanvasJS.Chart("chartContainerChickPrices", {
              animationEnabled: true,
              theme: "light2",
              title:{
                text: "Average Price per chick"
              },
              axisY:{
                title: "Chick Prices (in TZS)",
                logarithmic: true,
                titleFontColor: "#6D78AD",
                gridColor: "#6D78AD",
                labelFormatter: addSymbols
              },
              axisY2:{
                title: "Average Egg Prices (in TZS)",
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
                name: "Chick Prices",
                yValueFormatString: "#,##0 MW",
                dataPoints: <?php echo json_encode($dataPointsChickVsEggsprices, JSON_NUMERIC_CHECK); ?>
              },
              {
                type: "line",
                markerSize: 0,
                axisYType: "secondary",
                showInLegend: true,
                name: "Eggs Prices",
                yValueFormatString: "#,##0 MW",
                dataPoints: <?php echo json_encode($dataPointsChickVsEggsprices, JSON_NUMERIC_CHECK); ?>
              }]
             });
             chart.render();



             //growht vs number of eggs two lines
             var chart = new CanvasJS.Chart("chartContainerGrowthVsNumOfEggs", {
              animationEnabled: true,
              theme: "light2",
              title:{
                text: "Growth of industry and input Comparison"
              },
              axisY:{
                title: "Hatching Capacity (in Mil)",
                logarithmic: true,
                titleFontColor: "#6D78AD",
                gridColor: "#6D78AD",
                labelFormatter: addSymbols
              },
              axisY2:{
                title: "Number of Eggs (in Mil)",
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
                name: "Hatching Capacity",
                yValueFormatString: "#,##0 MW",
                dataPoints: <?php echo json_encode($dataPointsGrowthVsNUmEggs, JSON_NUMERIC_CHECK); ?>
              },
              {
                type: "line",
                markerSize: 0,
                axisYType: "secondary",
                showInLegend: true,
                name: "Number of Eggs",
                yValueFormatString: "#,##0 MW",
                dataPoints: <?php echo json_encode($dataPointsGrowthVsNUmEggs, JSON_NUMERIC_CHECK); ?>
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

      <script>
          $(document).ready(function(){
              $('#selectedBatch').on('change', function() {
                if ( this.value == 'stage 1')
                {
                  $("#pnl_candling_report").show();
                     // $('#contact').text("Email Address");
                     // $('#selected_batch_id').text("'
                        //  alert($(this).find("option:selected").text());
                           document.getElementById("selected_batch_id").innerHTML = $(this).find("option:selected").text();

                  $("#pnl_hatching_report").hide();
                  $("#pnl_sales_report").hide();
                }else if (this.value == 'stage 2') {
                    $("#pnl_hatching_report").show();

                    $("#pnl_candling_report").hide();
                    $("#pnl_sales_report").hide();
                }
                else if (this.value == 'stage 3') {
                    $("#pnl_sales_report").show();

                    $("#pnl_candling_report").hide();
                     $("#pnl_hatching_report").hide();
                }else if (this.value == 'stage 4') {
                    $("#pnl_sales_report").show();

                    $("#pnl_candling_report").hide();
                     $("#pnl_hatching_report").hide();
                }
                else
                {
                    $("#pnl_candling_report").hide();
                     $("#pnl_hatching_report").hide();
                     $("#pnl_sales_report").hide();
                }
              });
              //console.log("hellow");
          });
          </script>
  </body>
</html>
