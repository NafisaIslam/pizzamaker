<?php
/*
* Project Name: Pizza House
* Developed by Fowzia Abida
*/
require 'dbconnection.php';

$pizzaid = 0;
if (isset($_GET['pizzaid'])) {
    $pizzaid = $_GET['pizzaid'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pizzaid = test_input($_POST["pizzaid"]);
    $pizzaname = test_input($_POST["pizzaname"]);
    $baseprice = test_input($_POST["baseprice"]);

    pg_query($db_handle, "SELECT editpizzen('{$pizzaid}','{$pizzaname}','{$baseprice}')");
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
    <h2>Edit Pizza</h2><br>
    <div class="breadcrumb">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li><a href="pizzabaker.php">Pizza maker</a></li>
            <li>Edit Pizza</li>
        </ul>
    </div>
    <br>
    <form action="" method='POST'>
        <?php
        $result = pg_query($db_handle, "SELECT * from pizzen where pizzaid = " .$pizzaid);
        while ($row = pg_fetch_assoc($result)) {
            ?>

            <input type="hidden" name="pizzaid" value='<?php echo $row['pizzaid']; ?>' >
            <label for="sname">Pizza Name</label>
            <input type="text" name="pizzaname" value='<?php echo $row['pizzaname']; ?>'  placeholder='Pizza Name' >
            <br>

            <label for="rname">Base Price</label>
            <input type="text" name="baseprice" value='<?php echo $row['baseprice']; ?>' placeholder="Base Price.."><br>

            <input type="submit" value="Submit">

            <?php
        }

        ?>
    </form>
</div>

<p>Developed By Nafisa Islam</p>

</body>
</html>
