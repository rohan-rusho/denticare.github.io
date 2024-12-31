<?php
include 'connect.php';  // Presumably, this handles any necessary database or session setup
setcookie('user_id','',time() -1,'/');  // Clears the 'user_id' cookie
header('location:.../home.php');  // Redirects the user to 'home.php'
exit();  // It's a good practice to call exit() after a redirect to stop further code execution
?>
