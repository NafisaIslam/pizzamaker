<?php
require 'dbconnection.php';
error_reporting(E_ERROR | E_PARSE);

$ingredientname = "";
if (isset($_GET['ingredientname'])) {
    $ingredientname = $_GET['ingredientname'];
}
$ingredientid = 0;
if (isset($_GET['ingredientid'])) {
    $ingredientid = $_GET['ingredientid'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css ">
</head>
<body>

<div class="formdata">
    <br>
    <h2>Restocking</h2><br>
    <div class="breadcrumb">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li><a href="pizzabaker.php">Pizza maker</a></li>
            <li>Restocking</li>
        </ul>
    </div>
        <?php
        $result = pg_query($db_handle, "SELECT * from suppliers where ingredientname = '" . $ingredientname."'");
        if ($result) {

        ?>
    <table>
        <tr>
            <th> Supplier Name</th>
            <th> Ingredient Name</th>
            <th> Region Name</th>
            <th> Price</th>
            <th> Quantity</th>
            <th> Action</th>
        </tr>
           <?php
            while ($row = pg_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['suppliername'] . "</td>";
                echo "<td>" . $row['ingredientname'] . "</td>";
                echo "<td>" . $row['region'] . "</td>";
                echo "<td>" . $row['baseprice'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";

                echo "<td><a class='action-button' href='restocking.php?supplierid={$row['supplierid']}&ingredientid=$ingredientid'> Buy </a>";

                echo "</td></tr>\r\n";
            }
        }
        else echo "no supplier found for " .$ingredientname;

        ?>
    </table>


</div>


</body>
</html>
