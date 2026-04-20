<?php
namespace Core;

class EkaLicense {
    public static function generateKey(): string {
        return strtoupper(bin2hex(random_bytes(4)) . '-' . bin2hex(random_bytes(4)) . '-' . bin2hex(random_bytes(4)) . '-' . bin2hex(random_bytes(4)));
    }
}
