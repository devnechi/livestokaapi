<?php
// * presences
function has_presence($value){
 return isset($value) && $value !== "";
}

function redirect_to($new_location){
  header("Location: ". $new_location);
  exit;
}
// * String length
//max length
function has_max_length($value, $max){
  return  strlen($value) <  $max;
}


// * inclusion in a set
function has_inclusion_in($value, $set){
 return !in_array($value, $set);
}

function validate_max_length($fields_with_max_lengths){
 global $errors;
 // code...
 foreach ($fields_with_max_lengths as $field => $max) {
   // code...
   $value = trim("$_POST[$field]");
   if(!has_max_length($value, $max)){
     $errors[$field] = ucfirst($field) . " is too long";
   }
 }
}

function form_errors($errors = array()){
$output = "";
if(!empty($errors)){
 $output .= "<div class=\"error\">";
  $output .= "<div class=\"alert alert-warning\" role=\"alert\">
    <strong>Take note!</strong> <a href=\"#\" class=\"alert-link\">When registering</a> please fill all the relevant details.
  </div>";
  $output .= "<ul>";
    foreach($errors as $key => $error){
      $output .= "<li><span class=\"badge badge-danger\">{$error} </span></li>";
    }
    $output .= "</ul>";
    $output .= "</div>";
}
return $output;
}

//set a logged in user session
function logged_in() {
  return isset($_SESSION['user_log_id'] );
}

//confirm user has logged in
function confirm_logged_in() {
  if (!logged_in()) {
    redirect_to("../../web/login_area.php");
  }
}


?>
