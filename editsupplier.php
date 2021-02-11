<?php
/*
* Project Name: Pizza House
* Developed by Nafisa Islam
*/
require 'dbconnection.php';

$supplierid = 0;
if (isset($_GET['supplierid'])) {
    $supplierid = $_GET['supplierid'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supplierid = test_input($_POST["supplierid"]);
    $suppliername = test_input($_POST["suppliername"]);
    $ingredientname = test_input($_POST["ingredientname"]);
    $region = test_input($_POST["region"]);
    $baseprice = test_input($_POST["baseprice"]);
    $quantiy = test_input($_POST["quantity"]);
    $isavailable = test_input($_POST["isavailable"]);

    pg_query($db_handle, "SELECT editsuppliers('{$supplierid}','{$suppliername}','{$ingredientname}','{$region}','{$baseprice}','{$quantiy}','{$isavailable}')");
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
    <h2>Edit Suppliers</h2><br>
    <div class="breadcrumb">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li><a href="pizzabaker.php">Pizza maker</a></li>
            <li>Edit Suppliers</li>
        </ul>
    </div>
    <br>
    <form action="" method='POST'>
        <?php
        $result = pg_query($db_handle, "SELECT * from suppliers where supplierid = " .$supplierid);
        while ($row = pg_fetch_assoc($result)) {
            ?>

            <input type="hidden" id="iname" name="supplierid" value='<?php echo $row['supplierid']; ?>' >
            <input type="hidden" id="iname" name="isavailable" value='<?php echo $row['isavailable']; ?>' >

            <label for="sname">Supplier Name</label>
            <input type="text" name="suppliername" value='<?php echo $row['suppliername']; ?>'  placeholder='suppliername' >
            <br>

            <label for="iname">Ingredient Name</label>
            <input type="text" name="ingredientname" value='<?php echo $row['ingredientname']; ?>' placeholder="ingredientname..">
            <br>

            <label for="pname">Price</label>
            <input type="text" name="baseprice" value='<?php echo $row['baseprice']; ?>' placeholder="price..">
            <br>

            <label for="rname">Region Name</label>
            <input type="text" name="region" value='<?php echo $row['region']; ?>' placeholder="Regionname.."><br>

            <label for="qname">Quality</label>
            <input type="text" id="qname" name="quantity"
                   value='<?php echo $row['quantity']; ?>' placeholder="Quantity.."><br>

            <input type="submit" value="Submit">

            <?php
        }

        ?>
    </form>
</div>


</body>
</html>
