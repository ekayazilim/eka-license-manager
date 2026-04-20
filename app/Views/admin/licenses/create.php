<h2>Yeni Lisans Oluştur</h2>
<div class="card mt-3">
    <div class="card-body">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form action="/licenses/store" method="POST">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
            <div class="mb-3">
                <label class="form-label">Domain Adresi (Çoklu domain için virgül kullanın, Tümü için * girin)</label>
                <input type="text" name="domain" class="form-control" placeholder="ornek.com" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Sabit IP Adresi (Opsiyonel)</label>
                <input type="text" name="ip_address" class="form-control" placeholder="192.168.1.1">
            </div>
            <div class="mb-3">
                <label class="form-label">Bitiş Tarihi (Opsiyonel)</label>
                <input type="datetime-local" name="expires_at" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Durum</label>
                <select name="status" class="form-control">
                    <option value="active">Aktif</option>
                    <option value="suspended">Askıya Alınmış</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Oluştur ve Kaydet</button>
        </form>
    </div>
</div>
