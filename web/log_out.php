<?php
    ob_start();
    require_once '../includes/session.php';
    //getting the dboperation class
    require_once '../includes/DbOperation.php';
    require_once '../includes/validations_functions.php';

?>
    <?php
    	// v1: simple logout
    	// session_start();
      $_SESSION['user_log_id'] = null;
      $_SESSION['user_log_email'] = null;
      $_SESSION['user_log_usertype'] = null;
      $_SESSION['loggedIn'] = FALSE;

    	redirect_to("/mydroids/livestokaapi/web/login_area.php");
    ?>

    <?php
    	// v2: destroy session
    	// assumes nothing else in session to keep
    	// session_start();
    	// $_SESSION = array();
    	// if (isset($_COOKIE[session_name()])) {
    	//   setcookie(session_name(), '', time()-42000, '/');
    	// }
    	// session_destroy();
    	// redirect_to("/mydroids/livestokaapi/web/login_area.php");
    ?>
