<html>
<form action="27.php" method="post">
    Введите кол-во строк:    <input type="text" name="rows" required><br />
    Введите кол-во столбцов: <input type="text" name="cols" required><br />
    <input type="submit" value="Сгенерировать">
</form>
</html>
<?php
$colors = ['red','yellow','blue','gray','maroon','brown','green'];
if ($_POST['rows']) {
    $rows=$_POST['rows'];
    $cols=$_POST['cols'];
    //$res=0;
    echo "<table>";
    for ($i=1;$i<=$rows;$i++) {
        echo "<tr>";
        for ($j=1;$j<=$cols;$j++) {
            echo "<td bgcolor=".$colors[array_rand($colors)].">".rand(100,99000)."</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
?>