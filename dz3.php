<?php
$n=24;
echo "n = $n<br /><br />";
//---------------------------  Задание 1  ------------
echo "<b>Задание 1</b><br />";
for ($i=1; $i<=$n; $i++){
    echo "$i. Silence is golden<br />";
}

//---------------------------  Задание 2 FOR ------------
echo "<b>Задание 2</b><br />";
$s=0;
for ($i=1; $i<=150; $i++){
    $s=$s+$i;
//    echo "иттерация  $i). $s<br />";
}
echo "Cумма чисел в диапазоне от 1 до 150 (FOR) = $s<br/>";

//---------------------------  Задание 2 while ------------
$s=0;
$i=1;
while ($i<=150){
    $s=$s+$i;
//    echo "иттерация  $i). $s<br />";
    $i++;
}
echo "Cумма чисел в диапазоне от 1 до 150 (while) = $s<br/>";

//---------------------------  Задание 3 ------------
echo "<b>Задание 3</b><br />";
for ($i=1; $i<=200; $i++){
    echo "N - $i<br />";
}

//---------------------------  Задание 4 for------------
echo "<b>Задание 4</b><br />";
echo "Числа в последовательности от 200 до 1 (for)<br/>";
echo "<table>
        <tr>
            <th>FOR</th>
            <th>WHILE</th>
            <th>foreach</th>
        <tr>
            <td>";
for ($i=200; $i>=1; $i--){
    echo "$i<br />";
}
echo "</td>
      <td>";
$i=200;
//---------------------------  Задание 4 while------------
while ($i>=1){
    echo "$i<br />";
    $i--;
}
echo "</td>
      <td>";
//---------------------------  Задание 4 foreach------------
foreach (range(200, 1) as $i) {
    echo "$i<br />";
}
echo "</td>
    </tr>
  </table>";

//---------------------------  Задание 5 FOR ------------
echo "<b>Задание 5</b><br />";
$s=1;
for ($i=1; $i<=50; $i++){
    $s=$s*$i;
//    echo "иттерация  $i). $s<br />";
}
echo "произведение чисел от 1 до 50 (FOR) = $s<br/>";

//---------------------------  Задание 5 foreach ------------
$s=1;
foreach (range(1, 50) as $i) {
    $s=$s*$i;
//    echo "иттерация  $i). $s<br />";
}
echo "произведение чисел от 1 до 50 (FOREACH) = $s<br/>";


//---------------------------  Задание 6 FOR ------------
echo "<b>Задание 6</b><br />";
echo "<table>
        <tr>
            <th>FOR</th>
            <th>WHILE</th>
        <tr>
            <td>";
$s=1;
for ($i=1; $i<1000; $i++){
    if ($i%3==0 and $i%5==0) {
        echo "$i<br />";
    }
}
echo "</td>
      <td>";
//---------------------------  Задание 6 while ------------
$i=1;
while ($i<1000){
    if ($i%3==0 and $i%5==0) {
        echo "$i<br />";
    }
    $i++;
}
echo "</td>
    </tr>
  </table>";

//---------------------------  Задание 7 -------------
//переделал обращение к каждому  симоволу строки
echo "<b>Задание 7</b><br />";
$s=0;
for ($i=100000; $i<103999; $i++) {      //сузил немного диапазон, уж очень долго перебирает!!
    $j = (string) $i;                   //перевел в строку все заданное число
    $sum_first_3=$j[0]+$j[1]+$j[2];     //переделал
    $sum_last_3=$j[3]+$j[4]+$j[5];
    if($sum_first_3== $sum_last_3) {
        echo "$i<br />";
        $s++;
    }
    $s1++;
}
$p=round((100*$s/$s1),2);
echo "Количество счастливых билетов в заданном диапазоне - $s<br />";
echo "процент счастливых билетов от общего числа - $p<br />";

//---------------------------  Задание 8 for-------------
unset($n);
echo "<b>Задание 8</b><br />";
for ($i=0; $i<30; $i++) {
    if ($i % 2 == 0) {
        $n[$i] = 0;
    }
    else{
        $n[$i] = 1;
    }
}
echo "<pre>";
print_r($n);
echo "</pre>";

//---------------------------  Задание 8 while-------------
unset($n);
$i=0;
while($i<30){
    if ($i % 2 == 0) {
        $n[$i] = 0;
    }
    else{
        $n[$i] = 1;
    }
    $i++;
}
echo "<pre>";
print_r($n);
echo "</pre>";
//---------------------------  Задание 9 -------------
unset($n);
echo "<b>Задание 9</b><br />";
for ($i=1; $i<30; $i++) {
        $n[$i] = pow($i,2);
}
echo "<pre>";
print_r($n);
echo "</pre>";

//---------------------------  Задание 10 -------------
//переделал сортировку (разобрался как работает)
unset($n);
echo "<b>Задание 10</b><br />";
$array1 = array(1,5,6,8,13,14,15,80);
$array2 = array(0,2,5,12,65,68,70,71);
$r_both=array_merge($array1, $array2);
asort($r_both);
echo "<pre>";
print_r($r_both);
echo "</pre>";

//---------------------------  Задание 11 -------------
//переделал unset одной строкой
// переделал case в массивы. да. так намоного приятнее читать код
unset($n);
$n=6324561;
echo "<b>Задание 11</b><br />";
echo "n=$n<br>";
$count=strlen($n) ;
$f=$count/3;
$bythree=ceil($f);
$j=1;
//      массивы цифр по разрядам
$edinici = [
    "1" => "один",
    "2" => "два",
    "3" => "три",
    "4" => "четыре",
    "5" => "пять",
    "6" => "шесть",
    "7" => "семь",
    "8" => "восемь",
    "9" => "девять",
];
$desyatki = [
    "2" => "двадцать",
    "3" => "тридцать",
    "4" => "сорок",
    "5" => "пятьдесят",
    "6" => "шестьдесят",
    "7" => "семьдесят",
    "8" => "восемдесят",
    "9" => "девяносто",
];
$sotni = [
    "1" => "сто",
    "2" => "двести",
    "3" => "триста",
    "4" => "четыреста",
    "5" => "пятьсот",
    "6" => "шестьсот",
    "7" => "семьсот",
    "8" => "восемьсот",
    "9" => "девятьсот",
];
$desyatki_1 = [
    "1" => "одиннацать",
    "2" => "двенадцать",
    "3" => "тринадцать",
    "4" => "четырнадцать",
    "5" => "пятнадцать",
    "6" => "шестнадцать",
    "7" => "семнадцать",
    "8" => "восемнадцать",
    "9" => "девятнадцать",
];


for ($i=1;$i<=$bythree;$i++){
    unset($s1,$s2,$s3,$simvol_one,$simvol_two,$simvol_three);
    $simvol_one =   substr($n, $count-$j, 1);
    if(($count-$j+1)>=3){
        $simvol_three = substr($n, $count-$j-2, 1);
        if ($simvol_three>0) {
            $s3=$sotni[$simvol_three];
        }
    }
    if(($count-$j+1)>=2){
        $simvol_two = substr($n, $count-$j-1, 1);
         if ($simvol_two==1){
              $s2=$desyatki_1[$simvol_two];
         }
       if ($simvol_two!=1) {
             $s2=$desyatki[$simvol_two];
        }
    }
    if ($simvol_one<>0 and $simvol_two<>1){
        $s1=$edinici[$simvol_one];
    }
    $s=$s3." ".$s2." ".$s1;
    if ($j==4) {
        if ($simvol_two <> 1) {
            switch ($simvol_one) {
                case '1':
                    $st = "тысяча";
                    break;
                case '2':
                case '3':
                case '4':
                    $st = "тысячи";
                    break;
                case '5':
                case '6':
                case '7':
                case '8':
                case '9':
                case '0':
                    $st = "тысяч";
                    break;
            }
        }
        if ($simvol_two == 1) {
            $st = "тысяч";
        }
        if ($simvol_one == 0 and $simvol_two == 0 and $simvol_three == 0) {
            $st = " ";
        }
        $s = $s . " " . $st;
    }
    if ($j==7) {
       if ($simvol_two <> 1) {
            switch ($simvol_one) {
                case '1':
                    $sm = "миллон";
                    break;
                case '2':
                case '3':
                case '4':
                    $sm = "миллона";
                    break;
                case '5':
                case '6':
                case '7':
                case '8':
                case '9':
                case '0':
                    $sm = "миллонов";
                    break;
            }
        }
        if ($simvol_two == 1) {
            $sm = "миллонов";
        }
        if ($simvol_one == 0 and $simvol_two == 0 and $simvol_three == 0) {
            $sm = " ";
        }
        $s = $s . " " . $sm;
    }
$sb=$s." ".$sb;
    $j=$j+3;
}

echo "$sb<br>";
//---------------------------  Задание 12 -------------
//переделал. не внимательно читал задание. теперь ок.
echo "<b>Задание 12</b><br />";
$array11=range('a','z');
$t=1;
foreach ($array11 as $i){
    if ($t%2==0){
        echo "$i<br>";
    }
    else{
        echo " $i";
    }
    $t++;
}
