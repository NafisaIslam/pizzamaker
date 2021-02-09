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
            $result3 = pg_query($db_handle, "SELECT *from orders");

         while($row3 = pg_fetch_assoc($result3) )
         {
             echo "<tr>";
             echo "<td>" . $row3['orderid'] . "</td>";
             echo "<td>" . $row3['pizzaid'] . "</td>";

             if ($row3['pizzasize'] == 3 )
             {
                 echo "<td> Small </td>";
             }
             else if ($row3['pizzasize'] == 2)
             {
                 echo "<td> Medium </td>";
             }
             else
             {
             echo "<td> Large</td>";
             }

             echo "<td>" . $row3['totalprice'] . "</td>";
             echo "</td></tr>\r\n";
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
            $result = pg_query($db_handle, "SELECT *from  ingredients" );

            while($row = pg_fetch_assoc($result) )
            {
                echo "<tr>";
                echo "<td>" . $row['ingredientname'] . "</td>";
                echo "<td>" . $row['baseprice'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                if ($row['isavailable'] == 1)
                {
                    echo "<td> Available </td>";
                }
                else
                {
                    echo "<td> Unavailable </td>";
                }

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
     <ul class='navman'>
         <li>
             <a class='action-button' href="addsupplier.php">Add Supplier</a>
         </li>
     </ul>
     <br><table>
         <tr> 
             <th> Supplier Name</th>
             <th> Ingredient Name</th>
             <th> Price</th>
             <th> Status</th>
             <th> Action</th>
         </tr>
         <?php 
            $result1 = pg_query($db_handle, "SELECT  *from suppliers");

         while($row1 = pg_fetch_assoc($result1) )
         {
             echo "<tr>";
             echo "<td>" . $row1['suppliername'] . "</td>";
             echo "<td>" . $row1['ingredientname'] . "</td>";
             echo "<td>" . $row1['baseprice'] . "</td>";
             echo "<td>" . $row1['isavailable'] . "</td>";

             echo "<td><a class='action-button' href='editsupplier.php?supplierid={$row1['supplierid']}'> Edit </a>/ 

                <a class='action-button' href='removesupplier.php?supplierid={$row1['supplierid']}'> Remove </a>/
                 ";
             if ($row1['isavailable'] == 0)
             {
                 echo "<a class='action-button' href='showsupplier.php?supplierid={$row1['supplierid']}'>Show</a> /";
             }
             else
             {
                 echo "<a class='action-button' href='hidesupplier.php?supplierid={$row1['supplierid']}'>Hide</a>/
                ";
             }
             echo "<a class='action-button' href='restocksupplierform.php?supplierid={$row1['supplierid']}'> Restock </a>
                 ";
             echo "</td></tr>\r\n";
         }

         ?>
     </table>
</body>

</html>