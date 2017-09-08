<?php
$arr = ['green'=>'зеленый', 'red'=>'красный','blue'=>'голубой'];
foreach ($arr as $keys => $values){
    $ru[]=$values;
    $en[]=$keys;
}
echo"<pre>";
print_r($ru);
echo"</pre>";

echo"<pre>";
print_r($en);
echo"</pre>";
?>