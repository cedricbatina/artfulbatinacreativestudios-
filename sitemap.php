<?php
declare(strict_types=1);

/**
 * Sitemap XML dynamique — hreflang + images portraits.
 * Servi via sitemap.xml (rewrite) ou directement.
 */
require_once __DIR__ . '/includes/site.php';

header('Content-Type: application/xml; charset=UTF-8');
header('X-Robots-Tag: noindex');
header('Cache-Control: public, max-age=3600');

$routes = [
    'home' => ['changefreq' => 'weekly', 'priority' => '1.0', 'image' => 'studio'],
    'about' => ['changefreq' => 'monthly', 'priority' => '0.9', 'image' => 'audience'],
    'press' => ['changefreq' => 'monthly', 'priority' => '0.85', 'image' => 'panel'],
    'works' => ['changefreq' => 'weekly', 'priority' => '0.9', 'image' => 'gesture'],
    'studio' => ['changefreq' => 'monthly', 'priority' => '0.8', 'image' => 'gesture'],
    'contact' => ['changefreq' => 'monthly', 'priority' => '0.8', 'image' => 'studio'],
    'legal' => ['changefreq' => 'yearly', 'priority' => '0.2', 'image' => null],
    'privacy' => ['changefreq' => 'yearly', 'priority' => '0.2', 'image' => null],
];

$lastmod = gmdate('Y-m-d');
$host = 'https://www.artfulbatinacreativestudios.fr';

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
<?php foreach ($routes as $route => $meta): ?>
<?php foreach (ARTFUL_SUPPORTED_LOCALES as $locale):
    $loc = $host . '/' . artful_locale_path($route, $locale);
?>
  <url>
    <loc><?= htmlspecialchars($loc, ENT_XML1) ?></loc>
    <lastmod><?= $lastmod ?></lastmod>
    <changefreq><?= $meta['changefreq'] ?></changefreq>
    <priority><?= $meta['priority'] ?></priority>
<?php foreach (ARTFUL_SUPPORTED_LOCALES as $alt): ?>
    <xhtml:link rel="alternate" hreflang="<?= $alt ?>" href="<?= htmlspecialchars($host . '/' . artful_locale_path($route, $alt), ENT_XML1) ?>"/>
<?php endforeach; ?>
    <xhtml:link rel="alternate" hreflang="x-default" href="<?= htmlspecialchars($host . '/' . artful_locale_path($route, 'fr'), ENT_XML1) ?>"/>
<?php if ($meta['image']):
    $imgUrl = $host . '/' . artful_portrait_path($meta['image'], 'og');
    $imgAlt = artful_portrait_alt($meta['image'], $locale);
?>
    <image:image>
      <image:loc><?= htmlspecialchars($imgUrl, ENT_XML1) ?></image:loc>
      <image:title><?= htmlspecialchars($imgAlt, ENT_XML1) ?></image:title>
      <image:caption><?= htmlspecialchars($imgAlt, ENT_XML1) ?></image:caption>
    </image:image>
<?php endif; ?>
  </url>
<?php endforeach; ?>
<?php endforeach; ?>
</urlset>
