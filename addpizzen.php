<?php
/*
* Project Name: Pizza House
* Developed by Fowzia Abida
*/
require 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pizzaname = test_input($_POST["pizzaname"]);
    $baseprice = test_input($_POST["baseprice"]);

    pg_query($db_handle, "SELECT addpizzen('{$pizzaname}','{$baseprice}')");
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
    <h2>Add Pizzen</h2><br>

    <div class="breadcrumb">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li><a href="pizzabaker.php">Pizza maker</a></li>
            <li>Add Pizza</li>
        </ul>
    </div>
    <br>

    <form action="" method='POST'>

        <label for="sname">Pizza Name</label>
        <input type="text" name="pizzaname" required
               placeholder="Pizza Name.">

        <label for="pname">Price</label>
        <input type="text" name="baseprice" required placeholder="price.."><br>

        <input type="submit" value="Submit">
    </form>
</div>

<br>

</body>
</html>

