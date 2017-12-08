<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 04.12.17
 * Time: 14:13
 */

use PHPUnit\Framework\TestCase;
use App\Core\Router;
use App\Core\Config;

Class BuildUriTest extends TestCase
{
    public function testBuildUriInit()
    {
        $router = new Router('en/admin/pages');

        $this->assertEquals('/en/admin/Pages/edit', $router->buildUri('edit'));
        $this->assertNotEquals('/admin/Pages/edit', $router->buildUri('edit'));
        $this->assertEquals('/en/admin/Pages/edit/11/22/33', $router->buildUri('edit',[11,22,33]));
        $this->assertEquals('/en/admin/Pages/edit1', $router->buildUri('edit1'));

        $router = new Router('en/');
        $this->assertEquals('/en/pages/edit/11/22/33', $router->buildUri('edit',[11,22,33]));

        $router = new Router('admin/');
        $this->assertEquals('/admin/pages/edit/11/22/33', $router->buildUri('edit',[11,22,33]));

        $router = new Router('en/');
        $this->assertEquals('/en/pages/edit/11/22/33', $router->buildUri('edit',[11,22,33]));

        $router = new Router($router->buildUri('edit', [11,22,33]));
        $this->assertEquals( 'default', $router->getRoute());
        $this->assertEquals( 'en', $router->getLang());
        $this->assertEquals( 'PagesController', $router->getController());
        $this->assertEquals( 'editAction', $router->getAction());
        $this->assertEquals( [11,22,33], $router->getParams());

    }
}

