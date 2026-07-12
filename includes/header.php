<?php
declare(strict_types=1);
require_once __DIR__ . '/site.php';
?>
<a class="skip-link" href="#main-content"><?= artful_e((string)t('common.skip')) ?></a>
<header class="site-header"><div class="site-shell site-header__inner">
<a class="site-brand" href="<?= artful_e(artful_route('home')) ?>">
<img class="site-brand__logo" src="<?= artful_e(artful_logo_url()) ?>" width="44" height="44" alt="<?= artful_e((string)t('common.logo_alt')) ?>">
<span><strong><?= artful_e((string)t('common.brand_name')) ?></strong><small><?= artful_e((string)t('common.brand_tagline')) ?></small></span>
</a>
<button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-navigation"><span class="sr-only">Menu</span><span></span><span></span><span></span></button>
<nav id="primary-navigation" class="primary-nav" aria-label="Navigation"><?php foreach (artful_primary_nav_routes() as $route): ?><a href="<?= artful_e(artful_route($route)) ?>"<?= artful_nav_active($route) ?>><?= artful_e((string)t('common.nav.' . $route)) ?></a><?php endforeach; ?></nav>
<nav class="language-switcher" aria-label="<?= artful_e((string)t('common.language')) ?>"><?php foreach(ARTFUL_SUPPORTED_LOCALES as $lang): ?><a href="<?= artful_e(artful_route(artful_route_name(),$lang)) ?>" hreflang="<?= $lang ?>" lang="<?= $lang ?>"<?= $lang===artful_locale()?' class="is-active" aria-current="true"':'' ?>><?= strtoupper($lang) ?></a><?php endforeach; ?></nav>
</div></header>
<script>(()=>{const b=document.querySelector('.nav-toggle'),n=document.getElementById('primary-navigation');if(b&&n)b.addEventListener('click',()=>{const o=b.getAttribute('aria-expanded')==='true';b.setAttribute('aria-expanded',String(!o));n.classList.toggle('is-open',!o)})})();</script>
