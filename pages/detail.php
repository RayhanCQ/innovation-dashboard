<?php
declare(strict_types=1);

$availableYears = $statistics->getAvailableYears();
$yearValue = (string)($_GET['year'] ?? DEFAULT_YEAR);
$year = null;

if (!isAllTime($yearValue) && ctype_digit($yearValue)) {
    $candidateYear = (int)$yearValue;
    if (in_array($candidateYear, $availableYears, true)) {
        $year = $candidateYear;
        $yearValue = (string)$candidateYear;
    } else {
        $yearValue = DEFAULT_YEAR;
    }
} else {
    $yearValue = DEFAULT_YEAR;
}

$opdId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
$opdId = $opdId === false ? null : $opdId;
$opd = $opdId === null ? null : $statistics->getOpd($opdId);
$metrics = $opd === null ? ['total_inovator' => 0, 'total_inovasi' => 0, 'rasio' => '0.00'] : $statistics->getOpdMetrics((int)$opd['id'], $year);
$innovations = $opd === null ? [] : $statistics->getInnovationList((int)$opd['id'], $year);
$backParams = ['page' => 'dashboard'];

if ($year !== null) {
    $backParams['year'] = $year;
}

require __DIR__ . '/../partials/header.php';
require __DIR__ . '/../partials/navbar.php';
?>
<main class="py-4">
    <section class="container">
        <?php if ($opd === null): ?>
            <div class="empty-state text-center">
                <i class="bi bi-exclamation-circle display-6 text-muted"></i>
                <h1 class="h4 mt-3 mb-2">Data tidak ditemukan.</h1>
                <a class="btn btn-primary" href="<?= e(BASE_URL); ?>?page=dashboard">
                    <i class="bi bi-arrow-left me-1"></i>Kembali ke Dashboard
                </a>
            </div>
        <?php else: ?>
            <div class="detail-toolbar mb-4">
                <a class="btn btn-outline-primary" href="<?= e(BASE_URL . '?' . http_build_query($backParams)); ?>">
                    <i class="bi bi-arrow-left me-1"></i>Dashboard
                </a>
                <form class="d-flex align-items-center gap-2" method="get" action="<?= e(BASE_URL); ?>">
                    <input type="hidden" name="page" value="detail">
                    <input type="hidden" name="id" value="<?= e($opd['id']); ?>">
                    <label class="form-label mb-0 fw-semibold" for="year">Tahun</label>
                    <select class="form-select detail-year-select" id="year" name="year" data-auto-submit>
                        <option value="all" <?= selected('all', $yearValue); ?>>All Time</option>
                        <?php foreach ($availableYears as $availableYear): ?>
                            <option value="<?= e($availableYear); ?>" <?= selected($availableYear, $yearValue); ?>>
                                <?= e($availableYear); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>

            <div class="dashboard-heading mb-4">
                <p class="text-primary fw-semibold mb-1">Detail OPD</p>
                <h1 class="h3 fw-bold mb-1"><?= e($opd['nama_opd']); ?></h1>
                <p class="text-muted mb-0">Daftar inovasi dan ringkasan produktivitas OPD.</p>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-12 col-md-4">
                    <div class="summary-card h-100">
                        <div class="summary-title">Total Inovator</div>
                        <div class="summary-value"><?= e($metrics['total_inovator']); ?></div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="summary-card h-100">
                        <div class="summary-title">Inovasi Terverifikasi</div>
                        <div class="summary-value"><?= e($metrics['total_inovasi']); ?></div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="summary-card h-100">
                        <div class="summary-title">Rasio Inovasi</div>
                        <div class="summary-value"><?= e($metrics['rasio']); ?></div>
                    </div>
                </div>
            </div>

            <div class="table-panel">
                <div class="d-flex justify-content-between align-items-center gap-3 mb-3">
                    <h2 class="h5 fw-bold mb-0">Innovation List</h2>
                    <span class="text-muted small"><?= e(count($innovations)); ?> data</span>
                </div>

                <?php if ($innovations === []): ?>
                    <div class="empty-state compact text-center">
                        <i class="bi bi-inbox text-muted fs-1"></i>
                        <p class="text-muted mb-0 mt-2">Belum ada inovasi untuk filter ini.</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th class="text-nowrap">Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($innovations as $innovation): ?>
                                    <tr>
                                        <td>
                                            <div class="fw-semibold"><?= e($innovation['judul_inovasi']); ?></div>
                                            <?php if (!empty($innovation['deskripsi'])): ?>
                                                <div class="text-muted small"><?= e($innovation['deskripsi']); ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-nowrap"><?= e(formatDate($innovation['tanggal_inovasi'])); ?></td>
                                        <td>
                                            <span class="badge text-bg-<?= e(statusBadge($innovation['status'])); ?>">
                                                <?= e(statusLabel($innovation['status'])); ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </section>
<?php require __DIR__ . '/../partials/footer.php'; ?>
