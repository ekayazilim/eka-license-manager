<?php
namespace App\Models;

use Core\EkaModel;

class EkaLicense extends EkaModel {
    public function getAll(): array {
        $stmt = $this->db->query("SELECT * FROM eka_licenses ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public function findByKey(string $key): ?array {
        $stmt = $this->db->prepare("SELECT * FROM eka_licenses WHERE license_key = ? LIMIT 1");
        $stmt->execute([$key]);
        return $stmt->fetch() ?: null;
    }

    public function findById(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM eka_licenses WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function create(array $data): bool {
        $stmt = $this->db->prepare("INSERT INTO eka_licenses (license_key, domain, ip_address, expires_at, status) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['license_key'],
            $data['domain'],
            $data['ip_address'] ?? null,
            $data['expires_at'] ?? null,
            $data['status'] ?? 'active'
        ]);
    }

    public function update(int $id, array $data): bool {
        $stmt = $this->db->prepare("UPDATE eka_licenses SET domain = ?, ip_address = ?, expires_at = ?, status = ? WHERE id = ?");
        return $stmt->execute([
            $data['domain'],
            $data['ip_address'] ?? null,
            $data['expires_at'] ?? null,
            $data['status'] ?? 'active',
            $id
        ]);
    }

    public function countStatus(string $status): int {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM eka_licenses WHERE status = ?");
        $stmt->execute([$status]);
        return (int)$stmt->fetchColumn();
    }

    public function countTotal(): int {
        $stmt = $this->db->query("SELECT COUNT(*) FROM eka_licenses");
        return (int)$stmt->fetchColumn();
    }
}
