<?php
ob_start();
session_start();

include("../../includes/layouts/main_fm_header_layout.php");
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
<?php

     //function validating all the paramters are available
     //we will pass the required parameters to this function
     function isTheseParametersAvailable($params)
     {
         //assuming all parameters are available
         $available = true;
         $missingparams = "";

         foreach ($params as $param) {
             if (!isset($_POST[$param]) || strlen($_POST[$param])<=0) {
                 $available = false;
                 $missingparams = $missingparams . ", " . $param;
             }
         }

         //if parameters are missing
         if (!$available) {
             $response = array();
             $response['error'] = true;
             $response['message'] = 'Parameters ' . substr($missingparams, 1, strlen($missingparams)) . ' missing';

             //displaying error
             echo json_encode($response);

             //stopping further execution
             die();
         }
     }


         $db = new DbOperation();
          //an array to display response
          $response = array();
          $errors = array();
          $message = " ";

if ('POST' == $_SERVER['REQUEST_METHOD'] && isset($_POST['ppsubmission'])) {
    // product production data.


    $pcreator_id = $logged_user_id;
    $feeds_manufacturer_id = $feed_manufacturer_id;
    // receiving the post params
    $feeds_product_id =  $_POST['selectedProduct'];
    $quantity_produced  = $_POST['monthly_qty_production'];
    $quantity_measurements  = $_POST['quantity_measurements'];
    $current_quantity_instorage  = $_POST['current_quantinty_instorage'];
    $instorage_measurements  = $_POST['instorage_measurements'];
    // $product_manu_capacity  = $_POST['product_manu_capacity'];
    $next_day_update  = $_POST['next_day_updatep'];

    // $next_day_update = date("d/m/Y", strtotime(" +1 months"));

    //validations
    $fields_required= array("monthly_qty_production", "current_quantinty_instorage");
    foreach ($fields_required as $field) {
        $value = trim($_POST[$field]);
        if (!has_presence($value)) {
            $message = "<div class=\"alert alert-danger\" role=\"alert\">
           <strong>Oh snap!</strong> <a href=\"#\" class=\"alert-link\">Change a few things up</a> and try submitting again.
         </div>";

            $errors[$field] = ucfirst($field) . " can't be blank";
        }
    }


    //  //check if the values are numeric
    // $fields_required= array("gmp_cert_num", "feedbussiness_permit_num", "cert_of_incorporation_num", "", "premise_cert_num", "man_power", "num_products_produced", "storage_capacity", "production_capacity", "phonenumber");
    // foreach($fields_required as $field){
    //   $value = trim($_POST[$field]);
    //   if(!is_numeric($value)){
    //
    //     $message = "<div class=\"alert alert-info\" role=\"alert\">
    //       <strong>Oh snap!</strong> <a href=\"#\" class=\"alert-link\">make sure values are numeric </a> and try submitting again.
    //     </div>";
    //
    //      $errors[$field] = ucfirst($field) . " should be numeric";
    //
    //   }
    // }
    //

    if (empty($errors)) {
        // feed manufacturer adds new production data
        $product_production = $db->manufactureProductProduction($feeds_product_id, $pcreator_id, $quantity_produced, $quantity_measurements, $current_quantity_instorage, $instorage_measurements, $next_day_update);
        if ($product_production) {
            // user stored successfully
            $response["error"] = false;
            $response["npuid"] = $product_production["feed_production_unique_id"];
            $response["product_production"]["products_production_id"] = $product_production["products_production_id"];
            $response["product_production"]["feeds_product_id"] = $product_production["feeds_product_id"];
            $response["product_production"]["creator_id"] = $product_production["creator_id"];
            $response["product_production"]["quantity_produced"] = $product_production["quantity_produced"];
            $response["product_production"]["quantity_measurements"] = $product_production["quantity_measurements"];
            $response["product_production"]["current_quantity_instorage"] = $product_production["current_quantity_instorage"];
            $response["product_production"]["instorage_measurements"] = $product_production["instorage_measurements"];
            $response["product_production"]["product_manu_capacity"] = $product_production["product_manu_capacity"];
            $response["product_production"]["next_day_update"] = $product_production["next_day_update"];
            $response["product_production"]["date_created"] = $product_production["date_created"];
            $response["product_production"]["date_updated"] = $product_production["date_updated"];

            $ppmessage = "<div class=\"alert alert-success\" role=\"alert\">
              <strong>Well done!</strong> You successfully! <a href=\"#\" class=\"alert-link\">added production data</a>.
            </div>";


        } else {
            // user failed to store
            $response["error"] = true;
            $response["error_msg"] = "Unknown error occurred while inserting production data!";
            //echo json_encode($response);


        }
    } else {
        // $username = "";
        $ppmessage = "<div class=\"alert alert-info\" role=\"alert\">
 <strong>Take note!</strong> <a href=\"#\" class=\"alert-link\">When registering</a> please fill all the relevant details.
</div>";
    }
} elseif ('POST' == $_SERVER['REQUEST_METHOD'] && isset($_POST['rmsubmission'])) {
    // code...params forms raw material consumption
    // receiving the post params
    $creator_id = $logged_user_id;
    $feed_manufacturer_id = $feed_manufacturer_id;

     $raw_material_id = $_POST['selectedRawmaterial'];
     $use_of_material = $_POST['use_rawmaterials'];
     $total_raw_materials_consumed = $_POST['total_raw_materials_consumed'];
     $measurements = $_POST['quantity_measurements'];
     $current_instorage = $_POST['current_instorage'];
     $instorage_measurement =$_POST['instorage_measurement'];
     $material_source = $_POST['material_source'];
     $next_day_update = $_POST['next_day_update'];

     //validations
     $fields_required= array("total_raw_materials_consumed", "current_instorage");
     foreach ($fields_required as $field) {
         $value = trim($_POST[$field]);
         if (!has_presence($value)) {
             $message = "<div class=\"alert alert-danger\" role=\"alert\">
            <strong>Oh snap!</strong> <a href=\"#\" class=\"alert-link\">Change a few things up</a> and try submitting again.
          </div>";

             $errors[$field] = ucfirst($field) . " can't be blank";
         }
     }


     //  //check if the values are numeric
     // $fields_required= array("gmp_cert_num", "feedbussiness_permit_num", "cert_of_incorporation_num", "", "premise_cert_num", "man_power", "num_products_produced", "storage_capacity", "production_capacity", "phonenumber");
     // foreach($fields_required as $field){
     //   $value = trim($_POST[$field]);
     //   if(!is_numeric($value)){
     //
     //     $message = "<div class=\"alert alert-info\" role=\"alert\">
     //       <strong>Oh snap!</strong> <a href=\"#\" class=\"alert-link\">make sure values are numeric </a> and try submitting again.
     //     </div>";
     //
     //      $errors[$field] = ucfirst($field) . " should be numeric";
     //
     //   }
     // }
     //

     if (empty($errors)) {

        // feed manufacturer adds new product
        $rawmaterialconsumption = $db->manuRawMaterialConsumption($feed_manufacturer_id, $raw_material_id, $creator_id,  $use_of_material, $total_raw_materials_consumed, $measurements, $current_instorage, $instorage_measurement, $material_source, $next_day_update);
        if ($rawmaterialconsumption) {
            // user stored successfully
            $response["error"] = false;
            $response["rmcuid"] = $rawmaterialconsumption["consumption_unique_id"];
            $response["rawmaterialconsumption"]["consumption_id"] = $rawmaterialconsumption["consumption_id"];
            $response["rawmaterialconsumption"]["feed_manufacturer_id"] = $rawmaterialconsumption["feed_manufacturer_id"];
            $response["rawmaterialconsumption"]["raw_material_id"] = $rawmaterialconsumption["raw_material_id"];
            $response["rawmaterialconsumption"]["creator_id"] = $rawmaterialconsumption["creator_id"];
            $response["rawmaterialconsumption"]["use_of_material"] = $rawmaterialconsumption["use_of_material"];
            $response["rawmaterialconsumption"]["total_raw_materials_consumed"] = $rawmaterialconsumption["total_raw_materials_consumed"];
            $response["rawmaterialconsumption"]["measurements"] = $rawmaterialconsumption["measurements"];
            $response["rawmaterialconsumption"]["current_instorage"] = $rawmaterialconsumption["current_instorage"];
            $response["rawmaterialconsumption"]["instorage_measurement"] = $rawmaterialconsumption["instorage_measurement"];
            $response["rawmaterialconsumption"]["next_day_update"] = $rawmaterialconsumption["next_day_update"];
            $response["rawmaterialconsumption"]["date_created"] = $rawmaterialconsumption["date_created"];
            $response["rawmaterialconsumption"]["date_updated"] = $rawmaterialconsumption["date_updated"];

            // when successfull raw material consumption inserted
              $rmmessage = "<div class=\"alert alert-success\" role=\"alert\">
              <strong>Well done!</strong> You successfully! <a href=\"#\" class=\"alert-link\">added raw material use data</a>.
            </div>";

        } else {
          $rmmessage = "<div class=\"alert alert-warning\" role=\"alert\">
          <strong>Error!</strong> we cant seem to! <a href=\"#\" class=\"alert-link\">make sense of your data</a>.
        </div>";
        }

} else{

  $rmmessage = "<div class=\"alert alert-info\" role=\"alert\">
<strong>Success!</strong> <a href=\"#\" class=\"alert-link\">When registering</a> please fill all the relevant details.
</div>";
}
}
 ?>


<div class="container-fluid">
  <?php echo $message; ?>
  <?php echo form_errors($errors); ?>
  <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                      <div class="card-header" data-background-color="orange">
                          <h4 class="title">Update Manufacturing Monthly Summary</h4>
                          <p class="category">This data was last updated on,2018-06-24</p>
                      </div>
                      <div class="card-content table-responsive">
                          <p>There is three sets of data, overall data, individual product production data and individual raw material consumption data </p>
                          <p>This data will be computerised with data from other members in the industry <code>#results-aggregated-data</code>.</p>

                          <br />
                          <div class="row">
                            <div class="col-md-6">
                               <div class="container">
                                     <div class="form-group">
                                       <button type="button" onclick="location.href='update_overall_data.php';" class="btn btn-lg btn-warning" name="button">Enter Monthly Manufacturing Data</button>
                                    </div>
                                    <div class="form-group">
                                      <button type="button" onclick="document.getElementById('individualInfo').scrollIntoView();" class="btn btn-lg btn-warning" name="button">Enter Individual Product Data</button>
                                   </div>
                                   <div class="form-group">
                                     <button type="button" onclick="document.getElementById('individualInfo').scrollIntoView();" class="btn btn-lg btn-warning" name="button">Enter Individual Raw Material Data</button>
                                   </div>
                               </div>
                             </div>
                           </div>
                            <div class="col-md-6">
              								<div class="card">
              									<div class="card-header" data-background-color="orange">
              											<h4 class="title">Current User Details</h4>
              											<p class="category">As of Last Month February, 2018</p>
              									</div>
              									<div class="card-content table-responsive">
              											<!-- <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
              											<p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p> -->


                                      <h2> Welcome back, <small><?php echo $logged_user_email  ; ?></small></h2>
                                      <h2> With userr_id, <small><?php echo $logged_user_id  ; ?></small></h2>

                                      <h2> Feed Manufacturer Name, <small><?php echo $feed_manufacture_name; ?></small></h2>
                                      <h2> Feed Manufacturer ID, <small><?php echo $feed_manufacturer_id; ?></small></h2>
                                      <!-- <h2> Feed product ID, <small></small></h2> -->



              										</div>
              									</div>
              									</div>
                                <div class="col-md-6">
                  								<div class="card">
                  									<div class="card-header" data-background-color="orange">
                  											<h4 class="title">Current User Details</h4>
                  											<p class="category">As of Last Month February, 2018</p>
                  									</div>
                  									<div class="card-content table-responsive">
                  											<!-- <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                  											<p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p> -->


                                          <!-- <h2> Total Industry Production, <small><?php
                                          //echo $logged_user_email  ; ?></small></h2>
                                          <h2> Total Industry Raw Material Consumption, <small><?php
                                          // echo $logged_user_id  ; ?></small></h2>
 -->

                                          <?php

                                          // $creator_id  = $_POST['user_id'];
                                            $db = new DbOperation();
                                            if ($feed_manufacturer_id) {
                                                $feeds_manufacturer_id = $feed_manufacturer_id;
                                                // feed manufacturer adds new product
                                                // $manufacturer_id = $_POST['manufacturer_id'];
                                                $response['error'] = false;
                                                $response['message'] = 'Request successfully completed';
                                                $response['indsum'] = $db->getManufactureringIndustrySummations($feeds_manufacturer_id);
                                                // echo json_encode($response['rawmaterials']);

                                                $industrydata = json_encode($response['indsum']);
                                                $indstryObj = json_decode($industrydata);
                                                foreach ($indstryObj as $key => $value) {
                                                    //
                                                    // echo "<ul class=\"list-group\">
                                                    //       <li class=\"list-group-item\">Total Production" . $value->total_products_produced ."</li>
                                                    //       <li class=\"list-group-item\">" . $value->current_stock_instorage ."</li>
                                                    //       <li class=\"list-group-item\">" . $value->raw_materials_consumed ."</li>
                                                    //       <li class=\"list-group-item\">" . $value->current_raw_materials_instorage ."</li>
                                                    //       <li class=\"list-group-item\">" . $value->total_man_power ."</li>
                                                    //     </ul>";


                                                     echo "<h4> Total Industry Production: <span  class=\"badge badge-secondary\" style=\"font-size: 34px;\">".$value->total_products_produced ."</span><strong> TONS</strong></h4>
                                                         <h4> Total Quantity instorage: <span class=\"badge badge-secondary\" style=\"font-size: 34px;\"> ".$value->current_stock_instorage ."</span><strong> TONS</strong></h4>
                                                         <h4> Total Raw Materials Consumed:<span class=\"badge badge-secondary\" style=\"font-size: 34px;\"> ".$value->raw_materials_consumed ."</span><strong> TONS</strong></h4>
                                                         <h4> Total Raw Materials in storage:<span class=\"badge badge-secondary\" style=\"font-size: 34px;\"> ".$value->current_raw_materials_instorage ."</span><strong> TONS</strong></h4>
                                                         <h4> Total Raw Materials used:<span class=\"badge badge-secondary\" style=\"font-size: 34px;\"> ".$value->raw_materials_consumed ."</span> <strong> TONS</strong></h4>";

                                                    //$selectedpyp = $value->feed_product_id;
                                                    // echo $selectedpp;
                                                }
                                            } else {
                                                // user failed to store
                                                $response["error"] = true;
                                                $response["error_msg"] = "Your Data does not exist!";
                                                // echo json_encode($response);

                                                $ppmessage = "<div class=\"alert alert-danger\" role=\"alert\">
                                               <strong>Ops!</strong> <a href=\"update_overall_data.php\" class=\"alert-link\">Seems like you dont have data yet?</a> Update now.
                                             </div>";
                                            }


                                           ?>

                  										</div>
                  									</div>
                  									</div>
                                    <br />
                             <div class="col-md-12">
                               <div class="panel panel-default">
                                    <div class="panel-heading card-header">
                                       <h3 class="panel-title title">Your last Overrall Industry Updates</h3>
                                       <p class="category">as of last update made on, 2018-06-24</p>
                                    </div>
                                     <div class="panel-body">
                                        <?php

                                            echo "<table class=\"table\">
                                                    <thead class=\"text-warning\">
                                                      <tr>
                                                        <th scope=\"col\">#</th>
                                                        <th scope=\"col\">total man power</th>
                                                        <th scope=\"col\">products produced</th>
                                                        <th scope=\"col\">measurements</th>
                                                        <th scope=\"col\">stock instorage</th>
                                                        <th scope=\"col\">measurements</th>
                                                        <th scope=\"col\">raw materials used </th>
                                                        <th scope=\"col\">measurements</th>
                                                        <th scope=\"col\">date created</th>
                                                        <th scope=\"col\">next update</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>";


                                         ?>
                                         <?php

                                         // $creator_id  = $_POST['user_id'];
                                           $db = new DbOperation();
                                           if ($feed_manufacturer_id) {
                                               $feeds_manufacturer_id = $feed_manufacturer_id;
                                               // feed manufacturer adds new product
                                               // $manufacturer_id = $_POST['manufacturer_id'];
                                               $response['error'] = false;
                                               $response['message'] = 'Request successfully completed';
                                               $response['industryop'] = $db->manuGetIndustryProduction($feeds_manufacturer_id);
                                               // echo json_encode($response['rawmaterials']);

                                               $industrydata = json_encode($response['industryop']);
                                               $indstryObj = json_decode($industrydata);
                                               foreach ($indstryObj as $key => $value) {

                                                   echo "
                                                     <tr>
                                                       <th scope=\"row\">" . $value->manufacturing_operation_id . "</th>
                                                       <td>" . $value->total_man_power . "</td>
                                                       <td>" . $value->total_products_produced . "</td>
                                                       <td>" . $value->measurements . "</td>
                                                       <td>" . $value->current_stock_instorage . "</td>
                                                       <td>" . $value->storage_qty_measurements . "</td>
                                                       <td>" . $value->raw_materials_consumed . "</td>
                                                       <td>" . $value->raw_materials_measurements . "</td>
                                                       <td>" . $value->date_created . "</td>
                                                       <td>" . $value->next_day_update . "</td>

                                                     </tr>";
                                                   //$selectedpyp = $value->feed_product_id;
                                                   // echo $selectedpp;
                                               }
                                           } else {
                                               // user failed to store
                                               $response["error"] = true;
                                               $response["error_msg"] = "Your raw material does not exist!";
                                               // echo json_encode($response);

                                               $ppmessage = "<div class=\"alert alert-danger\" role=\"alert\">
                                              <strong>Ops!</strong> <a href=\"add_new_product.php\" class=\"alert-link\">Seems like you haven't created a product</a> Create one now.
                                            </div>";
                                           }

                                               echo "</tbody>
                                              </table>";
                                              ?>
                                </div>
                                </div>
                                </div>


                           <div class="row">
                               <div class="col-md-6">
                                 <br/>
                                 <div class="panel panel-default">
                                   <div class="panel-heading card-header">
                                     <h3 class="panel-title title">Last Product Production Updates</h3>
                                     <p class="category">as of last update made on, 2018-06-24</p>
                                    </div>
                                   <div class="panel-body">
                                      <?php

                                          echo "<table class=\"table\">
                                                  <thead class=\"text-warning\">
                                                    <tr>
                                                      <th scope=\"col\">#</th>
                                                      <th scope=\"col\">Product Name</th>
                                                      <th scope=\"col\">Product Type</th>
                                                      <th scope=\"col\">Quantity Produced</th>
                                                      <th scope=\"col\">Date Created</th>
                                                      <th scope=\"col\">Next day Update</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>";

                                       ?>
                                       <?php

                                       // $creator_id  = $_POST['user_id'];
                                         $db = new DbOperation();
                                         if ($feed_manufacturer_id) {
                                            //  $manufacturer_id = $feed_manufacturer_id;
                                             $manufacturer_id = 3;
                                             // feed manufacturer adds new product
                                             // $manufacturer_id = $_POST['manufacturer_id'];
                                             $response['error'] = false;
                                             $response['message'] = 'Request successfully completed';
                                             $response['product_production'] = $db->getProductionByManufacturer($manufacturer_id);
                                             // echo json_encode($response['rawmaterials']);

                                             $productions = json_encode($response['product_production']);
                                             $fpObj = json_decode($productions);
                                             foreach ($fpObj as $key => $value) {

                                                 echo "
                                                   <tr>
                                                     <th scope=\"row\">" . $value->products_production_id . "</th>
                                                     <td>" . $value->product_name . "</td>
                                                     <td>" . $value->product_type . "</td>
                                                     <td>" . $value->quantity_produced . "</td>
                                                     <td>" . $value->date_created . "</td>
                                                     <td>" . $value->next_day_update . "</td>
                                                   </tr>";
                                                 //$selectedpyp = $value->feed_product_id;
                                                 // echo $selectedpp;
                                             }
                                         } else {
                                             // user failed to store
                                             $response["error"] = true;
                                             $response["error_msg"] = "Your raw material does not exist!";
                                             // echo json_encode($response);

                                             $ppmessage = "<div class=\"alert alert-danger\" role=\"alert\">
                                            <strong>Ops!</strong> <a href=\"add_new_product.php\" class=\"alert-link\">Seems like you haven't created a product</a> Create one now.
                                          </div>";
                                         }

                                             echo "</tbody>
                                            </table>";
                                            ?>
                                       </div>
                                   </div>
                                </div>
                               <div class="col-md-6">
                                  <br/>
                                 <div class="panel panel-default">
                                   <div class="panel-heading card-header">
                                     <h3 class="panel-title title">Last Updates on Raw Material Consumption</h3>
                                     <p class="category">as of last update made on, 2018-06-24</p>
                                   </div>
                                   <div class="panel-body">

                                     <?php

                                         echo "<table class=\"table\">
                                                 <thead class=\"text-warning\">
                                                   <tr>
                                                     <th scope=\"col\">#</th>
                                                     <th scope=\"col\">Raw Material Title</th>
                                                     <th scope=\"col\">Total Consumption</th>

                                                     <th scope=\"col\">Date Added</th>
                                                     <th scope=\"col\">Next Update</th>
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

                                            $consumption = json_encode($response['consumption']);
                                            $rcObj = json_decode($consumption);
                                            foreach ($rcObj as $key => $value) {

                                                echo "
                                                  <tr>
                                                    <th scope=\"row\">" . $value->consumption_id . "</th>
                                                    <td>" . $value->raw_material_title. "</td>
                                                    <td>" . $value->total_raw_materials_consumed. "</td>

                                                    <td>" . $value->next_day_update. "</td>
                                                    <td>" . $value->date_created. "</td>
                                                  </tr>";
                                                //$selectedpyp = $value->feed_product_id;
                                                // echo $selectedpp;
                                            }
                                        } else {
                                            // user failed to store
                                            $response["error"] = true;
                                            $response["error_msg"] = "Your raw material does not exist!";
                                            // echo json_encode($response);

                                            $ppmessage = "<div class=\"alert alert-danger\" role=\"alert\">
                                           <strong>Ops!</strong> <a href=\"add_new_product.php\" class=\"alert-link\">Seems like you haven't created a product</a> Create one now.
                                         </div>";
                                        }

                                            echo "</tbody>
                                           </table>";
                                           ?>
                                   </div>
                                 </div>
                               </div>
                           </div>
                         </div>
                      </div>
                   </div>


             <div class="col-lg-12">
               <div class="card">
                   <div class="card-header" data-background-color="orange">
                       <h4 class="title">Update Individual Products Data and Individual Raw Materials Consumption.</h4>
                       <p class="category">By collecting this data it improves the accuracy of data that is used in forecasting feed manufacturers market trends.</p>
                   </div>
                   <div class="card-content table-responsive">
                       <!-- <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                       <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p> -->
                        <br />
                        <div class="container-fluid">
                          <div class="row">
                             <div class="col-md-6">
                             <!-- * form post method -->
                               <form method="post">
                                 <div class="panel panel-default">
                                   <div class="panel-heading card-header">
                                     <h3 class="panel-title title">Individual Product Monthly Production Data</h3>
                                     <p class="category">as of last update made on, 2018-06-24</p>
                                   </div>
                                   <div class="panel-body">
                                     <input type="hidden" name="ppsubmission" value="yes" >
                                 <div class="form-group col-md-12">
                                   <?php echo $ppmessage; ?>

                                   <label for="exampleFormControlSelect1">Select Product</label>

                                      <select class="form-control" id="selectedProduct" name="selectedProduct">
                                          <option>SELECT PRODUCT</option>
                                          <?php
                                          // $creator_id  = $_POST['user_id'];
                                            $db = new DbOperation();
                                            if ($feed_manufacturer_id) {
                                                $manufacturers_id = $feed_manufacturer_id;
                                                // feed manufacturer adds new product
                                                // $manufacturer_id = $_POST['manufacturer_id'];
                                                $response['error'] = false;
                                                $response['message'] = 'Request successfully completed';
                                                $response['feed_products'] = $db->manufacturerGetAllProducts($manufacturers_id);
                                                // echo json_encode($response['rawmaterials']);

                                                $feedproducts = json_encode($response['feed_products']);
                                                $fpObj = json_decode($feedproducts);
                                                foreach ($fpObj as $key => $value) {
                                                    echo "<option value='" . $value->feed_product_id . "'> " . $value->product_name .  "</option>";
                                                    //$selectedpyp = $value->feed_product_id;
                                                    // echo $selectedpp;
                                                }
                                            } else {
                                                // user failed to store
                                                $response["error"] = true;
                                                $response["error_msg"] = "Your raw material does not exist!";
                                                // echo json_encode($response);

                                                $ppmessage = "<div class=\"alert alert-danger\" role=\"alert\">
                                               <strong>Ops!</strong> <a href=\"add_new_product.php\" class=\"alert-link\">Seems like you haven't created a product</a> Create one now.
                                             </div>";
                                            }
                                          ?>
                                          </select>
                                 </div>

                                 <div class="form-group col-md-12">

                                   <label for="exampleFormControlTextarea1">Production Assesment</label>
                                   <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
                                 </div>

                                 <div class="form-group col-md-12">
                                   <label for="formGroupExampleInput">Quantity Produced</label>
                                   <input type="text" class="form-control" name="monthly_qty_production" id="monthly_qty_production" placeholder="">
                                 </div>
                                 <div class="form-group col-md-12">
                                   <label for="formGroupExampleInput">Quantity Produced measurements</label>

                                     <select class="form-control"  id="quantity_measurements" name="quantity_measurements" value="<?= isset($_POST['quantity_measurements']) ? $_POST['quantity_measurements'] : ''; ?>">
                                       <option>SELECT</option>
                                       <option>KG</option>
                                       <option>TONS</option>

                                     </select>
                                   </div>

                                 <div class="form-group col-md-12">
                                   <label for="exampleFormControlTextarea1">Quantity instorage</label>
                                   <input type="text" class="form-control" id="current_quantinty_instorage" name="current_quantinty_instorage" placeholder="">
                                 </div>
                                 <div class="form-group col-md-12">
                                   <label for="formGroupExampleInput">Quantity instorage measurements</label>
                                     <select class="form-control"  id="instorage_measurements" name="instorage_measurements" value="<?= isset($_POST['instorage_measurements']) ? $_POST['instorage_measurements'] : ''; ?>">
                                       <option>SELECT</option>
                                       <option>KG</option>
                                       <option>TONS</option>
                                     </select>
                                   </div>
                                 <div class="form-group col-md-12">
                                   <label for="exampleFormControlTextarea1">Date time</label>
                                   <input type="text" class="form-control" readonly id="next_day_updatep" name="next_day_updatep" value="<?php echo $next_day_update; ?>"  placeholder="">
                                   <small id="emailHelp" class="form-text text-muted">You will receive notifications to update info on this date.</small>
                                 </div>
                                 <div class="form-group">
                                   <button type="submit" class="btn btn-lg btn-success" name="submit" value="Submit">Update Product Data</button>
                                </div>
                               </div>
                               </div>
                               </form>
                             </div>



                             <div class="col-md-6">
                               <form method="post">
                              <section id="individualInfo">
                                 <div class="panel panel-default">
                                   <div class="panel-heading card-header">
                                     <h3 class="panel-title title">Individual Raw Material Monthly Consumption Data</h3>
                                     <p class="category">as of last update made on, 2018-06-24</p>
                                   </div>

                                   <div class="panel-body">
                                      <input type="hidden" name="rmsubmission" value="yes" >
                                   <div class="form-group col-md-12">
                                     <?php echo $rmmessage; ?>

                                   <label for="exampleFormControlSelect1">Select Raw Material</label>
                                   <select class="form-control" id="selectedRawmaterial" name="selectedRawmaterial">
                                     <option>SELECT Raw Material</option>
                                     <?php

                                       $db = new DbOperation();
                                       if ($feed_manufacturer_id) {
                                           $manufacturer_id = $feed_manufacturer_id;

                                           $response['error'] = false;
                                           $response['message'] = 'Request successfully completed';
                                           $response['rawmaterials'] = $db->manufacturerGetAllRawMaterials($manufacturer_id);
                                           // echo json_encode($response['rawmaterials']);
                                           $rawmats = json_encode($response['rawmaterials']);
                                           $someObj = json_decode($rawmats);
                                           foreach ($someObj as $key => $value) {
                                               //  echo $value->raw_material_id . ", " . $value->raw_material_title . "<br>";
                                               echo "<option value='" . $value->raw_material_id . "'> " . $value->raw_material_title .  "</option>";
                                           }
                                       } else {
                                           // user failed to store
                                           $response["error"] = true;
                                           $response["error_msg"] = "Your raw material does not exist!";
                                           // echo json_encode($response);
                                           $message = "<div class=\"alert alert-danger\" role=\"alert\">
                                          <strong>Ops!</strong> <a href=\"add_raw_material.php\" class=\"alert-link\">Seems like you haven't added Raw Materials</a> Add One Now.
                                        </div>";
                                       }
                                     ?>

                                   </select>
                                 </div>

                                 <div class="form-group col-md-12">

                                   <label for="exampleFormControlTextarea1">Use of Raw Materials</label>
                                   <textarea class="form-control" id="use_rawmaterials" name ="use_rawmaterials" rows="5"></textarea>
                                 </div>

                                 <div class="form-group col-md-12">
                                   <label for="formGroupExampleInput">Total Quantity Used/consumed</label>
                                   <input type="text" class="form-control" id="total_raw_materials_consumed" name="total_raw_materials_consumed" value="<?= isset($_POST['total_raw_materials_consumed']) ? $_POST['total_raw_materials_consumed'] : ''; ?>" placeholder="">
                                 </div>

                                 <div class="form-group col-md-12">
                                   <label for="formGroupExampleInput">Quantity Measurements</label>

                                     <select class="form-control"  id="quantity_measurements" name="quantity_measurements" value="<?= isset($_POST['quantity_measurements']) ? $_POST['quantity_measurements'] : ''; ?>">
                                       <option>SELECT</option>
                                       <option>KG</option>
                                       <option>TONS</option>

                                     </select>
                                   </div>
                                 <div class="form-group col-md-12">
                                   <label for="exampleFormControlTextarea1">Quantity in Storage</label>
                                   <input type="text" class="form-control" id="current_instorage" name="current_instorage" value="<?= isset($_POST['current_instorage']) ? $_POST['current_instorage'] : ''; ?>" placeholder="">
                                 </div>

                                 <div class="form-group col-md-12">
                                   <label for="formGroupExampleInput">Quantity instorage measurements</label>

                                     <select class="form-control"  id="instorage_measurement" name="instorage_measurement" value="<?= isset($_POST['instorage_measurement']) ? $_POST['instorage_measurement'] : ''; ?>">
                                       <option>SELECT</option>
                                       <option>KG</option>
                                       <option>TONS</option>

                                     </select>
                                   </div>

                                 <div class="form-group col-md-12">
                                   <label for="formGroupExampleInput">Raw Material Source</label>
                                     <select class="form-control"  id="material_source" name="material_source" value="<?= isset($_POST['material_source']) ? $_POST['material_source'] : ''; ?>">
                                       <option>SELECT</option>
                                       <option>Locally</option>
                                       <option>Imported</option>
                                       <option>Both</option>
                                     </select>
                                   </div>
                                 <div class="form-group col-md-12">
                                   <label for="exampleFormControlTextarea1">Next Scheduled Update</label>
                                   <input type="text" class="form-control" readonly id="next_day_update" name="next_day_update" value="<?php echo $next_day_update; ?>"  placeholder="">
                                   <small id="emailHelp" class="form-text text-muted">You will receive notifications to update info on this date.</small>

                                 </div>
                                 <div class="form-group col-md-12">
                                   <button type="submit" class="btn btn-lg btn-success" name="submit" value="Submit">Update Raw Material Data</button>
                                </div>
                               </div>
                               </div>
                               </form>
                             </div>
                          </div>
                         </div>
                      </div>
                   </div>
                </div>
              </section>
             </div>
         </div>
         <?php
         include("../../includes/layouts/main_fm_footer_layout.php");

         ?>
