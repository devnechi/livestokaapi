


<?php
$app = new DbOperation();
    if (!empty($_GET['key']) && isset($_GET['key'])) {
 
 if ($id != '') {

     // activate user
     $app->activateUserAccountByEmail($id);

     echo 'Your account is activated, please <a href="index.php">click here</a> to to login';

 } else {
     echo "Invalid activation key!";
 }

} else {
 echo "Invalid activation key!";
}

?>