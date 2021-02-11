<?php
/*
* Project Name: Pizza House
* Developed by Fowzia Abida
*/
require 'dbconnection.php';
$supplierid = 0;
if(isset($_GET['pizzaid'])){
    $pizzaid = $_GET['pizzaid'];
}
pg_query($db_handle, "SELECT removepizzen('{$pizzaid}')");
header("Location: pizzabaker.php");
?>