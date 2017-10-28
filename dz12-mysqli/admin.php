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
        logIn('You must log in!');
    }
    if (isset($_SERVER['PHP_AUTH_USER']) && $_SERVER['PHP_AUTH_USER'] != 'x' && !isset($_SESSION['auth'])) {
        $login = $_SERVER['PHP_AUTH_USER'];
        $passwd = $_SERVER['PHP_AUTH_PW'];
        if ($LoginPasswds[$login][0] == $passwd) {
            $_SESSION['auth'] = true;
            $_SESSION['typeIs'] = (string)$LoginPasswds[$login][1];
            $_SESSION['login'] = $login;
            echo '$_SESSION[type] - ' . $_SESSION['typeIs'];
        } else {
            echo "Wrong password or login. Try again";
            header($PathToGoOut);
        }
    }
    if ($_SERVER['PHP_AUTH_USER'] != 'x' && isset($_SESSION['auth']) && ($_SESSION['typeIs'] == 'admin')) {
        include_once('lib/core.php');
        $incPath = __DIR__ . '/inc/admin';
        $page = 'main';
        if ($_GET['page']) {
            $page = str_replace('/', '', $_GET['page']);
        }
        ob_start();
        include($incPath . '/header.php');
        if (!include($incPath . "/$page.php")) {
            echo '404';
        }
        include($incPath . '/footer.php');
        echo ob_get_clean();
    }
    if (isset($_SESSION['auth']) && ($_SESSION['typeIs'] == 'user')) {
        // что-то будет... а пока...
        header('Location:index.php');

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
