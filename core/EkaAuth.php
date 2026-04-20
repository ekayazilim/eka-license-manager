<?php
namespace Core;

class EkaAuth {
    public static function check(): bool {
        return isset($_SESSION['user_id']);
    }

    public static function user(): ?array {
        if (!self::check()) {
            return null;
        }
        $db = EkaDatabase::getConnection();
        $stmt = $db->prepare("SELECT * FROM eka_users WHERE id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        return $stmt->fetch() ?: null;
    }

    public static function login(int $userId): void {
        $_SESSION['user_id'] = $userId;
    }

    public static function logout(): void {
        unset($_SESSION['user_id']);
        session_destroy();
    }
}
