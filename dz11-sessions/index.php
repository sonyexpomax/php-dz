<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 9/27/17
 * Time: 19:39
 */

session_start();
define('DS', DIRECTORY_SEPARATOR);
ini_set('display_errors', 1);
$config = require 'config'.DS.'global.php';
ob_start();
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">

        <title>Hello world</title>
        <style>
            /*---------------- NAV -------------------------*/
            nav{
                margin:0 auto;
                width: 70%;
                color: #000000;
                margin-top: 10px;
                border: solid 1px #000000;

                box-shadow: 0 0 10px rgba(0,0,0,0.5);
            }
            nav ul{
                list-style-type: none;
                margin: 0;
                padding: 0;
                overflow: hidden;
            }
            nav li{
                float: left;
                display: inline;
                width: 22%;
                height: 35px;
            }
            nav li:hover{
                background-color: #f5f5f5;
            }
            nav li:last-child:hover{
                background-color: #ffffff;
            }
            nav li a{
                margin-top: 5px;
                display: block;
                text-align: center;
                padding: 5px 5px;
                text-decoration: none;
                font-size: 14px;
                color: #000000;
            }
            nav li a:hover{
                text-decoration: underline;
            }
            nav li:last-child{
                width:34%;
                float: right;
                text-align: center;
            }
            nav li:last-child a {
                float: left;
                color: #0000ff;
            }
            nav li:last-child p {
                color: #008800;
                font-weight: 600;
                float: left;
                font-size: 14px;
                margin-top: 10px;
            }
            footer{
                margin:0 auto;
                width: 70%;
                background-color: #666666;
                color: #ffffff;
                margin-top: 10px;

            }
            main{
                margin:0 auto;
                width: 70%;
            }
        </style>
    </head>
    <body>

    <?php

    // Если человек не авторизован - показываем форму входа
    if (!isset($_SESSION['auth'])) {
        if (isset($_GET['page']) && $_GET['page'] == 'registration') {
            $page = 'registration';
        } else {
            $page = 'auth';
        }
        $parts = [$page];
    }
    else{
        $page = 'main';
        if (!empty($_GET['page'])) {
            $page = $_GET['page'];
        }
        $parts = ['header', $page, 'footer',];
    }

        foreach ($parts as $part) {
            ob_start();
            include 'inc'.DS.$part.'.php';
            if (isset($_SESSION['login'])) {
                $partContent = str_ireplace('{{login}}',$_SESSION['login'],ob_get_clean());
            }
            else {
              $partContent = ob_get_clean();
            }
            echo $partContent;
        }
    ?>
    </body>
    </html>
<?php
$pageContent = ob_get_clean();
echo $pageContent;

?>