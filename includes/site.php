<?php
declare(strict_types=1);

const ARTFUL_VERSION = '2.2.8';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once __DIR__ . '/i18n.php';
require_once __DIR__ . '/portraits.php';

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
    $portraitKey = (string)($overrides['portrait'] ?? artful_portrait_for_route());
    $portraitMeta = artful_portrait_og_meta($portraitKey);
    unset($overrides['portrait']);

    return array_merge([
        'title' => (string)t('meta.default_title'),
        'description' => (string)t('meta.default_description'),
        'canonical' => artful_absolute_route(artful_route_name(), artful_locale()),
        'robots' => 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
        'type' => 'website',
        'portrait_key' => $portraitKey,
    ], $portraitMeta, $overrides);
}

/** Graphe Schema.org de base (Organization + Person + WebSite). */
function artful_schema_graph(array $extra = []): array
{
    $base = rtrim(artful_base_url(), '/');
    $orgId = $base . '/#organization';
    $personId = $base . '/#person';
    $websiteId = $base . '/#website';
    $logo = artful_url('images/pictures/official_logo_transparent.png');
    if (!is_file(dirname(__DIR__) . '/images/pictures/official_logo_transparent.png')) {
        $logo = artful_url('images/logo_share.png');
    }

    $graph = [
        [
            '@type' => 'WebSite',
            '@id' => $websiteId,
            'url' => $base . '/',
            'name' => '@rtful Batina Creative Studios',
            'alternateName' => 'ABCS',
            'inLanguage' => ['fr-FR', 'en', 'pt'],
            'publisher' => ['@id' => $orgId],
            'copyrightHolder' => ['@id' => $orgId],
        ],
        [
            '@type' => 'Organization',
            '@id' => $orgId,
            'name' => '@rtful Batina Creative Studios',
            'legalName' => 'Artful Batina Creative Studios',
            'url' => $base . '/',
            'logo' => [
                '@type' => 'ImageObject',
                'url' => $logo,
            ],
            'image' => artful_portrait_url('studio', 'og'),
            'email' => 'contact@artfulbatinacreativestudios.fr',
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Gradignan',
                'addressCountry' => 'FR',
            ],
            'founder' => ['@id' => $personId],
            'sameAs' => [
                'https://batina-media.com',
                'https://www.linkedin.com/in/cedric-batina-6b17b31a7/',
            ],
        ],
        [
            '@type' => 'Person',
            '@id' => $personId,
            'name' => 'Cédric Batina',
            'jobTitle' => 'Fondateur',
            'url' => artful_absolute_route('about', artful_locale()),
            'image' => artful_portrait_url('studio', '960'),
            'worksFor' => ['@id' => $orgId],
            'sameAs' => [
                'https://www.linkedin.com/in/cedric-batina-6b17b31a7/',
                'https://batina-media.com',
                'https://longoka.com',
                'https://lexikongo.fr',
                'https://madizi.com',
            ],
            'knowsAbout' => [
                'Ingénierie numérique',
                'Plateformes web',
                'Java',
                'C++',
                'Génération de jeux éducatifs',
                'Édition numérique',
                'Transmission des savoirs',
                'Automatisation',
            ],
        ],
    ];

    foreach ($extra as $node) {
        $graph[] = $node;
    }

    return [
        '@context' => 'https://schema.org',
        '@graph' => $graph,
    ];
}

function artful_breadcrumb_jsonld(array $items): array
{
    $elements = [];
    $position = 1;
    foreach ($items as $item) {
        $elements[] = [
            '@type' => 'ListItem',
            'position' => $position++,
            'name' => $item['name'],
            'item' => $item['url'],
        ];
    }
    return [
        '@type' => 'BreadcrumbList',
        '@id' => artful_absolute_route(artful_route_name(), artful_locale()) . '#breadcrumb',
        'itemListElement' => $elements,
    ];
}

function artful_render_head(array $meta, ?array $jsonLd = null): void
{
    $ogLocales = [
        'fr' => 'fr_FR',
        'en' => 'en_US',
        'pt' => 'pt_PT',
    ];
    $locale = artful_locale();
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= artful_e($meta['title']) ?></title>
<meta name="description" content="<?= artful_e($meta['description']) ?>">
<meta name="author" content="Cédric Batina">
<meta name="creator" content="@rtful Batina Creative Studios">
<meta name="publisher" content="@rtful Batina Creative Studios">
<meta name="robots" content="<?= artful_e($meta['robots']) ?>">
<meta name="googlebot" content="<?= artful_e($meta['robots']) ?>">
<meta name="theme-color" content="#171717">
<meta name="color-scheme" content="light">
<meta name="format-detection" content="telephone=no">
<meta name="geo.region" content="FR-NAQ">
<meta name="geo.placename" content="Gradignan">
<link rel="canonical" href="<?= artful_e($meta['canonical']) ?>">
<?php foreach (ARTFUL_SUPPORTED_LOCALES as $hreflang): ?>
<link rel="alternate" hreflang="<?= $hreflang ?>" href="<?= artful_e(artful_absolute_route(artful_route_name(), $hreflang)) ?>">
<?php endforeach; ?>
<link rel="alternate" hreflang="x-default" href="<?= artful_e(artful_absolute_route(artful_route_name(), 'fr')) ?>">
<meta property="og:locale" content="<?= artful_e($ogLocales[$locale] ?? 'fr_FR') ?>">
<?php foreach (ARTFUL_SUPPORTED_LOCALES as $hreflang):
    if ($hreflang === $locale) {
        continue;
    }
    ?>
<meta property="og:locale:alternate" content="<?= artful_e($ogLocales[$hreflang]) ?>">
<?php endforeach; ?>
<meta property="og:type" content="<?= artful_e($meta['type']) ?>">
<meta property="og:site_name" content="@rtful Batina Creative Studios">
<meta property="og:title" content="<?= artful_e($meta['title']) ?>">
<meta property="og:description" content="<?= artful_e($meta['description']) ?>">
<meta property="og:url" content="<?= artful_e($meta['canonical']) ?>">
<meta property="og:image" content="<?= artful_e($meta['image']) ?>">
<meta property="og:image:secure_url" content="<?= artful_e($meta['image']) ?>">
<meta property="og:image:type" content="<?= artful_e((string)($meta['image_type'] ?? 'image/webp')) ?>">
<meta property="og:image:width" content="<?= artful_e((string)($meta['image_width'] ?? '1200')) ?>">
<meta property="og:image:height" content="<?= artful_e((string)($meta['image_height'] ?? '630')) ?>">
<meta property="og:image:alt" content="<?= artful_e((string)($meta['image_alt'] ?? $meta['title'])) ?>">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= artful_e($meta['title']) ?>">
<meta name="twitter:description" content="<?= artful_e($meta['description']) ?>">
<meta name="twitter:image" content="<?= artful_e($meta['image']) ?>">
<meta name="twitter:image:alt" content="<?= artful_e((string)($meta['image_alt'] ?? $meta['title'])) ?>">
<?php if (!empty($meta['preload_image'])): ?>
<link rel="preload" as="image" href="<?= artful_e((string)$meta['preload_image']) ?>" imagesrcset="<?= artful_e((string)($meta['preload_imagesrcset'] ?? '')) ?>" imagesizes="<?= artful_e((string)($meta['preload_imagesizes'] ?? '28rem')) ?>" fetchpriority="high">
<?php endif; ?>
<link rel="icon" href="<?= artful_e(artful_asset('images/favicon.ico')) ?>" sizes="any">
<link rel="icon" type="image/png" sizes="32x32" href="<?= artful_e(artful_asset('images/favicon_32x32.png')) ?>">
<link rel="apple-touch-icon" href="<?= artful_e(artful_asset('images/apple-touch-icon.png')) ?>">
<link rel="manifest" href="<?= artful_e(artful_asset('site.webmanifest')) ?>">
<link rel="sitemap" type="application/xml" title="Sitemap" href="<?= artful_e(artful_url('sitemap.xml')) ?>">
<link rel="stylesheet" href="<?= artful_e(artful_asset('css/artful-tokens.css')) ?>?v=<?= ARTFUL_VERSION ?>">
<link rel="stylesheet" href="<?= artful_e(artful_asset('css/artful-2.0.0.css')) ?>?v=<?= ARTFUL_VERSION ?>">
<link rel="stylesheet" href="<?= artful_e(artful_asset('css/artful-i18n.css')) ?>?v=<?= ARTFUL_VERSION ?>">
<link rel="stylesheet" href="<?= artful_e(artful_asset('css/artful-premium.css')) ?>?v=<?= ARTFUL_VERSION ?>">
<link rel="stylesheet" href="<?= artful_e(artful_asset('css/artful-2.2.css')) ?>?v=<?= ARTFUL_VERSION ?>">
<?php if ($jsonLd !== null): ?>
<script type="application/ld+json"><?= json_encode($jsonLd, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) ?></script>
<?php endif;
}

/** Routes nav primaire — « Le studio » et « À propos » = footer. */
function artful_primary_nav_routes(): array
{
    return ['home', 'works', 'contact'];
}

function artful_nav_active(string $route): string
{
    return artful_route_name() === $route ? ' aria-current="page" class="is-active"' : '';
}
