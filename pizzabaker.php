<?php
require 'dbconnection.php';
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
    <link rel="stylesheet" href="style.css">
</head>

<body>
     <h2 class = "headl">Pizza Maker Homepage</h2>
     <div class="breadcrumb">
         <ul class="breadcrumb">
             <li><a href="index.html">Home</a></li>
             <li>Pizza maker</li>
         </ul>
     </div>

     <br><br><h2 class= "headl">Order List </h2>
     <br><table>
         <tr> 
             <th> Order Id</th>
             <th> Pizza Name</th>
             <th> Pizza Size</th>
             <th> Ingredient List</th>
             <th> Total Price</th>
             <th> Action</th>
         </tr>
         <?php 
            $result3 = pg_query($db_handle, "SELECT *from orders WHERE iscomplete = 0");

         while($row3 = pg_fetch_assoc($result3) )
         {
             echo "<tr>";
             echo "<td>" . $row3['orderid'] . "</td>";

             $pizzaNameResult = pg_query($db_handle, "SELECT *from pizzen WHERE pizzaid = ". $row3['pizzaid']);
             if($pizzaNameResult){
                 $pizzaNameRow = pg_fetch_assoc($pizzaNameResult);
                 echo "<td>" . $pizzaNameRow['pizzaname'] . "</td>";
             }else{
                 echo "<td>" . $row3['pizzaid'] . "</td>";
             }


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

             /*
              * Getting all the name of the ingredient from the ingredientlist
              * -- Using ingredientlist[] from the order table
              * */
             $ingredientListString = "";
             $ingredientListArray = json_decode(str_replace(['{', '}'], ['[', ']'], $row3['ingredientlist']));  // [[1,2],[3,4]]
             foreach ($ingredientListArray as $ingredient){
                 $ingredientNameResult = pg_query($db_handle, "SELECT * from ingredients WHERE ingredientid = ". $ingredient);
                 if($ingredientNameResult){
                     $ingredientName = pg_fetch_assoc($ingredientNameResult);
                     $ingredientListString .= $ingredientName['ingredientname']. ", ";
                 }else{
                     $ingredientListString .= "";
                 }
             }

             echo "<td>" . $ingredientListString . "</td>";
             echo "<td>" . $row3['totalprice'] . "</td>";
             echo "<td><a class='action-button' href='bakecomplete.php?orderid={$row3['orderid']}'>Complete Order!</a></td>";
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
                echo "<a class='action-button' href='restockingredientform.php?ingredientname={$row['ingredientname']}&ingredientid={$row['ingredientid']}'> Restock </a>
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

             if ($row1['isavailable'] == 1)
             {
                 echo "<td> Available </td>";
             }
             else
             {
                 echo "<td> Unavailable </td>";
             }

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
             echo "</td></tr>\r\n";
         }

         ?>
     </table>
</body>

</html>