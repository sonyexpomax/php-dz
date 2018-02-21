<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/6/17
 * Time: 19:06
 */

namespace App\Core;

use App\Core\DB\Connection;

class App
{
    /** @var Router */
    private static $router;

    /** @var DB\IConnection */
    private static $conn;

    /** @var Session */
    private static $session;


    /**
     * @return Session
     */
    public static function getSession(): Session
    {
        return self::$session;
    }


    /**
     * @return Router
     */
    public static function getRouter(): Router
    {
        return self::$router;
    }

    /**
     * @return DB\IConnection
     */
    public static function getConnection(): DB\IConnection
    {
        return self::$conn;
    }

    /**
     * @param $uri
     * @throws \Exception
     */
    public static function run($uri)
    {

        static::$conn = new Connection(
            Config::get('db.host'),
            Config::get('db.user'),
            Config::get('db.password'),
            Config::get('db.name')
        );

        static::$router = new Router($uri);
        static::$session = Session::getInstance();

        $route = static::$router->getRoute();
        $className = ucfirst(static::$router->getController());
        $action = static::$router->getAction();
        $params = static::$router->getParams();

//        var_dump($route);
//        var_dump($className);
//        var_dump($action);
//        die;

        Localization::setLang(static::$router->getLang());
        Localization::load();

        $controllerName = '\App\Controllers\\'
            .($route !== Config::get('defaultRoute') ? 'Admin\\' : '')
            .$className;

        // @todo Show 404 page
        if (!class_exists($controllerName)) {
            throw new \Exception('Controller '.$controllerName.' not found');
        }
        $layout = self::$router->getRoute();
        if($layout == 'admin' &&  Session::get('role') !='admin'){
            if ($action != 'loginAction'){
                Router::redirect('/admin/users/login');
            }

        }

        /** @var \App\Controllers\Base $controller */
        $controller = new $controllerName($params);
        if (!method_exists($controller, $action)) {
            throw new \Exception('Action '.$action.' not found in '.$controllerName);
        }
        if (!$controller instanceof \App\Controllers\Base) {
            throw new \Exception('Controller must extend Base class');
        }

        ob_start();
        $controller->$action();
        $view = new \App\Views\Base($controller->getData());

        $data = $view->getData();

        $router = \App\Core\App::getRouter();

        $action_name = str_replace('Action', '',$action);
        $controller_name = strtolower(str_replace('Controller', '',$className));

        $loader = new \Twig_Loader_Filesystem( ROOT.DS.'views'.DS.$route);
        $twig = new \Twig_Environment($loader, array(
            'cache' => false,
        ));

        $function = new \Twig_SimpleFunction('buildUriTwig', function ($path, $params = []) {
            $router = \App\Core\App::getRouter();
            return $router->buildUri($path, $params);
        });
        $twig->addFunction($function);

        $function = new \Twig_SimpleFunction('buildNameForLinkTwig', function ($code, $default = '') {
            return \App\Core\Localization::get($code, $default);
        });
        $twig->addFunction($function);

        $template = $controller_name.DS.$action_name.'.html.twig';

        echo $twig->render($template, array(
            'name' => 'Fabien',
            'messages' => \App\Core\Session::flash(),
            'title' => \App\Core\Config::get('siteName'),
            'login' => \App\Core\Session::get('login'),
            'data' => $data,
        ));

        ob_end_flush();
    }





}