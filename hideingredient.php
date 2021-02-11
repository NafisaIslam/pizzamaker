<?php
/*
* Project Name: Pizza House
* Developed by Fowzia Islam
*/
require 'dbconnection.php';

$ingredientid = 0;
if(isset($_GET['ingredientid'])){
  $ingredientid = $_GET['ingredientid'];
}


  pg_query($db_handle, "SELECT hideingredients('{$ingredientid}')");
  header("Location: pizzabaker.php");

?>