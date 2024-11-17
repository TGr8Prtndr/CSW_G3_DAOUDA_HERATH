<?php
/**
 * Code for handling logout for a user in Running association
 * @author HERATH Sanduni
 */

session_start();


session_destroy(); // Destroy the session
header("Location: login.php"); // Redirect to the login page
exit;
?>
