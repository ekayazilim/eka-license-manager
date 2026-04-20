<?php
use App\Controllers\EkaApiController;
use App\Middlewares\EkaRateLimitMiddleware;

$router->post('/api/v1/validate', [EkaApiController::class, 'validateLicense'], [EkaRateLimitMiddleware::class]);
