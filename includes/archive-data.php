<?php
declare(strict_types=1);

/**
 * Charge au maximum 12 créations historiques sans interrompre la page
 * si la base locale ou les variables d’environnement sont indisponibles.
 */
function artful_load_archives(int $limit = 12): array
{
    $root = dirname(__DIR__);
    $autoload = $root . '/vendor/autoload.php';
    if (!is_file($autoload)) {
        return [];
    }

    try {
        require_once $autoload;
        if (class_exists(\Dotenv\Dotenv::class) && is_file($root . '/.env')) {
            \Dotenv\Dotenv::createImmutable($root)->safeLoad();
        }

        $host = $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?: '';
        $user = $_ENV['DB_USER'] ?? getenv('DB_USER') ?: '';
        $pass = $_ENV['DB_PASSWORD'] ?? getenv('DB_PASSWORD') ?: '';
        $name = $_ENV['DB_NAME'] ?? getenv('DB_NAME') ?: '';
        if ($host === '' || $user === '' || $name === '') {
            return [];
        }

        mysqli_report(MYSQLI_REPORT_OFF);
        $db = @new mysqli($host, $user, $pass, $name);
        if ($db->connect_errno) {
            return [];
        }
        $db->set_charset('utf8mb4');

        $limit = max(1, min(24, $limit));
        $sql = "SELECT id, title, slug, content, image, date FROM creations ORDER BY id DESC LIMIT {$limit}";
        $result = $db->query($sql);
        if (!$result) {
            $db->close();
            return [];
        }

        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $db->close();
        return $rows;
    } catch (Throwable $exception) {
        return [];
    }
}
