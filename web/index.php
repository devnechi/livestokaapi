<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Livestoka | Home </title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
        <!-- Font-Awesome CSS -->
        <link rel="stylesheet" href="vendor/fontawesome-free/css/all.min.css">
        <!-- Custom-Style CSS -->
        <link rel="stylesheet" href="css/custom-style.css">
        <!-- Util-Style CSS -->
        <link rel="stylesheet" href="css/util.css">
        <!-- Slick CSS -->
        <link rel="stylesheet" href="css/slick.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <a href="index.php" class="navbar-brand"><img src="images/logo.png"></a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle Navigation">Menu <span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active"><a href="#" class="nav-link">home </a></li>
                    <li class="nav-item"><a href="#abouts" class="nav-link">abouts </a></li>
                    <li class="nav-item"><a href="#services" class="nav-link">services </a></li>
                    <li class="nav-item"><a href="#contacts" class="nav-link">contacts </a></li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <button type="submit" class="btn menu-right-button">login</button>
                </form>
                <form class="form-inline my-2 my-lg-0">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle menu-right-button" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">register as </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="registration/breeder_flock_farm_reg.php">Breeder Flock Farm</a>
                            <a class="dropdown-item" href="registration/hatchery_registration.php">Hatchery</a>
                            <a class="dropdown-item" href="registration/register_feeds_manufacturers.php">Feed Manufacturers</a>
                            <a class="dropdown-item" href="registration/select_type_of_dairy.php">Dairy</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item disabled" href="#">Association</a>
                        </div>
                    </div>
                </form>
            </div>
        </nav>
        <main>
            <!-- Carousel Section -->
            <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselIndicators" data-slide-to="2"></li>
                    <li data-target="#carouselIndicators" data-slide-to="3"></li>
                    <li data-target="#carouselIndicators" data-slide-to="4"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="images/slider/cock.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="images/slider/cowa.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="images/slider/ducks.jpg" alt="Third slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="images/slider/animals.jpg" alt="Fourth slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="images/slider/grainz.jpeg" alt="Fifth slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span>
                </a>
            </div>
            <!-- Card Section -->
            <div class="container-fluid">
                <h1 class="heading-1">Data Management and Industry Insights </h1>
                <p class="paragraph-1 text-center">With the platform all stakeholders in the business will have access to a wide market and  inclusive business community</p>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <img src="images/card/busrep.jpg" alt="" class="card-img-top">
                            <div class="card-body">
                                <h4 class="card-title">Business Intelligence </h4>
                                <p class="card-text">assists members and industry staleholders to track productivity.</p>
                                <!-- <a href="#" class="btn btn-outline-read-more">Read More</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="images/card/stata.png" alt="" class="card-img-top">
                            <div class="card-body">
                                <h4 class="card-title">Data Management </h4>
                                <p class="card-text">Record keeping, information management and data processing</p>
                                <!-- <a href="#" class="btn btn-outline-read-more">Read More</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="images/card/busrep.jpg" alt="" class="card-img-top">
                            <div class="card-body">
                                <h4 class="card-title">Industry Reports </h4>
                                <p class="card-text">Access to analysis and industry reports and monitoring growth.</p>
                                <!-- <a href="#" class="btn btn-outline-read-more">Read More</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="images/card/statb.jpg" alt="" class="card-img-top">
                            <div class="card-body">
                                <h4 class="card-title">Real Time Data </h4>
                                <p class="card-text">industry stakeholderes will always have access to real time data.</p>
                                <!-- <a href="#" class="btn btn-outline-read-more">Read More</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Who are we? -->
            <div class="container-fluid" id="services" style="background-color:#74f5e3;">
                <div class="row">
                    <!-- About Us -->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <h3 class="heading-1">About Us. <small>Who are we?</small></h3>
                        <p  class="paragraph-1">
                        We are creative tech heads who like to write code, program softwares and develop information systems that might help someone, community or business improve its productivity.
                        We hope with our vast knowledge in technology and development of various technology products we have something to contribute in the industry to elevate it to its full potential.
                        What we want
                        to archive as a technology company,
                        is to support the agricultural industry increase market awareness and increase productivity,
                        with the use of current technologies to make better industry decisions.
                        we are a team of developers, engineers and analysts who want leverage their technology expertise
                        and work with agricultural
                        industry stakeholders, In data collection, data analysis, and management.
                        </p>
                    </div>
                    <!-- Carousel start -->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div id="carousel-our-services" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-our-services" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-our-services" data-slide-to="1"></li>
                                <li data-target="#carousel-our-services" data-slide-to="2"></li>
                                <li data-target="#carousel-our-services" data-slide-to="3"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="images/about/dev.jpg" alt="First slide" class="img-thumb img-fluid">
                                </div>
                                <div class="carousel-item">
                                    <img src="images/about/cod.jpg" alt="Second slide" class="img-thumb img-fluid">
                                </div>
                                <div class="carousel-item">
                                    <img src="images/about/stat.png" alt="Third slide" class="img-thumb img-fluid">
                                </div>
                                <div class="carousel-item">
                                    <img src="images/about/dev.jpg" alt="Third slide" class="img-thumb img-fluid">
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-our-services" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span></a><a class="right carousel-control"
                            href="#carousel-example-generic" data-slide="next"><span class="glyphicon glyphicon-chevron-right">
                            </span></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- What's our goal? -->
            <div class="container-fluid" id="services">
                <div class="row">
                    <!-- Carousel start -->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div id="carousel-our-services" class="carouselsrv slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-our-services" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-our-services" data-slide-to="1"></li>
                                <li data-target="#carousel-our-services" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="images/goal/inv.jpg" alt="First slide" class="img-thumb img-fluid">
                                </div>
                                <div class="carousel-item">
                                    <img src="images/goal/center.jpg" alt="Second slide" class="img-thumb img-fluid">
                                </div>
                                <div class="carousel-item">
                                    <img src="images/goal/prop.jpg" alt="Third slide" class="img-thumb img-fluid">
                                </div>
                                <div class="carousel-item">
                                    <img src="images/goal/inv.jpg" alt="Third slide" class="img-thumb img-fluid">
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-our-services" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span></a><a class="right carousel-control"
                            href="#carousel-example-generic" data-slide="next"><span class="glyphicon glyphicon-chevron-right">
                            </span></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <h3 class="heading-1">What are Our Goal? <small>A data center</small></h3>
                        <p  class="paragraph-1">
                          Create an interactive platform, data warehouse and  Data Center that would be used to manage industry data.
                          The data collected could be used by individual companies to make business decision using up-to-date data, take advantage of available reports and statistics.
                        </p>
                        <p  class="paragraph-1">
                          <strong>Data Center and Source</strong>
                          With our technology tools offered on our platform they enable stakeholders to collect and manage big data for mining purposes, which can be accessed and analyzed by its members in the platform.
                        </p>

                        <p  class="paragraph-1">
                          <strong>Research Hub For Agri-businesses</strong>
                          Livestoka wants to be on the fore-front on research and technology advancement in the industry by constantly iterating and observing trends in our industry data and lead research opportunities.
                        </p>

                        <p  class="paragraph-1">
                          <strong>Tracking and Monitoring Industry Growth</strong>
                        With us being a data center for the industry we want to be able to be make predictive and calculated decisions, so as to ensure stakeholders take calculated risks, use data gathered and analyze to predict and determine the growth of the industry.</p>
                    </div>
                </div>
            </div>
            <!-- Who are we working -->
            <div class="container-fluid" style="background-color:#f4f4f4;padding-top:2%;padding-bottom:2%;">
                <h1 class="heading-1">Who we work with</h1>
                <p class="paragraph-1 text-center">With the platform all stakeholders in the business will have access to a wide market and  inclusive business community</p>
                <div class="row">
                    <div class="col-md-2">
                        <div class="card">
                            <img src="images/dealers/hatchery.jpg" alt="" class="card-img-top">
                            <div class="card-body">
                                <h4 class="card-title">Business Intelligence </h4>
                                <p class="card-text">assists members and industry staleholders to track productivity.</p>
                                <!-- <a href="#" class="btn btn-outline-read-more">Read More</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="images/dealers/breeders.jpg" alt="" class="card-img-top">
                            <div class="card-body">
                                <h4 class="card-title">Data Management </h4>
                                <p class="card-text">Record keeping, information management and data processing</p>
                                <!-- <a href="#" class="btn btn-outline-read-more">Read More</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="images/dealers/feeders.jpg" alt="" class="card-img-top">
                            <div class="card-body">
                                <h4 class="card-title">Industry Reports </h4>
                                <p class="card-text">Access to analysis and industry reports and monitoring growth.</p>
                                <!-- <a href="#" class="btn btn-outline-read-more">Read More</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="images/dealers/farmers.jpg" alt="" class="card-img-top">
                            <div class="card-body">
                                <h4 class="card-title">Real Time Data </h4>
                                <p class="card-text">industry stakeholderes will always have access to real time data.</p>
                                <!-- <a href="#" class="btn btn-outline-read-more">Read More</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="images/dealers/farmers.jpg" alt="" class="card-img-top">
                            <div class="card-body">
                                <h4 class="card-title">Real Time Data </h4>
                                <p class="card-text">industry stakeholderes will always have access to real time data.</p>
                                <!-- <a href="#" class="btn btn-outline-read-more">Read More</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="images/dealers/farmers.jpg" alt="" class="card-img-top">
                            <div class="card-body">
                                <h4 class="card-title">Real Time Data </h4>
                                <p class="card-text">industry stakeholderes will always have access to real time data.</p>
                                <!-- <a href="#" class="btn btn-outline-read-more">Read More</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="container-fluid" style="background-color:#f4f4f4;padding-top:2%;padding-bottom:2%;">
                <h1 class="heading-1 text-center">Whom are we working with! </h1>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-content table-responsive">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="card-content table-responsive">
                                            <img src="images/dealers/hatchery.jpg">
                                            <h3>Hatchery </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-content table-responsive">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="card-content table-responsive">
                                            <img src="images/dealers/breeders.jpg">
                                            <h3>Breeders </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-content table-responsive">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="card-content table-responsive">
                                            <img src="images/dealers/processors.jpg">
                                            <h3>Processors </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-content table-responsive">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="card-content table-responsive">
                                            <img src="images/dealers/farmers.jpg">
                                            <h3>Farmers </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-content table-responsive">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="card-content table-responsive">
                                            <img src="images/dealers/traders.jpg">
                                            <h3>Traders </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-content table-responsive">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="card-content table-responsive">
                                            <img src="images/dealers/feeders.jpg">
                                            <h3>Feed Manufacturers </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- Card Section -->
            <div class="container-fluid padding">
                <h1 class="heading-1">Make Strategic Business Decisions with Improve productivity leveraging our Platform Tools.</h1>
                <div class="row padding">
                    <div class="col-md-4 padding">
                        <div class="card">
                            <img src="images/ft/cube.png" alt="" class="card-img-top">
                            <div class="card-body">
                                <h4 class="card-title">Reporting System </h4>
                                <p class="card-text">Our reporting systems are based on real time data that's being given or supplied by customers</p>
                                <!-- <a href="#" class="btn btn-outline-read-more">Read More</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 padding">
                        <div class="card">
                            <img src="images/ft/data.png" alt="" class="card-img-top">
                            <div class="card-body">
                                <h4 class="card-title">Data Visualizer </h4>
                                <p class="card-text">Our platform offers feautures and tools that illustrate trends while visualising data</p>
                                <!-- <a href="#" class="btn btn-outline-read-more">Read More</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 padding">
                        <div class="card">
                            <img src="images/ft/pie.png" alt="" class="card-img-top">
                            <div class="card-body">
                                <h4 class="card-title">Our Analysis System </h4>
                                <p class="card-text">Ensures users have the right information and data that enables businesses to make the right decisions</p>
                                <!-- <a href="#" class="btn btn-outline-read-more">Read More</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Partners Section -->
            <div class="container-fluid" style="background-color:#74f5e3;padding-bottom:5%;">
                <h2 class="heading-1">Our Partners</h2>
                <!-- <hr> -->
                <section class="customer-logos slider">
                    <div class="slide"><img src="images/partners/tcpa.png" style="max-height:90px;"></div>
                    <div class="slide"><img src="images/partners/tfma.png" style="max-height:90px;"></div>
                    <div class="slide"><img src="images/partners/tpda.png" style="max-height:90px;"></div>
                </section>
                <!-- <hr> -->
            </div>
            <!-- Contact Section -->
            <div class="section-padding" id="contact">
                <div class="contact-form">
                    <div class="container-fluid">
                        <div class="row contact-form-area wow fadeInUp" data-wow-delay="0.4s">
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="contact-block">
                                    <h2>Contact Form</h2>
                                    <form id="contactForm">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required data-error="Please enter your name">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" placeholder="Email" id="email" class="form-control" name="email" required data-error="Please enter your email">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" placeholder="Subject" id="msg_subject" class="form-control" required data-error="Please enter your subject">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea class="form-control" id="message" placeholder="Your Message" rows="5" data-error="Write your message" required></textarea>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                                <div class="submit-button">
                                                    <button class="btn btn-common" id="submit" type="submit">Send Message</button>
                                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="footer-right-area wow fadeIn">
                                    <h2>Contact Address</h2>
                                    <div class="footer-right-contact">
                                        <div class="single-contact">
                                            <div class="contact-icon">
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                            <p>Kinondoni, Dar es Salaam.</p>
                                        </div>
                                        <div class="single-contact">
                                            <div class="contact-icon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                            <p><a href="mailto:no-reply@livestoka.com">info@livestoka.com</a></p>
                                            <!-- <p><a href="mailto:dennis@gmail.com">dennis@gmail.com</a></p> -->
                                        </div>
                                        <div class="single-contact">
                                            <div class="contact-icon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <p><a href="#">+255-687-859-500</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 m-t-20">
                                <div id="contact-map"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Footer Section -->
        <footer class="footer-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="footer-text text-center wow fadeInDown" data-wow-delay="0.3s">
                            <ul class="social-icon">
                                <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a class="instagram" href="#"><i class="fab fa-instagram"></i></a></li>
                                <li><a class="linkedin" href="#"><i class="fab fa-linkedin"></i></a></li>
                                <li><a class="youtube" href="#"><i class="fab fa-youtube"></i></a></li>
                                <li><a class="google" href="#"><i class="fab fa-google-plus"></i></a></li>
                                <li><a class="dribbble" href="#"><i class="fab fa-dribbble"></i></a></li>
                            </ul>
                            <p>Copyright © 2018 Livestoka Business System, All Right Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Go to Top Link -->
        <a href="#" class="back-to-top"><i class="fas fa-arrow-alt-circle-up"></i></a>
        <!-- Optional JavaScript -->
        <!-- jQuery JS -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <!-- Plugin JavaScript -->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Custom scripts for this template -->
        <script src="js/scripts.js"></script>
        <!-- Slick JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
        <!-- Tether -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/js/tether.min.js"></script>
        <!-- Google APIS -->
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZib4Lvp0g1L8eskVBFJ0SEbnENB6cJ-g&callback=initMap"></script>
    </body>
</html>
