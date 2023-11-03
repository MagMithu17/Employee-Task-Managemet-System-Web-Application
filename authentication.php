<?php 

ob_start();
session_set_cookie_params(300);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'classes/admin_class.php';
$obj_admin = new Admin_Class();

if(isset($_GET['logout'])){
	$obj_admin->admin_logout();
}

$_SESSION['LAST_ACTIVITY'] = time();

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 30)) {
            // The session has timed out, so you can log the user out or take appropriate action.
            session_unset();  // Unset all session values
            session_destroy(); // Destroy the session data
            header("Location: index.php"); // Redirect to the login page
            exit();
}