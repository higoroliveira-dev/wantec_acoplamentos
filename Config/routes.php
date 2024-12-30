<?php 
$routes = [
    '/' => ['controller' => 'HomeController', 'action' => 'index'],
    '/contato' => ['controller' => 'ContatoController', 'action' => 'index'],
    '/sobre' => ['controller' => 'AboutController', 'action' => 'index'],
    '/produtos' => ['controller' => 'ProductController', 'action' => 'index'],
    '/contato' => ['controller' => 'ContactController', 'action' => 'index'],
    '/blog' => ['controller' => 'BlogController', 'action' => 'index'],
];

// Autoload de classes
spl_autoload_register(function ($className) {
    $file = ROOT . '/App/Controllers/' . str_replace('\\', '/', $className) . '.php';
    echo $file;
    if (file_exists($file)) {
        require_once $file;
    }
});

// Interpretar a rota atual
$route = $_SERVER['REQUEST_URI'];

// Verificar se a rota existe
if (isset($routes[$route])) {
    $controllerName = $routes[$route]['controller'];
    $action = $routes[$route]['action'];

    $controller = new $controllerName();
    $controller->$action();
} else {
    // Rota não encontrada
    http_response_code(404);
    echo "404 - Página não encontrada";
    //require_once $file;
}