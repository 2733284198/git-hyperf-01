<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\HttpServer\Annotation\AutoController;
use function React\Promise\all;

/**
 * @AutoController
 */
class sessionctl
{
    public function index(RequestInterface $request, ResponseInterface $response)
    {
//        $this->session->set('foo', 'bar');
//        $foo = $this->session->get('foo');
//        return $response->raw('Hello Hyperf! = redis = ' . $foo);

        $data = $this->session->all();

        return $data;

    }
}
