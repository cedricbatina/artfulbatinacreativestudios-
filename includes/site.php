<?php
declare(strict_types=1);

const ARTFUL_VERSION = '2.2.0';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once __DIR__ . '/i18n.php';

/** Chemin web du site (vide en prod racine, ex. /artfulbatinacreativestudios en local XAMPP). */
function artful_base_path(): string
{
    static $base = null;
    if ($base !== null) {
        return $base;
    }
    $script = str_replace('\\', '/', (string)($_SERVER['SCRIPT_NAME'] ?? ''));
    $dir = dirname($script);
    if ($dir === '/' || $dir === '.' || $dir === '\\') {
        $base = '';
    } else {
        $base = rtrim($dir, '/');
    }
    return $base;
}

function artful_base_url(): string
{
    static $url = null;
    if ($url !== null) {
        return $url;
    }
    $host = (string)($_SERVER['HTTP_HOST'] ?? 'localhost');
    $isLocal = $host === 'localhost' || str_starts_with($host, '127.0.0.1');
    if ($isLocal) {
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $url = $scheme . '://' . $host . artful_base_path();
    } else {
        $url = 'https://www.artfulbatinacreativestudios.fr';
    }
    return $url;
}

function artful_e(?string $value): string
{
    return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function artful_url(string $path = ''): string
{
    return rtrim(artful_base_url(), '/') . '/' . ltrim($path, '/');
}

function artful_asset(string $path): string
{
    return artful_base_path() . '/' . ltrim($path, '/');
}

function artful_logo_url(): string
{
    $candidates = [
        'images/pictures/official_logo_transparent.png',
        'images/pictures/official_logo_@bc_transparent.png',
        'images/official_logo_@bc_transparent_.png',
    ];
    foreach ($candidates as $path) {
        if (is_file(dirname(__DIR__) . '/' . $path)) {
            return artful_asset($path);
        }
    }
    return artful_asset('images/logo_share.png');
}

function artful_localize_html(string $html): string
{
    $base = artful_base_path();
    if ($base === '') {
        return $html;
    }
    return str_replace(['src="/images/', 'href="/cv-'], ['src="' . $base . '/images/', 'href="' . $base . '/cv-'], $html);
}

function artful_page_meta(array $overrides = []): array
{
    return array_merge([
        'title' => (string)t('meta.default_title'),
        'description' => (string)t('meta.default_description'),
        'canonical' => artful_absolute_route(artful_route_name(), artful_locale()),
        'image' => artful_url('images/cedric-batina-founder.webp'),
        'robots' => 'index, follow',
        'type' => 'website',
    ], $overrides);
}

function artful_render_head(array $meta, ?array $jsonLd = null): void
{
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= artful_e($meta['title']) ?></title>
<meta name="description" content="<?= artful_e($meta['description']) ?>">
<meta name="author" content="Cédric Batina">
<meta name="robots" content="<?= artful_e($meta['robots']) ?>">
<link rel="canonical" href="<?= artful_e($meta['canonical']) ?>">
<?php foreach (ARTFUL_SUPPORTED_LOCALES as $locale): ?>
<link rel="alternate" hreflang="<?= $locale ?>" href="<?= artful_e(artful_absolute_route(artful_route_name(), $locale)) ?>">
<?php endforeach; ?>
<link rel="alternate" hreflang="x-default" href="<?= artful_e(artful_absolute_route(artful_route_name(), 'fr')) ?>">
<meta property="og:locale" content="<?= artful_e((string)t('meta.og_locale')) ?>">
<meta property="og:type" content="<?= artful_e($meta['type']) ?>">
<meta property="og:site_name" content="Artful Batina Creative Studios">
<meta property="og:title" content="<?= artful_e($meta['title']) ?>">
<meta property="og:description" content="<?= artful_e($meta['description']) ?>">
<meta property="og:url" content="<?= artful_e($meta['canonical']) ?>">
<meta property="og:image" content="<?= artful_e($meta['image']) ?>">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= artful_e($meta['title']) ?>">
<meta name="twitter:description" content="<?= artful_e($meta['description']) ?>">
<meta name="twitter:image" content="<?= artful_e($meta['image']) ?>">
<link rel="icon" href="<?= artful_e(artful_asset('images/favicon.ico')) ?>" sizes="any">
<link rel="stylesheet" href="<?= artful_e(artful_asset('css/artful-tokens.css')) ?>?v=<?= ARTFUL_VERSION ?>">
<link rel="stylesheet" href="<?= artful_e(artful_asset('css/artful-2.0.0.css')) ?>?v=<?= ARTFUL_VERSION ?>">
<link rel="stylesheet" href="<?= artful_e(artful_asset('css/artful-i18n.css')) ?>?v=<?= ARTFUL_VERSION ?>">
<link rel="stylesheet" href="<?= artful_e(artful_asset('css/artful-premium.css')) ?>?v=<?= ARTFUL_VERSION ?>">
<link rel="stylesheet" href="<?= artful_e(artful_asset('css/artful-2.2.css')) ?>?v=<?= ARTFUL_VERSION ?>">
<?php if ($jsonLd !== null): ?>
<script type="application/ld+json"><?= json_encode($jsonLd, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) ?></script>
<?php endif;
}

/** Routes affichées dans la navigation principale (SC-0011 : 4 entrées max). */
function artful_primary_nav_routes(): array
{
    return ['home', 'studio', 'works', 'contact'];
}

function artful_nav_active(string $route): string
{
    return artful_route_name() === $route ? ' aria-current="page" class="is-active"' : '';
}
