<?php
$isLoggedIn = \Core\EkaAuth::check();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eka Lisans Yönetimi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { min-height: 100vh; background-color: #343a40; }
        .sidebar a { color: #fff; text-decoration: none; display: block; padding: 10px; }
        .sidebar a:hover { background-color: #495057; }
        .content { padding: 20px; }
    </style>
</head>
<body>
    <?php if ($isLoggedIn): ?>
        <div class="d-flex">
            <div class="sidebar p-3" style="width: 250px;">
                <h4 class="text-white">Eka Lisans</h4>
                <hr class="text-white">
                <a href="/dashboard">Dashboard</a>
                <a href="/licenses">Lisanslar</a>
                <a href="/logs">API Logları</a>
                <a href="/logout" class="text-danger">Çıkış Yap</a>
            </div>
            <div class="content flex-grow-1">
                <?= $content ?? '' ?>
            </div>
        </div>
    <?php else: ?>
        <div class="container mt-5">
            <?= $content ?? '' ?>
        </div>
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
