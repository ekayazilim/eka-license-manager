<?php
namespace App\Models;

use Core\EkaModel;

class EkaLog extends EkaModel {
    public function getAll(): array {
        $stmt = $this->db->query("SELECT * FROM eka_logs ORDER BY id DESC LIMIT 500");
        return $stmt->fetchAll();
    }

    public function create(array $data): bool {
        $stmt = $this->db->prepare("INSERT INTO eka_logs (license_key, domain, ip_address, status, reason, request_data) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['license_key'] ?? null,
            $data['domain'] ?? null,
            $data['ip_address'] ?? null,
            $data['status'] ?? 'success',
            $data['reason'] ?? null,
            $data['request_data'] ?? null
        ]);
    }
}
