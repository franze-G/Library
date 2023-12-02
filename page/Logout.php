<?php
setcookie('token',"");
unset($_COOKIE['token']);
header("location:Login.php");

?>
