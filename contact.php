<?php
require "./functions.php";
$page_title = "Contact – @rtful Batina Creative Studios";
$page_description = "Contactez Cédric Batina – web, graphisme, identité visuelle, rédaction, formation. Gradignan/Bordeaux, France. Devis rapide, réponse en 24h, WhatsApp, LinkedIn.";
$page_keywords = "contact, devis, freelance, site web, graphisme, design, Bordeaux, Gradignan, WhatsApp, studio créatif, Batina, communication digitale, digital, France";
$page_url = "https://artfulbatinacreativestudios.fr/contact.php";
$page_img = "https://artfulbatinacreativestudios.fr/images/official_logo_@bc_transparent.png";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($page_title) ?></title>
  <meta name="description" content="<?= htmlspecialchars($page_description) ?>">
  <meta name="keywords" content="<?= htmlspecialchars($page_keywords) ?>">
  <meta name="author" content="Cédric Batina">
  <meta name="robots" content="index, follow">

  <!-- Canonical & SEO réseaux sociaux -->
  <link rel="canonical" href="<?= $page_url ?>">
  <meta property="og:title" content="<?= htmlspecialchars($page_title) ?>">
  <meta property="og:description" content="<?= htmlspecialchars($page_description) ?>">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= $page_url ?>">
  <meta property="og:image" content="<?= $page_img ?>">
  <meta property="og:locale" content="fr_FR">
  <meta property="og:site_name" content="@rtful Batina Creative Studios">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= htmlspecialchars($page_title) ?>">
  <meta name="twitter:description" content="<?= htmlspecialchars($page_description) ?>">
  <meta name="twitter:image" content="<?= $page_img ?>">

  <!-- Schema.org ContactPage -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "ContactPage",
    "name": "<?= addslashes($page_title) ?>",
    "description": "<?= addslashes($page_description) ?>",
    "url": "<?= $page_url ?>",
    "image": "<?= $page_img ?>",
    "contactOption": [
      {
        "@type": "ContactPoint",
        "contactType": "service client",
        "email": "hello@artfulbatinacreativestudios.fr",
        "url": "<?= $page_url ?>"
      },
      {
        "@type": "ContactPoint",
        "contactType": "WhatsApp",
        "telephone": "+33750000000",
        "url": "https://wa.me/33750000000"
      }
    ],
    "creator": {
      "@type": "Person",
      "name": "Cédric Batina"
    }
  }
  </script>

  <!-- Styles & Favicon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" />
  <link href="./stylefile.css" rel="stylesheet">
  <link rel="shortcut icon" href="./images/official_favicon48X48.ico" type="image/x-icon">
  <style>
 
 .contact-hero {
  background:rgb(70, 72, 72); /* couleur très claire et pro */
  border-radius: 1.5rem;
  margin-bottom: 2rem;
  padding: 2.2rem 1.2rem 1rem 1.2rem;
  box-shadow: 0 3px 16px rgba(0,0,0,0.06);
}
.contact-social a { 
  margin: 0 10px; 
  font-size: 1.1rem; 
  color: #fff; 
  transition: color 0.2s;
}
.contact-social a:hover { color:rgb(21, 88, 221); }
.whatsapp-btn {
  background: #25d366;
  color: #fff !important;
  border-radius: 30px;
  padding: 0.7em 1.8em;
  font-size: 1.1em;
  box-shadow: 0 2px 8px rgba(37,211,102,0.08);
  border:none;
  margin-top:  1px;
}
.whatsapp-btn:hover { background:#128c7e; color:#fff !important;}

    .map-embed {
      width: 100%; border: 0; min-height: 300px; border-radius: 16px;
      box-shadow: 0 2px 12px rgba(0,0,0,0.08);
      margin-bottom: 2rem;
    }
    .faq-question { cursor:pointer; }
    .faq-answer { display:none; }
    .faq-question.open + .faq-answer { display:block; }
   
  </style>
</head>

<body>
<?php require 'header.php'; ?>
<?php require_once "banner.php"; ?>

<a href="#contenu-principal" class="visually-hidden-focusable">Aller au contenu principal</a>
<main id="contenu-principal" class="container my-5" role="main" tabindex="-1">

  <!-- HERO -->
  <section class="contact-hero text-center mb-4">
  <h1 class="mb-3 text-white"><i class="fas fa-envelope-open-text me-2"></i>Contactez-moi</h1>
    <p class="lead mb-2 text-white">
      Un projet, une question, un devis ?<br>
      <strong class="text-primary">Discutons-en par mail, téléphone ou WhatsApp.<br>Réponse rapide, conseils personnalisés.</strong>
    </p>
    <div class="contact-social mt-3 mb-2">
      <a href="mailto:hello@artfulbatinacreativestudios.fr" aria-label="Envoyer un email"><i class="fas fa-envelope"></i></a>
      <a href="https://wa.me/33748484902" target="_blank" rel="noopener" aria-label="Discuter sur WhatsApp"><i class="fab fa-whatsapp"></i></a>
      <a href="https://www.linkedin.com/in/cedric-batina-6b17b31a7/" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
      <a href="https://github.com/cedricbatina" target="_blank" rel="noopener" aria-label="GitHub"><i class="fab fa-github"></i></a>
      <a href="tel:+33748484902" aria-label="Téléphoner"><i class="fas fa-phone"></i></a>
    </div>
    <a href="https://wa.me/33748484902" target="_blank" rel="noopener" class="whatsapp-btn mt-3" aria-label="Discuter sur WhatsApp">
      <i class="fab fa-whatsapp"></i> Discuter sur WhatsApp
    </a>
  </section>
 <!-- CONTACT FORM -->
 <section class="mb-5">
    <div class="mx-auto" style="max-width: 700px;">
      <?php include_once("./contact_form.php"); ?>
    </div>
  </section>
  <!-- Google Map -->
  <section class="mb-5">
  <h2 class="h4 text-center text-primary mb-3"><i class="fas fa-map-marker-alt"></i> Studio basé à Gradignan (Bordeaux)</h2>
  <iframe class="map-embed" title="Localisation – Studio Batina"
    src="https://www.google.com/maps?q=Résidence%20Barthez%204%2033170%20Gradignan,%20France&output=embed"
    width="100%" height="320" style="border:0; border-radius:18px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  <p class="text-center small text-muted mb-0">
    Rendez-vous : Résidence Barthez 4, 33170 Gradignan.<br>
    En visio ou déplacement possible en Nouvelle-Aquitaine.
  </p>
</section>


 

  <!-- FAQ -->
  <?php include_once("faq_contact.php"); ?>


  <!-- RGPD / confidentialité -->
  <section class="text-center small text-muted my-5">
    <p>
      <i class="fas fa-shield-alt"></i>
      <a href="mentions.php" rel="noopener">Politique de confidentialité & RGPD</a> – Vos données ne sont jamais partagées avec des tiers.  
      <span class="d-block">Site & données hébergés en France.</span>
    </p>
  </section>
</main>

<?php require_once("footer.php"); ?>
<!-- Bootstrap JS pour accordéon FAQ -->
<script>
  // Pour garantir le toggle "ouvrir/fermer" sur le même bouton (normalement Bootstrap le gère)
  document.querySelectorAll('.accordion-button').forEach(btn => {
    btn.addEventListener('click', function(e) {
      let target = document.querySelector(this.dataset.bsTarget);
      if (target && target.classList.contains('show')) {
        setTimeout(() => {  // Laisse Bootstrap faire l'ouverture, puis ferme si déjà ouvert
          bootstrap.Collapse.getInstance(target).hide();
        }, 30);
      }
    });
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
