<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, Auth, Token, X-Requested-With');

require_once 'init.php';
require_once 'router.php';

class StartUp
{

    public static function init($request)
    {

        try {
            
            $router = new Router();
            $request  = array_merge($request, (array) json_decode(file_get_contents("php://input")));
            $headers = Utils::getHeaders();
            $URL = new URL();
            $URI = $URL->getURI();
            $HTTPVerbRequest = $_SERVER['REQUEST_METHOD'];
            
            if (!isset($router->{$HTTPVerbRequest}[$URI])) {                
                return new StatusCodeOK("Route not found!");
            }
            
            $route = $router->$HTTPVerbRequest[$URI];

            if ($route->getAuthenticate()) {                
                if (!isset($headers['Token']) or !AuthenticateService::Authenticate($headers['Token'])) {
                    return new StatusCodeUnauthorized("Token is invalid!");
                }
                $request["Token"] = $headers['Token'];
            }

            $controller = $route->getController();
            $method = $route->getMethod();

            return  call_user_func(array(new $controller($request), $method), $request);
            
        } catch (Exception $e) {
            return new StatusCodeInternalError($e->getMessage());
        }        
    }
}

Session::destroy();
StartUp::init($_REQUEST)->response();
