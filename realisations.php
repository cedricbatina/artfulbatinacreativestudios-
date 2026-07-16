<?php
declare(strict_types=1);
$GLOBALS['artful_route_name']='works';
require_once __DIR__.'/includes/site.php';
require_once __DIR__.'/includes/content.php';
require_once __DIR__.'/includes/catalog.php';
$meta=artful_page_meta([
    'title'=>(string)t('works.title'),
    'description'=>(string)t('works.description'),
    'portrait'=>'gesture',
]);
$jsonLd=artful_schema_graph([
    artful_breadcrumb_jsonld([
        ['name'=>'@rtful Batina Creative Studios','url'=>artful_absolute_route('home',artful_locale())],
        ['name'=>(string)t('common.nav.works'),'url'=>artful_absolute_route('works',artful_locale())],
    ]),
]);
?><!doctype html><html lang="<?= artful_locale() ?>"><head><?php artful_render_head($meta,$jsonLd); ?></head><body><?php require __DIR__.'/includes/header.php'; ?><main id="main-content">
<header class="page-hero page-hero--premium"><div class="site-shell hero-grid"><div><p class="eyebrow"><?= artful_e((string)t('common.brand_name')) ?></p><h1><?= artful_e((string)t('works.heading')) ?></h1><p class="hero-lead"><?= artful_e((string)t('works.lead')) ?></p></div><div class="hero-portrait"><?= artful_portrait_img('gesture',['priority'=>true]) ?></div></div></header>
<section class="section section--surface"><div class="site-shell"><div class="section-heading"><div><p class="eyebrow">2020–2026</p><h2><?= artful_e((string)t('works.current')) ?></h2></div><p><?= artful_e((string)t('works.current_intro')) ?></p></div><?= artful_case_study_cards(false) ?><p class="sc-notice">Produits et usages → <a href="https://batina-media.com" target="_blank" rel="noopener">Batina Media ↗</a></p></div></section></main><?php require __DIR__.'/includes/footer.php'; ?></body></html>
