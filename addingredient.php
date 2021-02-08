<?php
require 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pizzaid = test_input($_POST["pizzaid"]);
    $ingredientname = test_input($_POST["ingredientname"]);
    $baseprice = test_input($_POST["baseprice"]);
    $regionname = test_input($_POST["regionname"]);
    $quantity = test_input($_POST["quantity"]);
    $pizzaid = test_input($_POST["pizzaid"]);
    $supplierid = test_input($_POST["supplierid"]);
    $isavailable = test_input($_POST["isavailable"]);

    pg_query($db_handle, "SELECT addingredient ('{$pizzaid}','{$ingredientname}','{$baseprice}', '{$regionname}','{$quantity}','{$isavailable}','{$supplierid}')");
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
    <h2>Add Ingredients</h2><br>

    <form action="" method='POST'>

        <label for="iname">Pizza Name</label>
        <select name="pizzaid">
            <?php
            $pizzasql = pg_query($db_handle, "SELECT * from pizzen");

            while ($row1 = pg_fetch_assoc($pizzasql)) {
                ?>
                <option value=<?php echo $row1['pizzaid']; ?>><?php echo $row1['pizzaname']; ?></option>
                <?php
            }
            ?>
        </select>
        <br>
        <label for="iname">Ingredient Name</label>
        <input type="text" id="iname" name="ingredientname"
               placeholder="ingredient name.."><br>

        <label for="pname">Ingredient Price</label>
        <input type="text" id="pname" name="baseprice" placeholder="price.."><br>

        <label for="rname">Region Name</label>
        <input type="text" id="rname" name="regionname" placeholder="Region name"><br>

        <label for="qname">Quality</label>
        <input type="text" id="qname" name="quantity" placeholder="Quantity..">
        <br>

        <label for="qname">Available</label>
        <select name="isavailable">
                <option value='1'>True</option>
                <option value='2'>False</option>
        </select>
        <br>

        <label for="iname">Supplier Name</label>
        <select name="supplierid">
            <?php
            $suppliersql = pg_query($db_handle, "SELECT * from suppliers");

            while ($row2 = pg_fetch_assoc($suppliersql)) {
                ?>
                <option value=<?php echo $row2['supplierid']; ?>><?php echo $row2['suppliername']; ?></option>
                <?php
            }
            ?>
        </select>

        <input type="submit" value="Submit">
    </form>
</div>


</body>
</html>
