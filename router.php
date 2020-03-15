<?php 
    use FastRoute\RouteCollector;
    use Config\URLs;

    class Router
    {
        private $httpMethod;

        private $uri;

        public function __construct()
        {

            $this->httpMethod = $_SERVER['REQUEST_METHOD'];
            $this->uri = $_SERVER['REQUEST_URI']; 
        }

        public function forward()
        {
            $dispatcher = FastRoute\simpleDispatcher('Router::loadRouters');

            // Strip query string (?foo=bar) and decode URI
            if (false !== $pos = strpos($this->uri, '?')) {
                $uri = substr($this->uri, 0, $pos);
            }
            $uri = rawurldecode($this->uri);
            
            $routeInfo = $dispatcher->dispatch($this->httpMethod, $uri);
            switch ($routeInfo[0]) {
                case FastRoute\Dispatcher::NOT_FOUND:
                    http_response_code(404);
                    break;
                case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                    $allowedMethods = $routeInfo[1];
                    http_response_code(405);
                    break;
                case FastRoute\Dispatcher::FOUND:
                    $controller_name = "Controller\\".$routeInfo[1][0];
                    $action = $routeInfo[1][1];
                    $vars = $routeInfo[2];
                    $controller = new $controller_name();
                    // if httpMethod === POST, get response and convert to array
                    if ($this->httpMethod === 'POST'){
                        $vars = json_decode(file_get_contents("php://input"), true);
                    }
                    call_user_func_array([$controller, $action], $vars);
                    break;
            }
        }

        public static function loadRouters(RouteCollector $route)
        {
            $url = new URLs();
            $urls = $url->getUrls();

            foreach($urls as list($method, $uri, $handler)){
                $route->addRoute($method, $uri, $handler);
            }
        }

    }
?>