    </main>

    <footer class="border-top bg-white py-3 mt-4">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <div class="text-muted small">
                &copy; <?= e(date('Y')); ?> <strong><?= e(APP_NAME); ?></strong>
                <span class="mx-1">.</span> Version <?= e(APP_VERSION); ?>
            </div>
            <div class="text-muted small">Dashboard Monitoring Inovasi OPD</div>
        </div>
    </footer>
</div>

<script src="<?= e(BOOTSTRAP_JS); ?>"></script>
<script src="<?= e(BASE_URL); ?>assets/js/app.js"></script>
<script src="<?= e(BASE_URL); ?>assets/js/dashboard.js"></script>
</body>
</html>
