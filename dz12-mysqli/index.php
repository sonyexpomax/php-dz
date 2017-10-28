<?php
session_start();
include_once('lib/core.php');
$incPath = __DIR__.'/inc/public';
$page = 'main';
if ($_GET['page']) {
    $page = str_replace('/', '', $_GET['page']);
}
ob_start();
include($incPath.'/header.php');
if (!include($incPath."/$page.php")) {
    echo '404';
}
if (isset($_SESSION['auth']) && ($_SESSION['typeIs'] == 'user')) {
    // что-то будет... а пока...
    echo "<h2>Hidden content</h2>
          <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet at commodi consequatur doloremque dolorum ea expedita facilis harum id laboriosam non odio odit, quam quis rem similique sint velit voluptatem?</p>
";

}

include($incPath.'/footer.php');
echo ob_get_clean();
//var_dump($_SESSION);


