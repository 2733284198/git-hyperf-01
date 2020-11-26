<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request\FooRequest;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

use Hyperf\Di\Annotation\Inject;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;

/**
 * @AutoController
 */
class validatedctl
{
    /**
     * @Inject()
     * @var ValidatorFactoryInterface
     */
    protected $validationFactory;

    public function index2(RequestInterface $request, ResponseInterface $response)
    {
        return $response->raw('Hello Hyperf!');
    }

    public function check(RequestInterface $request)
    {
        $validator = $this->validationFactory->make(
            $request->all(),
            [
                'foo' => 'required',
                'bar' => 'required',
            ],
            [
                'foo.required' => 'foo is required',
                'bar.required' => 'bar is required',
            ]
        );

        if ($validator->fails()){
            // Handle exception
            $errorMessage = $validator->errors()->first();

            return $errorMessage;
        }

        return $request->all();
    }

    public function foo(RequestInterface $request)
    {
        $validator = $this->validationFactory->make(
            $request->all(),
            [
                'foo' => 'required',
                'bar' => 'required',
            ],
            [
                'foo.required' => 'foo is required',
                'bar.required' => 'bar is required',
            ]
        );

        $validator->after(function ($validator) {
            if ($this->somethingElseIsInvalid()) {
                $validator->errors()->add('field', 'Something is wrong with this field!');
            }
        });

        if ($validator->fails()) {
            //
            echo '<hr>fails';
        }
    }

    public function somethingElseIsInvalid()
    {
        echo '<hr>somethingElseIsInvalid';
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
