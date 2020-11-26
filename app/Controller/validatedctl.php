<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request\FooRequest;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use mysql_xdevapi\Exception;

/**
 * @AutoController
 * Class validatedctl
 * @package App\Controller
 */

class validatedctl
{
    public function index2(RequestInterface $request, ResponseInterface $response)
    {
        return $response->raw('Hello Hyperf!');
    }

    public function index(FooRequest $request)
    {
        // 传入的请求通过验证...

        // 获取通过验证的数据...
        echo '<hr>';

        try {
            $validated = $request->validated();
            var_dump($validated);

            return $validated;
        }catch (Exception $exception){

            return $exception;
        }

    }
}
