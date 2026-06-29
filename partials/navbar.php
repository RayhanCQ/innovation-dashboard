<?php
$currentPage = $_GET['page'] ?? 'dashboard';
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= e(BASE_URL); ?>">
            <i class="bi bi-bar-chart-fill me-2"></i><?= e(APP_NAME); ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?= e(activeMenu('dashboard', (string)$currentPage)); ?>" href="<?= e(BASE_URL); ?>?page=dashboard">
                        <i class="bi bi-speedometer2 me-1"></i>Dashboard
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
