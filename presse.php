<?php
declare(strict_types=1);
$GLOBALS['artful_route_name'] = 'press';
require_once __DIR__ . '/includes/site.php';

$meta = artful_page_meta([
    'title' => (string)t('press.title'),
    'description' => (string)t('press.description'),
    'portrait' => 'panel',
]);

$body = (string)t('press.body');
$body = str_replace(
    [':contact', ':about', ':works', ':studio', ':portrait', ':press_photos'],
    [
        artful_route('contact') . '?motif=presse',
        artful_route('about'),
        artful_route('works'),
        artful_route('studio'),
        artful_portrait_img('panel', ['priority' => true]),
        artful_press_photos_grid(),
    ],
    $body
);
$body = artful_localize_html($body);

$base = rtrim(artful_base_url(), '/');
$pressImages = [];
foreach (artful_press_portrait_keys() as $pkey) {
    $img = [
        '@type' => 'ImageObject',
        'contentUrl' => artful_portrait_url($pkey, 'full'),
        'url' => artful_portrait_url($pkey, 'og'),
        'caption' => artful_portrait_alt($pkey),
    ];
    if ($pkey !== 'studio') {
        $img['creditText'] = 'Déclics Numériques';
    }
    $pressImages[] = $img;
}

$jsonLd = artful_schema_graph([
    artful_breadcrumb_jsonld([
        ['name' => '@rtful Batina Creative Studios', 'url' => artful_absolute_route('home', artful_locale())],
        ['name' => (string)t('common.press'), 'url' => artful_absolute_route('press', artful_locale())],
    ]),
    [
        '@type' => 'CollectionPage',
        '@id' => artful_absolute_route('press', artful_locale()) . '#press',
        'name' => (string)t('press.title'),
        'description' => (string)t('press.description'),
        'url' => artful_absolute_route('press', artful_locale()),
        'about' => ['@id' => $base . '/#person'],
        'image' => $pressImages,
    ],
]);
?><!doctype html>
<html lang="<?= artful_locale() ?>">
<head><?php artful_render_head($meta, $jsonLd); ?></head>
<body>
<?php require __DIR__ . '/includes/header.php'; ?>
<main id="main-content"><?= $body ?></main>
<?php require __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
