<?php

require 'dbconnection.php';




function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
        ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pizzaid = $_POST["pizzaid"];
    $baseprice = $_POST["baseprice"];
    $pizzasize = $_POST["pizzasize"];
    $checkbox = $_POST["ingredientlist"];
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
    $result = pg_query($db_handle, "SELECT addorder('{$pizzaid}', '{$baseprice}',{$pizzasize}, $ingredientlist_temp)");
    if($result){
        echo "Order Placed!<br>";
        echo "<a href='customerview.php'>Homepage</a>";
    }
}
?>