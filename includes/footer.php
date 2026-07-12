<?php declare(strict_types=1); ?>
<footer class="site-footer">
<div class="site-shell site-footer__grid">
<div class="site-footer__brand">
<img class="site-footer__logo" src="<?= artful_e(artful_logo_url()) ?>" width="48" height="48" alt="<?= artful_e((string)t('common.logo_alt')) ?>">
<strong>Artful Batina Creative Studios</strong>
<p class="site-footer__tagline"><?= artful_e((string)t('common.brand_tagline')) ?></p>
<p><?= artful_e((string)t('common.footer_desc')) ?></p>
</div>
<div>
<h2 class="footer-title"><?= artful_e((string)t('common.footer_studio')) ?></h2>
<ul class="footer-links">
<li><a href="<?= artful_e(artful_route('studio')) ?>"><?= artful_e((string)t('common.nav.studio')) ?></a></li>
<li><a href="<?= artful_e(artful_route('studio') . '#prestations') ?>"><?= artful_e((string)t('common.nav.services')) ?></a></li>
<li><a href="<?= artful_e(artful_route('works')) ?>"><?= artful_e((string)t('common.nav.works')) ?></a></li>
<li><a href="<?= artful_e(artful_route('method')) ?>"><?= artful_e((string)t('common.footer_method', [], 'Méthode')) ?></a></li>
<li><a href="<?= artful_e(artful_route('about')) ?>"><?= artful_e((string)t('common.nav.about')) ?></a></li>
<li><a href="<?= artful_e(artful_route('contact')) ?>"><?= artful_e((string)t('common.nav.contact')) ?></a></li>
</ul>
</div>
<div>
<h2 class="footer-title"><?= artful_e((string)t('common.footer_ecosystem')) ?></h2>
<ul class="footer-links">
<li><a href="https://batina-media.com" target="_blank" rel="noopener">Batina Media ↗</a></li>
<li><a href="https://batina-media.com/presse" target="_blank" rel="noopener"><?= artful_e((string)t('common.press')) ?> ↗</a></li>
<li><a href="https://longoka.com" target="_blank" rel="noopener">Longoka ↗</a></li>
<li><a href="https://lexikongo.fr" target="_blank" rel="noopener">Lexikongo ↗</a></li>
<li><a href="https://madizi.com" target="_blank" rel="noopener">Madizi ↗</a></li>
<li><a href="https://lunungu.com" target="_blank" rel="noopener">Lunungu ↗</a></li>
</ul>
</div>
<div>
<h2 class="footer-title"><?= artful_e((string)t('common.footer_network')) ?></h2>
<ul class="footer-links">
<li><a href="https://linkedin.com/in/cedric-batina-6b17b31a7/" target="_blank" rel="noopener">LinkedIn ↗</a></li>
<li><a href="https://github.com/cedricbatina" target="_blank" rel="noopener">GitHub ↗</a></li>
<li><a href="<?= artful_e(artful_route('contact')) ?>"><?= artful_e((string)t('common.footer_contact')) ?></a></li>
</ul>
</div>
</div>
<div class="site-shell site-footer__bottom"><span>© <?= date('Y') ?> Cédric Batina · Artful Batina Creative Studios</span><span>Artful <?= ARTFUL_VERSION ?></span></div>
</footer>
