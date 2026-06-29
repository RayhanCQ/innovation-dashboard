<?php
declare(strict_types=1);

date_default_timezone_set('Asia/Jakarta');

$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
$detectedBaseUrl = ($scriptDir === '/' || $scriptDir === '.') ? '/' : rtrim($scriptDir, '/') . '/';

define('APP_NAME', 'Innovation Dashboard');
define('APP_VERSION', '1.0.0');
define('BASE_URL', getenv('BASE_URL') ?: $detectedBaseUrl);

define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'innovation_dashboard');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');

define('APP_DEBUG', (getenv('APP_DEBUG') ?: 'true') === 'true');
define('DEFAULT_YEAR', 'all');
define('DEFAULT_SORT', 'DESC');

define('STATUS_VERIFIED', 'terverifikasi');
define('STATUS_SUBMITTED', 'diajukan');
define('STATUS_RETURNED', 'dikembalikan');

define('LEVEL_VERY_ACTIVE', 20);
define('LEVEL_ACTIVE', 10);
define('LEVEL_FAIR', 5);

define('BOOTSTRAP_CSS', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css');
define('BOOTSTRAP_JS', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js');
