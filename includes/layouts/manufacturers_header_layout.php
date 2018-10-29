<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> Manufacturers Dashboard</title>

         <link href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="https://raw.githubusercontent.com/l-lin/font-awesome-animation/master/dist/font-awesome-animation.min.css" rel="stylesheet" />
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

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
 .navbar-default {
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
}
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
     background-color: #1e5769;
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
 .navbar-default .dropdown-menu.notify-drop {
     min-width: 330px;
     background-color: #fff;
     min-height: 360px;
     max-height: 360px;
}
 .navbar-default .dropdown-menu.notify-drop .notify-drop-title {
     border-bottom: 1px solid #e2e2e2;
     padding: 5px 15px 10px 15px;
}
 .navbar-default .dropdown-menu.notify-drop .drop-content {
     min-height: 280px;
     max-height: 280px;
     overflow-y: scroll;
}
 .navbar-default .dropdown-menu.notify-drop .drop-content::-webkit-scrollbar-track {
     background-color: #F5F5F5;
}
 .navbar-default .dropdown-menu.notify-drop .drop-content::-webkit-scrollbar {
     width: 8px;
     background-color: #F5F5F5;
}
 .navbar-default .dropdown-menu.notify-drop .drop-content::-webkit-scrollbar-thumb {
     background-color: #ccc;
}
 .navbar-default .dropdown-menu.notify-drop .drop-content > li {
     border-bottom: 1px solid #e2e2e2;
     padding: 10px 0px 5px 0px;
}
 .navbar-default .dropdown-menu.notify-drop .drop-content > li:nth-child(2n+0) {
     background-color: #fafafa;
}
 .navbar-default .dropdown-menu.notify-drop .drop-content > li:after {
     content: "";
     clear: both;
     display: block;
}
 .navbar-default .dropdown-menu.notify-drop .drop-content > li:hover {
     background-color: #fcfcfc;
}
 .navbar-default .dropdown-menu.notify-drop .drop-content > li:last-child {
     border-bottom: none;
}
 .navbar-default .dropdown-menu.notify-drop .drop-content > li .notify-img {
     float: left;
     display: inline-block;
     width: 45px;
     height: 45px;
     margin: 0px 0px 8px 0px;
}
 .navbar-default .dropdown-menu.notify-drop .allRead {
     margin-right: 7px;
}
 .navbar-default .dropdown-menu.notify-drop .rIcon {
     float: right;
     color: #999;
}
 .navbar-default .dropdown-menu.notify-drop .rIcon:hover {
     color: #333;
}
 .navbar-default .dropdown-menu.notify-drop .drop-content > li a {
     font-size: 12px;
     font-weight: normal;
}
 .navbar-default .dropdown-menu.notify-drop .drop-content > li {
     font-weight: bold;
     font-size: 11px;
}
 .navbar-default .dropdown-menu.notify-drop .drop-content > li hr {
     margin: 5px 0;
     width: 70%;
     border-color: #e2e2e2;
}
 .navbar-default .dropdown-menu.notify-drop .drop-content .pd-l0 {
     padding-left: 0;
}
 .navbar-default .dropdown-menu.notify-drop .drop-content > li p {
     font-size: 11px;
     color: #666;
     font-weight: normal;
     margin: 3px 0;
}
 .navbar-default .dropdown-menu.notify-drop .drop-content > li p.time {
     font-size: 10px;
     font-weight: 600;
     top: -6px;
     margin: 8px 0px 0px 0px;
     padding: 0px 3px;
     border: 1px solid #e2e2e2;
     position: relative;
     background-image: linear-gradient(#fff,#f2f2f2);
     display: inline-block;
     border-radius: 2px;
     color: #B97745;
}
 .navbar-default .dropdown-menu.notify-drop .drop-content > li p.time:hover {
     background-image: linear-gradient(#fff,#fff);
}
 .navbar-default .dropdown-menu.notify-drop .notify-drop-footer {
     border-top: 1px solid #e2e2e2;
     bottom: 0;
     position: relative;
     padding: 8px 15px;
}
 .navbar-default .dropdown-menu.notify-drop .notify-drop-footer a {
     color: #777;
     text-decoration: none;
}
 .navbar-default .dropdown-menu.notify-drop .notify-drop-footer a:hover {
     color: #333;
}
 ul #idUserprofileDetails {
     min-height: inherit;
     max-height: inherit;
}
 ul #idUserprofileDetails .drop-contents {
     min-height: inherit;
     max-height: inherit;
}
/*User Profile*/
 .sidenav {
     height: 100%;
     width: 0;
     position: fixed;
     z-index: 10000000000000;
     top: 0;
     right: 0;
     background-color: #111;
     overflow-x: hidden;
     transition: 0.5s;
     padding-top: 60px;
}
 .sidenav a {
     padding: 8px 8px 8px 32px;
     text-decoration: none;
     font-size: 25px;
     color: #818181;
     display: block;
     transition: 0.3s;
}
 .sidenav a:hover {
     color: #f1f1f1;
}
 .sidenav .closebtn {
     position: absolute;
     top: 0;
     right: 25px;
     font-size: 36px;
     margin-left: 50px;
}
 @media screen and (max-height: 450px) {
     .sidenav {
         padding-top: 15px;
    }
     .sidenav a {
         font-size: 18px;
    }
}
 a {
     color: #0488ae;
     text-decoration: none;
}
 .user-details {
     position: relative;
     padding: 0;
}
 .user-details .user-image {
     position: relative;
     z-index: 1;
     width: 100%;
     text-align: center;
}
 .user-image img {
     clear: both;
     margin: auto;
     position: relative;
}
 .user-details .user-info-block {
     width: 100%;
     position: absolute;
     top: 72%;
    /*background: rgb(255, 255, 255);
    */
     z-index: 0;
     padding-top: 35px;
     color: white;
}
 .user-info-block .user-heading {
     width: 100%;
     text-align: center;
     margin: 10px 0 0;
}
 .user-info-block .navigation {
     float: left;
     width: 100%;
     margin: 0;
     padding: 0;
     list-style: none;
     border-bottom: 1px solid #428BCA;
     border-top: 1px solid #428BCA;
}
 .navigation li {
     float: left;
     margin: 0;
     padding: 0;
}
 .navigation li a {
     padding: 20px 30px;
     float: left;
}
 .navigation li.active a {
     background: #428BCA;
     color: #fff;
}
 .user-info-block .user-body {
     float: left;
     padding: 5%;
     width: 90%;
}
 .user-body .tab-content > div {
     float: left;
     width: 100%;
}
 .user-body .tab-content h4 {
     width: 100%;
     margin: 10px 0;
     color: #333;
}

</style>
</head>
<body>
    <div>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>

        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
            <div class="row">
                <div class="col-sm-12 col-md-12 user-details">
                    <div class="user-image">
                        <img src="data:image/jpeg;base64,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" alt="Pawan Sachitha" title="Pawan Sachitha" class="img-circle">
                    </div>
                    <div class="user-info-block">
                        <div class="user-heading">
                            <h3>Pawan Sachitha</h3>
                            <span class="help-block">Colombo, IN</span>
                        </div>
                        <ul class="navigation">
                            <li class="active">
                                <a data-toggle="tab" href="#information">
                                    <span class="glyphicon glyphicon-user"></span>
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#settings">
                                    <span class="glyphicon glyphicon-cog"></span>
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#email">
                                    <span class="glyphicon glyphicon-envelope"></span>
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#events">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </a>
                            </li>
                        </ul>
                        <div class="user-body">
                            <div class="tab-content">
                                <div id="information" class="tab-pane active">
                                    <h4>Account Information</h4>
                                </div>
                                <div id="settings" class="tab-pane">
                                    <h4>Settings</h4>
                                </div>
                                <div id="email" class="tab-pane">
                                    <h4>Send Message</h4>
                                </div>
                                <div id="events" class="tab-pane">
                                    <h4>Events</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                        </button>

                        <a href="#menu-toggle"  id="menu-toggle">
                            <i class="fa fa-bars fa-3x" aria-hidden="true"></i>
                        </a>
                        <a class="navbar-brand" href="/">LiveStoka</a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="hatchers_dashboard.php">Home</a></li>
                            <li><a href="/Home/About">News & Updates</a></li>
                            <li><a href="/Home/Contact">Feed Manufacturer's Industry</a></li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li><a ><strong class="icon-font-size"> Manufacturers Home Dashboard </strong></a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-bell icon-font-size"></span> (<b style="color:red">2</b>)</a>
                                <ul class="dropdown-menu notify-drop">
                                    <div class="notify-drop-title">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6">Bildirimler (<b>2</b>)</div>
                                            <div class="col-md-6 col-sm-6 col-xs-6 text-right"><a href="" class="rIcon allRead" data-tooltip="tooltip" data-placement="bottom" title="tümü okundu."><i class="fa fa-dot-circle-o"></i></a></div>
                                        </div>
                                    </div>
                                    <!-- end notify title -->
                                    <!-- notify content -->

                                    <div class="drop-content">
                                        <li>
                                            <div class="col-md-3 col-sm-3 col-xs-3"><div class="notify-img"><img src="http://placehold.it/45x45" alt=""></div></div>
                                            <div class="col-md-9 col-sm-9 col-xs-9 pd-l0">
                                                <a href="">Ahmet</a> yorumladı. <a href="">Çicek bahçeleri...</a> <a href="" class="rIcon"><i class="fa fa-dot-circle-o"></i></a>

                                                <hr>
                                                <p class="time">Şimdi</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col-md-3 col-sm-3 col-xs-3"><div class="notify-img"><img src="http://placehold.it/45x45" alt=""></div></div>
                                            <div class="col-md-9 col-sm-9 col-xs-9 pd-l0">
                                                <a href="">Ahmet</a> yorumladı. <a href="">Çicek bahçeleri...</a> <a href="" class="rIcon"><i class="fa fa-dot-circle-o"></i></a>
                                                <p>Lorem ipsum sit dolor amet consilium.</p>
                                                <p class="time">1 Saat önce</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col-md-3 col-sm-3 col-xs-3"><div class="notify-img"><img src="http://placehold.it/45x45" alt=""></div></div>
                                            <div class="col-md-9 col-sm-9 col-xs-9 pd-l0">
                                                <a href="">Ahmet</a> yorumladı. <a href="">Çicek bahçeleri...</a> <a href="" class="rIcon"><i class="fa fa-dot-circle-o"></i></a>
                                                <p>Lorem ipsum sit dolor amet consilium.</p>
                                                <p class="time">29 Dakika önce</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col-md-3 col-sm-3 col-xs-3"><div class="notify-img"><img src="http://placehold.it/45x45" alt=""></div></div>
                                            <div class="col-md-9 col-sm-9 col-xs-9 pd-l0">
                                                <a href="">Ahmet</a> yorumladı. <a href="">Çicek bahçeleri...</a> <a href="" class="rIcon"><i class="fa fa-dot-circle-o"></i></a>
                                                <p>Lorem ipsum sit dolor amet consilium.</p>
                                                <p class="time">Dün 13:18</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col-md-3 col-sm-3 col-xs-3"><div class="notify-img"><img src="http://placehold.it/45x45" alt=""></div></div>
                                            <div class="col-md-9 col-sm-9 col-xs-9 pd-l0">
                                                <a href="">Ahmet</a> yorumladı. <a href="">Çicek bahçeleri...</a> <a href="" class="rIcon"><i class="fa fa-dot-circle-o"></i></a>
                                                <p>Lorem ipsum sit dolor amet consilium.</p>
                                                <p class="time">2 Hafta önce</p>
                                            </div>
                                        </li>
                                    </div>
                                    <div class="notify-drop-footer text-center">
                                        <a href=""><i class="fa fa-eye"></i> Hidden</a>
                                    </div>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a ><span style="cursor:pointer" onclick="openNav()"><span class="glyphicon glyphicon-user icon-font-size"></span></a>

                            </li>

                        </ul>

                    </div>
                </nav>
            </div>
        </div>
        <!-- wrapper -->
        <div id="wrapper" class="toggled">
            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li class="sidebar-brand"><a>Manufacturer's Navigation</a>  </li>
                    <li><a href="feed_manufacturer_dashboard.php">Dashboard </a></li>
                    <li><a href="update_monthly_summary.php">Update Monthly Data </a></li>
                    <li><a href="add_new_product.php">Add New Product</a></li>
                    <li><a href="manage_products.php">View and Manage Products</a></li>
                    <li><a href="add_raw_material.php">Add New Raw Material</a></li>
                    <li><a href="manage_raw_materials.php">View and Manage Raw Materials</a></li>
                    <li><a href="#">Statistics </a></li>
                    <li><a href="#">Reports</a></li>
                    <li><a href="#">Update Manufacturer Information</a></li>
                    <li><a href="log_out.php">Log Out</a></li>
                </ul>
            </div>
            <!-- /#sidebar-wrapper -->
            <!-- Page Content -->
            <div id="page-content-wrapper">
              <div class="container">
                <h2>Basic Modal Example</h2>
                <!-- Trigger the modal with a button -->
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modal Header</h4>
                      </div>
                      <div class="modal-body">
                        <p>Some text in the modal.</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>

                  </div>
                </div>

              </div>
