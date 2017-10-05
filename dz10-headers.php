<?php
//---------------------------------------HEADER------------------------
if (isset($_POST['file'])){
    $filename = (string) $_POST['file'];
    //  var_dump($_POST);
   header("Content-type: application/octet-stream");
   header("Content-disposition: attachment; filename=\"{$filename}\"");
    readfile($filename);
}

//---------------------------------------COOKIE------------------------
setcookie("visits_count", 1);
//var_dump($_COOKIE);
if (!isset($_COOKIE['visits_count'])) {
    setcookie("visits_count", '2');
    echo "Ваше посещение № 1";
}
else{
    $current_cookie = (int) $_COOKIE['visits_count'];
    if ($current_cookie == 5){
        setcookie("visits_count", "", time() - 3600);
    }
    else{
        $current_cookie++;
        setcookie("visits_count", $current_cookie);
    }
    echo "Ваше посещение № ".$_COOKIE['visits_count'];
}

echo "
<html>
<head>
    <meta charset=\"utf-8\">
    <title>Download file</title>
</head>
<body>
            <h2>Загрузите файл</h2>
            <form method=\"post\" action=\"dz10-headers.php\">
                <input type='file' name=\"file\" required class=\"form-control\" />
                <input type=\"submit\" class=\"btn btn-primary\" value=\"Скачать\" />
            </form>
</body>
";

?>

</html>