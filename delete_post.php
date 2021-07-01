<?php  
include 'database.php';
include 'validator/both.php';

$db = new database();
$id = $_GET['id'];
$db->delete_post( [':id' => $id]);

// header("refresh:3;url=users.php");



?>