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

$ingredientid = 0;
if(isset($_GET['ingredientid'])){
  $ingredientid = $_GET['ingredientid'];
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

<form action="/action_page.php">
<?php
 $result = pg_query($db_handle, "SELECT * from ingredients where ingredientid = ".$ingredientid );

 $result_status = pg_result_status($result);
 if($result_status === PGSQL_COMMAND_OK || $result_status === PGSQL_TUPLES_OK)
 {
 $numfields = pg_num_fields($result);
 $numrows = pg_num_rows($result);

 for($ri = 0; $ri < $numrows; $ri++)
 {
  foreach(pg_fetch_row($result, $ri) as $value)
  echo $value;
 ?>
    <label for="sname">Supplier Name</label>
    <input type="text" id="sname" name="supname" value=<?php echo $value; ?> placeholder="supplier name.."><br>

    <label for="iname">Ingredient</label>
    <input type="text" id="iname" name="igname" value=<?php echo $value; ?> placeholder="ingredient name.."><br>

    <label for="pname">Price</label>
    <input type="text" id="pname" name="pricename" value=<?php echo $value; ?> placeholder="price.."><br>

    <input type="submit" value="Submit">
  
 <?php
 }
}
?>
</form>
</div>


</body>
</html>
