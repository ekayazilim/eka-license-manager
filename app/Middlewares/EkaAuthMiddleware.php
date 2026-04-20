<?php
namespace App\Middlewares;

use Core\EkaRequest;
use Core\EkaResponse;
use Core\EkaAuth;

class EkaAuthMiddleware {
    public function handle(EkaRequest $request, EkaResponse $response): void {
        if (!EkaAuth::check()) {
            $response->redirect('/login');
        }
    }
}
