<?php
use App\Controllers\EkaAuthController;
use App\Controllers\EkaDashboardController;
use App\Controllers\EkaLicenseController;
use App\Controllers\EkaLogController;
use App\Middlewares\EkaAuthMiddleware;
use App\Middlewares\EkaGuestMiddleware;
use App\Middlewares\EkaCsrfMiddleware;

$router->get('/', function($request, $response) {
    $response->redirect('/dashboard');
});

$router->get('/login', [EkaAuthController::class, 'loginView'], [EkaGuestMiddleware::class, EkaCsrfMiddleware::class]);
$router->post('/login', [EkaAuthController::class, 'loginAction'], [EkaGuestMiddleware::class, EkaCsrfMiddleware::class]);
$router->get('/logout', [EkaAuthController::class, 'logout']);

$router->get('/dashboard', [EkaDashboardController::class, 'index'], [EkaAuthMiddleware::class]);

$router->get('/licenses', [EkaLicenseController::class, 'index'], [EkaAuthMiddleware::class]);
$router->get('/licenses/create', [EkaLicenseController::class, 'createView'], [EkaAuthMiddleware::class, EkaCsrfMiddleware::class]);
$router->post('/licenses/store', [EkaLicenseController::class, 'store'], [EkaAuthMiddleware::class, EkaCsrfMiddleware::class]);

$router->get('/logs', [EkaLogController::class, 'index'], [EkaAuthMiddleware::class]);
