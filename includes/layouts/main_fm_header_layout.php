<?php
  if ($_SESSION['loggedIn'] != TRUE) {
  	// code...
		//SET UR ID AND THE USEREMAIL
		$message = "<div class=\"alert alert-danger\" role=\"alert\">
			<strong>Log in Again</strong> <a href=\"#\" class=\"alert-link\">Seems like we failed to authenticate you</a> Try login again.
		</div>";
          redirect_to("../../web/login_area.php");
  } else{
  	// code...
    //user session details
		$logged_user_id = $_SESSION['user_log_id'];
		$logged_user_email = $_SESSION['user_log_email'];
		$logged_user_usertype = $_SESSION['user_log_usertype'];
			//
		  if ($logged_user_usertype != "feed manufacturers") {
        // user is not of feed manufacturer type...
        //usertype is different
				  redirect_to("../../web/log_out.php");
		  } else {
		  	// logged in user is of feed manufacturer

        //TODO: update last_login status in database

        //

		  }

  }

 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title> Hatchery | Home Dashboard </title>

        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Our Custom CSS-->
        <link rel="stylesheet" href="../../web/css/style2.css">
        <link rel="stylesheet" href="../../web/css/bootstrap-datetimepicker.min.css">
        <!-- Scrollbar Custom CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<style>
  /*
    DEMO STYLE
*/
@import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";


body {
    font-family: 'Poppins', sans-serif;
    background: #fafafa;
}

p {
    font-family: 'Poppins', sans-serif;
    font-size: 1.1em;
    font-weight: 300;
    line-height: 1.7em;
    color: #999;
}

a, a:hover, a:focus {
    color: inherit;
    text-decoration: none;
    transition: all 0.3s;
}

.navbar {
    padding: 15px 10px;
    background: #fff;
    border: none;
    border-radius: 0;
    margin-bottom: 40px;
    box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
}

.navbar-btn {
    box-shadow: none;
    outline: none !important;
    border: none;
}

.line {
    width: 100%;
    height: 1px;
    border-bottom: 1px dashed #ddd;
    margin: 40px 0;
}

/* ---------------------------------------------------
    SIDEBAR STYLE
----------------------------------------------------- */
#sidebar {
    width: 250px;
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    z-index: 999;
    background: #0488ae;
    color: #fff;
    transition: all 0.3s;
}

#sidebar.active {
    margin-left: -250px;
}

#sidebar .sidebar-header {
    padding: 20px;
    background: #0488ae;
}

#sidebar ul.components {
    padding: 20px 0;
    border-bottom: 1px solid #0488ae;
}

#sidebar ul p {
    color: #fff;
    padding: 10px;
}

#sidebar ul li a {
    padding: 10px;
    font-size: 1.1em;
    display: block;
}
#sidebar ul li a:hover {
    color: #0488ae;
    background: #fff;
}

#sidebar ul li.active > a, a[aria-expanded="true"] {
    color: #fff;
    background: #0488ae;
}


a[data-toggle="collapse"] {
    position: relative;
}

a[aria-expanded="false"]::before, a[aria-expanded="true"]::before {
    content: '\e259';
    display: block;
    position: absolute;
    right: 20px;
    font-family: 'Glyphicons Halflings';
    font-size: 0.6em;
}
a[aria-expanded="true"]::before {
    content: '\e260';
}


ul ul a {
    font-size: 0.9em !important;
    padding-left: 30px !important;
    background: #6d7fcc;
}

ul.CTAs {
    padding: 20px;
}

ul.CTAs a {
    text-align: center;
    font-size: 0.9em !important;
    display: block;
    border-radius: 5px;
    margin-bottom: 5px;
}
a.download {
    background: #fff;
    color: #0488ae;
}
a.article, a.article:hover {
    background: #6d7fcc !important;
    color: #fff !important;
}


/* ---------------------------------------------------
    CONTENT STYLE
----------------------------------------------------- */
#content {
    width: calc(100% - 250px);
    padding: 40px;
    min-height: 100vh;
    transition: all 0.3s;
    position: absolute;
    top: 0;
    right: 0;
}
#content.active {
    width: 100%;
}


/* ---------------------------------------------------
    MEDIAQUERIES
----------------------------------------------------- */
@media (max-width: 768px) {
    #sidebar {
        margin-left: -250px;
    }
    #sidebar.active {
        margin-left: 0;
    }
    #content {
        width: 100%;
    }
    #content.active {
        width: calc(100% - 250px);
    }
    #sidebarCollapse span {
        display: none;
    }
}






.wrimagecard{
	margin-top: 0;
    margin-bottom: 1.5rem;
    text-align: left;
    position: relative;
    background: #fff;
    box-shadow: 12px 15px 20px 0px rgba(46,61,73,0.15);
    border-radius: 4px;
    transition: all 0.3s ease;
}
.wrimagecard .fa{
	position: relative;
    font-size: 70px;
}
.wrimagecard-topimage_header{
padding: 20px;
}
a.wrimagecard:hover, .wrimagecard-topimage:hover {
    box-shadow: 2px 4px 8px 0px rgba(46,61,73,0.2);
}
.wrimagecard-topimage a {
    width: 100%;
    height: 100%;
    display: block;
}
.wrimagecard-topimage_title {
    padding: 20px 24px;
    height: auto;
    padding-bottom: 0.75rem;
    position: relative;
}
.wrimagecard-topimage a {
    border-bottom: none;
    text-decoration: none;
    color: #525c65;
    transition: color 0.3s ease;
}


</style>

<style>
/*! * Start Bootstrap - Simple Sidebar (http://startbootstrap.com/) * Copyright 2013-2016 Start Bootstrap * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap/blob/gh-pages/LICENSE) */
 body {
     overflow-x: hidden;
}

.icon-font-size
{
    font-size: 22px;
}
/* Toggle Styles */
 #wrapper {
     padding-left: 0;
     -webkit-transition: all 0.5s ease;
     -moz-transition: all 0.5s ease;
     -o-transition: all 0.5s ease;
     transition: all 0.5s ease;
}
 #wrapper.toggled {
     padding-left: 250px;
}
 #sidebar-wrapper {
     z-index: 1000;
     position: fixed;
     left: 250px;
     width: 0;
     height: 100%;
     margin-left: -250px;
     overflow-y: auto;
     background: #0488ae;
     -webkit-transition: all 0.5s ease;
     -moz-transition: all 0.5s ease;
     -o-transition: all 0.5s ease;
     transition: all 0.5s ease;
}
 #wrapper.toggled #sidebar-wrapper {
     width: 250px;
}
 #page-content-wrapper {
     width: 100%;
     position: absolute;
     padding: 15px;
}
 #wrapper.toggled #page-content-wrapper {
     position: absolute;
     margin-right: -250px;
}
/* Sidebar Styles */
 .sidebar-nav {
     position: absolute;
     top: 0;
     width: 250px;
     margin: 0;
     padding: 0;
     list-style: none;
}
 .sidebar-nav li {
     text-indent: 20px;
     line-height: 40px;
}
 .sidebar-nav li a {
     display: block;
     text-decoration: none;
     color: #ffffff;
}
 .sidebar-nav li a:hover {
     text-decoration: none;
     color: #fff;
     background: rgba(255,255,255,0.2);
}
 .sidebar-nav li a:active, .sidebar-nav li a:focus {
     text-decoration: none;
}
 .sidebar-nav > .sidebar-brand {
     height: 65px;
     font-size: 18px;
     line-height: 60px;
}
 .sidebar-nav > .sidebar-brand a {
     color: #ffffff;
     background-color: black
}
 .sidebar-nav > .sidebar-brand a:hover {
     color: #fff;
     background: none;
}
 @media(min-width:768px) {
     #wrapper {
         padding-left: 0;
    }
     #wrapper.toggled {
         padding-left: 250px;
    }
     #sidebar-wrapper {
         width: 0;
    }
     #wrapper.toggled #sidebar-wrapper {
         width: 250px;
    }
     #page-content-wrapper {
         padding: 20px;
         position: relative;
    }
     #wrapper.toggled #page-content-wrapper {
         position: relative;
         margin-right: 0;
    }
}
 /* .navbar-default {
     background-color: #eeeeee;
     border-bottom: 2px solid #0488ae;
}
 .navbar {
     min-height: 50px;
}
 @media (min-width: 768px) {
     .navbar-nav > li > a {
         padding-top: 10px;
         padding-bottom: 10px;
    }
}
 .navbar {
     margin-bottom: 2px;
} */
 .card {
     display: inline-block;
     position: relative;
     width: 100%;
     margin: 25px 0;
     box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14);
     border-radius: 3px;
     color: rgba(0,0,0, 0.87);
     background: #fff;
}
 .card .card-height-indicator {
     margin-top: 100%;
}
 .card .title {
     margin-top: 0;
     margin-bottom: 5px;
}
 .card .card-image {
     height: 60%;
     position: relative;
     overflow: hidden;
     margin-left: 15px;
     margin-right: 15px;
     margin-top: -30px;
     border-radius: 6px;
}
 .card .card-image img {
     width: 100%;
     height: 100%;
     border-radius: 6px;
     pointer-events: none;
}
 .card .card-image .card-title {
     position: absolute;
     bottom: 15px;
     left: 15px;
     color: #fff;
     font-size: 1.3em;
     text-shadow: 0 2px 5px rgba(33, 33, 33, 0.5);
}
 .card .category:not([class*="text-"]) {
     color: #999999;
}
 .card .card-content {
     padding: 15px 20px;
}
 .card .card-content .category {
     margin-bottom: 0;
}
 .card .card-header {
     box-shadow: 0 10px 30px -12px rgba(0, 0, 0, 0.42), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
     margin: -20px 15px 0;
     border-radius: 3px;
     padding: 15px;
     background-color: #999999;
}
 .card .card-header .title {
     color: #FFFFFF;
}
 .card .card-header .category {
     margin-bottom: 0;
     color: rgba(255, 255, 255, 0.62);
}
 .card .card-header.card-chart {
     padding: 0;
     min-height: 160px;
}
 .card .card-header.card-chart + .content h4 {
     margin-top: 0;
}
 .card .card-header .ct-label {
     color: rgba(255, 255, 255, 0.7);
}
 .card .card-header .ct-grid {
     stroke: rgba(255, 255, 255, 0.2);
}
 .card .card-header .ct-series-a .ct-point, .card .card-header .ct-series-a .ct-line, .card .card-header .ct-series-a .ct-bar, .card .card-header .ct-series-a .ct-slice-donut {
     stroke: rgba(255, 255, 255, 0.8);
}
 .card .card-header .ct-series-a .ct-slice-pie, .card .card-header .ct-series-a .ct-area {
     fill: rgba(255, 255, 255, 0.4);
}
 .card .chart-title {
     position: absolute;
     top: 25px;
     width: 100%;
     text-align: center;
}
 .card .chart-title h3 {
     margin: 0;
     color: #FFFFFF;
}
 .card .chart-title h6 {
     margin: 0;
     color: rgba(255, 255, 255, 0.4);
}
 .card .card-footer {
     margin: 0 20px 10px;
     padding-top: 10px;
     border-top: 1px solid #eeeeee;
}
 .card .card-footer .content {
     display: block;
}
 .card .card-footer div {
     display: inline-block;
}
 .card .card-footer .author {
     color: #999999;
}
 .card .card-footer .stats {
     line-height: 22px;
     color: #999999;
     font-size: 12px;
}
 .card .card-footer .stats .material-icons {
     position: relative;
     top: 4px;
     font-size: 16px;
}
 .card .card-footer h6 {
     color: #999999;
}
 .card img {
     width: 100%;
     height: auto;
}
 .card .category .material-icons {
     position: relative;
     top: 6px;
     line-height: 0;
}
 .card .category-social .fa {
     font-size: 24px;
     position: relative;
     margin-top: -4px;
     top: 2px;
     margin-right: 5px;
}
 .card .author .avatar {
     width: 30px;
     height: 30px;
     overflow: hidden;
     border-radius: 50%;
     margin-right: 5px;
}
 .card .author a {
     color: #3C4858;
     text-decoration: none;
}
 .card .author a .ripple-container {
     display: none;
}
 .card .table {
     margin-bottom: 0;
}
 .card .table tr:first-child td {
     border-top: none;
}
 .card [data-background-color="orange"] {
     background: linear-gradient(60deg, #0488ae, #0488ae);
    /*box-shadow: 0 12px 20px -5px #bfeaf6, 0 4px 20px 0px #bfeaf6, 0 7px 8px -5px #bfeaf6;
    */
}
 .card [data-background-color] {
     color: #FFFFFF;
}
 .card [data-background-color] a {
     color: #FFFFFF;
}
 .card-stats .title {
     margin: 0;
}
 .card-stats .card-header {
     float: left;
     text-align: center;
}
 .card-stats .card-header i {
     font-size: 36px;
     line-height: 56px;
     width: 56px;
     height: 56px;
}
 .card-stats .card-content {
     text-align: right;
     padding-top: 10px;
}
 .card-nav-tabs .header-raised {
     margin-top: -30px;
}
 .card-nav-tabs .nav-tabs {
     background: transparent;
     padding: 0;
}
 .card-nav-tabs .nav-tabs-title {
     float: left;
     padding: 10px 10px 10px 0;
     line-height: 24px;
}
 .card-plain {
     background: transparent;
     box-shadow: none;
}
 .card-plain .card-header {
     margin-left: 0;
     margin-right: 0;
}
 .card-plain .content {
     padding-left: 5px;
     padding-right: 5px;
}
 .card-plain .card-image {
     margin: 0;
     border-radius: 3px;
}
 .card-plain .card-image img {
     border-radius: 3px;
}


</style>
    </head>
    <body>



        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>Hatchery dashboard </h3></h3>
                </div>

                <ul class="list-unstyled components">
                    <p>Navigation</p>
                    <li class="active">
                        <a href="hatchers_dashboard.php" >Home Dashboard</a>
                    </li>
                    <li class="active">
                        <a href="updatePostHatchedData.php" >Post Hatch data</a>
                    </li>
                    <li>
                        <a href="#">update account</a>
                    </li>
                    <li>
                        <a href="#">Statistics</a>
                    </li>
                    <li>
                        <a href="#">History</a>
                    </li>
                    <li>
                        <a href="#">Geo-Mapping</a>
                    </li>
                    <li>
                        <a href="#">logout</a>
                    </li>


                </ul>


            </nav>

            <!-- Page Content Holder -->
            <div id="content">

                <nav class="navbar navbar-default">
                    <div class="container-fluid">

                        <div class="navbar-header">
                            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                                <i class="glyphicon glyphicon-align-left"></i>
                                <span>Toggle Sidebar</span>
                            </button>
                        </div>

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="#">Welcome, <strong><?php echo $logged_user_email; ?></strong></a></li>                            </ul>
                        </div>
                    </div>
                </nav>
