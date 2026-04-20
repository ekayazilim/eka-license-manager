<?php
namespace App\Models;

use Core\EkaModel;

class EkaUser extends EkaModel {
    public function findByEmail(string $email): ?array {
        $stmt = $this->db->prepare("SELECT * FROM eka_users WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        return $stmt->fetch() ?: null;
    }

    public function findById(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM eka_users WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }
}
