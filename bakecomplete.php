<?php

require 'dbconnection.php';

if(isset($_GET['orderid'])){
    $orderid = $_GET["orderid"];
    $result = pg_query($db_handle, "SELECT completeorder('{$orderid}')");
    if($result){
        echo "<div style='text-align:center'>";
        header("Location: pizzabaker.php");
    }
}
?>

