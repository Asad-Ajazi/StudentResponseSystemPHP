<?php
session_start();
error_reporting(E_ERROR);

 if (isset($_SESSION['email'])) {
 	unset($_SESSION['email']);
 }
	session_destroy();


header("Location: login.php"); // redirect to login page


?>