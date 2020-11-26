<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Wmcategory;
use App\Model\Wmshop;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

use App\Model\Wmfood;

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

    /* hop food list */
    public function get_shopinfo(RequestInterface $request)
    {
        echo '<hr>get_shopinfo';

        $shop_result = Wmshop::query()->where('id', 10000)->firstOrFail();

        // 返回信息
        $all_input = $request->all();
//        return ($all_input);

        $result_message = [];
        $result_message['message'] = ['没有店铺数据'];
        $result_message['code'] = ['error'];

        // 获取数据

        // 请求参数
        $shop_id = $request->input('shop_id');
        $shop_res = Wmshop::query()->where('shop_id', $shop_id)->first();
        // 查询条件
        if ( $shop_res == null ) {
            return 'no this shop';
        }

        $cate_res = Wmcategory::where('shop_id', $shop_id)->get();
        $res_arr = [];


        $res_arr['foodCate'] = $cate_res;
        $res_arr['shop'] = $shop_res;

        foreach ($cate_res as $k => $v) {
            $res_arr['foodCate'][$k] = $cate_res[$k];
        }

        foreach ($res_arr['foodCate'] as $k => $v) {
            $cate_id = $res_arr['foodCate'][$k]['cate_id'];
            $food_res = Wmfood::where('cate_id', $cate_id)->get();

            $res_arr['food'][$cate_id] = $food_res;
        }

        return $res_arr;

    }

}
