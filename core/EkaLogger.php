<?php
namespace Core;

class EkaLogger {
    public static function log(string $level, string $message, array $context = []): void {
        $logDir = __DIR__ . '/../storage/logs';
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }
        $logFile = $logDir . '/app.log';
        $time = date('Y-m-d H:i:s');
        $contextString = !empty($context) ? json_encode($context) : '';
        $logEntry = "[$time] [$level] $message $contextString" . PHP_EOL;
        file_put_contents($logFile, $logEntry, FILE_APPEND);
    }
}
