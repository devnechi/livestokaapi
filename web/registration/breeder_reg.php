<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://v4-alpha.getbootstrap.com/favicon.ico">

    <title>Livestoka | Hatchery Owners Registration </title>

    <!-- Bootstrap core CSS -->
    <link href="http://v4-alpha.getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://v4-alpha.getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>

    <!-- Custom styles for this template -->
    <link href="http://v4-alpha.getbootstrap.com/examples/carousel/carousel.css" rel="stylesheet">

    <style>
    .card {
         border: transparent;
    }

    <style>
    .card {
         border: transparent;
    }

    /* The customcheck */
.customcheck {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default checkbox */
.customcheck input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border-radius: 5px;
}

/* On mouse-over, add a grey background color */
.customcheck:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.customcheck input:checked ~ .checkmark {
    background-color: #02cf32;
    border-radius: 5px;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.customcheck input:checked ~ .checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.customcheck .checkmark:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}


@import('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.0/css/bootstrap.min.css')

.funkyradio div {
  clear: both;
  overflow: hidden;
}

.funkyradio label {
  width: 100%;
  border-radius: 3px;
  border: 1px solid #D1D3D4;
  font-weight: normal;
}

.funkyradio input[type="radio"]:empty,
.funkyradio input[type="checkbox"]:empty {
  display: none;
}

.funkyradio input[type="radio"]:empty ~ label,
.funkyradio input[type="checkbox"]:empty ~ label {
  position: relative;
  line-height: 2.5em;
  text-indent: 3.25em;
  margin-top: 2em;
  cursor: pointer;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
}

.funkyradio input[type="radio"]:empty ~ label:before,
.funkyradio input[type="checkbox"]:empty ~ label:before {
  position: absolute;
  display: block;
  top: 0;
  bottom: 0;
  left: 0;
  content: '';
  width: 2.5em;
  background: #D1D3D4;
  border-radius: 3px 0 0 3px;
}

.funkyradio input[type="radio"]:hover:not(:checked) ~ label,
.funkyradio input[type="checkbox"]:hover:not(:checked) ~ label {
  color: #888;
}

.funkyradio input[type="radio"]:hover:not(:checked) ~ label:before,
.funkyradio input[type="checkbox"]:hover:not(:checked) ~ label:before {
  content: '\2714';
  text-indent: .9em;
  color: #C2C2C2;
}

.funkyradio input[type="radio"]:checked ~ label,
.funkyradio input[type="checkbox"]:checked ~ label {
  color: #777;
}

.funkyradio input[type="radio"]:checked ~ label:before,
.funkyradio input[type="checkbox"]:checked ~ label:before {
  content: '\2714';
  text-indent: .9em;
  color: #333;
  background-color: #ccc;
}

.funkyradio input[type="radio"]:focus ~ label:before,
.funkyradio input[type="checkbox"]:focus ~ label:before {
  box-shadow: 0 0 0 3px #999;
}

.funkyradio-default input[type="radio"]:checked ~ label:before,
.funkyradio-default input[type="checkbox"]:checked ~ label:before {
  color: #333;
  background-color: #ccc;
}

.funkyradio-primary input[type="radio"]:checked ~ label:before,
.funkyradio-primary input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #337ab7;
}

.funkyradio-success input[type="radio"]:checked ~ label:before,
.funkyradio-success input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #5cb85c;
}

.funkyradio-danger input[type="radio"]:checked ~ label:before,
.funkyradio-danger input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #d9534f;
}

.funkyradio-warning input[type="radio"]:checked ~ label:before,
.funkyradio-warning input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #f0ad4e;
}

.funkyradio-info input[type="radio"]:checked ~ label:before,
.funkyradio-info input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #5bc0de;
}
    </style>


    <nav class="navbar navbar-default navbar-static-top">
      <a href="../../web/index.php" class="navbar-brand">Back To Livestoka</a>
    </nav>


    <div class="container">
   
      <div class="row">
      <div class="col-md-12">
        <h1>Breed Owners Registration Area</h1>
        <p class="lead">Owner's and operators of Feed Manufactures can Register Below.<br> Please fill all the required Fields.</p>
      
      <!--register-section -->
      <section id="Breeder_Reg">
        <!-- <form action="feed_manufacture_registry.php" method="post"> -->

   
        <form action="breeder_reg.php" method="post">
    <!-- company information -->
            
              
                <div class="form-group">
                  <label for="formGroupExampleInput"><strong>Breed Description</strong></label>
                   <hr>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                    <label for="first_name">First Name</label>
                      <input type="text" class="form-control" id="first_name" name="first_name" value="<?= isset($_POST['first_name']) ? $_POST['first_name'] : ''; ?>" placeholder="First Name" onkeyup='check();'>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                     <label for="last_name">Last Name</label>
                       <input type="text" class="form-control" id="last_name" name="last_name" value="<?= isset($_POST['last_name']) ? $_POST['last_name'] : ''; ?>" placeholder="Last Name" onkeyup='check();'>
                      <!-- <span id='message'></span> -->
                     </div>
                  </div>
                </div>
                      <div class="form-group">
                        <label for="lblcompany_name">Organization/Breeders Name</label>
                        <input type="text" class="form-control" id="companyname" name="breed_name" value="<?= isset($_POST['breed_name']) ? $_POST['breed_name'] : ''; ?>" placeholder="">
                      </div>
                      <div class="form-group">
                        <label for="lblyear_established">Year started</label>
                        <input type="text" class="form-control" id="year_established" onblur="yearValidation(this.value,event)" onkeypress="yearValidation(this.value,event" name="year_established"  value="<?= isset($_POST['year_established']) ? $_POST['year_established'] : ''; ?>" placeholder="">
                      </div>
                      <div class="form-group ">
                        <label for="breed_assoc_aff">Breed Association Affiliation. <small>e.g TAFMA, TCPA or TPBA</small></label>
                        <input type="text" class="form-control" id="association_affiliation" name="association_affiliation" value="<?= isset($_POST['association_affiliation']) ? $_POST['association_affiliation'] : ''; ?>" placeholder="">
                      </div>

            
            
            <!-- end of company information -->
              <!-- <hr> -->
            <br />
            <!-- company information -->
          
                     

                        <div class="form-group">
                          <label for="address"><strong>Breeders Address and Location</strong></label>
                        <hr>
                        </div>
                        <div class="form-group">
                          <label for="countryList">Country</label>
                           <select class="form-control" id="country" name="country" value="<?= isset($_POST['country']) ? $_POST['country'] : ''; ?>">
                             <option>SELECT</option>
                             <option>Tanzania</option>
                             <option>Uganda</option>
                             <option>Kenya</option>
                             <option>Rwanda</option>
                           </select>

                        </div>
                        <div class="form-group">
                          <label for="countryList">Region</label>
                           <select class="form-control" id="country" name="country" value="<?= isset($_POST['country']) ? $_POST['country'] : ''; ?>">
                             <option>SELECT</option>
                             <option>Dar es salaam</option>
                             <option>Pwani</option>
                             <option>Dodoma</option>
                             <option>Mwanza</option>
                           </select>

                        </div>
                        <div class="form-group">
                          <label for="countryList">District</label>
                           <select class="form-control" id="country" name="country" value="<?= isset($_POST['country']) ? $_POST['country'] : ''; ?>">
                             <option>SELECT</option>
                             <option>Ilala</option>
                             <option>Kinondoni</option>
                             <option>Kigamboni</option>
                             <option>Temeke</option>
                           </select>

                        </div>
                        
                        <div class="form-group">
                          <label for="formGroupExampleInput2">District</label>
                          <input type="text" class="form-control" id="district" name="district" value="<?= isset($_POST['district']) ? $_POST['district'] : ''; ?>" placeholder="">
                        </div>
                        <div class="form-group">
                          <label for="exampleTextarea">Address</label>
                          <textarea class="form-control" id="address" name="address" rows="3" value="<?= isset($_POST['address']) ? $_POST['address'] : ''; ?>"></textarea>
                        </div>
                        <!-- <div class="form-group">
                          <label for="exampleTextarea">Address 2</label>
                          <textarea class="form-control" id="txt_address_two" name="" rows="3"></textarea>
                        </div> -->
                        <div class="form-group">
                                <label for="formGroupExampleInput2">P.O.Box</label>
                                <input type="text" class="form-control" id="pobox" name="poboxnum" placeholder="" value="<?= isset($_POST['poboxnum']) ? $_POST['poboxnum'] : ''; ?>">
                              </div>
                        <div class="form-group">
                                <label for="formGroupExampleInput2">Office Phone Number:</label>
                                <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="<?= isset($_POST['phonenumber']) ? $_POST['phonenumber'] : ''; ?>" placeholder=" ">
                              </div>
                        <!-- <div class="form-group">
                                <label for="formGroupExampleInput2">Office Phone Number 2</label>
                                <input type="text" class="form-control" id="txt_office_num_two" name="" placeholder=" ">
                              </div> -->
                         
                      
                      
                           
                            <br />
                            <!-- company information -->
                

                    <div class="form-group">
                      <label for="formGroupExampleInput"><strong>Establishment Declaration</strong></label>
                      <hr>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-6">
                          <p>*select your Establishment declaration.</p>
                          <div class="form-check">
                              <label class="customcheck">Breeder
                                <input type="checkbox" checked="checked" name="declaration[]" id="declaration" value="breed">
                                <span class="checkmark"></span>
                              </label>
                              <label class="customcheck"> breeding Started
                                <input type="checkbox" name="declaration[]" id="declaration" value="breeding">
                                <span class="checkmark"></span>
                              </label>
                              <label class="customcheck">Pedigree breeding Establishment
                                <input type="checkbox" name="declaration[]" id="declaration" value="pedigree">
                                <span class="checkmark"></span>
                              </label>
                          </div>
                          </div>
                        </div> -->
                        <div class="col-md-6">
                             <h4>select your Establishment declaration.</h4>
                             <p>facility type</p>

                            <div class="funkyradio">
                                <div class="funkyradio-success">
                                    <input type="radio" name="radio" id="radio1" checked/>
                                    <label for="radio1">Breed Establishment</label>
                                </div>
                                <div class="funkyradio-success">
                                    <input type="radio" name="radio" id="radio2" />
                                    <label for="radio2"> breeding Establishment</label>
                                </div>
                                <div class="funkyradio-success">
                                    <input type="radio" name="radio" id="radio3" />
                                    <label for="radio3">Pedigree breeding Establishment</label>
                                </div>
                            </div>
                        </div>
                      </div>
                    
                    <div class="form-group">
                      <label for="formGroupExampleInput"><strong>Establishment Information</strong></label>
                      <hr>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-6">
                          <p>*select your Establishment concerned.</p>
                          <div class="form-check">
                              <label class="customcheck">Fowls
                                <input type="checkbox" checked="checked" name="concerned[]" id="concerned" value="fowls">
                                <span class="checkmark"></span>
                              </label>
                              <label class="customcheck"> Turkey
                                <input type="checkbox" name="concerned[]" id="concerned" value="turkey">
                                <span class="checkmark"></span>
                              </label>
                              <label class="customcheck">Ducks
                                <input type="checkbox" name="concerned[]" id="concerned" value="ducks">
                                <span class="checkmark"></span>
                              </label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-check" style="padding-top: 26px;">
                          <label class="customcheck">Geese
                            <input type="checkbox" name="concerned[]" id="concerned" value="geese">
                            <span class="checkmark"></span>
                          </label>
                          <label class="customcheck">Guinea fowls
                            <input type="checkbox" name="concerned[]" id="concerned" value="guinea_fowls">
                            <span class="checkmark"></span>
                          </label>
                          </div>
                          <div class="form-group">
                            <label for="formGroupExampleInput2">Total Breeding Capacity</label>
                            <input type="text" class="form-control" id="total_breeding_capacity" name="total_incubation_capacity" value="<?= isset($_POST['total_incubation_capacity']) ? $_POST['total_incubation_capacity'] : ''; ?>" placeholder=" ">
                          </div>
                        </div>
                        </div>
                      </div>
                    
                  <!-- <div class="form-group">
                    <label for="formGroupExampleInput2">Total  Capacity</label>
                    <input type="text" class="form-control" id="total_incubation_capacity" name="total_incubation_capacity" value="<?= isset($_POST['total_incubation_capacity']) ? $_POST['total_incubation_capacity'] : ''; ?>" placeholder=" ">
                  </div> -->

                  <div class="form-group">
                    <label for="formGroupExampleInput"><strong>Establishment Activities</strong></label>
                    <hr>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      
                        <p>Select your Establishment category and type of Establishment.</p>
                        <div class="form-check">

                            <label class="customcheck">Utility Chicks
                              <input type="checkbox" checked="checked">
                              <span class="checkmark"></span>
                              <p><small>i.) Production of breeds
                                    stock or commercial chicks.</small>
                              </br>
                            <small>  ii.) production chicks:
                                     (chicks intended to be raised for the production of eggs for consumption.
                                  </small></br>
                            <small>iii.) Dual purpose chicks:
                        (chicks intended either for laying or for the table).
                                </small></p>
                                <p style="padding-bottom: 20px;"><strong>Note: utility to be checked only when it is clear chicks may be raised for either use</strong></p>
                            </label>

                            <label class="customcheck">grandparent stock chicks
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <p>Chicks intended for the production of commercial chicks.</p>
                            </br>
                        </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-check" style="padding-top: 26px;">
                          <label class="customcheck"> parent stock chicks
                            <input type="checkbox">
                            <span class="checkmark"></span>
                          </label>
                          <p>Chicks intended for the production of commercial chicks.</p>
                        </div>
                      </div>
                      
                    

                     <div class="form-group">
                       <label for="formGroupExampleInput2">Contact email</label>
                       <input type="email" class="form-control" id="email" name="email"  placeholder=" ">
                     </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                        <label for="exampleInputPassword1" class="control-label">Password</label>
                          <input type="password" class="form-control" id="password" name="password" >
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                         <label for="exampleInputConfirmPassword2" class="control-label">Confirm Password</label>
                           <input type="password" class="form-control" id="confirm_password" name="confirm_password" >
                           <span id='message'></span>
                         </div>
                      </div>
                    </div>
                      <div class="form-group">
                      <button type="submit"  name="submit" class="btn btn-primary btn-lg" value="Submit">Register</button>
                          </div>
                       </form>
                
                
                <hr>
               
      </section>
</div>
      <!--end of registeration section -->

    </div> 
    </div><!-- /.container-->
    <!--scripts -->
    <?php
   include("../../includes/layouts/public_ly_footer.php");
    
    ?>
   
    <script>
    function yearValidation(year,ev) {

  var text = /^[0-9]+$/;
  if(ev.type=="blur" || year.length==4 && ev.keyCode!=8 && ev.keyCode!=46) {
    if (year != 0) {
        if ((year != "") && (!text.test(year))) {

            alert("Please Enter Numeric Values Only");
            document.getElementById("year_established").focus();
            document.getElementById('year_established').value = '';
            return false;
        }

        if (year.length != 4) {
            alert("Year is not proper. Please check");
            document.getElementById("year_established").focus();
            document.getElementById('year_established').value = '';
            return false;

        }
        var current_year=new Date().getFullYear();
        if((year < 1920) || (year > current_year))
            {
            alert("Year should be in range 1920 to current year");
            document.getElementById("year_established").focus();
            document.getElementById('year_established').value = '';
            return false;

            }
        return true;
    } }
  }


  var check = function() {
       if (document.getElementById('password').value ==
           document.getElementById('confirm_password').value) {
           document.getElementById('message').style.color = 'green';
           document.getElementById('message').innerHTML = 'matching';
       } else {
       		document.getElementById('message').style.color = 'red';
           document.getElementById('message').innerHTML = 'not matching';
       }
   }
</script>
   