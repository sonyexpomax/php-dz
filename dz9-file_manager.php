<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <style>
        .frm_ren{
            width:900px;
            margin: 10px auto;
            border: solid 1px lightgray;

        }
        .frm_ren h2{
            width: 100%;
            text-align: center;
        }
        .frm_ren input{
            width: 290px;
            margin-left:5px ;
        }
        .frm_ren span{
            color: red;
        }
        .frm_ren textarea(
        col:42;
        )
    </style>
    <title>File Manager</title>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 9/20/17
 * Time: 18:42
 */
ini_set("display_errors",1);
error_reporting(E_ALL);
define('DS', DIRECTORY_SEPARATOR);
// Определим корневую директорию
$base = $_SERVER['DOCUMENT_ROOT'];
//echo $base."<br>";
// Определяем путь выбранной директории относительно корня
$path = '';
if (!empty($_GET['dir']) && !in_array($_GET['dir'], ['.', '/'])) {
    $path = $_GET['dir'];
}
// Получаем все файлы и директории из текущего пути
$files = scandir($base.DS.$path);
//var_dump($files);
// Очищаем от лишних элементов
$removeParts = ['.'];
if (!$path) {
    // Если мы в корне - удаляем элемент родительской директории
    $removeParts[] = '..';
}

//var_dump($_GET);
//-----------------------------------------------------удаление--------------------------
if(isset($_GET['delete'])){
    $del_file=$base.DS.$path.DS.$_GET['delete'];
    rmdir_or_files($del_file);
    $refresh_path = stristr($_SERVER['REQUEST_URI'], '&delete', true);
    //echo $refresh_path;
    header( 'Location:'.$refresh_path);
}
//..--------------------------------------------------переименование----------------------
if(isset($_GET['ren'])){
    $ren_f = $_GET['ren'];
    $ren_file=$base.DS.$path.DS.$_GET['ren'];
    //echo $ren_file;
    echo "
        <div class='frm_ren'>
            <h2>Переименовывание файла / папки <span>$ren_f</span></h2>
            <form action='#' method=\"post\">
                <input type=\"text\" name=\"old_name\" value=\"$ren_f\" />
                <input type=\"text\" name=\"new_name\" placeholder='Новое название'>
                <input type=\"submit\" value=\"Переименовать\">
            </form>
        </div>
    ";
}
if(isset($_POST['new_name'])){
    $old_name=$base.DS.$path.DS.$_POST['old_name'];
    $new_name=$base.DS.$path.DS.$_POST['new_name'];
    //echo $old_name."---------------".$new_name;
    rename($old_name,$new_name);
    $refresh_path = stristr($_SERVER['REQUEST_URI'], '&ren', true);
    header( 'Location:'.$refresh_path);

}

//..--------------------------------------------------редактирование----------------------
//var_dump($_GET);
if(isset($_GET['edit'])){

    $edit_file=$base.DS.$path.DS.$_GET['edit'];
    echo $edit_file;
    $edit_f = $_GET['edit'];
        if(!file_exists($edit_file)){
            exit("Error: File does not exist.");
        }
    echo "
        <div class='frm_ren'>
            <h2>Редактирование файла <span>$edit_f</span></h2>
            <form action='#' method=\"post\">
                <textarea rows=\"10\" cols=\"85\" name='text_edit'>";
                    $file = fopen($edit_file, "r");
                    while(!feof($file)){
                        echo htmlspecialchars(fgets($file));
                    }
                    fclose($file);
    echo "      </textarea><br />
                <input type='hidden' name='filename' value='$edit_f'>
                <input type='submit' value='Сохранить'>
            </form>
        </div>";

}
if(isset($_POST['text_edit'])) {
    $edit_file=$base.DS.$path.DS.$_POST['filename'];
    $open = fopen($edit_file,"w+");
    $text = $_POST['text_edit'];
    fwrite($open, $text);
    fclose($open);
    $refresh_path = stristr($_SERVER['REQUEST_URI'], '&edit', true);
    echo "<br>".$refresh_path;
   // header( 'Location:'.$refresh_path);
}

//touch($base.DS.$path.DS."tte4734444");
//mkdir($del_file=$base.DS.$path.DS."7744", 0777);

//------------------------------------------- удаление папок и файлов---------------------
function rmdir_or_files($dir) {
    if (is_dir($dir)) {
        $files = scandir($dir);
        foreach ($files as $file) {
            $path=$dir.DIRECTORY_SEPARATOR.$file;
            if ($file != "." && $file != "..") {
                if (is_dir($path)){
                    rmdir_or_files($path);
                }
                else{
                    unlink($path);
                }
            }
        }
        reset($files);
        rmdir($dir);
    }
    else{
        unlink($dir);
    }
}

//--------------------------------------------- Формируем данные для вывода
$files = array_diff($files, $removeParts);

$result = [];
foreach ($files as $file) {
    $name = $file;
    $name1 = $name;
    $absFile = $base.DS.$path.DS.$file;
    // Для директорий делаем имя со ссылкой
    if (is_dir($absFile)) {
        if ($file == '..') {
            // Ссылку "вверх" делаем на один элемент вложенности меньше
            $url = dirname($path);
        } else {
            $url = $path.DS.$name;
        }

        $name = "<a href=\"?dir={$url}\">{$name}</a>";
    }
    // Добавляем текущий элемент в массив результата
    $result[] = [
        'name1' => $name1,
        'name' => $name,
        'size' => round(filesize($absFile)/1024, 2) . ' кб',
        'created_at' => date('H:i:s d.m.Y', filectime($absFile)),
        'last_modif' => date('H:i:s d.m.Y', filemtime($absFile)),
    ];
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover" width="100">
                <thead>
                <tr class="bg-warning">
                    <th>Действия</th>
                    <th>Имя файла</th>
                    <th>Размер файла</th>
                    <th>Дата создания</th>
                    <th>Дата изменения</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $root_dir = stristr($_SERVER['REQUEST_URI'], '?', true);
                    //echo "==".$root_dir."==";
                    foreach ($result as $file){
                        if ($root_dir!=""){
                            $spec_simvol='&';
                        }
                        else{
                            $spec_simvol='?';
                        }
                        $dell_path=$_SERVER['REQUEST_URI'].$spec_simvol."delete=".$file['name1'];
                        $rename_path=$_SERVER['REQUEST_URI'].$spec_simvol."ren=".$file['name1'];
                        $edit_path=$_SERVER['REQUEST_URI'].$spec_simvol."edit=".$file['name1'];
                        echo "<tr>";
                        if ($file['name1'] === '..'){
                            echo "<td></td>";
                        }
                        else{
                            $type = stristr($file['name1'], '.');
                            if ($type == ".txt" or $type == ".php" or $type == ".html"){
                                echo "<td> <a href='$dell_path'>Удалить</a> / <a href='$rename_path'>Переименовать</a> / <a href='$edit_path'>Редактровать</a></td>";
                            }
                            else{
                                echo "<td> <a href='$dell_path'>Удалить</a> / <a href='$rename_path'>Переименовать</a></td>";
                            }

                        }
                         echo "
                        <td> {$file['name']} </td>
                        <td> {$file['size']} </td>
                        <td> {$file['created_at']} </td>
                        <td> {$file['last_modif']} </td>
                    </tr>";
                }
                //var_dump($_SERVER);
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>