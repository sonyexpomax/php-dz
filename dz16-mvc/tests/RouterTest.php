<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 04.12.17
 * Time: 12:50
 */
use PHPUnit\Framework\TestCase;
use App\Core\Router;
use App\Core\Config;


Class RouterTest extends TestCase
{
    public function testInitRouter()
    {
        //uri = users/auth/string/array
        $router = new Router('users/auth/string/array');

        $this->assertEquals(Config::get('defaultRoute'), $router->getRoute());
        $this->assertEquals(Config::get('defaultLanguage'), $router->getLang());

        $this->assertEquals( 'authAction', $router->getAction());
        $this->assertEquals( 'UsersController', $router->getController());
        $this->assertEquals( ['string', 'array'], $router->getParams());

        $this->assertNotEquals(Config::get('defaultAction'), $router->getAction());
        $this->assertNotEquals(Config::get('defaultController'), $router->getController());

        //uri = /en/admin/Pages/edit/11/22/33
        $router = new Router('/en/admin/Pages/edit/11/22/33');

        $this->assertEquals( 'admin', $router->getRoute());
        $this->assertEquals( 'en', $router->getLang());
        $this->assertEquals( 'PagesController', $router->getController());
        $this->assertEquals( 'editAction', $router->getAction());
        $this->assertEquals( [11,22,33], $router->getParams());

        //uri = contacts/index/11/22
        $router = new Router('contacts/index/11/22');

        $this->assertEquals( 'default', $router->getRoute());
        $this->assertEquals( 'ru', $router->getLang());
        $this->assertEquals( 'ContactsController', $router->getController());
        $this->assertEquals( 'indexAction', $router->getAction());
        $this->assertEquals( ['11', '22'], $router->getParams());

        //uri = en/pages/
        $router = new Router('en/pages/');

        $this->assertEquals( 'default', $router->getRoute());
        $this->assertEquals( 'en', $router->getLang());
        $this->assertEquals( 'PagesController', $router->getController());
        $this->assertEquals( 'indexAction', $router->getAction());
        $this->assertEquals( [], $router->getParams());

        //uri = 'admin/users/login
        $router = new Router('admin/users/login');

        $this->assertEquals( 'admin', $router->getRoute());
        $this->assertEquals( 'ru', $router->getLang());
        $this->assertEquals( 'UsersController', $router->getController());
        $this->assertEquals( 'loginAction', $router->getAction());
        $this->assertEquals( [], $router->getParams());


        $router = new Router('qq/ww/ee');

        $this->assertEquals( 'default', $router->getRoute());
        $this->assertEquals( 'ru', $router->getLang());
        $this->assertEquals( 'QqController', $router->getController());
        $this->assertEquals( 'wwAction', $router->getAction());
        $this->assertEquals( ['ee'], $router->getParams());
    }
}