<?php
/**
 * ------------------------------------------------------------
 * Innovation Dashboard
 * Statistics Helper
 * Semua query dashboard dipusatkan di sini.
 * ------------------------------------------------------------
 */

require_once __DIR__ . '/../config/database.php';

class Statistics
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAvailableYears(): array
    {
        $sql = "SELECT DISTINCT YEAR(tanggal_inovasi) AS tahun
                FROM innovations
                ORDER BY tahun DESC";

        return $this->db->fetchAll($sql);
    }

    public function getSummary(?int $year = null): array
    {
        $params = [];

        $where = "";
        if ($year !== null) {
            $where = "WHERE YEAR(tanggal_inovasi)=?";
            $params[] = $year;
        }

        $summary = [];

        $summary['total_opd'] = $this->db->fetch(
            "SELECT COUNT(*) AS total FROM opd"
        )['total'];

        $summary['total_inovasi'] = $this->db->fetch(
            "SELECT COUNT(*) AS total FROM innovations $where",
            $params
        )['total'];

        $summary['terverifikasi'] = $this->db->fetch(
            "SELECT COUNT(*) AS total FROM innovations
             $where " . ($where ? "AND" : "WHERE") . " status=?",
            array_merge($params, [STATUS_VERIFIED])
        )['total'];

        $summary['diajukan'] = $this->db->fetch(
            "SELECT COUNT(*) AS total FROM innovations
             $where " . ($where ? "AND" : "WHERE") . " status=?",
            array_merge($params, [STATUS_SUBMITTED])
        )['total'];

        $summary['dikembalikan'] = $this->db->fetch(
            "SELECT COUNT(*) AS total FROM innovations
             $where " . ($where ? "AND" : "WHERE") . " status=?",
            array_merge($params, [STATUS_RETURNED])
        )['total'];

        return $summary;
    }

    public function getOpdCards(?int $year = null, string $sort = 'DESC', string $keyword = ''): array
    {
        $params = [];

        $sql = "
        SELECT
            o.id,
            o.nama_opd,
            COALESCE(s.total_inovator,0) AS total_inovator,
            COUNT(i.id) AS total_inovasi
        FROM opd o
        LEFT JOIN innovations i
            ON o.id=i.opd_id
            AND i.status=?";

        $params[] = STATUS_VERIFIED;

        if ($year !== null) {
            $sql .= " AND YEAR(i.tanggal_inovasi)=?";
            $params[] = $year;
        }

        $sql .= "
        LEFT JOIN opd_statistics s
            ON o.id=s.opd_id";

        if ($year !== null) {
            $sql .= " AND s.tahun=?";
            $params[] = $year;
        }

        $sql .= " WHERE 1=1";

        if ($keyword !== '') {
            $sql .= " AND o.nama_opd LIKE ?";
            $params[] = "%{$keyword}%";
        }

        $sort = strtoupper($sort) === 'ASC' ? 'ASC' : 'DESC';

        $sql .= "
        GROUP BY o.id,o.nama_opd,s.total_inovator
        ORDER BY total_inovasi {$sort}, o.nama_opd ASC";

        $rows = $this->db->fetchAll($sql, $params);

        foreach ($rows as $i => &$row) {
            $row['ranking'] = $i + 1;
            $row['rasio'] = formatRatio(
                (int)$row['total_inovasi'],
                (int)$row['total_inovator']
            );
            $row['indicator'] = cardIndicator((int)$row['total_inovasi']);
        }

        return $rows;
    }

    public function getOpdDetail(int $opdId): ?array
    {
        return $this->db->fetch(
            "SELECT * FROM opd WHERE id=?",
            [$opdId]
        );
    }

    public function getInnovationList(int $opdId, ?int $year = null): array
    {
        $params = [$opdId];

        $sql = "
        SELECT
            judul_inovasi,
            tanggal_inovasi,
            status
        FROM innovations
        WHERE opd_id=?";

        if ($year !== null) {
            $sql .= " AND YEAR(tanggal_inovasi)=?";
            $params[] = $year;
        }

        $sql .= "
        ORDER BY tanggal_inovasi DESC";

        return $this->db->fetchAll($sql, $params);
    }
}

$statistics = new Statistics();
