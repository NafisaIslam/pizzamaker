<?php
/*
* Project Name: Pizza House
* Developed by Fowzia Abida
*/
require 'dbconnection.php';

$supplierid = 0;
if(isset($_GET['supplierid'])){
    $supplierid = $_GET['supplierid'];
}


pg_query($db_handle, "SELECT removesupplier('{$supplierid}')");
header("Location: pizzabaker.php");

?>