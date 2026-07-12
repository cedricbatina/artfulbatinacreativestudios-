<?php
declare(strict_types=1);
$GLOBALS['artful_route_name']='about';
require_once __DIR__.'/includes/site.php';
require_once __DIR__.'/includes/content.php';
require_once __DIR__.'/includes/catalog.php';
$meta=artful_page_meta(['title'=>(string)t('about.title'),'description'=>(string)t('about.description'),'type'=>'profile']);
$body=(string)t('about.body');
$body=str_replace([':contact',':case_studies',':expertise'],[artful_route('contact'),artful_case_study_cards(true),artful_expertise_cards()],$body);
$body=artful_localize_html($body);
?><!doctype html><html lang="<?= artful_locale() ?>"><head><?php artful_render_head($meta); ?></head><body><?php require __DIR__.'/includes/header.php'; ?><main id="main-content"><?= $body ?></main><?php require __DIR__.'/includes/footer.php'; ?></body></html>
