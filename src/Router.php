<?php

namespace Src;

require_once __DIR__ . "/../conf.php";

class Router
{
    private array $routes = [];

    public function add(
        string $path,
        string $controller,
        string $method,
        string $httpMethod
    ) {
        $path = trim($path);
        $this->routes[$httpMethod][$path] = [
            "controller" => $controller,
            "method" => $method,
        ];
    }

    public function dispatch()
    {
        $requestUri = $this->parseUri($_SERVER["REQUEST_URI"]);
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        foreach ($this->routes[$requestMethod] as $route => $target) {
            $dynamicParameterPattern = preg_replace('#\{([a-zA-Z0-9_]+)\}#', '([^/]+)', $route);

            if (preg_match("#^$dynamicParameterPattern$#", $requestUri, $matches)) {
                array_shift($matches);

                $controllerClass = $this->getControllerClass($target);
                $controller = $this->getController($target, $controllerClass);

                return call_user_func_array([$controller, $target["method"]], $matches);
            }
        }

        http_response_code(404);
        echo "Page non trouvée";
    }

    private function getControllerClass(array $target)
    {
        $controllerClass = "Src\\Controllers\\" . $target["controller"];

        if (!class_exists($controllerClass)) {
            http_response_code(500);
            echo "Contrôleur introuvable : $controllerClass";
            return;
        }

        return $controllerClass;
    }

    private function getController(array $target, string $controllerClass)
    {
        $controller = new $controllerClass();

        if (!method_exists($controller, $target["method"])) {
            http_response_code(500);
            echo "Méthode introuvable : " . $target["method"];
            return;
        }

        return $controller;
    }

    private function parseUri($uri): string
    {
        $trimmedUri = trim($uri);
        $route = str_replace(BASE_URL, "",  $trimmedUri);
        $trimmedRoute = ltrim($route, "/");

        return $trimmedRoute;
    }
}
