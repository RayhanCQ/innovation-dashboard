<?php
/**
 * ------------------------------------------------------------
 * Innovation Dashboard
 * Database Connection (PDO Singleton)
 * Version : 1.0.0
 * ------------------------------------------------------------
 */
// hawooo :3

require_once __DIR__ . '/config.php';

class Database
{
    private static ?Database $instance = null;
    private PDO $connection;

    private function __construct()
    {
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=utf8mb4',
            DB_HOST,
            DB_NAME
        );

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->connection = new PDO(
                $dsn,
                DB_USER,
                DB_PASS,
                $options
            );
        } catch (PDOException $e) {
            if (APP_DEBUG) {
                die(
                    '<h2>Database Connection Failed</h2>' .
                    '<p>' . htmlspecialchars($e->getMessage()) . '</p>'
                );
            }

            die('Database connection failed.');
        }
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }

    public function query(string $sql, array $params = []): PDOStatement
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);

        return $stmt;
    }

    public function fetch(string $sql, array $params = []): ?array
    {
        $stmt = $this->query($sql, $params);
        $row = $stmt->fetch();

        return $row === false ? null : $row;
    }

    public function fetchAll(string $sql, array $params = []): array
    {
        return $this->query($sql, $params)->fetchAll();
    }

    public function execute(string $sql, array $params = []): bool
    {
        return $this->query($sql, $params)->rowCount() >= 0;
    }
}

// Global helper
$db = Database::getInstance();
$conn = $db->getConnection();
