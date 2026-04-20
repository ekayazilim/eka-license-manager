<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Lisanslar</h2>
    <a href="/licenses/create" class="btn btn-success">Yeni Lisans Oluştur</a>
</div>
<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Lisans Anahtarı</th>
                    <th>Domain</th>
                    <th>IP</th>
                    <th>Bitiş Tarihi</th>
                    <th>Durum</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($licenses ?? [] as $license): ?>
                <tr>
                    <td><?= $license['id'] ?></td>
                    <td><code><?= htmlspecialchars($license['license_key']) ?></code></td>
                    <td><?= htmlspecialchars($license['domain']) ?></td>
                    <td><?= htmlspecialchars($license['ip_address'] ?: '-') ?></td>
                    <td><?= htmlspecialchars($license['expires_at'] ?: 'Sınırsız') ?></td>
                    <td>
                        <?php
                        $badgeClass = 'bg-success';
                        if ($license['status'] === 'expired') $badgeClass = 'bg-danger';
                        if ($license['status'] === 'suspended') $badgeClass = 'bg-warning';
                        ?>
                        <span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($license['status']) ?></span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
