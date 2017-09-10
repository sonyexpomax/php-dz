<?php
$str="Lorem ipsumk: dolor sit tamet, bcoabcnsectetup:pr adipi sicingk 65585583 elit. Ad animi at ea facilis iste 
      laudantium bquabcamkb tempore 5346634tenetur voluptas. :Aliquid bnimi assumenda, distinctio eligendi 
      eos inventore iste magni: minima molestiask.";
echo "<b>Строка:</b> <br /><font color='blue'><i>$str</i></font><br /><br />";
//---------------------------  Задание 1  ------------
echo "<b>Задание 1</b><br />";
$sum=0;
$a   = str_word_count($str, 1);
foreach ($a as $value){
   // echo "$value[0]<br />";
    if ($value[0]=='b'){
        $sum++;
    }
}
echo "количество слов, начинающихся с буквы b = $sum<br />";

//---------------------------  Задание 2  ------------
echo "<br /><b>Задание 2</b><br />";
$len=strlen($str);
for ($i=0;$i<=$len;$i++){
    switch ($str[$i]){
        case "r":$b['r']++;
            break;
        case "k":$b['k']++;
            break;
        case "t":$b['t']++;
            break;
    }
}
echo "Количество букв \"r\" - $b[r], \"k\" - $b[k], \"t\" - $b[t]<br />";

//---------------------------  Задание 3  ------------
echo "<br /><b>Задание 3</b><br />";
$sum=0;
$max=0;
$min=1000;
$arr = str_word_count($str, 1);
foreach ($arr as $value){
    $len=strlen($value);
    if ($len>$max){
        $max=$len;
    }
    if ($len<$min){
        $min=$len;
    }
}
echo " длина самого короткого слова = $min и самого длинного слова = $max<br />";

//---------------------------  Задание 4  ------------
echo "<br /><b>Задание 4</b><br />";
$i=0;
while($str[$i]!=":"){
    $i++;
}
echo "$i cимволов предшествует знаку \":\"<br />";

//---------------------------  Задание 5  ------------
echo "<br /><b>Задание 5</b><br />";
echo "В данной строке содержиться ".substr_count($str, 'abc')." раза построка \"abc\"<br />";

//---------------------------  Задание 6  ------------
echo "<br /><b>Задание 6</b><br />";
$str_count = count_chars($str,1);
foreach ($str_count as $key => $value)
{
    echo "Симол <b>'".chr($key)."'</b> встречается $value раза<br>";
}

//---------------------------  Задание 7  ------------
echo "<br /><b>Задание 7</b><br />";
$sum=0;
$a   = str_word_count($str, 1);
foreach ($a as $value){
    $len=strlen($value);
    if ($value[0]==$value[$len-1]){
       echo "$value<br />";
    }
}

//---------------------------  Задание 8  ------------
echo "<br /><b>Задание 8</b><br />";
$str3=str_replace(':',';',$str, $count);
echo "Строка c заменой \":\" на \";\" <br /><font color='#8b0000'><i>$str3</i></font><br />";
echo "Произведено $count замены!!<br />";

//---------------------------  Задание 9  ------------
$str2="roiw oiroeirr 423234 rdgdg4e 5oi4 !!!e5e3 0er43 fdijoi edeerefd????? 5 drerererefi 5 gtjj666j6jdl 234 re33333 re tcddddddd 33333drery";
echo "<br /><b>Задание 9</b><br />";
echo "<b>Строка:</b> $str2<br />";
preg_match_all('/\d+/', $str2, $numb2) ;
$numb2=$numb2[0];
var_dump($numb2);

//---------------------------  Задание 10  ------------
echo "<br /><b>Задание 10</b><br />";
//добавлены знаки $ . все отрабатывает!
$str="RWEWEWE g UOImkjjklUYYUYUTY reer EREYyrYEYERERYREY";
$len=strlen($str);
echo "<i>Входная строка:</i> <font color='green'>$str</font><br />";
for ($i=0,$low=0,$high=0;$i<=$len;$i++){
    if (($str[$i] >= 'a') and ($str[$i] <= 'z')){
        $low++;
    }
    if (($str[$i] >= 'A') and ($str[$i] <= 'Z')) {
        $high++;
    }
}
if ($low>$high){
    $str4 = strtolower($str);
}
if ($low<$high){
    $str4 = strtoupper($str);
}
if ($low==$high){
    $str4 = $str;
}
echo "<i>Выходная строка:</i> <font color=#d2691e>$str4</font><br />";

//---------------------------  Задание 11  ------------
echo "<br /><b>Задание 11</b><br />";
$slovo="РОТАТОР";
$len=strlen($slovo);
$len_half=floor($len/2);
echo "<i>Слово:</i> <font color='green'>$slovo</font><br />";
for ($i=0,$m=0;$i<=$len_half;$i++) {
    if ($slovo[$i] == $slovo[$len - $i]) {
        $m++;
    }
}
if($m==$len_half){
    echo "Это слово является палиндромом !!!!";
}
else{
    echo "Это слово <font color='red'> НЕ </font> является палиндромом";
}

//---------------------------  Задание 12  ------------
// переделано. теперь каждое слово в тексте переписывает наоборот
echo "<br /><br /><b>Задание 12</b><br />";
$str3="nodnoL si eht latipac fo taerG niatirB sti lacitilop cimonoce dna larutluc ertnec s'tI eno fo eht tsegral seitic ni eht dlrow stI noitalupop si erom naht noillim elpoep nodnoL si detautis no eht revir semahT ";
echo "<i>Входная строка:</i> <font color='green'>$str3</font><br />";
$arr1   = str_word_count($str3, 1);
echo "<i>Выходная строка:</i> <font color='blue'>";
foreach ($arr1 as  $old_str){
    $new_str[]=strrev($old_str);
    echo strrev($old_str)." ";
}
//var_dump($new_str);
echo "</font><br />";

//---------------------------  Задание 13  ------------
echo "<br /><br /><b>Задание 13</b><br />";
$str3="
But I must explain to you how";
echo "<i>Входная строка:</i> <font color='green'>$str3</font><br />";
$count_g = preg_match_all('/[aeiou]/i', $str3, $m1);
$count_s = preg_match_all('/[всdfghjklmnpqrstvwxyz]/i', $str3, $m2);
if($count_g > $count_s){
    echo "Гласных больше согласных ( $count_g > $count_s )<br />";
}
else {
    echo "Согласных больше гласных ( $count_s > $count_g )<br />";
}


//---------------------------  Задание 14  ------------
echo "<br /><br /><b>Задание 13</b><br />";
$sernames_l=[
'Смирнов Е.Е.',
'Иванов А.И.',
'Кузнецов Е.Е.',
'Соколов Н.Е.',
'Попов А.А.',
'Лебедев А.И.',
'Иванов А.А.',
'Новиков Е.Е.',
'Смирнов Б.Н.',
'Петров А.А.',
'Волков Н.Е.',
'Иванов В.В.',
'Иванов Б.Н.',
'Смирнов А.А.',
'Павлов Е.Е.',
'Семёнов Н.Е.',
'Голубев К.К.',
'Виноградов Б.Н.',
'Иванов К.К.',
'Смирнов Н.Е.',
'Волков К.К.',
'Новиков Б.Н.',
'Новиков А.И.',
'Виноградов А.И.'
];
echo "<b>Список студентов:</b><br />";
foreach ($sernames_l as $val){
    echo "<font color='#483d8b'>$val</font><br />";
    $sernames_s[] = strtok($val, " ");
}

$sernames_m[] = array_count_values ($sernames_s);
$sernames_m=$sernames_m[0];
 //   var_dump($sernames_m);
foreach ($sernames_m as $k => $v) {
    echo "У $k оказалось ".($v-1)." однофамильцев <br />";
}
?>
