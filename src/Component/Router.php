<?php

namespace User\Test\Component;

class Router
{
    private array $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes[$_SERVER['REQUEST_METHOD']];
    }

    public function run()
    {
        $uri = $this->getUri();

        // $routes = $this->routes[$_SERVER['REQUEST_METHOD']];

        foreach ($this->routes as $routeUri => $routeInternal) {
            if (!preg_match("~$routeUri~", $uri)) {
                continue;
            }

            // Тут мы нашли роут

            $routeInternal = preg_replace("~$routeUri~", $routeInternal, $uri); // 'users\/([0-9]+)' (users/444) => 'users/view/$1' 

            $routeInternalParts = explode('/', $routeInternal); // "users/1" => ['users', 'view', '1']

            $controllerName = CONTROLLER_NAMESPACE . '\\' . ucfirst(array_shift($routeInternalParts)) . '\\' . ucfirst(array_shift($routeInternalParts)) . 'Controller'; // App\Mvc\Controller\MainController
            $actionName = 'action' . ucfirst(array_shift($routeInternalParts)); // "actionIndex"

            $controller = new $controllerName(); // создали объект класса MainController
            $controller->$actionName(...$routeInternalParts); // вызываем метод actionIndex() ['1', '3'] => function actionName($firstValue, $secondValue)
            // через деструктуризацию присваеваем параметрам которые передаем в метод значение 1 первому, 3 второму
            return;
        }

        echo '404 not found!';
    }

    private function getUri(): string
    {
        return trim($_SERVER['REQUEST_URI'], '/'); // "/users/1/create/" => "users/1/create"
    }
}
