<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Wmshop;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * @AutoController()
 */

/*class UserController
{
    // Hyperf 会自动为此方法生成一个 /user/index 的路由，允许通过 GET 或 POST 方式请求
    public function index(RequestInterface $request)
    {
        // 从请求中获得 id 参数
        $id = $request->input('id', 1);
        return (string)$id;
    }
}*/

class shopinfo
{
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        return $response->raw('Hello Hyperf!');
    }

    // Hyperf 会自动为此方法生成一个 /user/index 的路由，允许通过 GET 或 POST 方式请求
    public function index2(RequestInterface $request)
    {
        // 从请求中获得 id 参数
        $id = $request->input('id', 1);
        return (string)$id;
    }

    public function shopname(RequestInterface $request)
    {
        // 从请求中获得 id 参数
        $data = Wmshop::getshopname();
        return $data;
    }

    public function shopnum(RequestInterface $request)
    {
        $data = Wmshop::getshopnum();
        return $data;
    }

    public function shopchangename(RequestInterface $request)
    {
        $shop = Wmshop::query()->where('id', 10200)->first();
        $shop->shopname = 'shop Hyperf';
        $shop->save();

        $shopname = Wmshop::query()->findOrFail(10200);
        return $shopname;
    }

    public function shopnew(RequestInterface $request)
    {
        $shop = new Wmshop();
        $shop->name = 'Hyperf - 2020-11-26';
        $shop->save();

        $res = Wmshop::firstOrFail(10000);
        return $res;

    }


}
