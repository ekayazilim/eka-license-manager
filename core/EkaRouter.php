<?php
namespace Core;

class EkaRouter {
    public EkaRequest $request;
    public EkaResponse $response;
    private array $routes = [];

    public function __construct(EkaRequest $request, EkaResponse $response) {
        $this->request = $request;
        $this->response = $response;
    }

    public function get(string $path, $callback, array $middlewares = []): void {
        $this->routes['GET'][$path] = ['callback' => $callback, 'middlewares' => $middlewares];
    }

    public function post(string $path, $callback, array $middlewares = []): void {
        $this->routes['POST'][$path] = ['callback' => $callback, 'middlewares' => $middlewares];
    }

    public function resolve(): void {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        
        $route = $this->routes[$method][$path] ?? null;
        $params = [];

        if ($route === null) {
            foreach ($this->routes[$method] ?? [] as $routePath => $routeData) {
                $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9_]+)', $routePath);
                $pattern = "@^" . $pattern . "$@D";
                
                if (preg_match($pattern, $path, $matches)) {
                    array_shift($matches);
                    $route = $routeData;
                    $params = $matches;
                    break;
                }
            }
        }

        if ($route === null) {
            $this->response->setStatusCode(404);
            $controller = new EkaController();
            $controller->render('errors/404');
            exit;
        }

        foreach ($route['middlewares'] as $middleware) {
            $middlewareInstance = new $middleware();
            $middlewareInstance->handle($this->request, $this->response);
        }

        $callback = $route['callback'];

        if (is_array($callback)) {
            $callback[0] = new $callback[0]();
        }

        call_user_func($callback, $this->request, $this->response, $params);
    }
}
