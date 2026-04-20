<?php
session_start();

spl_autoload_register(function ($class) {
    $prefix = '';
    $base_dir = __DIR__ . '/';
    $map = [
        'App\\' => 'app/',
        'Core\\' => 'core/',
        'Config\\' => 'config/'
    ];

    foreach ($map as $prefix => $dir) {
        if (strncmp($prefix, $class, strlen($prefix)) === 0) {
            $relative_class = substr($class, strlen($prefix));
            $file = $base_dir . $dir . str_replace('\\', '/', $relative_class) . '.php';
            if (file_exists($file)) {
                require $file;
            }
        }
    }
});

use Core\EkaRouter;
use Core\EkaRequest;
use Core\EkaResponse;

$request = new EkaRequest();
$response = new EkaResponse();
$router = new EkaRouter($request, $response);

require_once __DIR__ . '/routes/web.php';
require_once __DIR__ . '/routes/api.php';

$router->resolve();
