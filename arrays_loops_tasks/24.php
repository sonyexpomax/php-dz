<html>
    <form action="24.php" method="post">
        Введите число:          <input type="text" name="number" required><br />
        Введите искомую цифру:  <input type="text" name="find" required><br />
                                <input type="submit" value="Поиск">
    </form>
</html>
<?php
if ($_POST['number']) {
    $number=$_POST['number'];
    $find=$_POST['find'];
    $len=strlen($number);
    $res=0;
    for ($i=1;$i<=$len;$i++) {
        if ($find==$number[$i-1]){
            $res++;
        }
    }
    echo "Количество вхождений цифры $find в числе $number равно $res!!";
}
?>

