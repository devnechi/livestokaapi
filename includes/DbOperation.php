<?php

class DbOperation
{
    //Database connection link
    private $con;

    //Class constructor
    function __construct()
    {
        //Getting the DbConnect.php file
        require_once dirname(__FILE__) . '/DbConnect.php';

        //Creating a DbConnect object to connect to the database
        $db = new DbConnect();

        //Initializing our connection link of this class
        //by calling the method connect of DbConnect class
        $this->con = $db->connect();
    }



/////////////////////////REGISTRATION: Manufactures//////////////////////////////////////////////////////////////////////////

/*
*REGISTRATION: activation :
* user account activation
*/
public function activateUserAccount($user_id, $account_status){
  $stmt = $this->con->prepare("UPDATE lvusers_tb SET account_status = ? WHERE user_id = ?");
 $stmt->bind_param("si", $account_status, $user_id);
 if($stmt->execute())
 return true;
 return false;
}

/*check if account is active*/

public function isAccountActive($user_id, $account_status){
  $stmt = $this->con->prepare("SELECT user_id, account_status FROM lvusers_tb WHERE user_id = ? AND account_status = ?");
  $stmt->bind_param("is", $user_id, $account_status);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
      // user existed
      $stmt->close();
      return true;
  } else {
      // user not existed
      $stmt->close();
      return false;
  }
}


/*
*REGISTRATION: type of user :
* reg user type -> Manufactures
*/

public function registerUser($email, $password,  $usertype, $account_status){

  $uuid = uniqid('', true);
  $hash = $this->hashSSHA($password);
  $encrypted_password = $hash["encrypted"]; // encrypted password
     $salt = $hash["salt"]; // salt

     $stmt = $this->con->prepare("INSERT INTO lvusers_tb(user_unique_id, email, encrypted_password, usertype, salt, account_status, created_at) VALUES(?, ?, ?, ?, ?, ?, NOW())");
   $stmt->bind_param("ssssss", $uuid, $email, $encrypted_password, $usertype,  $salt, $account_status);

   $result = $stmt->execute();
   $stmt->close();

   // check for successful store
   if ($result) {
       $stmt = $this->con->prepare("SELECT * FROM lvusers_tb WHERE email = ?");
       $stmt->bind_param("s", $email);
       $stmt->execute();
       $user = $stmt->get_result()->fetch_assoc();
       $stmt->close();

       return $user;
   } else {

    echo mysql_error();

       return false;
   }
}


/*
*add new manufacturer to the database
*/
public function registerFeedManufacturers($user_id, $companyname, $year_established, $cert_of_incorporation_num, $feedbussiness_permit_num, $premise_cert_num, $gmp_cert_num, $association_affiliation, $country, $region, $district, $address, $pobox, $phonenumber, $websiteurl, $contact_person, $production_capacity, $storage_capacity, $num_products_produced, $man_power, $plant_manager){

  $mfuid = uniqid('', true);

  $stmt = $this->con->prepare("INSERT INTO feed_manufactures (feed_manufactures_unique_id, user_id, companyname, year_established, cert_of_incorporation_num, feedbussiness_permit_num, premise_cert_num, gmp_cert_num, association_affiliation, country, region, district, address, pobox, phonenumber, websiteurl, contact_person, production_capacity, storage_capacity, num_products_produced, man_power, plant_manager, created_at) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
          $stmt->bind_param("ssssssssssssssssssssss", $mfuid, $user_id, $companyname, $year_established, $cert_of_incorporation_num, $feedbussiness_permit_num, $premise_cert_num, $gmp_cert_num, $association_affiliation, $country, $region, $district, $address, $pobox, $phonenumber, $websiteurl, $contact_person, $production_capacity, $storage_capacity, $num_products_produced, $man_power, $plant_manager);
          $result = $stmt->execute();
          $stmt->close();

          // check for successful store
          if ($result) {
              $stmt = $this->con->prepare("SELECT * FROM feed_manufactures WHERE cert_of_incorporation_num = ?");
              $stmt->bind_param("s", $cert_of_incorporation_num);
              $stmt->execute();
              $feed_manufacturer = $stmt->get_result()->fetch_assoc();
              $stmt->close();

              return $feed_manufacturer;

          } else {
              return false;
          }




}





/**
 *
 *feed manufacturers: add a new product
 *
 */
public function manufactureAddNewProduct($creator_id, $feed_manu_id, $product_name, $brand_name, $product_type,  $protein_level, $product_purpose_statement, $product_description){
    $npuid = uniqid('', true);
    $stmt = $this->con->prepare("INSERT INTO feeds_products (feeds_products_unique_id, creator_id, manufacturers_id,  product_name, brand_name, product_type, protein_level, product_purpose_statement, product_description,  created_at) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
            $stmt->bind_param("sssssssss", $npuid, $creator_id, $feed_manu_id, $product_name, $brand_name, $product_type,  $protein_level, $product_purpose_statement, $product_description);
            $result = $stmt->execute();
            $stmt->close();

            // check for successful store
            if ($result) {
                $stmt = $this->con->prepare("SELECT * FROM feeds_products WHERE brand_name = ?");
                $stmt->bind_param("s", $brand_name);
                $stmt->execute();
                $feeds_product = $stmt->get_result()->fetch_assoc();
                $stmt->close();

                return $feeds_product;

            } else {
                return false;
            }



}

/**
 *
 *feed manufacturers: feed manufacturers get all products
 *
 */
public function manufacturerGetAllProducts($manufacturers_id){

  $stmt = $this->con->prepare("SELECT feed_product_id, feeds_products_unique_id, creator_id, manufacturers_id, product_name, brand_name, product_type, protein_level, product_purpose_statement, product_description, created_at, updated_at  FROM  feeds_products WHERE manufacturers_id = ?");
    //$stmt = $this->con->prepare("SELECT * FROM businessDetails WHERE user_id = ?");
    $stmt->bind_param("s", $manufacturers_id);
  $stmt->execute();
  $stmt->bind_result($feed_product_id, $feeds_products_unique_id, $creator_id, $manufacturers_id, $product_name, $brand_name, $product_type, $protein_level, $product_purpose_statement, $product_description, $created_at, $updated_at);

  $products = array();

  while ($stmt->fetch()) {
      $product  = array();
      $product['feed_product_id'] = $feed_product_id;
      $product['feeds_products_unique_id'] = $feeds_products_unique_id;
      $product['creator_id'] = $creator_id;
      $product['manufacturers_id'] = $manufacturers_id;
      $product['product_name'] = $product_name;
      $product['brand_name'] = $brand_name;
      $product['product_type'] = $product_type;
      $product['protein_level'] = $protein_level;
      $product['product_purpose_statement'] = $product_purpose_statement;
      $product['product_description'] = $product_description;
      $product['created_at'] = $created_at;
      $product['updated_at'] = $updated_at;

      array_push($products, $product);
  }
  return $products;

}
/**
 *
 *feed manufacturers: feed manufacturers get all products production
 *
 */
 public function manufacturerGetAllProductProduction($manufacturers_id){

       $stmt = $this->con->prepare("SELECT products_production_id, feed_production_unique_id, feeds_product_id, creator_id,  manufacturer_id, quantity_produced, quantity_measurements, current_quantity_instorage, instorage_measurements, product_manu_capacity, next_day_update, date_created, date_updated FROM  feeds_products_production WHERE manufacturer_id = $manufacturers_id");
      $stmt->execute();
      $stmt->bind_result($products_production_id, $feed_production_unique_id, $feeds_product_id, $creator_id,  $manufacturer_id, $quantity_produced, $quantity_measurements, $current_quantity_instorage, $instorage_measurements, $product_manu_capacity, $next_day_update, $date_created, $date_updated);

      $product_productions = array();

      while ($stmt->fetch()) {
          $product_production  = array();
          $product_production['feed_production_unique_id'] = $feed_production_unique_id;
          $product_production['products_production_id'] = $products_production_id;
          $product_production['feeds_product_id'] = $feeds_product_id;
          $product_production['creator_id'] = $creator_id;
          $product_production['manufacturer_id'] = $manufacturer_id;
          $product_production['quantity_produced'] = $quantity_produced;
          $product_production['quantity_measurements'] = $quantity_measurements;
          $product_production['current_quantity_instorage'] = $current_quantity_instorage;
          $product_production['instorage_measurements'] = $instorage_measurements;
          $product_production['product_manu_capacity'] = $product_manu_capacity;
          $product_production['next_day_update'] = $next_day_update;
          $product_production['date_created'] = $date_created;
          $product_production['date_updated'] = $date_updated;

          array_push($product_productions, $product_production);
      }
      return $product_productions;
   }


   /*
   *FEED MANUFACTURER: get production with product name
   *
   */
  public function getProductionByManufacturer($manufacturer_id){

    $stmt = $this->con->prepare("SELECT feeds_products_production.products_production_id
    , feeds_products.product_name
    , feeds_products.product_type
    , feeds_products_production.manufacturer_id
    , feeds_products_production.quantity_produced
    , feeds_products_production.quantity_measurements
    , feeds_products_production.current_quantity_instorage
	  , feeds_products_production.instorage_measurements
    , feeds_products_production.next_day_update
    , feeds_products_production.date_created

    FROM feeds_products_production
    INNER JOIN feeds_products
    ON
    feeds_products.feed_product_id=feeds_products_production.feeds_product_id WHERE  feeds_products_production.manufacturer_id = $manufacturer_id");
   $stmt->execute();
   $stmt->bind_result($products_production_id, $product_name, $product_type, $manufacturer_id, $quantity_produced, $quantity_measurements, $current_quantity_instorage, $instorage_measurements, $next_day_update, $date_created);

   $product_productions = array();

   while ($stmt->fetch()) {
       $product_production  = array();
       $product_production['products_production_id'] = $products_production_id;
       $product_production['product_name'] = $product_name;
       $product_production['product_type'] = $product_type;
       $product_production['manufacturer_id'] = $manufacturer_id;
       $product_production['quantity_produced'] = $quantity_produced;
       $product_production['quantity_measurements'] = $quantity_measurements;
       $product_production['current_quantity_instorage'] = $current_quantity_instorage;
       $product_production['instorage_measurements'] = $instorage_measurements;
       $product_production['next_day_update'] = $next_day_update;
       $product_production['date_created'] = $date_created;
       array_push($product_productions, $product_production);
   }
   return $product_productions;
  }



/**
 *
 *feed manufacturers: add a product production
 *
 */
public function manufactureProductProduction($feeds_product_id, $pcreator_id,  $quantity_produced, $quantity_measurements, $current_quantity_instorage, $instorage_measurements, $next_day_update){

    $fppuid = uniqid('', true);

    $stmt = $this->con->prepare("INSERT INTO feeds_products_production (feed_production_unique_id, feeds_product_id, creator_id,  quantity_produced, quantity_measurements, current_quantity_instorage, instorage_measurements, next_day_update, date_created) VALUES(?, ?, ?, ?, ?, ?, ?, ?, NOW())");
            $stmt->bind_param("ssssssss", $fppuid, $feeds_product_id, $pcreator_id,  $quantity_produced, $quantity_measurements, $current_quantity_instorage, $instorage_measurements, $next_day_update);
            $result = $stmt->execute();
            $stmt->close();

            // check for successful store
            if ($result) {
                $stmt = $this->con->prepare("SELECT * FROM feeds_products_production WHERE feeds_product_id = ?");
                $stmt->bind_param("s", $feeds_product_id);
                $stmt->execute();
                $product_production = $stmt->get_result()->fetch_assoc();
                $stmt->close();

                return $product_production;

            } else {
                return false;
            }
}

public function getFeedManufacturerDetails($user_id){
  $stmt = $this->con->prepare("SELECT feed_manufactures_id, feed_manufactures_unique_id, user_id, companyname, year_established, cert_of_incorporation_num, feedbussiness_permit_num, premise_cert_num, gmp_cert_num, association_affiliation, country, region, district, address, pobox, phonenumber, websiteurl, contact_person, production_capacity, storage_capacity, num_products_produced, man_power, plant_manager, created_at, updated_at FROM feed_manufactures WHERE user_id = ?");
    //$stmt = $this->con->prepare("SELECT * FROM businessDetails WHERE user_id = ?");

    $stmt->bind_param("s", $user_id);

    if ($stmt->execute()) {
        // $user = $stmt->get_result()->fetch_assoc();
        $manufacturer = $stmt->get_result()->fetch_assoc();

        $stmt->close();

            return $manufacturer;

    } else {
        return null;
  }

  }


/*
*
* feed manufacturer: adds new raw material they use
*/
public function manuAddNewRawMaterial($creator_id, $manufacturer_id, $raw_material_title, $raw_material_desc, $purpose_statement){

  $rmuid = uniqid('', true);
  $stmt = $this->con->prepare("INSERT INTO raw_materials (raw_material_unique_id, creator_id, manufacturer_id, raw_material_title, raw_material_desc, purpose_statement, date_created) VALUES(?, ?, ?, ?, ?, ?, NOW())");
          $stmt->bind_param("ssssss", $rmuid, $creator_id, $manufacturer_id, $raw_material_title, $raw_material_desc, $purpose_statement);
          $result = $stmt->execute();
          $stmt->close();

          // check for successful store
          if ($result) {
              $stmt = $this->con->prepare("SELECT * FROM raw_materials WHERE manufacturer_id = ?");
              $stmt->bind_param("s", $manufacturer_id);
              $stmt->execute();
              $rawmaterial = $stmt->get_result()->fetch_assoc();
              $stmt->close();

              return $rawmaterial;

          } else {
              return false;
          }

}

/**
 *
 *feed manufacturers: feed manufacturers get all raw materials
 *
 */
public function manufacturerGetAllRawMaterials($manufacturer_id){
  $stmt = $this->con->prepare("SELECT raw_material_id, raw_material_unique_id, creator_id, manufacturer_id, raw_material_title, raw_material_desc, purpose_statement, date_created, date_updated  FROM raw_materials WHERE manufacturer_id = ?");
    //$stmt = $this->con->prepare("SELECT * FROM businessDetails WHERE user_id = ?");
    $stmt->bind_param("s", $manufacturer_id);
  $stmt->execute();
  $stmt->bind_result($raw_material_id, $raw_material_unique_id, $creator_id, $manufacturer_id, $raw_material_title, $raw_material_desc, $purpose_statement, $date_created, $date_updated);

  $rawmaterials = array();

  while ($stmt->fetch()) {
      $rawmaterial  = array();
      $rawmaterial['raw_material_id'] = $raw_material_id;
      $rawmaterial['raw_material_unique_id'] = $raw_material_unique_id;
      $rawmaterial['creator_id'] = $creator_id;
      $rawmaterial['manufacturer_id'] = $manufacturer_id;
      $rawmaterial['raw_material_title'] = $raw_material_title;
      $rawmaterial['raw_material_desc'] = $raw_material_desc;
      $rawmaterial['purpose_statement'] = $purpose_statement;
      $rawmaterial['date_created'] = $date_created;
      $rawmaterial['date_updated'] = $date_updated;

      array_push($rawmaterials, $rawmaterial);
  }
  return $rawmaterials;
}


/*
*FEED MANUFACTURER: get production with product name
*
*/

public function getRawMaterialByManufacturer($feed_manufacturer_id){

 $stmt = $this->con->prepare("SELECT
 fm_rm_consumption.consumption_id
    , raw_materials.raw_material_title
    , fm_rm_consumption.feed_manufacturer_id
    , fm_rm_consumption.total_raw_materials_consumed
    , fm_rm_consumption.measurements
    , fm_rm_consumption.current_instorage
	  , fm_rm_consumption.instorage_measurement
    , fm_rm_consumption.next_day_update
    , fm_rm_consumption.date_created

FROM fm_rm_consumption
INNER JOIN  raw_materials
 ON
  raw_materials.raw_material_id=fm_rm_consumption.raw_material_id WHERE  fm_rm_consumption.feed_manufacturer_id = $feed_manufacturer_id");
$stmt->execute();
$stmt->bind_result($consumption_id, $raw_material_title, $feed_manufacturer_id, $total_raw_materials_consumed, $measurements, $current_instorage, $instorage_measurement, $next_day_update, $date_created);

$consumptions = array();

while ($stmt->fetch()) {
    $consumption  = array();
    $consumption['consumption_id'] = $consumption_id;
    $consumption['raw_material_title'] = $raw_material_title;
    $consumption['feed_manufacturer_id'] = $feed_manufacturer_id;
    $consumption['total_raw_materials_consumed'] = $total_raw_materials_consumed;
    $consumption['measurements'] = $measurements;
    $consumption['current_instorage'] = $current_instorage;
    $consumption['instorage_measurement'] = $instorage_measurement;
    $consumption['next_day_update'] = $next_day_update;
    $consumption['date_created'] = $date_created;
    array_push($consumptions, $consumption);
}
return $consumptions;
}


/*
*
* feed manufacturer: insert a raw material consumption
*/
public function manuRawMaterialConsumption($feed_manufacturer_id, $raw_material_id, $creator_id,  $use_of_material, $total_raw_materials_consumed, $measurements, $current_instorage, $instorage_measurement, $material_source, $next_day_update){

          $rmcuid = uniqid('', true);
          $stmt = $this->con->prepare("INSERT INTO fm_rm_consumption (consumption_unique_id, feed_manufacturer_id, raw_material_id, creator_id,  use_of_material, total_raw_materials_consumed, measurements, current_instorage, instorage_measurement, material_source, next_day_update, date_created) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
          $stmt->bind_param("sssssssssss", $rmcuid, $feed_manufacturer_id, $raw_material_id, $creator_id, $use_of_material, $total_raw_materials_consumed, $measurements, $current_instorage, $instorage_measurement, $material_source, $next_day_update);
          $result = $stmt->execute();
          $stmt->close();

          // check for successful store
          if ($result) {
              $stmt = $this->con->prepare("SELECT * FROM fm_rm_consumption WHERE feed_manufacturer_id = ?");
              $stmt->bind_param("s", $feed_manufacturer_id);
              $stmt->execute();
              $rawmaterialconsumption = $stmt->get_result()->fetch_assoc();
              $stmt->close();

              return $rawmaterialconsumption;

          } else {
              return false;
          }

}

/*
*
* feed manufacturer: insert a monthly industry manufacturing update
*/
public function feedManufacturerIndustryData($feeds_manufacturer_id, $creator_id, $total_man_power, $total_products_produced, $measurements, $current_stock_instorage, $storage_qty_measurements, $num_raw_materials_used, $raw_materials_consumed, $current_raw_materials_instorage, $raw_materials_measurements, $next_day_update){

          $miduid = uniqid('', true);
          $stmt = $this->con->prepare("INSERT INTO feeds_manufacturing_industry (operation_unique_id, feeds_manufacturer_id, creator_id, total_man_power, total_products_produced, measurements, current_stock_instorage, storage_qty_measurements, number_of_rawmaterials_used, raw_materials_consumed, current_raw_materials_instorage, raw_materials_measurements, next_day_update, date_created) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
          $stmt->bind_param("sssssssssssss", $miduid, $feeds_manufacturer_id, $creator_id, $total_man_power, $total_products_produced, $measurements, $current_stock_instorage, $storage_qty_measurements, $num_raw_materials_used, $raw_materials_consumed, $current_raw_materials_instorage, $raw_materials_measurements, $next_day_update);
          $result = $stmt->execute();
          $stmt->close();

          // check for successful store
          if ($result) {
              $stmt = $this->con->prepare("SELECT * FROM feeds_manufacturing_industry WHERE feeds_manufacturer_id = ?");
              $stmt->bind_param("s", $feeds_manufacturer_id);
              $stmt->execute();
              $manuoperation = $stmt->get_result()->fetch_assoc();
              $stmt->close();

              return $manuoperation;

          } else {
              return false;
          }

}


/*
*FEED Manufacturer: get industry data
*
*/
public function manuGetIndustryProduction($feeds_manufacturer_id){
  $stmt = $this->con->prepare("SELECT manufacturing_operation_id, operation_unique_id, feeds_manufacturer_id,
   creator_id, total_man_power, total_products_produced, measurements, current_stock_instorage,
   storage_qty_measurements, number_of_rawmaterials_used, raw_materials_consumed, current_raw_materials_instorage,
   raw_materials_measurements, next_day_update, date_created, date_updated FROM livestoka.feeds_manufacturing_industry WHERE feeds_manufacturer_id = $feeds_manufacturer_id");
    //$stmt = $this->con->prepare("SELECT * FROM businessDetails WHERE user_id = ?");
    //$stmt->bind_param("s", $feeds_manufacturer_id);
  $stmt->execute();
  $stmt->bind_result($manufacturing_operation_id, $operation_unique_id, $feeds_manufacturer_id,
   $creator_id, $total_man_power, $total_products_produced, $measurements, $current_stock_instorage,
   $storage_qty_measurements, $number_of_rawmaterials_used, $raw_materials_consumed, $current_raw_materials_instorage,
   $raw_materials_measurements, $next_day_update, $date_created, $date_updated);

  $industryops = array();

  while ($stmt->fetch()) {
      $industryop  = array();
        $industryop['manufacturing_operation_id'] = $manufacturing_operation_id;
        $industryop['operation_unique_id'] = $operation_unique_id;
        $industryop['feeds_manufacturer_id'] = $feeds_manufacturer_id;
        $industryop['creator_id'] = $creator_id;
        $industryop['total_man_power'] = $total_man_power;
        $industryop['total_products_produced'] = $total_products_produced;
        $industryop['measurements'] = $measurements;
        $industryop['current_stock_instorage'] = $current_stock_instorage;
        $industryop['storage_qty_measurements'] = $storage_qty_measurements;
        $industryop['number_of_rawmaterials_used'] = $number_of_rawmaterials_used;
        $industryop['raw_materials_consumed'] = $raw_materials_consumed;
        $industryop['current_raw_materials_instorage'] = $current_raw_materials_instorage;
        $industryop['raw_materials_measurements'] = $raw_materials_measurements;
        $industryop['next_day_update'] = $next_day_update;
        $industryop['date_created'] = $date_created;
        $industryop['date_updated'] = $date_updated;
        array_push($industryops, $industryop);
  }
  return $industryops;
  }



/*
*
*FEED MANUFACTURER: GET INDUSTRY SUMMATIONS
*
*/
public function getManufactureringIndustrySummations($feeds_manufacturer_id){
  $stmt = $this->con->prepare(" SELECT SUM(total_products_produced),SUM(current_stock_instorage),SUM(raw_materials_consumed), SUM(current_raw_materials_instorage), SUM(total_man_power)
 FROM feeds_manufacturing_industry WHERE feeds_manufacturer_id = $feeds_manufacturer_id");
    //$stmt = $this->con->prepare("SELECT * FROM businessDetails WHERE user_id = ?");
    //$stmt->bind_param("s", $feeds_manufacturer_id);
  $stmt->execute();
  $stmt->bind_result($total_products_produced, $current_stock_instorage, $raw_materials_consumed,
   $current_raw_materials_instorage, $total_man_power);

  $indsums = array();

  while ($stmt->fetch()) {
      $indsum  = array();
        $indsum['total_products_produced'] = $total_products_produced;
        $indsum['current_stock_instorage'] = $current_stock_instorage;
        $indsum['raw_materials_consumed'] = $raw_materials_consumed;
        $indsum['current_raw_materials_instorage'] = $current_raw_materials_instorage;
        $indsum['total_man_power'] = $total_man_power;
        array_push($indsums, $indsum);
  }
  return $indsums;

}



/*
*
*FEED MANUFACTURER: PRODUCT SUMMATIONS
*
*/
// public function getManufacturerProductSum($manufacturers_id){
//   // $stmt = $this->con->prepare("SELECT COUNT(*) FROM feeds_products WHERE manufacturers_id = $manufacturers_id");
//   // //$stmt->bind_param('i', $manufacturers_id);
//   //   // $stmt->bind_param('i', $manufacturers_id);
//   //   // $productsum = $stmt->get_result();
//   //   $productsum = $stmt->execute();
//   //   $stmt->close();
//
//     $troopcount_sql = ("SELECT COUNT(*) FROM feeds_products WHERE manufacturers_id = $manufacturers_id");
// $productsum = $this->con->mysqli_query($troopcount_sql);
//
// }


/*
*
*FEED MANUFACTURER: RAW MATERIAL SUMMATIONS
*
*/
public function getManufacturerRawMaterialSum($manufacturer_id){


}

/*
*REGISTRATION: type of user :
* reg user type -> Manufactures
*/

public function registerHatcheryUser($fname, $lname, $email, $password,  $usertype, $account_status){

  $uuid = uniqid('', true);
  $hash = $this->hashSSHA($password);
  $encrypted_password = $hash["encrypted"]; // encrypted password
     $salt = $hash["salt"]; // salt

     $stmt = $this->con->prepare("INSERT INTO lvusers_tb(user_unique_id, fname, lname, email, encrypted_password, usertype, salt, account_status, created_at) VALUES(?, ?, ?, ?, ?, ?, ?, ?, NOW())");
   $stmt->bind_param("ssssssss", $uuid, $fname, $lname, $email, $encrypted_password, $usertype,  $salt, $account_status);

   $result = $stmt->execute();
   $stmt->close();

   // check for successful store
   if ($result) {
       $stmt = $this->con->prepare("SELECT * FROM lvusers_tb WHERE email = ?");
       $stmt->bind_param("s", $email);
       $stmt->execute();
       $user = $stmt->get_result()->fetch_assoc();
       $stmt->close();

       return $user;
   } else {

    echo mysql_error();

       return false;
   }
}

/*
*add new hatchery
*/
public function registerNewHatchery($user_id, $hatchery_name, $year_established, $incorporation_number, $business_permit_number, $premise_certificate_number, $gmp_certificate_number, $hatcheries_owned, $association_affiliation, $country,  $region, $district, $pobox, $websiteurl, $address, $contact_person, $total_hatchery_capacity, $total_incubation_capacity, $num_breeds_hatched, $total_man_power, $plant_manager){

    $htuid = uniqid('', true);

    $stmt = $this->con->prepare("INSERT INTO hatcheries_tbl (hatchery_unique_id, user_id, hatchery_name,
 year_established, association_affiliation, country, region, district, pobox, websiteurl,
 phone_number,
 address, hatchery_declaration, total_incubation_setting_capacity, hatchery_category,
 establishment_concerned, contact_person, created_at) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?,
 ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
            $stmt->bind_param("ssssssssssssssssss", $htuid, $user_id, $hatchery_name, $year_established, $incorporation_number, $business_permit_number, $premise_certificate_number, $gmp_certificate_number, $hatcheries_owned, $association_affiliation, $country,  $region, $district, $pobox, $websiteurl, $address, $contact_person, $total_hatchery_capacity, $total_incubation_capacity, $num_breeds_hatched, $total_man_power, $plant_manager);
            $result = $stmt->execute();
            $stmt->close();

            // check for successful store
            if ($result) {
                $stmt = $this->con->prepare("SELECT * FROM hatcheries_tbl WHERE incorporation_number = ?");
                $stmt->bind_param("s", $incorporation_number);
                $stmt->execute();
                $hatchery = $stmt->get_result()->fetch_assoc();
                $stmt->close();

                return $hatchery;

            } else {
                return false;
            }
}


/**
 * Check user is existed or not
 */
public function doesUserEmailExist($email)
{
    $stmt = $this->con->prepare("SELECT email from lvusers_tb WHERE email = ?");

    $stmt->bind_param("s", $email);

    $stmt->execute();

    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // user existed
        $stmt->close();
        return true;
    } else {
        // user not existed
        $stmt->close();
        return false;
    }
}


/**
 * Check if manufacturer userid is existed or not
 */
public function doesFeedManufactureExist($user_id)
{
    $stmt = $this->con->prepare("SELECT user_id FROM feed_manufactures WHERE user_id = ?");

    $stmt->bind_param("s", $user_id);

    $stmt->execute();

    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // user existed
        $stmt->close();
        return true;
    } else {
        // user not existed
        $stmt->close();
        return false;
    }
}



/**
 * Check if manufacturer userid is existed or not
 */
public function doesHatcheryUserExist($user_id)
{
    $stmt = $this->con->prepare("SELECT user_id FROM hatcheries_tbl WHERE user_id = ?");

    $stmt->bind_param("s", $user_id);

    $stmt->execute();

    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // user existed
        $stmt->close();
        return true;
    } else {
        // user not existed
        $stmt->close();
        return false;
    }
}

/**
   * Encrypting password
   * @param password
   * returns salt and encrypted password
   */
  public function hashSSHA($password)
  {
      $salt = sha1(rand());
      $salt = substr($salt, 0, 10);
      $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
      $hash = array("salt" => $salt, "encrypted" => $encrypted);
      return $hash;
  }

  /**
   * Decrypting password
   * @param salt, password
   * returns hash string
   */
  public function checkhashSSHA($salt, $password)
  {
      $hash = base64_encode(sha1($password . $salt, true) . $salt);

      return $hash;
  }


  /**
     * Get user by email and password
     */
    public function attempt_login($email, $password)
    {
        $stmt = $this->con->prepare("SELECT * FROM lvusers_tb WHERE email = ?");

        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            // verifying user password
            $salt = $user['salt'];
            $encrypted_password = $user['encrypted_password'];
            $hash = $this->checkhashSSHA($salt, $password);
            // check for password equality
            if ($encrypted_password == $hash) {
                // user authentication details are correct
                return $user;
            }
        } else {
            return null;
        }
    }

    /*
* The delete operation
* When this method is called record is deleted for the given id
*/
public function deleteUserAccount($user_id)
{
   $stmt = $this->con->prepare("DELETE FROM lvusers_tb WHERE user_id = ? ");
   $stmt->bind_param("i", $user_id);
   if ($stmt->execute()) {
       return true;
   }

   return false;
}


}
