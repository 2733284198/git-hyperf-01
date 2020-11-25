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
namespace App\Controller;

use Hyperf\DbConnection\Db;
use Hyperf\Utils\Arr;
use Hyperf\Utils\ApplicationContext;
use Hyperf\Snowflake\IdGeneratorInterface;

class IndexController extends AbstractController
{
    public function index()
    {
        echo 'testdb';

        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
        ];
    }

    public function testsnowflake()
    {

        $container = ApplicationContext::getContainer();
        $generator = $container->get(IdGeneratorInterface::class);

        $id = $generator->generate();
        return $id;
    }

    public function testredis()
    {
        $res = phpinfo();
        return $res;

        $container = ApplicationContext::getContainer();

        $redis = $container->get(\Hyperf\Redis\Redis::class);
        $result = $redis->keys('*');

//        return $result;

        $k1 = $redis->set('k1', 'v1');
        $k1 = $redis->get('k1');
//        return $k1;

    }

    public function testdb()
    {
        $row = Db::table('t1')->first(); // sql 会自动加上 limit 1
        var_dump($row);

        var_dump($row);

//        $res = DB::query("SELECT * FROM 't1'; ");
//        foreach ($res as $r) {
//            var_dump($r);
//        }

//        var_dump($res);
//
//        $users = Db::table('user')->get("id,name");
        echo 'testdb';


//        $users = Db::select('SELECT * FROM `t1` ');  //  返回array
//        var_dump(Arr::last(Db::getQueryLog()));

//        foreach($users as $user){
//            echo $user->id;
//        }

//        $users = Db::table('t1')->get();
    }
}
