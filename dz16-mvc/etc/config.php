<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/1/17
 * Time: 21:14
 */

use App\Core\Config;

/**
 * Routing
 */
Config::set('routes', ['default', 'admin']);
Config::set('defaultRoute', 'default');
Config::set('defaultController', 'pages');
Config::set('defaultAction', 'index');

/**
 * Lang
 */
Config::set('languages', ['en', 'ru']);
Config::set('defaultLanguage', 'ru');



/**
 * Debug
 */
Config::set('debug', true);


/**
 * Meta
 */
Config::set('siteName', 'Academy MVC');


/**
 * Database
 */
Config::set('db.host', 'localhost:3306');
Config::set('db.user', 'mvc');
Config::set('db.password', 'mvc');
Config::set('db.name', 'mvc');

/**
 * password login
 */
Config::set('salt', 'asdfqwer');