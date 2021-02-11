<?php
require 'dbconnection.php';


// if(pg_connection_status($db_handle) === PGSQL_CONNECTION_OK)
// {
//   echo "The connection to the database has been established.<br/>\r\n";
//   //var_dump($db_handle);
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap ">
    <link rel="stylesheet" href="style.css">
</head>

<body class="boxsize">
<h2 class="headl">Pizza House! </h2>
<div class="breadcrumb">
    <ul class="breadcrumb">
        <li><a href="index.html">Home</a></li>
        <li><a href="#">Customerview</a></li>
    </ul>
</div>
<br>

    <table>
        <tr>
            <th> Pizza Name</th>
            <th> Price</th>
            <th> Pizza Size</th>
            <th> Select Pizza</th>
        </tr>
        <?php
        $result3 = pg_query($db_handle, "SELECT *from Pizzen");

        while ($row3 = pg_fetch_assoc($result3)) {
            echo "<tr><form method='POST' action='showingredientlist.php'>";
            echo "<td>" . $row3['pizzaname'] . "</td>";
            echo "<td>&euro;" . $row3['baseprice'] . "</td>";

            echo "
         <td>
           <select name='pizzasize' value='1'>
              <option value='1'>Large</option>
              <option value='2'>Medium</option>
              <option value='3'>Small</option>
            </select>
         </td>";
            echo "<input type='hidden' name='pizzaid' value='{$row3['pizzaid']}'>";
            echo "<input type='hidden' name='pizzaname' value='{$row3['pizzaname']}'>";
            echo "<input type='hidden' name='baseprice' value='{$row3['baseprice']}'>";
            echo "<td><input class='action-button' type='submit' value='Check Ingredients!' /></td>";
            echo "</td></tr></form>\r\n";
        }
        ?>
    </table>
</body>

</html>