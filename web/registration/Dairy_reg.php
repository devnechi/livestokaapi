
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

    <title>Livestoka | Breed Owners Registration </title>

    <!-- Bootstrap core CSS -->
    <link href="http://v4-alpha.getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://v4-alpha.getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>

    <!-- Custom styles for this template -->
    <link href="http://v4-alpha.getbootstrap.com/examples/carousel/carousel.css" rel="stylesheet">

    
  </head>
  <body>

    <nav class="navbar navbar-default navbar-static-top">
      <a href="/../../web/index.php" class="navbar-brand">Back To Livestoka</a>
    </nav>
    <div class="row">
   <div class="col-md-12">

    <div class="container">
      <div class="starter-template">
        <h1>Dairy Farmers Registration Area</h1>
        <p class="lead"> Please fill all the required Fields.</p>
      </div>
      <!--register section -->
      <section id="manufacturersReg">
        <!-- <form action="feed_manufacture_registry.php" method="post"> -->

   <?php //echo $message; ?>
       <?php
        //echo form_errors($errors);
         ?>
        <form action="hatcher_reg.php" method="post">
    <!-- company information -->
            <div class="card">
              <div class="card-body">
                <div class="form-group">
                  <label for="formGroupExampleInput"><strong>Farmers particulars</strong></label>
                   <hr>
                </div>
               
                </div>
                      
              </div>
            
            <!-- end of company information -->
              <!-- <hr> -->
    
            <!-- company information -->
            
                    
                      
                      
                    <div class="form-group">
                    <label for="first_name">First Name</label>
                      <input type="text" class="form-control" id="first_name" name="first_name" value="<?= isset($_POST['first_name']) ? $_POST['first_name'] : ''; ?>" placeholder="First Name" onkeyup='check();'>
                    </div>
                  
                  
                    <div class="form-group">
                     <label for="last_name">Last Name</label>
                       <input type="text" class="form-control" id="last_name" name="last_name" value="<?= isset($_POST['last_name']) ? $_POST['last_name'] : ''; ?>" placeholder="Last Name" onkeyup='check();'>
                      <!-- <span id='message'></span> -->
                     </div>
                        <div class="form-group">
                          <label for="address"><strong>Breeders Address and Location</strong></label>
                        <hr>
                        </div>
                        <div class="form-group">
                          <label class="control-label" for="countryList">Country</label>
                           <select class="form-control" id="country" name="country" >
                             <option>SELECT</option>
                             <option>Tanzania</option>
                             <option>Uganda</option>
                             <option>Kenya</option>
                             <option>Rwanda</option>
                           </select>

                        </div>
                        <div class="form-group">
                          <label for="countryList">Region</label>
                           <select class="form-control" id="country" name="country" >
                             <option>SELECT</option>
                             <option>Dar es Salaam</option>
                             <option>Mwanza</option>
                             <option>Arusha</option>
                             <option>Mara</option>
                             <option>Mbeya</option>
                             <option>Pwani</option>
                           </select>

                        </div>
                        <div class="form-group">
                          <label for="countryList">District</label>
                           <select class="form-control" id="country" name="country" >
                             <option>SELECT</option>
                             <option>Ilala</option>
                             <option>Kinondoni</option>
                             <option>Temeke</option>
                             <option>Kigamboni</option>
                           </select>

                        </div>
                        <div class="form-group">
                          <label for="exampleTextarea">Address</label>
                          <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                        </div>
                      
                        <div class="form-group">
                                <label for="formGroupExampleInput2">P.O.Box</label>
                                <input type="text" class="form-control" id="pobox" name="poboxnum" placeholder="" >
                              </div>
                        <div class="form-group">
                                <label for="formGroupExampleInput2">Office Phone Number:</label>
                                <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder=" ">
                              </div>
                       
             
                     <div class="form-group">
                       <label for="formGroupExampleInput2">Contact email</label>
                       <input type="email" class="form-control" id="email" name="email"  placeholder=" ">
                     </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                          <input type="password" class="form-control" id="password" name="password"  placeholder="Password" onkeyup='check();'>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                         <label for="exampleInputConfirmPassword2">Confirm Password</label>
                           <input type="password" class="form-control" id="confirm_password" name="confirm_password"  placeholder="Password" onkeyup='check();'>
                           <span id='message'></span>
                         </div>
                      </div>
                    </div>
                      <div class="form-group">
                      <button type="submit"  name="submit" class="btn btn-primary btn-lg" value="Submit">Register</button>
                          </div>
                       </form>
                  </div>
                </div>
                <hr>
               </div>
      </section>

      <!--end of registeration section -->

    </div> <!-- /.container-->

    <!--scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
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
    <!-- jQuery first, then Bootstrap JS. -->
  
  </body>
</html>
