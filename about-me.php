<?php
declare(strict_types=1);
$GLOBALS['artful_route_name']='about';
require_once __DIR__.'/includes/site.php';
require_once __DIR__.'/includes/content.php';
require_once __DIR__.'/includes/catalog.php';
$meta=artful_page_meta([
    'title'=>(string)t('about.title'),
    'description'=>(string)t('about.description'),
    'type'=>'profile',
    'portrait'=>'audience',
]);
$body=(string)t('about.body');
$body=str_replace(
    [':contact',':works',':case_studies',':expertise',':portrait'],
    [artful_route('contact'),artful_route('works'),artful_case_study_cards(true),artful_expertise_cards(),artful_portrait_img('audience',['priority'=>true])],
    $body
);
$body=artful_localize_html($body);
$base=rtrim(artful_base_url(),'/');
$jsonLd=artful_schema_graph([
    artful_breadcrumb_jsonld([
        ['name'=>'@rtful Batina Creative Studios','url'=>artful_absolute_route('home',artful_locale())],
        ['name'=>(string)t('common.nav.about'),'url'=>artful_absolute_route('about',artful_locale())],
    ]),
    [
        '@type'=>'ProfilePage',
        '@id'=>artful_absolute_route('about',artful_locale()).'#profile',
        'url'=>artful_absolute_route('about',artful_locale()),
        'mainEntity'=>['@id'=>$base.'/#person'],
        'image'=>artful_portrait_url('audience','960'),
    ],
]);
?><!doctype html><html lang="<?= artful_locale() ?>"><head><?php artful_render_head($meta,$jsonLd); ?></head><body><?php require __DIR__.'/includes/header.php'; ?><main id="main-content"><?= $body ?></main><?php require __DIR__.'/includes/footer.php'; ?></body></html>
