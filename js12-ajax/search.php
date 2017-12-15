<?php
header('Access-Control-Allow-Origin: *');
header("Content-type: text/html; charset=utf-8");

$tips = ['Ad', "javascript", "java", "download", "downtown", "Dow!" ];
$pages = [
    [
        'tip' => 'Ad',
        'name' => "Advances",
        'description' => 'Ad! Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
    ],
    [
        'tip' => 'Ad',
        'name' => "Adaway",
        'description' => 'Adaway! Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
    ],
    [
        'tip' => 'javascript',
        'name' => "JavaScript Tutorial",
        'description' => '"JavaScript Tutorial". Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
    ],
    [
        'tip' => 'javascript',
        'name' => "Learn JavaScript | Codecademy",
        'description' => '"Learn JavaScript". Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
    ],
    [
        'tip' => 'java',
        'name' => "Java training | Pluralsight",
        'description' => 'Java training | Pluralsight . Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
    ],
    [
        'tip' => 'java',
        'name' => "Installing TensorFlow for Java | TensorFlow",
        'description' => 'Installing TensorFlow for Java | TensorFlow . Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
    ],
    [
        'tip' => 'download',
        'name' => "Download uTorrent - free - latest version",
        'description' => 'Download uTorrent - free - latest version. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
    ],
    [
        'tip' => 'download',
        'name' => "Apache OpenOffice - Official Download",
        'description' => 'Apache OpenOffice - Official Download. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
    ],
    [
        'tip' => 'downtown',
        'name' => "Downtown LA",
        'description' => 'Downtown LA. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
    ],
    [
        'tip' => 'downtown',
        'name' => "Downtown | Define Downtown at Dictionary.com",
        'description' => 'Downtown | Define Downtown at Dictionary.com. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
    ],
    [
        'tip' => 'Dow!',
        'name' => "Dow!. The Dow Chemical Company - Home",
        'description' => 'Dow! Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
    ],
    [
        'tip' => 'Dow!',
        'name' => "Dow Corning: Silicone Solutions, Products & Technologies",
        'description' => 'Dow Corning: Silicone Solutions, Products & Technologies! Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
    ],
];



if($_GET){
    $search = stripslashes(htmlspecialchars(addslashes($_GET['search'])));
    if($search == ''){
        exit("Начните вводить запрос");
    }
    searchTip($tips, $search);
}


if($_POST){
    $tip = stripslashes(htmlspecialchars(addslashes($_POST['tip'])));

    $resultArr =[];
    $resultArr[] = "<h4>Результаты поиска:</h4>";
    for($i = 0; $i < count($pages); $i++){
        if ($pages[$i]['tip'] == $tip){
            $resultArr[] = "<h3>".$pages[$i]['name']."</h3><p>".$pages[$i]['description']."</p>";
        }
    }

    $result = implode('',$resultArr);
    echo json_encode($result);
}

/**
 * @param $arr
 * @param $search
 */
function searchTip($arr,$search)
{
    $j=[];
    for($i = 0;$i < count($arr); $i++){
        if (strpos($arr[$i], $search)!==false){
            echo "<div class='tips_row' onclick = getRow('{$arr[$i]}')>{$arr[$i]}</div>";
            $j[] = $i;
        }
    }

    if(count($j) == 0){
        echo "<div class='tips_row' onclick = getRow('{$arr[0]}')>{$arr[0]}</div>";
    }
    else{
        if(!array_search(0, $j)){
            echo "<div class='tips_row' onclick = getRow('{$arr[0]}')>{$arr[0]}</div>";
        };
    }
}