<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\HttpServer\Annotation\AutoController;
//use function React\Promise\all;
//use Hyperf\Contract\SessionInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Redis\RedisFactory;
use Hyperf\Utils\ApplicationContext;

//引入


/**
 * @Annotation
 * @AutoController
 */
class sessionctl
{

    /**
     * @Inject()
     * @var \Hyperf\Contract\SessionInterface
     */
    private $session;

   public function __construct(SessionInterface $session)
   {
       $this->session = $session;
   }

    public function index(RequestInterface $request, ResponseInterface $response)
    {
        $this->session->set("sessionid", "sessionid-01");

        $sess = $this->session->get("sessionid");

        var_dump($sess);
        return $sess;


    }

    public function getcook()
    {

    }
}
