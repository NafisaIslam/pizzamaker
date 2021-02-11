<?php
/*
* Project Name: Pizza House
* Developed by Nafisa Islam
*/
require 'dbconnection.php';

$pizzasize_post="";
$pizzaid_post ="";
$pizzaname_post ="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pizzasize_post = $_POST["pizzasize"];
    $pizzaid_post = $_POST["pizzaid"];
    $pizzaname_post = $_POST["pizzaname"];
    $baseprice_post = $_POST["baseprice"];
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
    <h2 class="headl">Ingredient List</h2>
    <div class="breadcrumb">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li><a href="customerview.php">Customerview</a></li>
            <li>Ingredient List</li>
        </ul>
    </div>

    <h3 class="headsubtitle"><?php echo "Pizza Name: $pizzaname_post" ?></h3>
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
            $result3 = pg_query($db_handle, "SELECT * from ingredients where isavailable = 1 and pizzaid = " . $pizzaid_post);
            $count = 0;
            while ($row3 = pg_fetch_assoc($result3)) {
                echo "<tr>";
                echo "<td>" . $row3['ingredientname'] . "</td>";
                echo "<td>" . $row3['regionname'] . "</td>";

                echo "<td>" . $row3['baseprice'] . "</td>";

                echo "<input type='hidden' name='pizzaid' value=".$row3['pizzaid']." />";
                echo "<input type='hidden' id='pizzaprice' name='baseprice' value=".$baseprice_post." />";
                echo "<input type='hidden' id='ingredientprice' value=".$row3['baseprice']." />";
                echo "<td><a class='action-button'><input onclick='updateprice({$row3['baseprice']}, this)' type='checkbox' name='ingredientlist[]' value=".$row3['ingredientid']." /></a></td>";
                echo "</td></tr>\r\n";
            }
            ?>
            <input type="hidden" name="pizzasize" value="<?php echo $pizzasize_post; ?>">
        </table>
        <h4><?php echo $pizzaname_post . " Price: &euro;".$baseprice_post ?></h4>
        <h4><?php echo $pizzaname_post . " Price: &euro; <span id='ingredientstotal'></span>" ?></h4>
        <h4><?php echo "Total Amount: &euro; <span id='totalamount'></span>" ?></h4>

        <br><input type="submit" value="Create Order" style="width: 200px">
    </form>

    <script>
        var ingredientstotal = 0;
        var totalAmount = 0;
        function updateprice(price, param) {
            if(param.checked == true){
                console.log('true');
                ingredientstotal = ingredientstotal + (parseInt(price));
                document.getElementById('ingredientstotal').innerText = ingredientstotal;

                totalAmount = ingredientstotal + (parseInt(document.getElementById('pizzaprice').value));
                document.getElementById('totalamount').innerText = totalAmount;
            }
            else{
                ingredientstotal = ingredientstotal - (parseInt(price));
                document.getElementById('ingredientstotal').innerText = ingredientstotal;
                console.log('false');

                totalAmount = ingredientstotal + (parseInt(document.getElementById('pizzaprice').value));
                document.getElementById('totalamount').innerText = totalAmount;
            }


        }
    </script>
    </body>

</html>