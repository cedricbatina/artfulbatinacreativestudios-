<?php
declare(strict_types=1);

session_start();

$locale = $_SESSION['artful_locale'] ?? 'fr';
if (!in_array($locale, ['fr', 'en', 'pt'], true)) {
    $locale = 'fr';
}

$base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
if ($base === '/') {
    $base = '';
}

header('Location: ' . $base . '/' . $locale . '/', true, 302);
exit;
