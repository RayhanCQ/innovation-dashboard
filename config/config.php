<?php
/**
 * ------------------------------------------------------------
 * Innovation Dashboard
 * Configuration File
 * Version : 1.0.0
 * ------------------------------------------------------------
 */

date_default_timezone_set('Asia/Jakarta');

define('APP_NAME', 'Innovation Dashboard');
define('APP_VERSION', '1.0.0');

/*
|--------------------------------------------------------------------------
| Base URL
|--------------------------------------------------------------------------
| Ubah sesuai lokasi project.
| Contoh:
| http://localhost/innovation-dashboard/
*/

define('BASE_URL', 'http://localhost/innovation-dashboard/');

/*
|--------------------------------------------------------------------------
| Database Configuration
|--------------------------------------------------------------------------
*/

define('DB_HOST', 'localhost');
define('DB_NAME', 'innovation_dashboard');
define('DB_USER', 'root');
define('DB_PASS', '');

/*
|--------------------------------------------------------------------------
| Application Settings
|--------------------------------------------------------------------------
*/

define('APP_DEBUG', true);
define('DEFAULT_YEAR', 'all');
define('DEFAULT_SORT', 'desc');

/*
|--------------------------------------------------------------------------
| Status Constants
|--------------------------------------------------------------------------
*/

define('STATUS_VERIFIED', 'terverifikasi');
define('STATUS_SUBMITTED', 'diajukan');
define('STATUS_RETURNED', 'dikembalikan');

/*
|--------------------------------------------------------------------------
| Card Indicator Threshold
|--------------------------------------------------------------------------
| Digunakan untuk menentukan warna indikator card.
*/

define('LEVEL_VERY_ACTIVE', 20);
define('LEVEL_ACTIVE', 10);
define('LEVEL_FAIR', 5);

/*
|--------------------------------------------------------------------------
| Pagination
|--------------------------------------------------------------------------
*/

define('ITEMS_PER_PAGE', 8);

/*
|--------------------------------------------------------------------------
| Bootstrap CDN
|--------------------------------------------------------------------------
*/

define(
    'BOOTSTRAP_CSS',
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css'
);

define(
    'BOOTSTRAP_JS',
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js'
);
