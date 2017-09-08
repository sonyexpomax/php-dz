<?php
//не понял какую именно строку выводить. вывел обе
$arr = [1, 2, 3, 4, 5, 6, 7, 8, 9];
echo "-";
foreach ($arr as $value){
  echo $value."-";
}
echo "<br />";
foreach ($arr as $value){
    echo $value."";
}
?>