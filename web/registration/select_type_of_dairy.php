<?php 
   include('../../includes/layouts/public_layout_header.php');
   ?>
<!------ Include the above in your HEAD tag ---------->
<style>

.carousel-fade .carousel-inner .item {
  opacity: 0;
  -webkit-transition-property: opacity;
  -moz-transition-property: opacity;
  -o-transition-property: opacity;
  transition-property: opacity;
}
.carousel-fade .carousel-inner .active {
  opacity: 1;
}
.carousel-fade .carousel-inner .active.left,
.carousel-fade .carousel-inner .active.right {
  left: 0;
  opacity: 0;
  z-index: 1;
}
.carousel-fade .carousel-inner .next.left,
.carousel-fade .carousel-inner .prev.right {
  opacity: 1;
}
.carousel-fade .carousel-control {
  z-index: 2;
}
.fade-carousel {
    position: relative;
    height: 100vh;
}
.fade-carousel .carousel-inner .item {
    height: 100vh;
}
.fade-carousel .carousel-indicators > li {
    margin: 0 2px;
    background-color: #f39c12;
    border-color: #f39c12;
    opacity: .7;
}
.fade-carousel .carousel-indicators > li.active {
  width: 10px;
  height: 10px;
  opacity: 1;
}

/********************************/
/*          Hero Headers        */
/********************************/
.hero {
    position: absolute;
    top: 50%;
    left: 50%;
    z-index: 3;
    color: #fff;
    text-align: center;

    text-shadow: 1px 1px 0 rgba(0,0,0,.75);
      -webkit-transform: translate3d(-50%,-50%,0);
         -moz-transform: translate3d(-50%,-50%,0);
          -ms-transform: translate3d(-50%,-50%,0);
           -o-transform: translate3d(-50%,-50%,0);
              transform: translate3d(-50%,-50%,0);
}
.hero h1 {
    font-size: 6em;    
    font-weight: bold;
    margin: 0;
    padding: 0;
}

.fade-carousel .carousel-inner .item .hero {
    opacity: 0;
    -webkit-transition: 4s all ease-in-out .2s;
       -moz-transition: 4s all ease-in-out .2s; 
        -ms-transition: 4s all ease-in-out .2s; 
         -o-transition: 4s all ease-in-out .2s; 
            transition: 4s all ease-in-out .2s; 
}
.fade-carousel .carousel-inner .item.active .hero {
    opacity: 1;
    -webkit-transition: 4s all ease-in-out .2s;
       -moz-transition: 4s all ease-in-out .2s; 
        -ms-transition: 4s all ease-in-out .2s; 
         -o-transition: 4s all ease-in-out .2s; 
            transition: 4s all ease-in-out .2s;    
}

/********************************/
/*            Overlay           */
/********************************/
.overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    z-index: 2;
  
}

/********************************/
/*          Custom Buttons      */
/********************************/
.btn.btn-lg {padding: 10px 40px;}
.btn.btn-hero,
.btn.btn-hero:hover,
.btn.btn-hero:focus {
    color: #f5f5f5;
    background-color: #1abc9c;
    border-color: #1abc9c;
    outline: none;
    margin: 20px auto;
}

/********************************/
/*       Slides backgrounds     */
/********************************/
.fade-carousel .slides .slide-1, 
.fade-carousel .slides .slide-2,
.fade-carousel .slides .slide-3,
.fade-carousel .slides .slide-4,
.fade-carousel .slides .slide-5 {
  height: 100vh;
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
}
.fade-carousel .slides .slide-1 {
  background-image: url(../../web/images/dairy/meat-1030729_1920.jpg); 
}
.fade-carousel .slides .slide-2 {
  background-image: url(../../web/images/dairy/cows-2641195_1920.jpg);
}
.fade-carousel .slides .slide-3 {
  background-image: url(../../web/images/dairy/milk-3518891_1920.jpg);
}
.fade-carousel .slides .slide-4 {
  background-image: url(../../web/images/dairy/cow-2790134_1920.jpg);
}
.fade-carousel .slides .slide-5 {
  background-image: url(../../web/images/dairy/meat-3195334_1920.jpg);
}
/********************************/
/*          Media Queries       */
/********************************/
@media screen and (min-width: 980px){
    .hero { width: 980px; }    
}
@media screen and (max-width: 640px){
    .hero h1 { font-size: 4em; }    
}

.navbar{

      background-color: rgba(255, 255, 255, 0.1);
    position: absolute;
    width: 100%;
    z-index: 2;
    border:none;
    color:white;
}
#login-dp{
    min-width: 250px;
    padding: 14px 14px 0;
    overflow:hidden;
    background-color:rgba(255,255,255,.8);
}
#login-dp .help-block{
    font-size:12px    
}
#login-dp .bottom{
    background-color:rgba(255,255,255,.8);
    border-top:1px solid #ddd;
    clear:both;
    padding:14px;
}
#login-dp .social-buttons{
    margin:12px 0    
}
#login-dp .social-buttons a{
    width: 49%;
}
#login-dp .form-group {
    margin-bottom: 10px;
}
.btn-fb{
    color: #fff;
    background-color:#3b5998;
}
.btn-fb:hover{
    color: #fff;
    background-color:#496ebc 
}
.btn-tw{
    color: #fff;
    background-color:#55acee;
}
.btn-tw:hover{
    color: #fff;
    background-color:#59b5fa;
}
@media(max-width:768px){
    #login-dp{
        background-color: inherit;
        color: #fff;
    }
    #login-dp .bottom{
        background-color: inherit;
        border-top:0 none;
    }
}

nav a{
  color:white;
}
.icon-bar{
  background-color:black;
}


</style>

<nav class="navbar navbar-top fixed-top  " role="navigation" style="background-color:rgba(255,255,255,0.1);  position:absolute;">
  <div class="container-fluid" >
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Login dropdown</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    
      
      <ul class="nav navbar-nav navbar-right">
        <li><p class="navbar-text">Already have an account</p></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
			<ul id="login-dp" class="dropdown-menu">
				<li>
					 <div class="row">
							<div class="col-md-12">
							
								<div class="social-buttons">
									<a href="#" class="btn btn-fb"><i class="fa fa-facebook"></i> Facebook</a>
									<a href="#" class="btn btn-tw"><i class="fa fa-twitter"></i> Twitter</a>
                  <a href="#" class="btn btn-tw"><i class="fa fa-twitter"></i> Google</a>
								</div>
                                Enter
								 <form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
										<div class="form-group">
											 <label class="sr-only" for="exampleInputEmail2">Email address</label>
											 <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email address" required>
										</div>
										<div class="form-group">
											 <label class="sr-only" for="exampleInputPassword2">Password</label>
											 <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
                                             <div class="help-block text-right"><a href="">Forget the password ?</a></div>
										</div>
										<div class="form-group">
											 <button type="submit" class="btn btn-primary btn-block">Sign in</button>
										</div>
										<div class="checkbox">
											 <label>
											 <input type="checkbox"> keep me logged-in
											 </label>
										</div>
								 </form>
							</div>
							<div class="bottom text-center">
								New here ? <a href="#"><b>Join Us</b></a>
							</div>
					 </div>
				</li>
			</ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="carousel fade-carousel carousel-fade slide" style="top:0%;" data-ride="carousel" data-interval="8000" id="bs-carousel">
   
  <div class="overlay">   <div class="hero">        
        <hgroup>
            <h1>Get Started</h1>        
            <h3>Get start by registering  your  field</h3>
        </hgroup>
        <span > <select class=" btn btn-hero btn-lg "  id="register" >
                    <option>Register As</option>
                    <option value="1">Milk processor Unit</option>
                       <option value="2">Beef Cattle Farm</option>
                     <option value="3">Meat Processor</option>
                       <option value="4">Cattle Traders</option>
                     
                     
                     </select></span>
      </div>
                     </div>

  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#bs-carousel" data-slide-to="0" class="active"></li>
    <li data-target="#bs-carousel" data-slide-to="1"></li>
    <li data-target="#bs-carousel" data-slide-to="2"></li>
    <li data-target="#bs-carousel" data-slide-to="4"></li>
    <li data-target="#bs-carousel" data-slide-to="5"></li>
  </ol>
  
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item slides active">
      <div class="slide-1"></div>
    
    </div>
    <div class="item slides">
      <div class="slide-2"></div>

    </div>
    <div class="item slides">
      <div class="slide-3"></div>
    
    </div>
    <div class="item slides">
      <div class="slide-4"></div>
      
    </div>
    <div class="item slides">
      <div class="slide-5"></div>
      
    </div>
  </div> 
</div>

 <!-- <script>

$("#register").on('change', function() {
  window.location=$(this).val()
  //set isopen to opposite so next  time  when use clicked select  box
  //it wont trigger this event


});
</script> -->
 

<?php

include('../../includes/layouts/public_ly_footer.php');?>
