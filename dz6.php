<!--//---------------------------  Задание 1  ------------------------------->
<html>
    <b>Задание 1</b><br />
    <form action="dz6.php" method="post">
    Введите число:          <input type="text" name="num" required><br />
    Введите степень:        <input type="text" name="stepen" required><br />
                            <input type="submit" value="Найти">
    </form>
<?php
function vozved_v_stepen($num, $stepen=2)
{
    for ($i = 1, $result = 1; $i <= $stepen; $i++) {
        $result = $result * $num;
    }
    return $result;
}

if ($_POST['num']) {
    $num = $_POST['num'];
    $stepen = $_POST['stepen'];
    echo "Число $num при возведении в степень $stepen равно " . vozved_v_stepen($num, $stepen)."<br />";
}
?>

<!--//----------------------------  Задание 2  ----------------------------->
<br /><b>Задание 2</b><br />
<form action="dz6.php" method="post">
    Введите начало диапазона: <input type="text" name="diap_start" required><br />
    Введите конец диапазона:  <input type="text" name="diap_end" required><br />
    Введите кол-во элементов: <input type="text" name="c" required><br />
                              <input type="submit" value="Найти">
</form>

<?php
function sozdanie_massiva($diap_start, $diap_end, $count)
{
    for ($i = 0; $i < $count; $i++) {
        $mass[$i]=rand($diap_start,$diap_end);
    }
    return $mass;
}
if ($_POST['diap_start']) {
    $diap_start = $_POST['diap_start'];
    $diap_end = $_POST['diap_end'];
    $c= $_POST['c'];
    echo "Созданный массив: <pre>".print_r(sozdanie_massiva($diap_start, $diap_end, $c),1)."</pre>";
}

//----------------------------  Задание 3  ----------------------------->
echo "<br /><b>Задание 3</b><br />";
function elem_sum($mass){
    $sum=0;
    foreach ($mass as $value){
        $sum=$sum+$value;
    }
    return $sum;
}
$mass = [5,3,7,10];
echo "<font color='green'>Дан массив ". print_r($mass,1)."</font><br />";
echo "<font color='blue'>Cумма элементов целочисленного массива равна ".elem_sum($mass)."</font><br />";

//----------------------------  Задание 4  ----------------------------->
echo "<br /><b>Задание 4</b><br />";

$max=0;
$i_max=0;
for ($i=1;$i<=10;$i++){
    $mass_{$i} = sozdanie_massiva(10, 99, 10);     //создаем массив
    echo "Массив $i : ";
    print_r($mass_{$i});
    echo "<br />";
    $current_max=elem_sum($mass_{$i});              // находим сумму элементов массива
    if ($current_max > $max){
        $max=$current_max;
        $i_max=$i;
    }
    //print_r($mass_{$i});
}
echo "<br /><font color='green'>Массив с максимальной суммой элементов № $i_max (сумма элелментов равна $max) - </font>";
print_r($mass_{$i_max});

//----------------------------  Задание 5  ----------------------------->
echo "<br /><b>Задание 5</b><br />";
$str='rrrrrrrrrrrrrrr';
function str_add(&$str){
    $str=$str."functioned!";
    echo $str;
}
$str='wwwwwwwwwwwwwwww';
str_add($str);

//----------------------------  Задание 6  ----------------------------->
echo "<br /><b>Задание 6</b><br />";
function echo_num($num){
    if($num!=1){
        echo_num($num-1);
    }
    echo $num." ";
}
echo_num(15);
?>









</html>
