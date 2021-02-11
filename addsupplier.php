<?php
require 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $suppliername = test_input($_POST["suppliername"]);
    $ingredientname = test_input($_POST["ingredientname"]);
    $region = test_input($_POST["region"]);
    $baseprice = test_input($_POST["baseprice"]);
    $quantity = test_input($_POST["quantity"]);
    $isavailable = test_input($_POST["isavailable"]);

    pg_query($db_handle, "SELECT addsuppliers ('{$suppliername}','{$ingredientname}','{$region}', '{$baseprice}','{$quantity}','{$isavailable}')");
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
    <h2>Add Supplier</h2><br>

    <div class="breadcrumb">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li><a href="pizzabaker.php">Pizza maker</a></li>
            <li>Add Suppliers</li>
        </ul>
    </div>
    <br>

    <form action="" method='POST'>

        <label for="sname">Supplier Name</label>
        <input type="text" name="suppliername" required
               placeholder="Suppler Name."><br>

        <label for="iname">Ingredient Name</label>
        <input type="text"  name="ingredientname" required
               placeholder="ingredient name.."><br>

        <label for="rname">Region Name</label>
        <input type="text"  name="region" required
               placeholder="region name.."><br>

        <label for="pname">Price</label>
        <input type="text"  name="baseprice" required placeholder="price.."><br>

        <label for="qname">Quality</label>
        <input type="text" name="quantity" required placeholder="Quantity..">
        <br>

        <label for="qname">Available</label>
        <select name="isavailable">
            <option value='1'>True</option>
            <option value='2'>False</option>
        </select>
        <br>
        </select>

        <input type="submit" value="Submit">
    </form>
</div>


</body>
</html>

