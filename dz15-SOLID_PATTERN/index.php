<?php
ini_set("display_errors",1);
error_reporting(E_ALL);
session_start();

spl_autoload_register(function($class) {
    //include 'App/Entity/' . str_replace('\\', '/', $class) . '.php';
    include  str_replace('\\', '/', $class) . '.php';
});

include_once('lib/core.php');

if ($_SERVER['PHP_AUTH_USER'] != 'x' && isset($_SESSION['auth'])) {
    $incPath = __DIR__ . '/inc/admin';
}
else{
     $incPath = __DIR__.'/inc/public';
}

if ($_GET['page']) {
    $page = str_replace('/', '', $_GET['page']);
}
ob_start();
include($incPath.'/header.php');
if (!include($incPath."/$page.php")) {
    echo '404';
}

include($incPath.'/footer.php');
echo ob_get_clean();






