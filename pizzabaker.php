<?php
$host = "pgsql.hrz.tu-chemnitz.de";
$port = "5432"; 
$databaseName = "pizza_maker01";
$userName = "pizza_maker01_rw";
$password = "aeHoh6uaju";
$tableName1 = "orders";
$tableName2 = "ingredients";
$tableName3 = "suppliers";

$db_handle = pg_connect("host=" . $host . " port=" . $port . " dbname=" . $databaseName . " user=" . $userName . " password=" . $password) or die("Die Verbindung konnte nicht aufgebaut werden.");

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css ">
</head>

<body>
     <h2 class = "headl">Order List </h2>
     <br><table>
         <tr> 
             <th> Order Id</th>
             <th> Pizza Name</th>
             <th> Pizza Size</th>
             <th> Total Price</th>
         </tr>
         <?php 
            $result = pg_query($db_handle, "SELECT *from " . $tableName1);

            $result_status = pg_result_status($result);
            if($result_status === PGSQL_COMMAND_OK || $result_status === PGSQL_TUPLES_OK)
            {
            $numfields = pg_num_fields($result);
            $numrows = pg_num_rows($result);

            for($ri = 0; $ri < $numrows; $ri++)
            {
            echo "<tr>";
            foreach(pg_fetch_row($result, $ri) as $value)
                echo "<td>" . $value . "</td>";
            echo "</tr>\r\n";
            }
        }
         ?>
     </table>


     <br><br><h2 class= "headl">Ingredients List </h2>
     <ul class='navman'>
         <li>
             <a class='action-button' href="addingerient.php">Add Ingredient</a>
         </li>
         <br>
         <li>
             <a class='action-button' href="restockingredient.php">Restock</a>
         </li>
     </ul>
     <br><table>
         <tr> 
             <th> Ingredient Name</th>
             <th> Price</th>
             <th> Quantity</th>
             <th> Status</th>
             <th> Action</th>
         </tr>
         <?php 
            $result = pg_query($db_handle, "SELECT ingredientname,baseprice,quantity, isavailable, ingredientid from  " . $tableName2);

            $result_status = pg_result_status($result);
            if($result_status === PGSQL_COMMAND_OK || $result_status === PGSQL_TUPLES_OK)
            {
            $numfields = pg_num_fields($result);
            $numrows = pg_num_rows($result);

            for($ri = 0; $ri < $numrows; $ri++)
            {
            echo "<tr>";
            foreach(pg_fetch_row($result, $ri) as $value)
                echo "<td>" . $value . "</td>";
                echo "<td><a class='action-button' href='editingredient.php?ingredientid={$value}'> Edit </a> / <a class='action-button' href='removeingredient.php'> Remove </a>/
                <a class='action-button' href='hideorshow.php'>hide or show</a>
                </td>";
                echo "</tr>\r\n";
            }
        }
         ?>
     </table>



     <br><br><h2 class= "headl">Suppliers List </h2>
     <br><table>
         <tr> 
             <th> Supplier Name</th>
             <th> Ingredient Name</th>
             <th> Price</th>
             <th> Status</th>
         </tr>
         <?php 
            $result = pg_query($db_handle, "SELECT suppliername	,ingredientname	,baseprice,isavailable from " . $tableName3);

            $result_status = pg_result_status($result);
            if($result_status === PGSQL_COMMAND_OK || $result_status === PGSQL_TUPLES_OK)
            {
            $numfields = pg_num_fields($result);
            $numrows = pg_num_rows($result);

            for($ri = 0; $ri < $numrows; $ri++)
            {
            echo "<tr>";
            foreach(pg_fetch_row($result, $ri) as $value)
                echo "<td>" . $value . "</td>";
            echo "</tr>\r\n";
            }
          }
         ?>
     </table>
</body>

</html>