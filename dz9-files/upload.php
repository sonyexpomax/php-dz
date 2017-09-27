<html>
    <head>
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <div class="main">
            <h2>Добавление нового файла</h2><br />
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
                <input type="file" name="file_1">
                <input type="submit" value="Отправить">
            </form>


<?php
ini_set("display_errors",1);
error_reporting(E_ALL);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file = $_FILES['file_1'];
    if (file_exists($file['tmp_name'])) {
        $type = stristr($file['type'], '/', true);
        if (!empty($type)) {
            if (!file_exists($type)) {
                mkdir($type, 0755, true);
                echo "Создана новая папка $type<br />";
            }
            move_uploaded_file($file['tmp_name'], $type . DIRECTORY_SEPARATOR . $file['name']);
            chmod($type . DIRECTORY_SEPARATOR . $file['name'], 0644);
            echo "Файл успешно загружен в папку $type<br />";
        }
    }
}
?>
        </div>
        <div class="main">
            <div class="a">
                <a href="index.php" >На главную</a><br />
            </div>
        </div>
    </body>
</html>
