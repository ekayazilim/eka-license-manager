<?php
namespace Config;

class EkaDatabaseConfig {
    public static function get(): array {
        return [
            'host' => '127.0.0.1',
            'dbname' => 'eka_license_manager',
            'user' => 'root',
            'password' => 'ServBay.dev',
            'charset' => 'utf8mb4'
        ];
    }
}
