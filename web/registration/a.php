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
    text-transform: uppercase;
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
.fade-carousel .slides .slide-3 {
  height: 100vh;
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
}
.fade-carousel .slides .slide-1 {
  background-image: url(https://ununsplash.imgix.net/photo-1416339134316-0e91dc9ded92?q=75&fm=jpg&s=883a422e10fc4149893984019f63c818); 
}
.fade-carousel .slides .slide-2 {
  background-image: url(https://ununsplash.imgix.net/photo-1416339684178-3a239570f315?q=75&fm=jpg&s=c39d9a3bf66d6566b9608a9f1f3765af);
}
.fade-carousel .slides .slide-3 {
  background-image: url(https://ununsplash.imgix.net/photo-1416339276121-ba1dfa199912?q=75&fm=jpg&s=9bf9f2ef5be5cb5eee5255e7765cb327);
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





</style>
<div class="carousel fade-carousel carousel-fade slide" data-ride="carousel" data-interval="8000" id="bs-carousel">
  <!-- Overlay -->
  <div class="overlay"> 
                     </div>

  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#bs-carousel" data-slide-to="0" class="active"></li>
    <li data-target="#bs-carousel" data-slide-to="1"></li>
    <li data-target="#bs-carousel" data-slide-to="2"></li>
  </ol>
  
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item slides active">
      <div class="slide-1"></div>
      <div class="hero">
        <hgroup>
        <h1>Get Started</h1>        
            <h3>Get start by registering  your  field</h3>
        </hgroup><span > <select class=" btn btn-hero btn-lg "  id="register" name="register">
                    <option>Register As</option>
                       <option>Advocacy Work</option>
                       <option>Survey</option>
                       <option>Research</option>
                     
                     </select></span>
       
      </div>
    </div>
    <div class="item slides">
      <div class="slide-2"></div>
      <div class="hero">        
        <hgroup>
        <h1>Get Started</h1>        
            <h3>Get start by registering  your  field</h3>
        </hgroup>       
        
        <span > <select class=" btn btn-hero btn-lg "  id="register" name="register">
                    <option>Register As</option>
                       <option>Advocacy Work</option>
                       <option>Survey</option>
                       <option>Research</option>
                     
                     </select></span>
      </div>
    </div>
    <div class="item slides">
      <div class="slide-3"></div>
      <div class="hero">        
        <hgroup>
            <h1>Get Started</h1>        
            <h3>Get start by registering  your  field</h3>
        </hgroup>
        <span > <select class=" btn btn-hero btn-lg "  id="register" name="register">
                    <option>Register As</option>
                       <option>Advocacy Work</option>
                       <option>Survey</option>
                       <option>Research</option>
                     
                     </select></span>
      </div>
    </div>
  </div> 
</div>



<?php

include('../../includes/layouts/public_ly_footer.php');?>