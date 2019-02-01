<?php
namespace Helpers;

class Router
{
    private $routes = [];
    private $controller;
    private $method;

    public function __construct(){
        $this->loadRoutes();
    }

    private function loadRoutes(){
        $this->routes = json_decode(
            file_get_contents(
                "config/routes.json"),
            true
        );

        //print_r($this->routes);
    }

    public function addRoute($params)
    {
        $this->routes[] = $params;
    }

    public function match($url, $verb)
    {
        foreach ($this->routes as $route) {
            //echo $route['uri'] .'=='. $url;
            if (($route['uri'] == $url)
                && ($route['verb'] == strtolower($verb))) {
                 $actionName = $route['action'] . 'Action';
                $controllerClass = "Controllers\\".ucfirst($route['module']) . 'Controller';
                 $actionName = $route['action'] . 'Action';

                if (!class_exists($controllerClass) ||
                    !method_exists($controllerClass, $actionName)){
                    $module = 'default';
                    $action = 'notfound';
                    $controllerClass = "Controllers\\".ucfirst($module) . 'Controller';
                    $actionName = $action . 'Action';
                }
                $this->controller = new $controllerClass();
                $this->method = $actionName;
                return true;
            }
        }
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function execute()
    {
        $this->controller->{$this->method}();
    }
}