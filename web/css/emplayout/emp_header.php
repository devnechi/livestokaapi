<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>agroVet</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <!--Include the above in your HEAD tag ---------->


<style>
.panel-body {
    padding: 15px;
    color: white;
    background-color: #6488a7;
}

.btn-block {
    display: block;
    width: 200px;
    height: 50px;
}
</style>

</head>

<body>
  <!-- <h1>Hello, world!</h1> -->


  <nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
        <a class="navbar-brand" href="#">
							agroVet Employee
						</a>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="../home.html" target="_blank">Log out</a></li>
          <li class="dropdown ">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
									Settings
									<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li class="dropdown-header">SETTINGS</li>
              <li class=""><a href="#">Link</a></li>
              <li class=""><a href="#">Other Link</a></li>
              <li class=""><a href="#">Other Link</a></li>
              <li class="divider"></li>
              <li><a href="#">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container-fluid">
    <div class="col col-md-3">
      <div class="panel-group" id="accordion">
        <!-- <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
								Employees</a>
							  </h4>
          </div>
          <div id="collapse1" class="panel-collapse collapse in">
            <ul class="list-group">
              <li class="list-group-item"><span class="badge">253</span> Add New Employee</li>
              <li class="list-group-item"><span class="badge">17</span> Manage Employee </li>
              <li class="list-group-item"><span class="badge">3</span> Employee Activity</li>
            </ul>
          </div>
        </div> -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
								Uza</a>
							  </h4>
          </div>
          <div id="collapse2" class="panel-collapse collapse">
            <ul class="list-group">
              <li class="list-group-item"><span class="badge">12</span> Uza Bidhaa</li>
              <li class="list-group-item"><span class="badge">5</span> Toa Huduma </li>
              <li class="list-group-item"><span class="badge">5</span> Mauzo Yote </li>

            </ul>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                Bidhaa</a>
                </h4>
          </div>
          <div id="collapse3" class="panel-collapse collapse">
            <ul class="list-group">
              <li class="list-group-item"><span class="badge">12</span> Ongeza Bidhaa</li>
              <li class="list-group-item"><span class="badge">5</span> Bidhaa zilizopo </li>
              <li class="list-group-item"><span class="badge">5</span> Historia za Bidha </li>
            </ul>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
								Settings</a>
							  </h4>
          </div>
          <div id="collapse3" class="panel-collapse collapse">
            <ul class="list-group">
              <li class="list-group-item"><span class="badge">1</span> Users Reported</li>
              <li class="list-group-item"><span class="badge">5</span> User Waiting Activation</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
