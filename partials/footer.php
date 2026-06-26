<?php
/**
 * ------------------------------------------------------------
 * Innovation Dashboard
 * Shared Footer Layout
 * ------------------------------------------------------------
 */
?>

    </main>

    <footer class="border-top bg-white py-3 mt-5">
        <div class="container">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">

                <div class="text-muted small">
                    &copy; <?= date('Y'); ?>
                    <strong><?= APP_NAME; ?></strong>
                    &middot;
                    Version <?= APP_VERSION; ?>
                </div>

                <div class="text-muted small mt-2 mt-md-0">
                    Dashboard Monitoring Inovasi OPD
                </div>

            </div>

        </div>
    </footer>

</div>

<script src="<?= BOOTSTRAP_JS; ?>"></script>

<script src="<?= BASE_URL; ?>assets/js/app.js"></script>

<script src="<?= BASE_URL; ?>assets/js/dashboard.js"></script>

</body>
</html>
