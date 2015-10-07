<?php
session_start();
setcookie('remember', NULL, -1);
unset($_SESSION['auth']);
$_SESSION['flash']['success']= 'Vous &ecirc;tes maintenant d&eacute;connect&eacute;';
header('Location: login.php');
?>