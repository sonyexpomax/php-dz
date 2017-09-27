<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 9/20/17
 * Time: 18:41
 */
define('DS', DIRECTORY_SEPARATOR);
// Определим где мы будет хранить картинки
$galleryDir = __DIR__.DS.'gallery_files';
// Если директория не создана - создаем
if (!is_dir($galleryDir)) {
    if (!mkdir($galleryDir, 0755, true)) {
        die('Не удалось создать директорию');
    }
}

// Логика обработки запроса
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file = $_FILES['image'];
    if (file_exists($file['tmp_name'])) {
        $type = stristr($file['type'], '/', true);
        if ($type=="image") {
            // Тут делаем проверку на mime-type == image/...
            // Если все ок - перемещаем загруженную картинку в свою директорию
            move_uploaded_file(
                $file['tmp_name'],
                $galleryDir . DS . $file['name']
            );
        }
        else{
            echo "Ошибка! Загружаемый файл должен быть изображением!";
        }
    }
}
// Получаем список файлов директории и очищаем от лишних элементов
$images = array_diff(scandir($galleryDir), ['.', '..']);

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <title>Gallery</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Загрузите свои картинки</h1>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="file" name="image" required class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">
                    Отправить
                </button>
            </form>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <?php
                    foreach ($images as $imgPath) {
                        echo "<div class='col-md-6'><img src='gallery_files/$imgPath' style='width: 200px; height: 200px;'></div>";
                    }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>