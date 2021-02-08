<?php
require 'dbconnection.php';
$ingredientid = 0;

if(isset($_GET['ingredientid'])) {
    $ingredientid = $_GET['ingredientid'];
}
$supplierid = 0;
if (isset($_GET['supplierid'])) {
    $supplierid = $_GET['supplierid'];
    $result = pg_query($db_handle, "SELECT * from suppliers where supplierid = '{$supplierid}'");
    while ($row= pg_fetch_assoc($result))
    {
        pg_query($db_handle, "SELECT restocking ('$ingredientid','{$row['baseprice']}','{$row ['region']}','{$row['quantity']}','{$row['supplierid']}','{$row['isavailable']}')");
        header("Location: pizzabaker.php");
    }

}
?>