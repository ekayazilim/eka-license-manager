<?php
namespace Core;

class EkaResponse {
    public function setStatusCode(int $code): void {
        http_response_code($code);
    }

    public function json(array $data, int $code = 200): void {
        header('Content-Type: application/json');
        $this->setStatusCode($code);
        echo json_encode($data);
        exit;
    }

    public function redirect(string $url): void {
        header("Location: $url");
        exit;
    }
}
