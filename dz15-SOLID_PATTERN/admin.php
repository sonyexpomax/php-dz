<?php
session_start();
//var_dump($_SERVER);

error_reporting(E_ALL);
$LoginPasswds = ['admin' => ['12345','admin'],
                 'user' =>  ['12345','user']
                ];
$PathToGoOut = 'Location:http://x:x@localhost/test1/dz12-mysqli/'."index.php";
if (isset($_GET['out'])) {
    session_unset();
    $_SERVER['PHP_AUTH_USER']= 'x';
    $_SERVER['PHP_AUTH_PW'] = 'x';
    header($PathToGoOut);
}
else {
    if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] == 'x') {
        logIn('-You must log in!');
    }
    if (isset($_SERVER['PHP_AUTH_USER']) && $_SERVER['PHP_AUTH_USER'] != 'x' && !isset($_SESSION['auth'])) {
        $login = $_SERVER['PHP_AUTH_USER'];
        $passwd = $_SERVER['PHP_AUTH_PW'];
        if ($LoginPasswds[$login][0] == $passwd) {
            $_SESSION['auth'] = true;
            $_SESSION['typeIs'] = (string)$LoginPasswds[$login][1];
            $_SESSION['login'] = $login;
            echo '$_SESSION[type] - ' . $_SESSION['typeIs'];
            header('Location:index.php');
        } else {
            echo "Wrong password or login. Try again";
            header($PathToGoOut);
        }
    }
}

/**
 * @param $textMessage
 */
function logIn($textMessage){
    header("WWW-Authenticate: Basic realm='{$textMessage}', encoding='UTF-8'");
    header('HTTP/1.0 401 Unauthorized');
    echo "Необходимо зайти под своей учетной записью! 
    <a href='index.php'>Перейти на главную страницу</a>";
}
//var_dump($_SESSION);
