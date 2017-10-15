<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 9/27/17
 * Time: 20:13
 */
$salt = sha1('salt');

return [
    'salt' => $salt,
    'company' => 'Наша Компания',
    'pageIdParam' => 'page',
    'menu' => [
        [
            'id' => 'products',
            'title' => 'Продукция',
        ],
        [
            'id' => 'finance',
            'title' => 'Финансы',
        ],
        [
            'id' => 'contacts',
            'title' => 'Контакты',
        ]
    ],
    /*'users' => [
        ['admin', sha1($salt.'123456')],
    ],*/
    'users' => unserialize(file_get_contents('./config/logins.txt')),
    'files' => [
        ['login', __DIR__.'/logins.txt'],
    ]
];
/*
if($_SESSION['login']){
    $config['users'][0][0]=$login;
    $config['users'][0][1]=$passwd;
    var_dump($config['users']);
}
*/