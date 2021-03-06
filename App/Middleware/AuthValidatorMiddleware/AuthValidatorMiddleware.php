<?php


namespace App\Middleware\AuthValidatorMiddleware;

use App\Middleware\BaseMiddleware;

class AuthValidatorMiddleware extends BaseMiddleware
{
    public function __invoke($request, $response, $next)
    {
        $auth = $this->container->AuthService;
        if (!$auth->isLoggedIn()){
            return $response->withRedirect($this->container->router->pathFor('home'));

        }
        $this->container->view->getEnvironment()->addGlobal('isLoggedIn', $auth->isLoggedIn());
        $response = $next($request, $response);
        return $response;
    }
}