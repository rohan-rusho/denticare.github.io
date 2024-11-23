<?php
include 'connect.php'; 

// Clear the admin_id cookie by setting it to an empty value and an expired time
setcookie('admin_id', '', time() - 1, '/');

// Redirect to the login page
header('Location: ../admin/login.php');
exit; // Always call exit() after header redirection to stop the script execution
?>
