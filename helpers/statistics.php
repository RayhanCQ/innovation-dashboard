<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/functions.php';

class Statistics
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAvailableYears(): array
    {
        $rows = $this->db->fetchAll(
            "SELECT DISTINCT YEAR(tanggal_inovasi) AS tahun
             FROM innovations
             ORDER BY tahun DESC"
        );

        return array_map('intval', array_column($rows, 'tahun'));
    }

    public function getSummary(?int $year = null): array
    {
        $totalOpd = $this->db->fetch("SELECT COUNT(*) AS total FROM opd");

        $sql = "SELECT
                    COUNT(CASE WHEN status = ? THEN 1 END) AS terverifikasi,
                    COUNT(CASE WHEN status = ? THEN 1 END) AS diajukan,
                    COUNT(CASE WHEN status = ? THEN 1 END) AS dikembalikan
                FROM innovations";
        $params = [STATUS_VERIFIED, STATUS_SUBMITTED, STATUS_RETURNED];

        if ($year !== null) {
            $sql .= " WHERE YEAR(tanggal_inovasi) = ?";
            $params[] = $year;
        }

        $row = $this->db->fetch($sql, $params) ?? [];
        $verified = (int)($row['terverifikasi'] ?? 0);

        return [
            'total_opd' => (int)($totalOpd['total'] ?? 0),
            'total_inovasi' => $verified,
            'terverifikasi' => $verified,
            'diajukan' => (int)($row['diajukan'] ?? 0),
            'dikembalikan' => (int)($row['dikembalikan'] ?? 0),
        ];
    }

    public function getDashboardCards(?int $year = null, string $sort = 'DESC', string $keyword = ''): array
    {
        $sort = strtoupper($sort) === 'ASC' ? 'ASC' : 'DESC';
        $params = [STATUS_VERIFIED];
        $innovationYearSql = '';
        $statisticsYearSql = '';
        $statisticsParams = [];

        if ($year !== null) {
            $innovationYearSql = " AND YEAR(tanggal_inovasi) = ?";
            $params[] = $year;
            $statisticsYearSql = " WHERE tahun = ?";
            $statisticsParams[] = $year;
        }

        $sql = "
            SELECT
                o.id,
                o.nama_opd,
                COALESCE(s.total_inovator, 0) AS total_inovator,
                COALESCE(i.total_inovasi, 0) AS total_inovasi
            FROM opd o
            LEFT JOIN (
                SELECT opd_id, COUNT(*) AS total_inovasi
                FROM innovations
                WHERE status = ?{$innovationYearSql}
                GROUP BY opd_id
            ) i ON i.opd_id = o.id
            LEFT JOIN (
                SELECT opd_id, SUM(total_inovator) AS total_inovator
                FROM opd_statistics
                {$statisticsYearSql}
                GROUP BY opd_id
            ) s ON s.opd_id = o.id";

        $params = array_merge($params, $statisticsParams);
        $keyword = trim($keyword);

        if ($keyword !== '') {
            $sql .= " WHERE o.nama_opd LIKE ?";
            $params[] = '%' . $keyword . '%';
        }

        $sql .= " ORDER BY total_inovasi {$sort}, o.nama_opd ASC";
        $rows = $this->db->fetchAll($sql, $params);

        foreach ($rows as $index => &$row) {
            $row['total_inovator'] = (int)$row['total_inovator'];
            $row['total_inovasi'] = (int)$row['total_inovasi'];
            $row['ranking'] = $index + 1;
            $row['rasio'] = formatRatio($row['total_inovasi'], $row['total_inovator']);
            $row['indicator'] = cardIndicator($row['total_inovasi']);
        }
        unset($row);

        return $rows;
    }

    public function getOpd(int $opdId): ?array
    {
        return $this->db->fetch(
            "SELECT id, nama_opd, created_at, updated_at
             FROM opd
             WHERE id = ?",
            [$opdId]
        );
    }

    public function getOpdMetrics(int $opdId, ?int $year = null): array
    {
        $params = [STATUS_VERIFIED];
        $innovationYearSql = '';
        $statisticsYearSql = '';
        $statisticsParams = [];

        if ($year !== null) {
            $innovationYearSql = " AND YEAR(tanggal_inovasi) = ?";
            $params[] = $year;
            $statisticsYearSql = " WHERE tahun = ?";
            $statisticsParams[] = $year;
        }

        $sql = "
            SELECT
                COALESCE(s.total_inovator, 0) AS total_inovator,
                COALESCE(i.total_inovasi, 0) AS total_inovasi
            FROM opd o
            LEFT JOIN (
                SELECT opd_id, COUNT(*) AS total_inovasi
                FROM innovations
                WHERE status = ?{$innovationYearSql}
                GROUP BY opd_id
            ) i ON i.opd_id = o.id
            LEFT JOIN (
                SELECT opd_id, SUM(total_inovator) AS total_inovator
                FROM opd_statistics
                {$statisticsYearSql}
                GROUP BY opd_id
            ) s ON s.opd_id = o.id
            WHERE o.id = ?";

        $row = $this->db->fetch($sql, array_merge($params, $statisticsParams, [$opdId])) ?? [];
        $innovation = (int)($row['total_inovasi'] ?? 0);
        $innovator = (int)($row['total_inovator'] ?? 0);

        return [
            'total_inovator' => $innovator,
            'total_inovasi' => $innovation,
            'rasio' => formatRatio($innovation, $innovator),
        ];
    }

    public function getInnovationList(int $opdId, ?int $year = null): array
    {
        $params = [$opdId];
        $sql = "SELECT id, judul_inovasi, deskripsi, tanggal_inovasi, status
                FROM innovations
                WHERE opd_id = ?";

        if ($year !== null) {
            $sql .= " AND YEAR(tanggal_inovasi) = ?";
            $params[] = $year;
        }

        $sql .= " ORDER BY tanggal_inovasi DESC, id DESC";

        return $this->db->fetchAll($sql, $params);
    }

    public function getOpdCards(?int $year = null, string $sort = 'DESC', string $keyword = ''): array
    {
        return $this->getDashboardCards($year, $sort, $keyword);
    }

    public function getOpdDetail(int $opdId): ?array
    {
        return $this->getOpd($opdId);
    }
}

$statistics = new Statistics();
