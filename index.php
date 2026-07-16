<?php
declare(strict_types=1);
$GLOBALS['artful_route_name']='home';
require_once __DIR__.'/includes/site.php';
require_once __DIR__.'/includes/content.php';
require_once __DIR__.'/includes/catalog.php';
require_once __DIR__.'/includes/creative-studios.php';
$meta=artful_page_meta(['title'=>(string)t('home.title'),'description'=>(string)t('home.description'),'portrait'=>'studio']);
$body=(string)t('home.body');
$body=str_replace(
    [':about',':studio',':works',':contact',':projects',':case_studies',':capabilities',':capability_flow',':method_track',':partners',':now_section',':creative_studios',':role_clarity',':portrait'],
    [artful_route('about'),artful_route('studio'),artful_route('works'),artful_route('contact'),artful_project_cards(),artful_case_study_cards(true),artful_capabilities_list(),artful_capability_flow(),artful_method_track(),artful_partners_section(),artful_now_section(),artful_creative_studios_section(true),artful_role_clarity_section(),artful_portrait_img('studio',['priority'=>true])],
    $body,
);
$body=artful_localize_html($body);
$jsonLd=artful_schema_graph([
    [
        '@type'=>'ProfessionalService',
        '@id'=>rtrim(artful_base_url(),'/').'/#service',
        'name'=>'@rtful Batina Creative Studios',
        'url'=>artful_absolute_route('home',artful_locale()),
        'image'=>artful_portrait_url('studio','og'),
        'provider'=>['@id'=>rtrim(artful_base_url(),'/').'/#organization'],
        'areaServed'=>'Worldwide',
        'serviceType'=>['Ingénierie numérique','Développement de plateformes','Édition numérique','Automatisation'],
    ],
]);
?><!doctype html><html lang="<?= artful_locale() ?>"><head><?php artful_render_head($meta,$jsonLd); ?></head><body><?php require __DIR__.'/includes/header.php'; ?><main id="main-content"><?= $body ?></main><?php require __DIR__.'/includes/footer.php'; ?></body></html>
