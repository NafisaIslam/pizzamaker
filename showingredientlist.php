<?php
require 'dbconnection.php';

$pizzasize_post="";
$pizzaid_post ="";
$pizzaname_post ="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pizzasize_post = $_POST["pizzasize"];
    $pizzaid_post = $_POST["pizzaid"];
    $pizzaname_post = $_POST["pizzaname"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap ">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css ">
</head>

<body class="boxsize">
    <h2 class="headl">Ingredients</h2>
    <h3 class="headsubtitle"><?php echo "Pizza Name: $pizzaname" ?></h3>
    <br>
    <form method="POST" action="createorder.php">
        <table>
            <tr>
                <th> Ingredient Name</th>
                <th> Region Name</th>
                <th> Price</th>
                <th> Add</th>
            </tr>

            <?php
            $result3 = pg_query($db_handle, "SELECT *from ingredients where pizzaid = " . $pizzaid);
            $count = 0;
            while ($row3 = pg_fetch_assoc($result3)) {
                echo "<tr>";
                echo "<td>" . $row3['ingredientname'] . "</td>";
                echo "<td>" . $row3['regionname'] . "</td>";
                echo "<td>" . $row3['baseprice'] . "</td>";

                echo "<td><input type='hidden' name='pizzaid' value=".$row3['pizzaid']." /></td>";
                echo "<td><input type='hidden' name='baseprice' value=".$row3['baseprice']." /></td>";
                echo "<td><a class='action-button'><input type='checkbox' name='ingredientlist[]' value=".$row3['ingredientid']." /></a></td>";
                echo "</td></tr>\r\n";
            }
            ?>
            <input type="hidden" name="pizzasize" value="<?php echo $pizzasize_post; ?>">
            <input type="submit" value="Create Order">
        </table>
    </form>

    </body>

</html>