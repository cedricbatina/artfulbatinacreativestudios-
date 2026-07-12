<?php
declare(strict_types=1);
$GLOBALS['artful_route_name']='works';
require_once __DIR__.'/includes/site.php';
require_once __DIR__.'/includes/content.php';
require_once __DIR__.'/includes/catalog.php';
$meta=artful_page_meta(['title'=>(string)t('works.title'),'description'=>(string)t('works.description')]);
?><!doctype html><html lang="<?= artful_locale() ?>"><head><?php artful_render_head($meta); ?></head><body><?php require __DIR__.'/includes/header.php'; ?><main id="main-content">
<header class="page-hero"><div class="site-shell"><p class="eyebrow">Artful Batina</p><h1><?= artful_e((string)t('works.heading')) ?></h1><p><?= artful_e((string)t('works.lead')) ?></p></div></header>
<section class="section section--surface"><div class="site-shell"><div class="section-heading"><div><p class="eyebrow">2020–2026</p><h2><?= artful_e((string)t('works.current')) ?></h2></div><p><?= artful_e((string)t('works.current_intro')) ?></p></div><?= artful_case_study_cards(false) ?><p class="sc-notice">Produits et usages → <a href="https://batina-media.com" target="_blank" rel="noopener">Batina Media ↗</a></p></div></section></main><?php require __DIR__.'/includes/footer.php'; ?></body></html>
