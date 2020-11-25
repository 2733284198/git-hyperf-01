<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');
//Router::addRoute(['GET', 'POST', 'HEAD'], '/testdb', 'App\Controller\IndexController@testdb');

Router::get('/favicon.ico', function () {
    return '';
});

Router::get('/testdb', 'App\Controller\IndexController@testdb');
Router::get('/testredis', 'App\Controller\IndexController@testredis');
Router::get('/testsnowflake', 'App\Controller\IndexController@testsnowflake');
Router::get('/testlog', 'App\Controller\IndexController@testlog');
Router::get('/testdb2', 'App\Controller\IndexController@testdb2');