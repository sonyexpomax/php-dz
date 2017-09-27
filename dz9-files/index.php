<html>
    <head>
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <div class="main">

        <?php
        $dir='image';
        //--------------------------------------------------Список  всех изображений из директории image-------------
        function list_images ($dir){
            if (is_dir($dir)) {
                $list = array_diff(scandir($dir), ['..', '.']);
                return $list;
            }
        }
        //--------------------------------------------------Печать всех изображений из директории image-------------
        function print_img ($dir='image'){
            foreach (list_images($dir) as $file) {
                echo "<img src='" . $dir . DIRECTORY_SEPARATOR . $file . "' />";
            }
        }
        echo "<h2>Изображения в директории image</h2><br />";
        print_img();
        echo "<br />";
        //--------------------------------------------------Список  всех файлов из корневой директории-------------
        function list_files($dir="./", &$results = array()){
            $files = array_diff(scandir($dir), ['..', '.']);
            foreach($files as $key => $value){
                $path = $dir.DIRECTORY_SEPARATOR.$value;
                if(!is_dir($path)) {
                    $results[] = $path;
                } else  {
                    if (($path != './/image')){
                        list_files($path, $results);
                        $results[] = $path;
                    }
                }
            }
            return $results;
        }
        //--------------------------------------------------------------------------------------------------------
        $ff=list_files();
        //var_dump($ff);
        asort($ff);
        //--------------------------------------------------Вывод всех загруженных документов---------------------
        foreach ($ff as $str){
            if (substr_count($str, '/') == 2 && substr_count($str, '.') < 2){
                $str2 = basename($str);
               echo "<strong>Список файлов в директории ". basename($str) .":</strong><br />";
            }
            elseif (dirname($str)<>"."){
                echo basename($str)." <br />";
            }
        }



        ?>
        </div>
        <div class="main">
            <div class="a">
                <a href="upload.php" >Добавить Файл</a><br />
            </div>
        </div>
    </body>
</html>