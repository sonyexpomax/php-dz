<?php
$m=1;
$j=0;
echo "<br />Элементы  больше ноля и у которых не парный индекс<br />";
for ($i = 1; $i <= 10; $i++){
    $array[$i] = rand(1, 100);
    if ($array[$i]>0 and $i%2==0){
        $m=$m*$array[$i];
    }
    if ($array[$i]>0 and $i%2!=0){
        echo "$i => $array[$i]<br />";
    }
}
echo "<br />Исходный массив <br />";
echo "<pre>";
print_r($array);
echo "</pre>";
echo "<br />произведение элементов, которые больше ноля 
            и у которых парные индексы равно <b>$m</b><br />";
?>