<?php
ob_start();
session_start();

   include("../../includes/layouts/manufacturers_header_layout.php");
    require_once '../../includes/DbOperation.php';
    require_once '../../includes/validations_functions.php';
    //getting the dboperation class
?>
<?php confirm_logged_in(); ?>
<?php $layout_context = "feed_manufacturer"; ?>
<?php
   $next_day_update = date("d-m-Y", strtotime(" +1 months"));
$errors = array();
$message = " ";
$ppmessage = " ";
$pmessage = " ";
$rmmessage = " ";

?>
<?php
  if ($_SESSION['loggedIn'] != true) {
      // code...
      //SET UR ID AND THE USEREMAIL
      $message = "<div class=\"alert alert-danger\" role=\"alert\">
			<strong>Log in Again</strong> <a href=\"#\" class=\"alert-link\">Seems like we failed to authenticate you</a> Try login again.
		</div>";
      redirect_to("/mydroids/livestokaapi/web/login_area.php");
  } else {
      // code...
      //user session details
      $logged_user_id = $_SESSION['user_log_id'];
      $logged_user_email = $_SESSION['user_log_email'];
      $logged_user_usertype = $_SESSION['user_log_usertype'];
      //
      if ($logged_user_usertype != "feed manufacturer") {
          // user is not of feed manufacturer type...
          //usertype is different
          redirect_to("/mydroids/livestokaapi/web/login_area.php");
      } else {
          //TODO: update last_login status in database

          //get the corresponding feed manufacturer.
          $db = new DbOperation();
          // json response array
          $user_id = $logged_user_id;
          $response = array("error" => false);
          if (isset($user_id)) {
              // receiving the post params
              $manufacturer = $db->getFeedManufacturerDetails($user_id);
              if ($manufacturer != false) {
                  // use is found
                  $response["error"] = false;
                  $response["mfuid"] = $manufacturer["feed_manufactures_unique_id"];
                  $response["manufacturer"]["feed_manufactures_id"] = $manufacturer["feed_manufactures_id"];
                  $response["manufacturer"]["user_id"] = $manufacturer["user_id"];
                  $response["manufacturer"]["companyname"] = $manufacturer["companyname"];
                  $response["manufacturer"]["year_established"] = $manufacturer["year_established"];
                  $response["manufacturer"]["cert_of_incorporation_num"] = $manufacturer["cert_of_incorporation_num"];
                  $response["manufacturer"]["feedbussiness_permit_num"] = $manufacturer["feedbussiness_permit_num"];
                  $response["manufacturer"]["premise_cert_num"] = $manufacturer["premise_cert_num"];
                  $response["manufacturer"]["gmp_cert_num"] = $manufacturer["gmp_cert_num"];
                  $response["manufacturer"]["association_affiliation"] = $manufacturer["association_affiliation"];
                  $response["manufacturer"]["country"] = $manufacturer["country"];
                  $response["manufacturer"]["region"] = $manufacturer["region"];
                  $response["manufacturer"]["district"] = $manufacturer["district"];
                  $response["manufacturer"]["address"] = $manufacturer["address"];
                  $response["manufacturer"]["pobox"] = $manufacturer["pobox"];
                  $response["manufacturer"]["phonenumber"] = $manufacturer["phonenumber"];
                  $response["manufacturer"]["websiteurl"] = $manufacturer["websiteurl"];
                  $response["manufacturer"]["contact_person"] = $manufacturer["contact_person"];
                  $response["manufacturer"]["production_capacity"] = $manufacturer["production_capacity"];
                  $response["manufacturer"]["storage_capacity"] = $manufacturer["storage_capacity"];
                  $response["manufacturer"]["num_products_produced"] = $manufacturer["num_products_produced"];
                  $response["manufacturer"]["man_power"] = $manufacturer["man_power"];
                  $response["manufacturer"]["plant_manager"] = $manufacturer["plant_manager"];
                  $response["manufacturer"]["created_at"] = $manufacturer["created_at"];
                  $response["manufacturer"]["updated_at"] = $manufacturer["updated_at"];

                  //echo json_encode($response);

                  $feed_manufacture_name = $manufacturer["companyname"];
                  $feed_manufacturer_id =  $manufacturer["feed_manufactures_id"];
              } else {
                  // user is not found with the credentials
                  $response["error"] = true;
                  $response["error_msg"] = "Can not find user. Please try again later!";
                  //echo json_encode($response);
              }
          } else {
              // required post params is missing
              $response["error"] = true;
              $response["error_msg"] = "Required user ID is missing!";
              //echo json_encode($response);
          }
      }
  }
?>

<div class="container-fluid">

              <div class="row">
                            <div class="col-lg-12">
                              <div class="card">
                                  <div class="card-header" data-background-color="orange">
                                      <h4 class="title">Manage Raw Materials</h4>
                                      <p class="category">All the raw materials used and registered by the feed manufacturer will be listed here</p>
                                  </div>
                                  <div class="card-content table-responsive">
                                      <!-- <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                                      <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p> -->

                                       <br />
                                       <div class="row">
                                         <div class="col-md-6">
                                           <div class="panel panel-default">
                                             <div class="panel-heading card-header">
                                               <h3 class="panel-title title">PreviouS Month Entered Data</h3>
                                             </div>
                                             <div class="panel-body">

                                               <div class="row">
                                                  <div class="col-md-8">
                                                    <!-- <h2>total raw materials</h2> -->
                                                    <div class="alert alert-info" role="alert">
                                                     <strong>Ops!</strong> <a href="#" class="alert-link">currently Data does not exist </a> soon their will be data.
                                                   </div>

                                                  </div>

                                               </div>
                                           </div>
                                         </div>
                                         </div>
                                              <div class="col-md-6">
                                                <div class="panel panel-default">
                                                  <div class="panel-heading card-header">
                                                    <h3 class="panel-title title">Manage Raw Material Info</h3>
                                                  </div>
                                                  <div class="panel-body">
                                                    <div class="form-group  col-md-6">
                                                      <div class="form-group col-md-6">
                                                        <button type="button" onclick="location.href='update_overall_data.php';" class="btn btn-lg btn-warning" name="button"> Update Raw Materials</button>
                                                     </div>
                                                     </div>

                                                     <div class="form-group  col-md-6">
                                                       <div class="form-group col-md-6">
                                                         <button type="button" onclick="location.href='update_overall_data.php';" class="btn btn-lg btn-warning" name="button">Delete Raw Materials</button>
                                                      </div>

                                                  </div>
                                                </div>
                                              </div>
                                       </div>

                                     </div>
                                       <br />
                                       <br />
                                           <div class="row">
                                             <div class="col-md-12">
                                               <div class="panel panel-default">
                                                 <div class="panel-heading card-header">
                                                   <h3 class="panel-title title">All Raw Materials Produced</h3>
                                                 </div>
                                                 <div class="panel-body">
                                            <?php

                                                echo "  <table class=\"table table-hover\">
                                                      <thead class=\"text-warning\">
                                                          <tr>
                                                              <th>#</th>
                                                              <th>Raw Material</th>
                                                              <th>Description</th>
                                                              <th>Raw Material Purpose</th>
                                                              <th>Raw Material Status</th>
                                                              <th>Date created</th>

                                                          </tr>
                                                      </thead>
                                                      <tbody>";

                                             ?>
                                             <?php

                                             // $creator_id  = $_POST['user_id'];
                                               $db = new DbOperation();
                                               if ($feed_manufacturer_id) {
                                                   $manufacturer_id = $feed_manufacturer_id;
                                                   // feed manufacturer adds new product
                                                   // $manufacturer_id = $_POST['manufacturer_id'];
                                                   $response['error'] = false;
                                                   $response['message'] = 'Request successfully completed';
                                                   $response['rawmaterial'] = $db->manufacturerGetAllRawMaterials($manufacturer_id);
                                                   // echo json_encode($response['rawmaterials']);

                                                   $rawmaterial = json_encode($response['rawmaterial']);
                                                   $rcObj = json_decode($rawmaterial);
                                                   if (empty($rcObj)) {
                                                       // Object is empty
                                                       $pmessage = "<div class=\"alert alert-danger\" role=\"alert\">
                                                     <strong>Ops!</strong> <a href=\"add_raw_material.php\" class=\"alert-link\">Seems like you haven't added raw materials</a> add them now.
                                                   </div>";
                                                   } else {
                                                       foreach ($rcObj as $key => $value) {
                                                           echo "
                                                         <tr>
                                                           <th scope=\"row\">" . $value->raw_material_id . "</th>
                                                           <td>" . $value->raw_material_title. "</td>
                                                           <td>" . $value->raw_material_desc. "</td>
                                                           <td>" . $value->purpose_statement. "</td>
                                                           <td> in Use</td>
                                                           <td>" . $value->date_created. "</td>

                                                         </tr>

                                                         ";
                                                           // /" . $value->created_at. "
                                                       //$selectedpyp = $value->feed_product_id;
                                                       // echo $selectedpp;
                                                       }
                                                   }
                                               } else {
                                                   // user failed to store
                                                   $response["error"] = true;
                                                   $response["error_msg"] = "Your raw material does not exist!";
                                                   // echo json_encode($response);

                                                   $ppmessage = "<div class=\"alert alert-danger\" role=\"alert\">
                                                  <strong>Ops!</strong> <a href=\"update_monthly_summary.php\" class=\"alert-link\">Seems like you added your raw material consumtion data </a> Add the data now.
                                                </div>";
                                               }

                                                   echo "</tbody>
                                                   </table>";
                                                  ?>
                                                 <br />
                                                 <?php echo $pmessage; ?>

                                                 </div>
                                               </div>
                                             </div>
                                             <div class="col-md-12">
                                               <br />
                                               <br />
                                               <div class="panel panel-default">
                                                 <div class="panel-heading card-header">
                                                   <h3 class="panel-title title">Raw Material Consumption</h3>
                                                 </div>
                                                 <div class="panel-body">
                                                   <?php

                                                       echo "  <table class=\"table table-hover\">
                                                             <thead class=\"text-warning\">
                                                                 <tr>
                                                                     <th>#</th>
                                                                     <th>Raw Material Title</th>
                                                                     <th>Raw Material Consumed</th>
                                                                     <th>Measurements</th>
                                                                     <th>Stock instorage</th>
                                                                     <th>Measurements</th>
                                                                     <th>Date Registered</th>
                                                                 </tr>
                                                             </thead>
                                                             <tbody>";

                                                    ?>
                                                    <?php

                                                    // $creator_id  = $_POST['user_id'];
                                                      $db = new DbOperation();
                                                      if ($feed_manufacturer_id) {
                                                          $feed_manufacturer_id = $feed_manufacturer_id;
                                                          // feed manufacturer adds new product
                                                          // $manufacturer_id = $_POST['manufacturer_id'];
                                                          $response['error'] = false;
                                                          $response['message'] = 'Request successfully completed';
                                                          $response['consumption'] = $db->getRawMaterialByManufacturer($feed_manufacturer_id);
                                                          // echo json_encode($response['rawmaterials']);

                                                          $rawmaterialconsumtion = json_encode($response['consumption']);
                                                          $rcObj = json_decode($rawmaterialconsumtion);
                                                          if (empty($rcObj)) {
                                                              // Object is empty

                                                              $ppmessage = "<div class=\"alert alert-danger\" role=\"alert\">
                                                           <strong>Ops!</strong> <a href=\"update_monthly_summary.php\" class=\"alert-link\">Seems like you haven't added your product production data</a> Create one now.
                                                         </div>";
                                                          } else {
                                                              // Object is NOT empty (would return false in this example)
                                                              foreach ($rcObj as $key => $value) {
                                                                  echo "
                                                                   <tr>
                                                                     <th scope=\"row\">" . $value->consumption_id . "</th>
                                                                     <td>" . $value->raw_material_title. "</td>
                                                                     <td>" . $value->total_raw_materials_consumed. "</td>
                                                                     <td>" . $value->measurements. "</td>
                                                                     <td>" . $value->current_instorage. "</td>
                                                                     <td>" . $value->instorage_measurement. "</td>
                                                                     <td>" . $value->next_day_update. "</td>
                                                                     <td>" . $value->date_created. "</td>
                                                                   </tr>

                                                                   ";
                                                                  // /" . $value->created_at. "
                                                                 //$selectedpyp = $value->feed_product_id;
                                                                 // echo $selectedpp;
                                                              }
                                                          }
                                                      } else {
                                                          // user failed to store
                                                          $response["error"] = true;
                                                          $response["error_msg"] = "Your raw material does not exist!";
                                                          // echo json_encode($response);

                                                          $ppmessage = "<div class=\"alert alert-danger\" role=\"alert\">
                                                         <strong>Ops!</strong> <a href=\"update_monthly_summary.php\" class=\"alert-link\">Seems like you haven't added your raw material consumption data</a> add it now.
                                                       </div>";
                                                      }

                                                          echo "</tbody>
                                                          </table>";
                                                         ?>
                                                         <br />
                                                         <?php echo $ppmessage; ?>
                                                 </div>

                                               </div>
                                               <br />
                                               <br />
                                             </div>

                                           <!-- <div class="col-md-12">
                                                  <div class="panel panel-default">
                                                    <div class="panel-heading card-header">
                                                      <h3 class="panel-title title">All Products Produced by Feed Manufacturer</h3>
                                                    </div>
                                                    <div class="panel-body">
                                                      <table class="table table-inverse">
                                                        <thead>
                                                          <tr>
                                                            <th>#</th>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Username</th>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Username</th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                          <tr>
                                                            <th scope="row">1</th>
                                                            <td>Mark</td>
                                                            <td>Otto</td>
                                                            <td>@mdo</td>
                                                            <td>First Name</td>
                                                            <td>Last Name</td>
                                                            <td>Username</td>
                                                          </tr>
                                                          <tr>
                                                            <th scope="row">2</th>
                                                            <td>Mark</td>
                                                            <td>Otto</td>
                                                            <td>@mdo</td>
                                                            <td>First Name</td>
                                                            <td>Last Name</td>
                                                            <td>Username</td>
                                                          </tr>
                                                          <tr>
                                                            <th scope="row">3</th>
                                                            <td>Mark</td>
                                                            <td>Otto</td>
                                                            <td>@mdo</td>
                                                            <td>First Name</td>
                                                            <td>Last Name</td>
                                                            <td>Username</td>
                                                          </tr>
                                                        </tbody>
                                                      </table>

                                                      <div class="form-group  col-md-6">
                                                        <div class="form-group col-md-6">
                                                          <button type="button" onclick="location.href='update_overall_data.php';" class="btn btn-lg btn-warning" name="button">View full raw materials</button>
                                                        </div>

                                                      </div>
                                                    </div>
                                                  </div>
                                                </div> -->
                                             </div>
                                         </div>
                                         <br />

                                     </div>
                                </div>
                               </div>


                         </div>
                     </div>
                   </body>
                   </html>
