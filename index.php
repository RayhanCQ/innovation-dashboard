<?php
declare(strict_types=1);
/**
 * Innovation Dashboard
 * Front Controller
 */
session_start();

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/helpers/functions.php';
require_once __DIR__ . '/helpers/statistics.php';

$page = $_GET['page'] ?? 'dashboard';

$routes = [
    'dashboard' => __DIR__ . '/pages/dashboard.php',
    'detail' => __DIR__ . '/pages/detail.php',
];

if (!isset($routes[$page])) {
    http_response_code(404);
    ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>404 - Page Not Found</title>
<style>
body{margin:0;font-family:Arial,sans-serif;background:#f8f9fa;display:flex;justify-content:center;align-items:center;height:100vh}
.card{background:#fff;padding:40px;border-radius:12px;box-shadow:0 5px 20px rgba(0,0,0,.1);text-align:center}
a{color:#0d6efd;text-decoration:none}
</style>
</head>
<body>
<div class="card">
<h1>404</h1>
<p>Halaman tidak ditemukan.</p>
<a href="<?= BASE_URL; ?>">Kembali ke Dashboard</a>
</div>
</body>
</html>
<?php
    exit;
}

require_once $routes[$page];
