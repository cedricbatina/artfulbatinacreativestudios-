<?php
declare(strict_types=1);
$GLOBALS['artful_route_name']='privacy';
require_once dirname(__DIR__).'/includes/site.php';
$title=(string)t('legal.privacy');
$meta=artful_page_meta(['title'=>$title.' — @rtful Batina Creative Studios','description'=>$title,'robots'=>'noindex, follow']);
$sections=[
    'fr' => [
        '(\'Données collectées\', \'Le formulaire peut collecter votre nom, organisation, email, téléphone facultatif, type de demande, sujet et message.\')',
        '(\'Finalité\', \'Ces données servent uniquement à répondre et assurer le suivi de votre demande.\')',
        '(\'Vos droits\', \'Écrivez à contact@artfulbatinacreativestudios.fr pour exercer vos droits.\')',
        '(\'Cookies\', \'Aucun traceur non essentiel ne doit être déposé sans consentement préalable.\')'
    ],
    'en' => [
        '(\'Data collected\', \'The form may collect your name, organisation, email, optional phone number, request type, subject and message.\')',
        '(\'Purpose\', \'This data is used only to respond to and follow up your request.\')',
        '(\'Your rights\', \'Write to contact@artfulbatinacreativestudios.fr to exercise your rights.\')',
        '(\'Cookies\', \'No non-essential tracker should be set without prior consent.\')'
    ],
    'pt' => [
        '(\'Dados recolhidos\', \'O formulário pode recolher o seu nome, organização, email, telefone facultativo, tipo de pedido, assunto e mensagem.\')',
        '(\'Finalidade\', \'Estes dados são utilizados apenas para responder e acompanhar o seu pedido.\')',
        '(\'Os seus direitos\', \'Escreva para contact@artfulbatinacreativestudios.fr para exercer os seus direitos.\')',
        '(\'Cookies\', \'Nenhum rastreador não essencial deve ser instalado sem consentimento prévio.\')'
    ]
][artful_locale()];
?><!doctype html><html lang="<?= artful_locale() ?>"><head><?php artful_render_head($meta); ?></head><body><?php require dirname(__DIR__).'/includes/header.php'; ?><main id="main-content"><header class="page-hero"><div class="site-shell"><h1><?= artful_e($title) ?></h1></div></header><section class="section section--surface"><div class="site-shell legal-content"><?php foreach($sections as $s): ?><h2><?= artful_e($s[0]) ?></h2><p><?= artful_e($s[1]) ?></p><?php endforeach; ?><p>Email: contact@artfulbatinacreativestudios.fr · Gradignan, France.</p></div></section></main><?php require dirname(__DIR__).'/includes/footer.php'; ?></body></html>