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

$sort = strtoupper((string)($_GET['sort'] ?? DEFAULT_SORT));
if (!in_array($sort, ['ASC', 'DESC'], true)) {
    $sort = DEFAULT_SORT;
}

$keyword = substr(trim((string)($_GET['keyword'] ?? '')), 0, 100);
$summary = $statistics->getSummary($year);
$cards = $statistics->getDashboardCards($year, $sort, $keyword);

$summaryCards = [
    ['label' => 'Total OPD', 'value' => $summary['total_opd'], 'icon' => 'bi-building'],
    ['label' => 'Total Inovasi', 'value' => $summary['total_inovasi'], 'icon' => 'bi-lightbulb'],
    ['label' => 'Terverifikasi', 'value' => $summary['terverifikasi'], 'icon' => 'bi-check-circle'],
    ['label' => 'Diajukan', 'value' => $summary['diajukan'], 'icon' => 'bi-send'],
    ['label' => 'Dikembalikan', 'value' => $summary['dikembalikan'], 'icon' => 'bi-arrow-counterclockwise'],
];

require __DIR__ . '/../partials/header.php';
require __DIR__ . '/../partials/navbar.php';
?>
<main class="py-4">
    <section class="container">
        <div class="dashboard-heading mb-4">
            <p class="text-primary fw-semibold mb-1">Monitoring OPD</p>
            <h1 class="h3 fw-bold mb-1">Dashboard Monitoring Inovasi OPD</h1>
            <p class="text-muted mb-0">Monitoring produktivitas inovasi Organisasi Perangkat Daerah.</p>
        </div>

        <div class="row g-3 mb-4">
            <?php foreach ($summaryCards as $card): ?>
                <div class="col-6 col-lg">
                    <div class="summary-card h-100">
                        <div class="d-flex align-items-center justify-content-between gap-3">
                            <div>
                                <div class="summary-title"><?= e($card['label']); ?></div>
                                <div class="summary-value"><?= e($card['value']); ?></div>
                            </div>
                            <i class="bi <?= e($card['icon']); ?> summary-icon"></i>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <form class="filter-card" method="get" action="<?= e(BASE_URL); ?>">
            <input type="hidden" name="page" value="dashboard">
            <div class="row g-3 align-items-end">
                <div class="col-12 col-md-3 col-xl-2">
                    <label class="form-label fw-semibold" for="year">Tahun</label>
                    <select class="form-select" id="year" name="year" data-auto-submit>
                        <option value="all" <?= selected('all', $yearValue); ?>>All Time</option>
                        <?php foreach ($availableYears as $availableYear): ?>
                            <option value="<?= e($availableYear); ?>" <?= selected($availableYear, $yearValue); ?>>
                                <?= e($availableYear); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-12 col-md-3 col-xl-2">
                    <label class="form-label fw-semibold" for="sort">Urutkan</label>
                    <select class="form-select" id="sort" name="sort" data-auto-submit>
                        <option value="DESC" <?= selected('DESC', $sort); ?>>Highest to Lowest</option>
                        <option value="ASC" <?= selected('ASC', $sort); ?>>Lowest to Highest</option>
                    </select>
                </div>

                <div class="col-12 col-md-6 col-xl-5">
                    <label class="form-label fw-semibold" for="keyword">Cari OPD</label>
                    <input class="form-control" id="keyword" name="keyword" value="<?= e($keyword); ?>" placeholder="Nama OPD" data-search-input>
                </div>

                <div class="col-12 col-xl-3 d-flex gap-2">
                    <button class="btn btn-primary flex-fill" type="submit">
                        <i class="bi bi-funnel me-1"></i>Terapkan
                    </button>
                    <a class="btn btn-outline-secondary flex-fill" href="<?= e(BASE_URL); ?>?page=dashboard">
                        <i class="bi bi-arrow-clockwise me-1"></i>Reset
                    </a>
                </div>
            </div>
        </form>

        <?php if ($cards === []): ?>
            <div class="empty-state text-center">
                <i class="bi bi-search display-6 text-muted"></i>
                <h2 class="h5 mt-3 mb-1">Data tidak ditemukan.</h2>
                <p class="text-muted mb-0">Coba ubah tahun atau kata kunci pencarian.</p>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($cards as $card): ?>
                    <?php
                    $indicator = $card['indicator'];
                    $detailParams = ['page' => 'detail', 'id' => (int)$card['id']];
                    if ($year !== null) {
                        $detailParams['year'] = $year;
                    }
                    ?>
                    <div class="col-12 col-md-6 col-xl-4">
                        <article class="opd-card position-relative h-100">
                            <div class="card-indicator indicator-<?= e($indicator['class']); ?>"></div>
                            <div class="card-body-custom d-flex flex-column h-100">
                                <span class="rank-badge"><?= e(rankingBadge((int)$card['ranking'])); ?></span>
                                <div class="activity-label mb-3">
                                    <span class="status-dot indicator-<?= e($indicator['class']); ?>"></span>
                                    <?= e($indicator['label']); ?>
                                </div>
                                <h2 class="card-title-opd mb-3"><?= e($card['nama_opd']); ?></h2>
                                <div class="card-stat">
                                    <span>Total Inovator</span>
                                    <strong><?= e($card['total_inovator']); ?></strong>
                                </div>
                                <div class="card-stat">
                                    <span>Inovasi Terverifikasi</span>
                                    <strong><?= e($card['total_inovasi']); ?></strong>
                                </div>
                                <div class="ratio-box mb-3">
                                    <span class="d-block text-muted small">Rasio Inovasi</span>
                                    <strong><?= e($card['rasio']); ?></strong>
                                </div>
                                <a class="btn btn-primary mt-auto" href="<?= e(BASE_URL . '?' . http_build_query($detailParams)); ?>">
                                    <i class="bi bi-box-arrow-up-right me-1"></i>Lihat Detail
                                </a>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
<?php require __DIR__ . '/../partials/footer.php'; ?>
