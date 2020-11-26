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
use Hyperf\Logger\LoggerFactory;
use Hyperf\Utils\Arr;
use Hyperf\Utils\ApplicationContext;
use Hyperf\Snowflake\IdGeneratorInterface;
use App\Model\T1model;


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

    public function testlog()
    {
        echo 'testlog';

//        $logger = LoggerFactory::class->get('log', 'default');
//        $logger->info('Your log message');
    }

    public function testdb2()
    {
//        $users = T1model::query()->find([1, 2]);

        $users = Db::table('t1')->where('age', '>', 10) ->paginate(10);

        var_dump($users);

        $deluser = T1model::query()->find(4);
        $deluser->delete();

        $users = Db::table('t1')->where('age', '>', 10) ->paginate(10);
        return $users;
    }

    public function testdb()
    {

        $user = T1model::query()->where('id', 1)->first();
        $user->name = 'Hyperf';
        $user->save();

        Db::enableQueryLog();
        $row = Db::table('t1')->first(); // sql 会自动加上 limit 1
        var_dump($row);
//        $users = Db::select('SELECT * FROM `t1` WHERE id > 0',[1]);  //  返回array
//        $users = Db::select('SELECT * FROM `t1` WHERE id > 0' );  //  返回array
        $users = Db::select('SELECT * FROM `t1` ');  //  返回array
        foreach ($users as $user) {
            echo $user->name;
        }
        return $users;
        // 打印最后一条 SQL 相关数据
        var_dump(Arr::last(Db::getQueryLog()));
//        $users = Db::table('user')->get("id,name");
        echo 'testdb';
    }
}
