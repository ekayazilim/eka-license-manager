<?php
namespace App\Middlewares;

use Core\EkaRequest;
use Core\EkaResponse;
use Core\EkaLogger;

class EkaRateLimitMiddleware {
    public function handle(EkaRequest $request, EkaResponse $response): void {
        $ip = $request->getIp();
        $key = 'rate_limit_' . md5($ip);
        $limit = 60;
        $window = 60;

        if (!isset($_SESSION[$key])) {
            $_SESSION[$key] = [
                'requests' => 1,
                'start_time' => time()
            ];
        } else {
            if (time() - $_SESSION[$key]['start_time'] > $window) {
                $_SESSION[$key] = [
                    'requests' => 1,
                    'start_time' => time()
                ];
            } else {
                $_SESSION[$key]['requests']++;
                if ($_SESSION[$key]['requests'] > $limit) {
                    EkaLogger::log('WARNING', "Rate limit exceeded for IP: {$ip}");
                    $response->json(['status' => 'error', 'reason' => 'Rate limit exceeded'], 429);
                }
            }
        }
    }
}
