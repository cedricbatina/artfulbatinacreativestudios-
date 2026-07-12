<?php
declare(strict_types=1);
require_once __DIR__.'/includes/site.php';

$locale = strtolower((string)($_GET['lang'] ?? ''));
if (!in_array($locale, ARTFUL_SUPPORTED_LOCALES, true)) {
    $locale = artful_locale();
}

header('Location: ' . artful_route('works', $locale), true, 301);
exit;
