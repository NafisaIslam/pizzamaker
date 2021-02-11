<?php

require 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["ingredientlist"])){
        $pizzaid = $_POST["pizzaid"];
        $baseprice = $_POST["baseprice"];
        $pizzasize = $_POST["pizzasize"];

        $checkbox = $_POST["ingredientlist"];

        /*
         * calculating the total price
         * */

        $totalPrice = (int) $baseprice;
        foreach($checkbox as $chk1)
        {
            $resultForPrice =  pg_query($db_handle, "SELECT * FROM ingredients WHERE ingredientid = ".$chk1);
            if($resultForPrice){
                $value = pg_fetch_assoc($resultForPrice);
                $totalPrice = (int) $totalPrice + (int) $value['baseprice'];
            }
        }

        $ingredientlist = $checkbox;

        $ingredientlist_temp="ARRAY[";

        $numItems = count($ingredientlist);
        $i = 0;
        foreach($ingredientlist as $chk1)
        {

            if(++$i === $numItems) {
                $ingredientlist_temp .= "'". $chk1."'";
            }else{
                $ingredientlist_temp .= "'". $chk1."',";
            }
        }
        $ingredientlist_temp.="]";

        //echo '<pre>'; print_r($ingredientlist_temp); echo '</pre>';
        $result = pg_query($db_handle, "SELECT addorder('{$pizzaid}', '{$totalPrice}','{$pizzasize}', $ingredientlist_temp)");
        if($result){
            echo "<div style='text-align:center'>";
            echo "Order Placed!<br>";
            echo "<a href='customerview.php'>Homepage</a></div>";
        }
    }else{
        echo "Please select an ingredients!";
        echo "<a href='customerview.php'>Back</a></div>";
    }

}
?>

