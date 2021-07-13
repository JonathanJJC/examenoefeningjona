<?php

session_start();

$_SESSION = ['email'];
$_SESSION = ['voornaam'];

session_destroy();

header('location: logintest.php');
exit;
?>