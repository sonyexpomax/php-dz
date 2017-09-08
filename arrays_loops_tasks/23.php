<html>
    <form action="23.php" method="post">
        Введите число: <input type="text" name="number"><br />
        <input type="submit">
    </form>
</html>
<?php
if ($_POST['number']) {
    $number=$_POST['number'];
    $len=strlen($number);
    echo "$len <br>";
     $res=0;
    for ($i=1;$i<=$len;$i++) {
        $res = $res + $number[$i-1];
     }
    echo "Сумма всех цифр числа $number равна $res";
}
?>

