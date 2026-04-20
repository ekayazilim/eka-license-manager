<?php
namespace Config;

class EkaAppConfig {
    public static function get(): array {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $domainName = $_SERVER['HTTP_HOST'];
        return [
            'base_url' => $protocol . $domainName,
            'name' => 'Eka Sunucu Bilişim Sistemleri'
        ];
    }
}
