<?php
declare(strict_types=1);
$GLOBALS['artful_route_name']='legal';
require_once dirname(__DIR__).'/includes/site.php';
$title=(string)t('legal.notice');
$meta=artful_page_meta(['title'=>$title.' — @rtful Batina Creative Studios','description'=>$title,'robots'=>'noindex, follow']);
$sections=[
    'fr' => [
        '(\'Éditeur\', \'Le site est édité par Cédric Batina, entrepreneur individuel exerçant sous le nom commercial @rtful Batina Creative Studios.\')',
        '(\'À compléter avant production\', \'Le SIREN/SIRET officiel et les coordonnées exactes de l’hébergeur doivent être renseignés.\')',
        '(\'Propriété intellectuelle\', \'Les contenus et créations restent protégés par les droits applicables.\')'
    ],
    'en' => [
        '(\'Publisher\', \'This website is published by Cédric Batina, an independent entrepreneur trading as @rtful Batina Creative Studios.\')',
        '(\'Complete before production\', \'The official business registration number and exact hosting details must be added.\')',
        '(\'Intellectual property\', \'Content and creative work remain protected by applicable rights.\')'
    ],
    'pt' => [
        '(\'Editor\', \'Este site é editado por Cédric Batina, empreendedor individual que exerce sob o nome comercial @rtful Batina Creative Studios.\')',
        '(\'Completar antes da produção\', \'O número oficial de registo e os dados exatos do alojamento devem ser adicionados.\')',
        '(\'Propriedade intelectual\', \'Os conteúdos e criações permanecem protegidos pelos direitos aplicáveis.\')'
    ]
][artful_locale()];
?><!doctype html><html lang="<?= artful_locale() ?>"><head><?php artful_render_head($meta); ?></head><body><?php require dirname(__DIR__).'/includes/header.php'; ?><main id="main-content"><header class="page-hero"><div class="site-shell"><h1><?= artful_e($title) ?></h1></div></header><section class="section section--surface"><div class="site-shell legal-content"><?php foreach($sections as $s): ?><h2><?= artful_e($s[0]) ?></h2><p><?= artful_e($s[1]) ?></p><?php endforeach; ?><p>Email: contact@artfulbatinacreativestudios.fr · Gradignan, France.</p></div></section></main><?php require dirname(__DIR__).'/includes/footer.php'; ?></body></html>