<?php
namespace App\Middlewares;

use Core\EkaRequest;
use Core\EkaResponse;

class EkaCsrfMiddleware {
    public function handle(EkaRequest $request, EkaResponse $response): void {
        if ($request->getMethod() === 'POST') {
            $body = $request->getBody();
            if (!isset($_SESSION['csrf_token']) || !isset($body['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $body['csrf_token'])) {
                $response->setStatusCode(403);
                die('CSRF token validation failed.');
            }
        } else {
            if (!isset($_SESSION['csrf_token'])) {
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            }
        }
    }
}
