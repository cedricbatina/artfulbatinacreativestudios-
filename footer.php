<footer class="footer-main mt-5 pt-4 pb-2 bg-dark text-light border-top shadow-sm" role="contentinfo">
  <div class="container">
    <div class="row align-items-center gy-3">
      <!-- Colonne 1 : Logo et baseline -->
      <div class="col-md-4 text-center text-md-start mb-2 mb-md-0">
        <a href="index.php" class="d-inline-flex align-items-center text-decoration-none" aria-label="Accueil">
          <img src="images/pictures/official_logo_@bc_transparent.png" alt="Logo Artful Batina Creative Studios" style="height:38px;width:auto;border-radius:8px;" loading="lazy">
          <span class="ms-2 fw-bold text-light site_name" style="font-size:1.1rem;">@rtful Batina Creative Studios</span>
        </a>
        <div class="small mt-2 text-secondary">Web, design, contenus & formation à Gradignan – Bordeaux</div>
      </div>
      <!-- Colonne 2 : Liens utiles -->
      <div class="col-md-4 text-center">
        <nav aria-label="Liens rapides">
          <ul class="list-inline mb-2">
            <li class="list-inline-item"><a href="about-me.php" class="footer-link">À propos</a></li>
            <li class="list-inline-item"><a href="creations.php" class="footer-link">Créations</a></li>
            <li class="list-inline-item"><a href="contact.php" class="footer-link">Contact</a></li>
            <li class="list-inline-item"><a href="privacy.php" class="footer-link">Mentions légales</a></li>
          </ul>
        </nav>
        <div class="small text-secondary">
          <a href="mailto:contact@artfulbatinacreativestudios.fr" class="footer-link" aria-label="Contact email"><i class="fas fa-envelope"></i> contact@artfulbatinacreativestudios.fr</a>
          <span class="mx-1">|</span>
          <a href="https://wa.me/33748484902" class="footer-link" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i> WhatsApp</a>
        </div>
      </div>
      <!-- Colonne 3 : Réseaux sociaux -->
      <div class="col-md-4 text-center text-md-end">
        <div class="mb-1 small">Suivez-moi :</div>
        <div>
          <a href="https://www.facebook.com/artfulbatinacreativestudios" class="footer-social" aria-label="Facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
          <a href="https://www.instagram.com/artfulbatinacreativestudios/" class="footer-social" aria-label="Instagram" target="_blank"><i class="fab fa-instagram"></i></a>
          <a href="https://www.pinterest.fr/artfulbatinacreativestudios/" class="footer-social" aria-label="Pinterest" target="_blank"><i class="fab fa-pinterest"></i></a>
          <a href="https://www.youtube.com/channel/UCr3BQ2BRAcln_5NWwavANnQ" class="footer-social" aria-label="YouTube" target="_blank"><i class="fab fa-youtube"></i></a>
          <a href="https://twitter.com/artfulbatina" class="footer-social" aria-label="Twitter" target="_blank"><i class="fab fa-x-twitter"></i></a>
          <a href="https://www.tiktok.com/@artfulbatinacreative" class="footer-social" aria-label="TikTok" target="_blank"><i class="fab fa-tiktok"></i></a>
          <a href="https://github.com/cedricbatina" class="footer-social" aria-label="GitHub" target="_blank"><i class="fab fa-github"></i></a>
        </div>
      </div>
    </div>
    <hr class="my-2" style="opacity:0.1;">
    <div class="row">
      <div class="col text-center small text-secondary">
        © <?= date("Y") ?> <span class="fw-bold">@rtful Batina Creative Studios</span>. Tous droits réservés.
        | Réalisé avec <span aria-label="amour" style="color:#e25555;">♥</span> à Gradignan, France.
      </div>
    </div>
  </div>
  
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Styles spécifiques Footer -->
<style>
.footer-main { font-size: 1.03em; }
.footer-link {
  color: #c8d0e0; text-decoration: none; margin: 0 5px; transition: color .2s;
}
.footer-link:hover, .footer-social:hover { color: #ffae23 !important; text-decoration: underline; }


@media (max-width: 600px) {
  .footer-main .row > [class*="col-"] { text-align: center!important; margin-bottom: 0.5em;}
  .footer-main { padding: 2em 0.5em 0.7em 0.5em;}
}
.footer-social {
  display: inline-block;
  color: #c8d0e0;
  font-size: 1.19em;
  margin: 0 5px;
  background: none;
  border-radius: 6px;
  vertical-align: middle;
  transition: color .16s;
  padding: 0; /* Pas de padding */
  line-height: 1.2;
  box-shadow: none;
}

.footer-social i {
  vertical-align: -0.13em; /* Corrige la hauteur FA, ajuster si besoin */
}

.footer-social:hover, .footer-social:focus {
  color: #ffae23 !important;
  background: none;
  outline: none;
}

.footer-social:focus-visible {
  outline: 2px solid #ffae23;
}

</style>
