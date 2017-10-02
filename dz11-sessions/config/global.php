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
    'users' => [
        ['admin', sha1($salt.'123456')],
    ]
];