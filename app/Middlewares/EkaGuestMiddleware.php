<?php
namespace App\Middlewares;

use Core\EkaRequest;
use Core\EkaResponse;
use Core\EkaAuth;

class EkaGuestMiddleware {
    public function handle(EkaRequest $request, EkaResponse $response): void {
        if (EkaAuth::check()) {
            $response->redirect('/dashboard');
        }
    }
}
