<?php

    //getting the dboperation class
    require_once '../includes/DbOperation.php';

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

    //an array to display response
    $response = array();

    //if it is an api call
    //that means a get parameter named api call is set in the URL
    //and with this parameter we are concluding that it is an api call
    if (isset($_GET['apicall'])) {
        switch ($_GET['apicall']) {

        // * once registered user account is updated
       case 'updateuseraccount':
       $db = new DbOperation();
      // json response array
      $response = array("error" => false);

      if (isset($_POST['user_id'])){
        // $db = new DbOperation();
        $user_id = $_POST['user_id'];
        $account_status = "active";

        if ($db->isAccountActive($user_id, $account_status)){
            // user already existed
            // $response["error"] = true;
            // $response["error_msg"] = "User already exists with " . $email;
            $response["error"] = true;
            $response["error_msg"] = "Account is already active ";
            //echo json_encode($response);
       //      $message = "<div class=\"alert alert-info\" role=\"alert\">
       //   <strong>Account!</strong> <a href=\"#\" class=\"alert-link\">Is already active, you can log in now.
       // </div>";
            // echo json_encode($response);
        } else {
        $result = $db->activateUserAccount($user_id, $account_status);
        if($result){
        $response['error'] = false;
        $response['message'] = 'account activated successfully';
        //$response['heroes'] = $db->getHeroes();

        }else{
        $response['error'] = true;
        $response['message'] = 'Some error occurred please try again';
        }
      }
       } else {
             $response["error"] = true;
             $response["error_msg"] = "Required parameters (user_id) is missing!";
             echo json_encode($response);
         }

       break;
            //the CREATE operation
            //if the api call value is 'createhero'
            //we will create a record in the database
            //CREATE A NEW CLIENT
    case 'createnewuser':
         $db = new DbOperation();
        // json response array
        $response = array("error" => false);

        if (isset($_POST['email']) && isset($_POST['password'])){

            // receiving the post params
            $email = $_POST['email'];
            $password = $_POST['password'];
            $usertype = $_POST['usertype'];
            $account_status = $_POST['account_status'];

            // check if user is already existed with the same email
            if ($db->doesUserEmailExist($email)){
                // user already existed
                $response["error"] = true;
                $response["error_msg"] = "User already exists with " . $email;
                echo json_encode($response);
            } else {
                // create a new user
                $user = $db->registerUser($email, $password,  $usertype, $account_status);
                if ($user) {
                    // user stored successfully
                    $response["error"] = false;
                    $response["uid"] = $user["user_unique_id"];
                    $response["user"]["user_id"] = $user["user_id"];
                    $response["user"]["email"] = $user["email"];
                    $response["user"]["usertype"] = $user["usertype"];
                    $response["user"]["encrypted_password"] = $user["encrypted_password"];
                    $response["user"]["usertype"] = $user["usertype"];
                    $response["user"]["account_status"] = $user["account_status"];
                    $response["user"]["salt"] = $user["salt"];
                    $response["user"]["created_at"] = $user["created_at"];
                    $response["user"]["updated_at"] = $user["updated_at"];

                } else {
                    // user failed to store
                    $response["error"] = true;
                    $response["error_msg"] = "Unknown error occurred in registration!";
                    echo json_encode($response);
                }
            }
        } else {
            $response["error"] = true;
            $response["error_msg"] = "Required parameters (email or password) is missing!";
            echo json_encode($response);
        }
          break;

          /// login user
          case 'loginuser':
          $db = new DbOperation();
          // json response array
          $response = array("error" => false);
          if (isset($_POST['email']) && isset($_POST['password'])) {
              // receiving the post params
              $email = $_POST['email'];
              $password = $_POST['password'];
              // get the user by email and password
              $user = $db->attempt_login($email, $password);
              if ($user != false) {
                  // use is found

                  $response["error"] = false;
                  $response["uid"] = $user["user_unique_id"];
                  $response["user"]["user_id"] = $user["user_id"];
                  $response["user"]["usertype"] = $user["usertype"];
                  $response["user"]["encrypted_password"] = $user["encrypted_password"];
                  $response["user"]["email"] = $user["email"];
                  $response["user"]["account_status"] = $user["account_status"];
                  $response["user"]["created_at"] = $user["created_at"];
                  $response["user"]["updated_at"] = $user["updated_at"];
                  //echo json_encode($response);

              } else {
                  // user is not found with the credentials
                  $response["error"] = true;
                  $response["error_msg"] = "Login credentials are wrong. Please try again!";
                  //echo json_encode($response);
              }
          } else {
              // required post params is missing

              $response["error"] = true;
              $response["error_msg"] = "Required parameters email or password is missing!";
              //echo json_encode($response);

          }
          break;

         // register new hatchery
          case 'registernewhatchery':
          $db = new DbOperation();
         // json response array
         $response = array("error" => false);

         if (isset($_POST['user_id'])){

             // receiving the post params
             $user_id = $_POST['user_id'];
             $hatchery_name = $_POST['hatchery_name'];
             $type_of_ownership = $_POST['type_of_ownership'];
             $date_established = $_POST['date_established'];
             $hatch_reg_number = $_POST['hatch_reg_number'];
             $owners_full_name = $_POST['owners_full_name'];
             //$hatchery_affiliation[]
             $hatchery_affiliation = $_POST['hatchery_affiliation'];
             $hatchery_manager = $_POST['hatchery_manager'];
             $hatchery_veterinarian = $_POST['hatchery_veterinarian'];
             $vet_reg_number = $_POST['vet_reg_number'];

             // hatching purposes
             // $utility_chicks = $_POST['utility_chicks'];
             // $grandparent_stock_chicks = $_POST['grandparent_stock_chicks'];
             // $parent_stock_chicks = $_POST['parent_stock_chicks'];

             //type of breed
             // $broiler = $_POST['broiler'];
             // $layers =  $_POST['layers'];
             // $dual_purpose = $_POST['dual_purpose'];

               // Breed
              // $typeofbreeds = $_POST['typeofBreed'];

             //type of poultry hacthing
             // $hatching_fowls = $_POST['hatching_chicken'];
             // $hatching_turkey = $_POST['hatching_turkey'];
             // $hatching_ducks = $_POST['hatching_ducks'];
             // $hatching_geese = $_POST['hatching_geese'];
             // $hatching_guinea_fowls = $_POST['hatching_guinea_fowls'];
             // $hatching_quails = $_POST['hatching_quails'];
             // $hatching_ostrich = $_POST['hatching_ostrich'];

             //source of eggs by the hatcher
             // $imported_eggs = $_POST['imported_eggs'];
             // $other_local_farms = $_POST['other_local_farms'];
             // $out_growers = $_POST['out_growers'];
             // $owns_breeder_farm = $_POST['owns_breeder_farm'];

             //hatchery Capacity
             $total_incubator_capacity = $_POST['total_incubator_capacity'];
             $total_hatcher_capacity = $_POST['total_hatcher_capacity'];

              //
              $websiteurl = $_POST['websiteurl'];
              $contact_person = $_POST['contact_person'];
              $country = $_POST['country'];
              $region = $_POST['region'];
              $district = $_POST['district'];
              $address = $_POST['address'];
              $pobox = $_POST['pobox'];
              $phonenumber = $_POST['phonenumber'];




             // check if user is already existed with the same email
             if ($db->doesHatcheryUserExist($user_id)){
                 // user already existed
                 $response["error"] = true;
                 $response["error_msg"] = "hatchery owner already exists with " . $user_id;
               //  echo json_encode($response);
             } else {
                 // create a new user
                 $hatchery = $db->registerNewHatchery($user_id,
                     $owners_full_name,
                     $hatchery_name,
                     $type_of_ownership,
                     $date_established,
                     $hatch_reg_number,
                     $hatchery_affiliation,
                     $hatchery_manager,
                     $hatchery_veterinarian,
                     $vet_reg_number,
                     $total_incubator_capacity,
                     $total_hatcher_capacity,
                     $contact_person,
                     $country,
                     $region,
                     $district,
                     $pobox,
                     $websiteurl,
                     $address,
                     $phonenumber);
                 if ($hatchery) {
                     // user stored successfully
                        $response["error"] = false;
                        $response["htuid"] = $hatchery["hatchery_unique_id"];
                        $response["hatchery"]["hatchery_id"] = $hatchery["hatchery_id"];
                        $response["hatchery"]["user_id"] = $hatchery["user_id"];
                        $response["hatchery"]["hatchery_name"] = $hatchery["hatchery_name"];
                        $response["hatchery"]["date_established"] = $hatchery["date_established"];
                        $response["hatchery"]["type_of_ownership"] = $hatchery["type_of_ownership"];
                        $response["hatchery"]["hatch_reg_number"] = $hatchery["hatch_reg_number"];
                        $response["hatchery"]["hatchery_affiliation"] = $hatchery["hatchery_affiliation"];
                        $response["hatchery"]["hatchery_manager"] = $hatchery["hatchery_manager"];
                        $response["hatchery"]["hatchery_veterinarian"] = $hatchery["hatchery_veterinarian"];
                        $response["hatchery"]["vet_reg_number"] = $hatchery["vet_reg_number"];
                        $response["hatchery"]["country"] = $hatchery["country"];
                        $response["hatchery"]["region"] = $hatchery["region"];
                        $response["hatchery"]["district"] = $hatchery["district"];
                        $response["hatchery"]["pobox"] = $hatchery["pobox"];
                        $response["hatchery"]["address"] = $hatchery["address"];
                        $response["hatchery"]["contact_person"] = $hatchery["contact_person"];
                        $response["hatchery"]["total_incubator_capacity"] = $hatchery["total_incubator_capacity"];
                        $response["hatchery"]["total_hatcher_capacity"] = $hatchery["total_hatcher_capacity"];
                        $response["hatchery"]["websiteurl"] = $hatchery["websiteurl"];
                        $response["hatchery"]["phone_number"] = $hatchery["phone_number"];
                        $response["hatchery"]["created_at"] = $hatchery["created_at"];
                        $response["hatchery"]["updated_at"] = $hatchery["updated_at"];

                 } else {
                     // user failed to store
                     $response["error"] = true;
                     $response["error_msg"] = "Unknown error occurred in registration!";
                    // echo json_encode($response);
                 }
             }
         } else {
             $response["error"] = true;
             $response["error_msg"] = "Required parameters (email or password) is missing!";
             echo json_encode($response);
         }
          break;

          case 'createfeedmanufactures':
               $db = new DbOperation();
              // json response array
              $response = array("error" => false);

              if (isset($_POST['user_id'])){

                  // receiving the post params
                  $user_id = $_POST['user_id'];
                  $companyname = $_POST['companyname'];
                  $year_established = $_POST['year_established'];
                  $premise_cert_num = $_POST['premise_cert_num'];
                  $cert_of_incorporation_num = $_POST['cert_of_incorporation_num'];
                  $feedbussiness_permit_num = $_POST['feedbussiness_permit_num'];
                  $gmp_cert_num = $_POST['gmp_cert_num'];
                  $association_affiliation = $_POST['association_affiliation'];
                  $country = $_POST['country'];
                  $region = $_POST['region'];
                  $district = $_POST['district'];
                  $address = $_POST['address'];
                  $pobox = $_POST['pobox'];
                  $phonenumber = $_POST['phonenumber'];
                  $websiteurl = $_POST['websiteurl'];
                  $contact_person = $_POST['contact_person'];
                  $production_capacity = $_POST['production_capacity'];
                  $storage_capacity = $_POST['storage_capacity'];
                  $num_products_produced = $_POST['num_products_produced'];
                  $man_power = $_POST['man_power'];
                  $plant_manager = $_POST['plant_manager'];

                  // check if user is already existed with the same email
                  if ($db->doesFeedManufactureExist($user_id)){
                      // user already existed
                      $response["error"] = true;
                      $response["error_msg"] = "feed manufacturer already exists with " . $user_id;
                    //  echo json_encode($response);
                  } else {
                      // create a new user
                      $feed_manufacturer = $db->registerFeedManufacturers($user_id, $companyname, $year_established, $cert_of_incorporation_num, $feedbussiness_permit_num, $premise_cert_num, $gmp_cert_num, $association_affiliation, $country, $region, $district, $address, $pobox, $phonenumber, $websiteurl, $contact_person, $production_capacity, $storage_capacity, $num_products_produced, $man_power, $plant_manager);
                      if ($feed_manufacturer) {
                          // user stored successfully
                          $response["error"] = false;
                          $response["mfuid"] = $feed_manufacturer["feed_manufactures_unique_id"];
                          $response["feed_manufacturer"]["feed_manufactures_id"] = $feed_manufacturer["feed_manufactures_id"];
                          $response["feed_manufacturer"]["user_id"] = $feed_manufacturer["user_id"];
                          $response["feed_manufacturer"]["companyname"] = $feed_manufacturer["companyname"];
                          $response["feed_manufacturer"]["cert_of_incorporation_num"] = $feed_manufacturer["cert_of_incorporation_num"];
                          $response["feed_manufacturer"]["feedbussiness_permit_num"] = $feed_manufacturer["feedbussiness_permit_num"];
                          $response["feed_manufacturer"]["premise_cert_num"] = $feed_manufacturer["premise_cert_num"];
                          $response["feed_manufacturer"]["gmp_cert_num"] = $feed_manufacturer["gmp_cert_num"];
                          $response["feed_manufacturer"]["association_affiliation"] = $feed_manufacturer["association_affiliation"];
                          $response["feed_manufacturer"]["country"] = $feed_manufacturer["country"];
                          $response["feed_manufacturer"]["region"] = $feed_manufacturer["region"];
                          $response["feed_manufacturer"]["district"] = $feed_manufacturer["district"];
                          $response["feed_manufacturer"]["address"] = $feed_manufacturer["address"];
                          $response["feed_manufacturer"]["pobox"] = $feed_manufacturer["pobox"];
                          $response["feed_manufacturer"]["phonenumber"] = $feed_manufacturer["phonenumber"];
                          $response["feed_manufacturer"]["websiteurl"] = $feed_manufacturer["websiteurl"];
                          $response["feed_manufacturer"]["contact_person"] = $feed_manufacturer["contact_person"];
                          $response["feed_manufacturer"]["storage_capacity"] = $feed_manufacturer["storage_capacity"];
                          $response["feed_manufacturer"]["num_products_produced"] = $feed_manufacturer["num_products_produced"];
                          $response["feed_manufacturer"]["man_power"] = $feed_manufacturer["man_power"];
                          $response["feed_manufacturer"]["plant_manager"] = $feed_manufacturer["plant_manager"];
                          $response["feed_manufacturer"]["created_at"] = $feed_manufacturer["created_at"];
                          $response["feed_manufacturer"]["updated_at"] = $feed_manufacturer["updated_at"];

                      } else {
                          // user failed to store
                          $response["error"] = true;
                          $response["error_msg"] = "Unknown error occurred in registration!";
                          echo json_encode($response);
                      }
                  }
              } else {
                  $response["error"] = true;
                  $response["error_msg"] = "Required parameters (email or password) is missing!";
                  echo json_encode($response);
              }
                break;

            case 'getfeedmanufacturerdetails':

            $db = new DbOperation();
            // json response array
            $response = array("error" => false);
            if (isset($_POST['user_id'])) {
                // receiving the post params
                $user_id = $_POST['user_id'];

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
            break;


            // * feed manufacturer adds new product
            case 'feeds_addnew_product':
            $db = new DbOperation();
           // json response array
           $response = array("error" => false);
           if (isset($_POST['user_id'])){
               // receiving the post params
               $creator_id = $_POST['user_id'];
               $feed_manu_id = $_POST['manufacturers_id'];
               $product_name = $_POST['product_name'];
               $brand_name = $_POST['brand_name'];
               $product_type = $_POST['product_type'];
               $protein_level = $_POST['protein_level'];
               $product_purpose_statement =$_POST['product_purpose_statement'];
               $product_description = $_POST['product_description'];

                   // feed manufacturer adds new product
                   $feeds_product = $db->manufactureAddNewProduct($creator_id, $feed_manu_id, $product_name, $brand_name, $product_type,  $protein_level, $product_purpose_statement, $product_description);
                   if ($feeds_product) {
                       // user stored successfully
                       $response["error"] = false;
                       $response["npuid"] = $feeds_product["feeds_products_unique_id"];
                       $response["feeds_product"]["feed_product_id"] = $feeds_product["feed_product_id"];
                       $response["feeds_product"]["creator_id"] = $feeds_product["creator_id"];
                       $response["feeds_product"]["manufacturers_id"] = $feeds_product["manufacturers_id"];
                       $response["feeds_product"]["product_name"] = $feeds_product["product_name"];
                       $response["feeds_product"]["brand_name"] = $feeds_product["brand_name"];
                       $response["feeds_product"]["product_type"] = $feeds_product["product_type"];
                       $response["feeds_product"]["protein_level"] = $feeds_product["protein_level"];
                       $response["feeds_product"]["product_purpose_statement"] = $feeds_product["product_purpose_statement"];
                       $response["feeds_product"]["product_description"] = $feeds_product["product_description"];
                       $response["feeds_product"]["created_at"] = $feeds_product["created_at"];
                       $response["feeds_product"]["updated_at"] = $feeds_product["updated_at"];

                   } else {
                       // user failed to store
                       $response["error"] = true;
                       $response["error_msg"] = "Unknown error occurred while creating a new product!";
                       echo json_encode($response);
                   }

           } else {
               $response["error"] = true;
               $response["error_msg"] = "Required parameters (user id or product name) is missing!";
               echo json_encode($response);
           }
            break;

            // * feed manufacturer adds new product production
            case 'getallfeedsproducts':
           $db = new DbOperation();
           if (isset($_POST['manufacturer_id'])){
               // receiving the post params
               $manufacturers_id = $_POST['manufacturer_id'];
                $response['error'] = false;
                $response['message'] = 'Request successfully completed';
                $response['feed_products'] = $db->manufacturerGetAllProducts($manufacturers_id);

             } else {
                  $response["error"] = true;
                  $response["error_msg"] = "Required parameters (manufacturer id or product id) is missing!";
                  //echo json_encode($response);
              }
            break;

            // * feed manufacturer adds new product production
            case 'feeds_product_production':
            $db = new DbOperation();
           // json response array
           $response = array("error" => false);

           if (isset($_POST['user_id'])){

               // receiving the post params
                   $feeds_product_id = $_POST['feeds_product_id'];
                   $creator_id  = $_POST['user_id'];
                   $quantity_produced  = $_POST['monthly_qty_production'];
                   $quantity_measurements  = $_POST['quantity_measurements'];
                   $current_quantity_instorage  = $_POST['current_quantinty_instorage'];
                   $product_manu_capacity  = $_POST['product_manu_capacity'];
                   $next_day_update  = $_POST['next_update_day'];

                   // feed manufacturer adds new production data
                   $product_production = $db->manufactureProductProduction($feeds_product_id, $pcreator_id,  $quantity_produced, $quantity_measurements, $current_quantity_instorage, $product_manu_capacity, $next_day_update);
                   if ($product_production) {
                       // user stored successfully
                       $response["error"] = false;
                       $response["npuid"] = $product_production["feed_production_unique_id"];
                       $response["product_production"]["products_production_id"] = $product_production["products_production_id"];
                       $response["product_production"]["feeds_product_id"] = $product_production["feeds_product_id"];
                       $response["product_production"]["creator_id"] = $product_production["creator_id"];
                       $response["product_production"]["quantity_produced"] = $product_production["quantity_produced"];
                       $response["product_production"]["quantity_measurements"] = $product_production["quantity_measurements"];
                       $response["product_production"]["current_quantinty_instorage"] = $product_production["current_quantinty_instorage"];
                       $response["product_production"]["product_manu_capacity"] = $product_production["product_manu_capacity"];
                       $response["product_production"]["next_day_update"] = $product_production["next_day_update"];
                       $response["product_production"]["date_created"] = $product_production["date_created"];
                       $response["product_production"]["date_updated"] = $product_production["date_updated"];

                   } else {
                       // user failed to store
                       $response["error"] = true;
                       $response["error_msg"] = "Unknown error occurred while inserting production data!";
                       echo json_encode($response);
                   }

           } else {
               $response["error"] = true;
               $response["error_msg"] = "Required parameters (user id or product id) is missing!";
               echo json_encode($response);
           }


            break;


            // * feed manufacturer adds new product production
            case 'manugetallproductproduction':
               $manufacturers_id = $_POST['manufacturers_id'];

                $db = new DbOperation();
                $response['error'] = false;
                $response['message'] = 'Request successfully completed';
                $response['product_production'] = $db->manufacturerGetAllProductProduction($manufacturers_id);

            break;

            // * feed manufacturer adds new product production
            case 'getproductproductionbymanufacturer':
               $manufacturer_id = $_POST['manufacturers_id'];

                $db = new DbOperation();
                $response['error'] = false;
                $response['message'] = 'Request successfully completed';
                $response['product_production'] = $db->getProductionByManufacturer($manufacturer_id);

            break;

            // * feed manufacturer adds new product production
            case 'getrawmaterialsbymanufacturer':
               $feed_manufacturer_id = $_POST['feed_manufacturer_id'];

                $db = new DbOperation();
                $response['error'] = false;
                $response['message'] = 'Request successfully completed';
                $response['product_production'] = $db->getRawMaterialByManufacturer($feed_manufacturer_id);

            break;


            // * feed manufacturer adds new product
            case 'feeds_addnew_rawmaterial':
            $db = new DbOperation();
           // json response array
           $response = array("error" => false);
           if (isset($_POST['user_id'])){
               // receiving the post params
               $creator_id = $_POST['user_id'];
               $manufacturer_id = $_POST['manufacturers_id'];
               $raw_material_title = $_POST['raw_material_title'];
               $raw_material_desc = $_POST['raw_material_desc'];
               $purpose_statement = $_POST['purpose_statement'];

                   // feed manufacturer adds new product
                   $rawmaterial = $db->manuAddNewRawMaterial($creator_id, $manufacturer_id, $raw_material_title, $raw_material_desc, $purpose_statement);
                   if ($rawmaterial) {
                       // user stored successfully
                       $response["error"] = false;
                       $response["rmuid"] = $rawmaterial["raw_material_unique_id"];
                       $response["rawmaterial"]["raw_material_id"] = $rawmaterial["raw_material_id"];
                       $response["rawmaterial"]["creator_id"] = $rawmaterial["creator_id"];
                       $response["rawmaterial"]["manufacturer_id"] = $rawmaterial["manufacturer_id"];
                       $response["rawmaterial"]["raw_material_title"] = $rawmaterial["raw_material_title"];
                       $response["rawmaterial"]["raw_material_desc"] = $rawmaterial["raw_material_desc"];
                       $response["rawmaterial"]["purpose_statement"] = $rawmaterial["purpose_statement"];
                       $response["rawmaterial"]["date_created"] = $rawmaterial["date_created"];
                       $response["rawmaterial"]["date_updated"] = $rawmaterial["date_updated"];

                   } else {
                       // user failed to store
                       $response["error"] = true;
                       $response["error_msg"] = "Unknown error occurred while creating a new product!";
                       // echo json_encode($response);
                   }

           } else {
               $response["error"] = true;
               $response["error_msg"] = "Required parameters (user id or product name) is missing!";
               // echo json_encode($response);
           }
            break;

            case 'getallrawmaterials':
            $db = new DbOperation();
            if (isset($_POST['manufacturer_id'])){
                // receiving the post params
                $manufacturer_id = $_POST['manufacturer_id'];
                 $response['error'] = false;
                 $response['message'] = 'Request successfully completed';
                 $response['rawmaterial'] = $db->manufacturerGetAllRawMaterials($manufacturer_id);

              } else {
                   $response["error"] = true;
                   $response["error_msg"] = "Required parameters (manufacturer id or product id) is missing!";
                   //echo json_encode($response);
               }

            break;

            // * feed manufacturer insert a raw material consumption
            case 'feedmanufacturingindustry':
              $db = new DbOperation();
              // json response array
              $response = array("error" => false);
              if (isset($_POST['user_id'])){
               // receiving the post params
                $creator_id = $_POST['user_id'];
                $feeds_manufacturer_id = $_POST['feeds_manufacturer_id'];
                $total_man_power = $_POST['total_man_power'];
                $total_products_produced = $_POST['total_products_produced'];
                $measurements = $_POST['measurements'];
                $current_stock_instorage = $_POST['current_stock_instorage'];
                $storage_qty_measurements = $_POST['storage_qty_measurements'];
                $num_raw_materials_used = $_POST['number_of_rawmaterials_used'];
                $raw_materials_consumed = $_POST['raw_materials_consumed'];
                $current_raw_materials_instorage = $_POST['current_raw_materials_instorage'];
                $raw_materials_measurements = $_POST['raw_materials_measurements'];
                $next_day_update = $_POST['next_day_update'];

                   // feed manufacturer adds new product
                   $manuoperation = $db->feedManufacturerIndustryData($feeds_manufacturer_id, $creator_id, $total_man_power, $total_products_produced, $measurements, $current_stock_instorage, $storage_qty_measurements, $raw_materials_consumed, $current_raw_materials_instorage, $raw_materials_measurements, $next_day_update);
                   if ($manuoperation) {
                       // user stored successfully
                       $response["error"] = false;
                       $response["miduid"] = $manuoperation["operation_unique_id"];
                       $response["manuoperation"]["manufacturing_operation_id"] = $manuoperation["manufacturing_operation_id"];
                       $response["manuoperation"]["feeds_manufacturer_id"] = $manuoperation["feeds_manufacturer_id"];
                       $response["manuoperation"]["creator_id"] = $manuoperation["creator_id"];
                       $response["manuoperation"]["total_man_power"] = $manuoperation["total_man_power"];
                       $response["manuoperation"]["total_products_produced"] = $manuoperation["total_products_produced"];
                       $response["manuoperation"]["measurements"] = $manuoperation["measurements"];
                       $response["manuoperation"]["current_stock_instorage"] = $manuoperation["current_stock_instorage"];
                       $response["manuoperation"]["storage_qty_measurements"] = $manuoperation["storage_qty_measurements"];
                       $response["manuoperation"]["number_of_rawmaterials_used"] = $manuoperation["number_of_rawmaterials_used"];
                       $response["manuoperation"]["raw_materials_consumed"] = $manuoperation["raw_materials_consumed"];
                       $response["manuoperation"]["raw_materials_measurements"] = $manuoperation["raw_materials_measurements"];
                       $response["manuoperation"]["next_day_update"] = $manuoperation["next_day_update"];
                       $response["manuoperation"]["date_created"] = $manuoperation["date_created"];
                       $response["manuoperation"]["date_updated"] = $manuoperation["date_updated"];




                   } else {
                       // user failed to store
                       $response["error"] = true;
                       $response["error_msg"] = "Unknown error occurred while creating a raw material consumption record!";
                       // echo json_encode($response);
                   }

           } else {
               $response["error"] = true;
               $response["error_msg"] = "Required parameters (user id or product name) is missing!";
               // echo json_encode($response);
           }
            break;


            // * feed manufacturer gets industry data
            case 'getmanuindustrydata':
               $feeds_manufacturer_id = $_POST['feeds_manufacturer_id'];

                $db = new DbOperation();
                $response['error'] = false;
                $response['message'] = 'Request successfully completed';
                $response['industryop'] = $db->manuGetIndustryProduction($feeds_manufacturer_id);

            break;

            // * feed manufacturer gets industry summations data
            case 'getmanuindustrysumdata':
               $feeds_manufacturer_id = $_POST['feeds_manufacturer_id'];

                $db = new DbOperation();
                $response['error'] = false;
                $response['message'] = 'Request successfully completed';
                $response['indsum'] = $db->getManufactureringIndustrySummations($feeds_manufacturer_id);

            break;

            // * feed manufacturer gets product summations data
            // case 'getproductsumdata':
            //     $manufacturers_id = $_POST['manufacturers_id'];
            //     $db = new DbOperation();
            //     $response['error'] = false;
            //     $response['message'] = 'Request successfully completed';
            //     $response['productsum'] = $db->getManufacturerProductSum($manufacturers_id);
            // break;


            // * feed manufacturer insert a raw material consumption
            case 'rawmaterialconsumption':
              $db = new DbOperation();
              // json response array
              $response = array("error" => false);
              if (isset($_POST['user_id'])){
               // receiving the post params
                $creator_id = $_POST['user_id'];
                $feed_manufacturer_id = $_POST['feed_manufacturer_id'];
                $raw_material_id = $_POST['raw_material_id'];
                $use_of_material = $_POST['use_of_material'];
                $total_raw_materials_consumed = $_POST['total_raw_materials_consumed'];
                $measurements = $_POST['measurements'];
                $current_instorage = $_POST['current_instorage'];
                $instorage_measurement =$_POST['instorage_measurement'];
                $material_source = $_POST['material_source'];
                $next_day_update = $_POST['next_day_update'];

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


                   } else {
                       // user failed to store
                       $response["error"] = true;
                       $response["error_msg"] = "Unknown error occurred while creating a raw material consumption record!";
                       // echo json_encode($response);
                   }

           } else {
               $response["error"] = true;
               $response["error_msg"] = "Required parameters (user id or product name) is missing!";
               // echo json_encode($response);
           }
            break;


          //the delete operation
            case 'deleteuseraccount':
            $db = new DbOperation();

              //for the delete operation we are getting a GET parameter from the url having the id of the record to be deleted
              if (isset($_GET['user_id'])) {
                  if ($db->deleteUserAccount($_GET['user_id'])) {
                      $response['error'] = false;
                      $response['message'] = 'user accoount deleted successfully';
                    //  $response['users'] = $db->getUserDetails();
                  } else {
                      $response['error'] = true;
                      $response['message'] = 'Some error occurred please try again';
                  }
              } else {
                  $response['error'] = true;
                  $response['message'] = 'Nothing to delete, provide an id please';
              }
               break;

             }
          } else {
              //if it is not api call
              //pushing appropriate values to response array
              $response['error'] = true;
              $response['message'] = 'Invalid API Call';
          }

      //displaying the response in json structure
      echo json_encode($response);
