<?php
require 'dbconnection.php';
$tableName1 = "orders";
$tableName2 = "ingredients";
$tableName3 = "suppliers";


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
            $result = pg_query($db_handle, "SELECT orderid, pizzaid, pizzasize,totalprice from " . $tableName1);

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
             <a class='action-button' href="addingredient.php">Add Ingredient</a>
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

            while($row = pg_fetch_assoc($result) )
            {
                echo "<tr>";
                echo "<td>" . $row['ingredientname'] . "</td>";
                echo "<td>" . $row['baseprice'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>" . $row['isavailable'] . "</td>";

                echo "<td><a class='action-button' href='editingredient.php?ingredientid={$row['ingredientid']}'> Edit </a>/ 

                <a class='action-button' href='removeingredient.php?ingredientid={$row['ingredientid']}'> Remove </a>/
                 ";
                 if ($row['isavailable'] == 0)
                 {
                echo "<a class='action-button' href='showingredient.php?ingredientid={$row['ingredientid']}'>Show</a> /";
                 }
                else 
                {
                echo "<a class='action-button' href='hideingredient.php?ingredientid={$row['ingredientid']}'>Hide</a>/
                ";
                }
                echo "<a class='action-button' href='restockingredientform.php?ingredientid={$row['ingredientid']}'> Restock </a>
                 ";
                echo "</td></tr>\r\n";
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
            $result = pg_query($db_handle, "SELECT suppliername,ingredientname,baseprice,isavailable from " . $tableName3);

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