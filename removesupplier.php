<?php
require 'dbconnection.php';

$supplierid = 0;
if(isset($_GET['supplierid'])){
    $supplierid = $_GET['supplierid'];
}


pg_query($db_handle, "SELECT removesupplier('{$supplierid}')");
header("Location: pizzabaker.php");

?>