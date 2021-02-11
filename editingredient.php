<?php
require 'dbconnection.php';

$ingredientid = 0;
if(isset($_GET['ingredientid'])){
  $ingredientid = $_GET['ingredientid'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $ingredientname = test_input($_POST["ingredientname"]);
  $baseprice = test_input($_POST["baseprice"]);
  $regionname = test_input($_POST["regionname"]);
  $quantiy = test_input($_POST["quantity"]);
  $ingredientid = test_input($_POST["ingredientid"]);
  $pizzaid = test_input($_POST["pizzaid"]);
  $supplierid = test_input($_POST["supplierid"]);
  $isavailable = test_input($_POST["isavailable"]);

  pg_query($db_handle, "SELECT editingredients ('{$ingredientid}','{$pizzaid}','{$ingredientname}','{$baseprice}', '{$regionname}','{$quantiy}','{$isavailable}','{$supplierid}')");
}
  function test_input($data) {
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

<div class= "formdata">
<br><h2>Edit Ingredients</h2><br>
    <div class="breadcrumb">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li><a href="pizzabaker.php">Pizza maker</a></li>
            <li>Edit Ingredients</li>
        </ul>
    </div>
    <br>

<form action="" method = 'POST'>
<?php
 $result = pg_query($db_handle, "SELECT * from ingredients where ingredientid = ".$ingredientid );
  while ($row = pg_fetch_assoc($result))
 {
 ?>
    <input type="hidden" id="iname" name="ingredientid" value=<?php echo $row['ingredientid']; ?> >
    <input type="hidden" id="iname" name="pizzaid" value=<?php echo $row['pizzaid']; ?> >
    <input type="hidden" id="iname" name="supplierid" value=<?php echo $row['supplierid']; ?> >
    <input type="hidden" id="iname" name="isavailable" value=<?php echo $row['isavailable']; ?> >
    <?php
      $pizzasql = pg_query($db_handle, "SELECT * from pizzen where pizzaid = " . $row['pizzaid']);
       
      while ($row1 = pg_fetch_assoc($pizzasql))
       {
    ?>

    <label for="pname">Pizza Name</label>
    <input type="text" id="pname" name="pizzaname" value=<?php echo $row1['pizzaname']; ?> placeholder="Pizza name.."><br>
    <?php
      }
    ?>
    <label for="iname">Ingredient</label>
    <input type="text" id="iname" name="ingredientname" value=<?php echo $row['ingredientname']; ?> placeholder="ingredient name.."><br>

    <label for="pname">Price</label>
    <input type="text" id="pname" name="baseprice" value=<?php echo $row['baseprice']; ?> placeholder="price.."><br>

    <label for="rname">Region Name</label>
    <input type="text" id="rname" name="regionname" value=<?php echo $row['regionname']; ?> placeholder="Region name.."><br>
    
    <label for="qname">Quality</label>
    <input type="text" id="qname" name="quantity" value=<?php echo $row['quantity']; ?> placeholder="Quantity.."><br>

    <input type="submit" value="Submit">
  
 <?php
 }

?>
</form>
</div>


</body>
</html>
