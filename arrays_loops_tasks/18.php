<?php
$days = [
    1 =>'Понедельник' ,
    2 =>'Вторник' ,
    3 =>'Среда' ,
    4 =>'Четверг' ,
    5 =>'Пятница' ,
    6 =>'Суббота' ,
    7 =>'Воскресенье'
];

foreach ($days as $keys => $values){
    if ($keys==7 or $keys==6 ){
        echo "<b>$values</b><br />";
    }
    else{
        echo "$values<br />";
    }
}
?>

