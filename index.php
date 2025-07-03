<?php
//session_start();
require './database_connexion.php';
require './functions.php';

$page_title = '@rtful Batina Creative Studios - Accueil';
$page_description = 'Développement web, design graphique, rédaction et formations créatives avec Cédric Batina.';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php echo htmlspecialchars($page_description); ?>">
  <meta name="author" content="Cédric Batina">
  <meta name="robots" content="index, follow">
  <title><?php echo htmlspecialchars($page_title); ?></title>
  
  <!-- Open Graph SEO -->
  <meta property="og:title" content="<?php echo htmlspecialchars($page_title); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars($page_description); ?>">
  <meta property="og:type" content="website">
  <meta property="og:image" content="./images/official_favicon48X48.ico">
  <meta property="og:url" content="https://artfulbatinacreativestudios.fr/">
  <meta property="og:locale" content="fr_FR">
<meta property="og:site_name" content="@rtful Batina Creative Studios">
<meta name="twitter:image" content="https://artfulbatinacreativestudios.fr/images/official_favicon48X48.ico">
<meta name="twitter:site" content="@cedricbatina">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= htmlspecialchars($page_title) ?>">
<meta name="twitter:description" content="<?= htmlspecialchars($page_description) ?>">
<meta name="keywords" content="développement web, design graphique, SEO, Gradignan, Bordeaux, création site internet, Cédric Batina, freelance, studio créatif, consultant, expert, formation, identité visuelle, communication digitale, charte graphique, France, Nouvelle-Aquitaine">


<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Person",
  "name": "Cédric Batina",
  "url": "https://artfulbatinacreativestudios.fr/",
  "image": "https://artfulbatinacreativestudios.fr/images/official_logo_@bc_transparent.png",
  "sameAs": [
    "https://www.linkedin.com/in/cédric-batina-6b17b31a7/",
    "https://github.com/cedricbatina"
  ],
  "jobTitle": "Développeur web et designer graphique",
  "worksFor": {
    "@type": "Organization",
    "name": "@rtful Batina Creative Studios"
  },
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "Gradignan",
    "addressRegion": "Nouvelle-Aquitaine",
    "addressCountry": "FR"
  },
  "description": "Développement web, design graphique, SEO, rédaction et formations par Cédric Batina à Gradignan (Bordeaux)."
}
</script>
<meta property="og:image" content="https://artfulbatinacreativestudios.fr/images/official_favicon48X48.ico">

<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">

  <!-- Styles & Favicon -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" />
  <link rel="stylesheet" href="./stylefile.css">
  <link rel="shortcut icon" href="./images/official_favicon48X48.ico" type="image/x-icon">

  <style>
    .fade-in {
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    }
    .fade-in.show {
      opacity: 1;
      transform: translateY(0);
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
    }
    .creation-card:hover {
      box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    }
    .card-title {
  white-space: normal;
  word-break: break-word;
}
.visually-hidden-focusable { position:absolute; left:-9999px; }
.visually-hidden-focusable:focus { position:static; left:auto; background: #ff4500; color:#fff; z-index:9999; padding:4px 8px; }


    @media (max-width: 576px) {
      main, .container-fluid {
        padding-left: 6px;
        padding-right: 6px;
      }
    }
  </style>
</head>

<body>
<?php require_once 'header.php'; ?>
<?php require_once 'banner.php'; ?>
<a href="#accueil-title" class="visually-hidden-focusable">Aller au contenu principal</a>

<main id="accueil-title" class="container-fluid m-auto" role="main" tabindex="-1">
  <!-- Intro -->
  <section class="p-2 fade-in text-center" aria-labelledby="accueil-title">
  <?php
$annee_debut = 2011; // Mets ici ton année de début réelle
$experience = date('Y') - $annee_debut;
?>
<span class="badge bg-warning text-dark mb-2" aria-label="<?= $experience ?> ans d'expérience">
    <?= $experience ?> ans d’expérience
</span>
<span class="badge bg-info text-dark mb-2 ms-2" aria-label="Projeté sur LinkedIn">
  <i class="fab fa-linkedin"></i>
  <a href="https://www.linkedin.com/in/cedric-batina-6b17b31a7/" target="_blank" rel="noopener nofollow" class="text-dark" style="text-decoration:none;">LinkedIn</a>
</span>

    <h1 class="site_name" id="accueil-title">Bienvenue chez Artful Batina Creative Studios</h1>
    <p class="titre">Création Web, Contenus & Formations par Cédric Batina</p>
    <p>
      Je suis <strong>Cédric Batina</strong>, développeur web indépendant et créatif digital basé en Nouvelle-Aquitaine.<br>
      J’aide entrepreneurs, associations et artistes à donner vie à leurs idées grâce à des solutions visuelles modernes,
      des contenus impactants et des outils web performants.
    </p>
    <a href="contact.php" class="btn btn-warning mt-3 mb-3" aria-label="Contactez-moi">
  <i class="fas fa-envelope me-2"></i>Contactez-moi pour votre projet
</a>
<p class="mt-2 text-muted small">
  Discutons de votre projet ou de vos idées créatives, réponse sous 24h !
</p>

  </section>

  <!-- Approche -->
  <section class="p-2 fade-in" aria-labelledby="approche-title">
    <h2 class="services_title" id="approche-title">🎯 Mon approche</h2>
    <ul>
      <li>✔ Écoute, analyse, accompagnement personnalisé</li>
      <li>✔ Créativité ancrée dans l’utile et le fonctionnel</li>
      <li>✔ Réactivité, autonomie et simplicité</li>
    </ul>
  </section>

  <!-- Services -->
  <section class="p-2 fade-in m-4" aria-labelledby="prestations-title">
    <h2 class="services_title m-2" id="prestations-title">🛠️ Prestations</h2>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
      <div class="col">
        <div class="card h-100 text-center p-3">
          <i class="fas fa-code fa-2x mb-2"></i>
          <h5>Développement Web</h5>
          <p>Sites vitrines, portfolios, blogs et plateformes personnalisées modernes et responsives.</p>
        </div>
      </div>
      <div class="col">
        <div class="card h-100 text-center p-3">
          <i class="fas fa-pen-nib fa-2x mb-2"></i>
          <h5>Identité Visuelle</h5>
          <p>Logos, maquettes, supports de communication et design graphique sur mesure.</p>
        </div>
      </div>
      <div class="col">
        <div class="card h-100 text-center p-3">
          <i class="fas fa-lightbulb fa-2x mb-2"></i>
          <h5>Formations Créatives</h5>
          <p>Initiation ou perfectionnement en graphisme, programmation ou outils numériques adaptés à vos besoins.</p>
        </div>
      </div>
      <div class="col">
        <div class="card h-100 text-center p-3">
          <i class="fas fa-search fa-2x mb-2"></i>
          <h5>SEO & Rédaction</h5>
          <p>Textes optimisés, stratégie de contenu, visibilité locale & référencement naturel efficace.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Projets récents -->
  <section class="p-2 fade-in m-4" aria-labelledby="projets-recents-title">
  <h2 class="services_title m-2" id="projets-recents-title">🎬 Projets récents</h2>
  <ul class="list-unstyled">
    <li class="mb-2">
      📺 <strong>
        <a href="https://goseneye.com" target="_blank" rel="noopener nofollow" aria-label="Voir Gosen’Eye, plateforme de gestion vidéo">Gosen’Eye</a>
      </strong>
      <span class="badge bg-secondary ms-2">Plateforme vidéo</span> :
      plateforme de gestion vidéo moderne pour créateurs et formateurs.
    </li>
    <li class="mb-2">
      📚 <strong>
        <a href="https://lexikongo.com" target="_blank" rel="noopener nofollow" aria-label="Voir Lexikongo, dictionnaire Kikongo-Français-Anglais">Lexikongo</a>
      </strong>
      <span class="badge bg-success ms-2">Nuxt 3</span> :
      dictionnaire Kikongo-Français-Anglais en ligne, collaboratif et multilingue.
    </li>
    <li class="mb-2">
      📖 <strong>
        <a href="https://longoka.fr" target="_blank" rel="noopener nofollow" aria-label="Voir Longoka, plateforme de formations en ligne">Longoka</a>
      </strong>
      <span class="badge bg-primary ms-2">E-learning</span> :
      plateforme de formations en ligne, avec vidéos, cours interactifs et exercices.
    </li>
    <li class="mb-2">
      🔧 <strong>
        <a href="https://cyrille-plomberie.fr" target="_blank" rel="noopener nofollow" aria-label="Voir Ambès Cyrille Plomberie, site vitrine">Ambès Cyrille Plomberie</a>
      </strong>
      <span class="badge bg-warning text-dark ms-2">Vue.js</span> :
      site vitrine professionnel, optimisé SEO, pour artisan plombier à Ambès en Gironde.
    </li>
    <li class="mb-2">
      💆 <strong>
        <a href="https://www.keratotherapeute-bordeaux.com/" target="_blank" rel="noopener nofollow" aria-label="Voir Kératothérapeute Bordeaux, site vitrine WordPress">Kératothérapeute Bordeaux</a>
      </strong>
      <span class="badge bg-danger text-white ms-2">WordPress</span> :
      site vitrine professionnel pour spécialiste des soins de la peau à Bordeaux, développé et optimisé sous WordPress.
    </li>
  </ul>
  <p>
    <a href="creations.php" class="btn" aria-label="Voir toutes mes créations">Voir mes créations</a>
  </p>
</section>


  <!-- Dernières Créations -->
  <section class="p-2 fade-in" aria-labelledby="dernieres-creations-title">
  <h2 class="services_title text-center m-3" id="dernieres-creations-title">🖼️ Dernières Créations</h2>
  <?php
    $query = "SELECT * FROM creations ORDER BY id DESC LIMIT 3";
    $result = mysqli_query($con, $query);
  ?>
  <?php if (mysqli_num_rows($result) > 0) : ?>
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-3 mb-3 justify-content-center">
      <?php foreach ($result as $row) : ?>
        <?php if (!empty($row['image'])) : ?>
  <div class="col">
    <div class="card h-100 border-0 creation-card fade-in" style="overflow: hidden; transition: box-shadow 0.3s ease;">
      <!-- Lien autour de l'image -->
      <a href="creation.php?slug=<?= urlencode($row['slug']) ?>" aria-label="Voir la création <?= htmlspecialchars($row['title']) ?>">
        <img
          src="<?= htmlspecialchars($row['image']) ?>"
          class="card-img-top img-fluid"
          alt="<?= htmlspecialchars($row['title']) ?>"
          loading="lazy"
          style="height: 200px; object-fit: cover;"
        >
      </a>
      <script>
document.addEventListener('DOMContentLoaded', function() {
  var img = document.querySelector('.creation-detail-img');
  if(img) {
    img.onerror = function() {
      this.src = 'images/placeholder.jpg';
    }
  }
});
</script>

      <div class="card-body d-flex flex-column text-center">
        <h5 class="card-title text-primary"><?= nl2br(htmlspecialchars($row['title'])) ?></h5>
        <p class="creation_date text-muted small mb-1">
          <i class="far fa-calendar-alt me-1 small text-muted"></i>
          <?= $formatter->format(new DateTime($row['date'])) ?>
        </p>
        <p class="card-text text-secondary small">
          <?= nl2br(htmlspecialchars(substr($row['content'], 0, 160))) ?>...
        </p>
        <!-- Lien bouton vers la même fiche détail -->
        <a href="creation.php?slug=<?= urlencode($row['slug']) ?>" class="btn btn-outline-primary btn-sm mt-auto" aria-label="Voir la création <?= htmlspecialchars($row['title']) ?>">
          Voir la création
        </a>
      </div>
    </div>
  </div>
<?php endif; ?>

      <?php endforeach; ?>
    </div>
    <div class="text-center mb-4">
      <a href="creations.php" class="btn btn-primary btn-lg mt-3" aria-label="Voir toutes les créations">
        <i class="fas fa-th-large me-2"></i>VOIR TOUTES LES <strong>CRÉATIONS</strong>
      </a>
    </div>
  <?php endif; ?>
</section>


  <?php // Optionnel : Désactive le formulaire direct sur la home, laisse le bouton Contact dans le header/footer. ?>
</main>

<?php require 'footer.php'; ?>

<script>
  // animation fade-in on scroll
  const faders = document.querySelectorAll('.fade-in');
  const appearOptions = { threshold: 0.2, rootMargin: '0px 0px -50px 0px' };
  const appearOnScroll = new IntersectionObserver(function(entries, observer) {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('show');
        observer.unobserve(entry.target);
      }
    });
  }, appearOptions);

  faders.forEach(fader => {
    appearOnScroll.observe(fader);
  });
</script>

</body>
</html>
