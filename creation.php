<?php
require './database_connexion.php';
require './functions.php';

if (!isset($_GET['slug']) || empty($_GET['slug'])) {
    // Redirection ou message d'erreur propre
    header('Location: creations.php');
    exit;
}
$slug = $_GET['slug'];
$stmt = $con->prepare("SELECT * FROM creations WHERE slug = ?");
$stmt->bind_param("s", $slug);
$stmt->execute();
$result = $stmt->get_result();
$creation = $result->fetch_assoc();

if (!$creation) {
    // Création non trouvée
    header('HTTP/1.0 404 Not Found');
    $page_title = "Création introuvable";
    $page_description = "La création demandée n'existe pas ou a été supprimée.";
} else {
    $page_title = "@rtful Batina Creative Studios - " . $creation['title'];
    $page_description = mb_substr(strip_tags($creation['content']), 0, 160) . "...";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?= htmlspecialchars($page_description) ?>">
  <meta name="author" content="Cédric Batina">
  <meta name="robots" content="index, follow">
  <title><?= htmlspecialchars($page_title) ?></title>
  
  <!-- SEO / Open Graph / Twitter (adapté dynamiquement) -->
  <meta property="og:title" content="<?= htmlspecialchars($page_title) ?>">
  <meta property="og:description" content="<?= htmlspecialchars($page_description) ?>">
  <meta property="og:type" content="article">
  <meta property="og:image" content="<?= !empty($creation['image']) ? htmlspecialchars($creation['image']) : './images/official_favicon48X48.ico' ?>">
  <meta property="og:url" content="https://artfulbatinacreativestudios.fr/creation.php?slug=<?= urlencode($slug) ?>">
  <meta property="og:locale" content="fr_FR">
  <meta property="og:site_name" content="@rtful Batina Creative Studios">
  <meta name="twitter:site" content="@cedricbatina">

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= htmlspecialchars($page_title) ?>">
  <meta name="twitter:description" content="<?= htmlspecialchars($page_description) ?>">
  <meta name="twitter:image" content="<?= !empty($creation['image']) ? htmlspecialchars($creation['image']) : './images/official_favicon48X48.ico' ?>">

  <?php if ($creation): ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CreativeWork",
  "name": "<?= addslashes($creation['title']) ?>",
  "description": "<?= addslashes(mb_substr(strip_tags($creation['content']), 0, 160)) ?>",
  "image": "<?= !empty($creation['image']) ? addslashes($creation['image']) : 'https://artfulbatinacreativestudios.fr/images/official_favicon48X48.ico' ?>",
  "author": {
    "@type": "Person",
    "name": "Cédric Batina"
  },
  "datePublished": "<?= date('Y-m-d', strtotime($creation['date'])) ?>",
  "url": "https://artfulbatinacreativestudios.fr/creation.php?slug=<?= urlencode($slug) ?>"
}
</script>
<?php endif; ?>

  <link rel="canonical" href="https://artfulbatinacreativestudios.fr/creation.php?slug=<?= urlencode($slug) ?>">

  <!-- Favicon & styles (comme sur index) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" />
  <link rel="stylesheet" href="./stylefile.css">
  <link rel="shortcut icon" href="./images/official_favicon48X48.ico" type="image/x-icon">
  <style>
    .creation-detail-img {
      display: block;
      margin: 0 auto 2rem auto;
      max-width: 100%;
      max-height: 420px;
      border-radius: 10px;
      box-shadow: 0 2px 16px rgba(0,0,0,0.10);
      background: #f8f8f8;
      object-fit: contain;
    }
    .card-title, h1.site_name {
  word-break: break-word;
  hyphens: auto;
}

    .back-link {
      margin-top: 2rem;
    }
  </style>
</head>
<body>
<?php require 'header.php'; ?>
<?php require 'banner.php'; ?>
<a href="#contenu-principal" class="visually-hidden-focusable">Aller au contenu principal</a>

<main id="contenu-principal" class="container my-5" role="main">
<?php if (!$creation) : ?>
  <div class="alert alert-warning text-center my-5">
    <h1>Création introuvable</h1>
    <p>La création que vous cherchez n'existe pas ou a été supprimée.</p>
    <a href="creations.php" class="btn btn-primary mt-3"><i class="fas fa-arrow-left"></i> Retour aux créations</a>
  </div>
<?php else: ?>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent px-0 py-2">
      <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
      <li class="breadcrumb-item"><a href="creations.php">Créations</a></li>
      <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($creation['title']) ?></li>
    </ol>
  </nav>

  <article itemscope itemtype="https://schema.org/CreativeWork">
    <header class="mb-4 text-center">
      <h1 class="site_name" itemprop="name"><?= htmlspecialchars($creation['title']) ?></h1>
      <p class="creation_date text-muted small mb-2">
        <i class="far fa-calendar-alt me-1"></i>
        <?php
          $formatter = new IntlDateFormatter(
            'fr_FR',
            IntlDateFormatter::LONG,
            IntlDateFormatter::SHORT
          );
          $date = new DateTime($creation['date']);
          echo $formatter->format($date);
        ?>
      </p>
    </header>

    <!-- Image principale -->
    <?php if (!empty($creation['image'])): ?>
      <img src="<?= !empty($creation['image']) ? htmlspecialchars($creation['image']) : 'images/placeholder.jpg' ?>"
     alt="Visuel de la création : <?= htmlspecialchars($creation['title']) ?>"
     class="creation-detail-img"
     itemprop="image"
     loading="lazy">

    <?php endif; ?>

    <!-- Si le contenu contient une URL de site web, on l'affiche comme lien visitable -->
    <section class="mb-4">
      <div class="card card-body shadow-sm">
        <div itemprop="description">
          <?= nl2br(htmlspecialchars($creation['content'])) ?>
        </div>
        <?php
        // Chercher une URL dans le contenu et l'afficher en mode "visiter le site"
        if (preg_match('/https?:\/\/[^\s]+/', $creation['content'], $matches)) :
            $url = $matches[0];
        ?>
          <div class="mt-3 text-center">
            <a href="<?= htmlspecialchars($url) ?>" target="_blank" rel="noopener nofollow" class="btn btn-success" aria-label="Visiter le site lié à cette création">
              <i class="fas fa-globe"></i> Visiter le site
            </a>
          </div>
        <?php endif; ?>
      </div>
    </section>
    <?php
// Requête précédente/suivante par id (optionnel : adapte si tu veux par date ou par id)
$prev = mysqli_query($con, "SELECT slug, title FROM creations WHERE id < {$creation['id']} ORDER BY id DESC LIMIT 1");
$next = mysqli_query($con, "SELECT slug, title FROM creations WHERE id > {$creation['id']} ORDER BY id ASC LIMIT 1");
$prev = mysqli_fetch_assoc($prev);
$next = mysqli_fetch_assoc($next);
?>
<!-- Navigation précédente/suivante -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-center my-4 gap-2">
  <?php if ($prev): ?>
    <a href="creation.php?slug=<?= urlencode($prev['slug']) ?>"
       class="btn btn-outline-secondary"
       aria-label="Création précédente : <?= htmlspecialchars($prev['title']) ?>">
      <i class="fas fa-arrow-left"></i>
      <span class="d-none d-sm-inline">Précédent</span>
      <span class="visually-hidden"><?= htmlspecialchars($prev['title']) ?></span>
    </a>
  <?php else: ?>
    <span></span>
  <?php endif; ?>

  <a href="creations.php" class="btn btn-secondary" aria-label="Retour à la liste des créations">
    <i class="fas fa-th-large me-2"></i>Retour à la liste
  </a>

  <?php if ($next): ?>
    <a href="creation.php?slug=<?= urlencode($next['slug']) ?>"
       class="btn btn-outline-secondary ms-md-auto"
       aria-label="Création suivante : <?= htmlspecialchars($next['title']) ?>">
      <span class="d-none d-sm-inline">Suivant</span>
      <i class="fas fa-arrow-right"></i>
      <span class="visually-hidden"><?= htmlspecialchars($next['title']) ?></span>
    </a>
  <?php else: ?>
    <span></span>
  <?php endif; ?>
</div>

<!-- Bouton contact -->
<div class="text-center mb-4">
  <a href="contact.php" class="btn btn-warning" aria-label="Contactez-moi à propos de cette création">
    <i class="fas fa-envelope me-2"></i>Parler de votre projet
  </a>
  <p class="mt-2 text-muted small">
  Discutons de votre projet ou de vos idées créatives, réponse sous 24h !
</p>

</div>

<!-- Partage social -->
<div class="text-center m-3">
  <p class="me-2 text-primary fw-bold">Partager cette publication :</p>
  <a href="https://twitter.com/intent/tweet?url=<?= urlencode('https://artfulbatinacreativestudios.fr/creation.php?slug='.$slug) ?>&text=<?= urlencode($creation['title']) ?>"
     target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary" aria-label="Partager sur X/Twitter">
    <i class="fab fa-twitter"></i> X/Twitter
  </a>
  <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode('https://artfulbatinacreativestudios.fr/creation.php?slug='.$slug) ?>"
     target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary" aria-label="Partager sur Facebook">
    <i class="fab fa-facebook"></i> Facebook
  </a>
  <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= urlencode('https://artfulbatinacreativestudios.fr/creation.php?slug='.$slug) ?>&title=<?= urlencode($creation['title']) ?>"
     target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary" aria-label="Partager sur LinkedIn">
    <i class="fab fa-linkedin"></i> LinkedIn
  </a>
</div>

<section class="my-5 text-center text-muted small">
  <p>@rtful Batina Creative Studios accompagne entrepreneurs, associations et artistes dans leurs projets web et graphiques depuis 2011.</p>
</section>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var img = document.querySelector('.creation-detail-img');
    if (img) {
      img.onerror = function() {
        this.src = 'images/placeholder.jpg';
      }
    }
  });
</script>

  </article>
<?php endif; ?>
</main>
<?php require 'footer.php'; ?>
</body>
</html>
