<h2>API Logları</h2>
<div class="card mt-3">
    <div class="card-body">
        <table class="table table-striped table-sm text-center">
            <thead>
                <tr>
                    <th>Tarih</th>
                    <th>Lisans Anahtarı</th>
                    <th>Domain</th>
                    <th>IP</th>
                    <th>Durum</th>
                    <th>Sebep</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logs ?? [] as $log): ?>
                <tr>
                    <td><?= htmlspecialchars($log['created_at']) ?></td>
                    <td><code><?= htmlspecialchars($log['license_key'] ?? '-') ?></code></td>
                    <td><?= htmlspecialchars($log['domain'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($log['ip_address'] ?? '-') ?></td>
                    <td>
                        <?php if ($log['status'] === 'success'): ?>
                            <span class="badge bg-success">Başarılı</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Başarısız</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($log['reason'] ?? '-') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
