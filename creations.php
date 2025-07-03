<?php
include "./functions.php";
include 'database_connexion.php';

// Récupérer tous les types pour le filtre
$type_result = mysqli_query($con, "SELECT DISTINCT type FROM creation_types ORDER BY type");
$types = [];
while ($tr = mysqli_fetch_assoc($type_result)) $types[] = $tr['type'];

$type_filter = isset($_GET['type']) ? $_GET['type'] : null;
$per_page = 6;
$page = max(1, intval($_GET['page'] ?? 1));
$offset = ($page-1) * $per_page;

if ($type_filter) {
    $subq = "SELECT DISTINCT creation_id FROM creation_types WHERE type = '".mysqli_real_escape_string($con, $type_filter)."'";
    $count_q = "SELECT COUNT(*) FROM creations WHERE id IN ($subq)";
    $list_q = "SELECT * FROM creations WHERE id IN ($subq) ORDER BY id DESC LIMIT $per_page OFFSET $offset";
} else {
    $count_q = "SELECT COUNT(*) FROM creations";
    $list_q = "SELECT * FROM creations ORDER BY id DESC LIMIT $per_page OFFSET $offset";
}
$count_r = mysqli_query($con, $count_q);
$total = mysqli_fetch_row($count_r)[0];
$total_pages = ceil($total / $per_page);

$res = mysqli_query($con, $list_q);
$creations = [];
while ($row = mysqli_fetch_assoc($res)) $creations[] = $row;
$creation_ids = array_column($creations, 'id');
$type_map = [];
if ($creation_ids) {
    $id_list = implode(',', array_map('intval', $creation_ids));
    $types_res = mysqli_query($con, "SELECT creation_id, type FROM creation_types WHERE creation_id IN ($id_list)");
    while ($tr = mysqli_fetch_assoc($types_res)) {
        $type_map[$tr['creation_id']][] = $tr['type'];
    }
}
$formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::SHORT);

// Fonction pour couper la description proprement sans couper de mots
function truncate_words($text, $max = 130) {
    $text = strip_tags($text);
    if (mb_strlen($text) <= $max) return $text;
    $words = preg_split('/\s+/', $text);
    $out = '';
    foreach ($words as $word) {
        if (mb_strlen($out . ' ' . $word) > $max) break;
        $out .= ($out ? ' ' : '') . $word;
    }
    return trim($out) . '…';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<?php
$page_title = '@rtful Batina Creative Studios – Créations publiées';
$page_description = "Découvrez les créations graphiques et web de Cédric Batina : sites web, logos, affiches, cartes de visite, illustrations et plus encore. Exemples de réalisations et projets récents.";
$page_keywords = "portfolio, créations, design graphique, développement web, affiches, logo, carte de visite, site internet, illustration, studio créatif, Cédric Batina, Gradignan, Bordeaux, freelance";
$page_url = "https://artfulbatinacreativestudios.fr/creations.php";
$page_img = "https://artfulbatinacreativestudios.fr/images/official_logo_@bc_transparent.png";
?>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= htmlspecialchars($page_title) ?></title>
<meta name="description" content="<?= htmlspecialchars($page_description) ?>">
<meta name="keywords" content="<?= htmlspecialchars($page_keywords) ?>">
<meta name="author" content="Cédric Batina">
<meta name="robots" content="index, follow">

<!-- Canonical -->
<link rel="canonical" href="<?= $page_url ?>">

<!-- Open Graph -->
<meta property="og:title" content="<?= htmlspecialchars($page_title) ?>">
<meta property="og:description" content="<?= htmlspecialchars($page_description) ?>">
<meta property="og:type" content="website">
<meta property="og:image" content="<?= $page_img ?>">
<meta property="og:url" content="<?= $page_url ?>">
<meta property="og:site_name" content="@rtful Batina Creative Studios">
<meta property="og:locale" content="fr_FR">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= htmlspecialchars($page_title) ?>">
<meta name="twitter:description" content="<?= htmlspecialchars($page_description) ?>">
<meta name="twitter:image" content="<?= $page_img ?>">
<meta name="twitter:site" content="@CedricBatina">
<meta name="twitter:creator" content="@CedricBatina">

<!-- Favicon & Manifest déjà inclus ailleurs -->

<!-- Schema.org JSON-LD PortfolioPage -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "name": "<?= addslashes($page_title) ?>",
  "description": "<?= addslashes($page_description) ?>",
  "url": "<?= $page_url ?>",
  "image": "<?= $page_img ?>",
  "creator": {
    "@type": "Person",
    "name": "Cédric Batina",
    "url": "https://www.linkedin.com/in/cédric-batina-6b17b31a7/"
  }
}
</script>

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" />
   <link href="./stylefile.css" rel="stylesheet">
   <link rel="shortcut icon" href="./images/official_favicon48X48.ico" type="image/x-icon">
</head>
<body>
<a href="#contenu-principal" class="visually-hidden-focusable">Aller au contenu principal</a>

<?php require_once "header.php"; ?>
<?php require_once "banner.php"; ?>

<main id="contenu-principal" class="container my-5" role="main" tabindex="-1">

  <h1 class="services_title mb-2 text-center">Les créations publiées</h1>
  <p class="p-1 text-center">
   Je vais bien au-delà de la simple <strong>création de designs</strong>. En tant que freelance, je vous accompagne personnellement dans l’élaboration de votre <strong>stratégie de marketing visuel</strong> : <strong>graphismes</strong> pour les <strong>réseaux sociaux</strong>, <strong>brochures</strong>, <strong>flyers</strong>, <strong>cartes de visite</strong>, <strong>affiches</strong>, <strong>bannières</strong> et plus encore.<br>
   Mon engagement : fournir des <strong>designs</strong> de haute qualité à des tarifs compétitifs, afin de promouvoir votre activité sans dépasser votre budget.<br>
   <strong>@rtful Batina Creative Studios</strong>, c’est ma marque d’indépendant passionné au service de vos idées. Si vous souhaitez <strong>créer</strong> une <strong>identité visuelle</strong> distinctive pour votre projet ou entreprise, <a href="contact.php">contactez-moi</a> dès aujourd'hui et échangeons sur la meilleure manière de <strong>communiquer</strong> votre message.<br>
   J’analyse vos objectifs, votre public cible et votre <strong>image de marque</strong>. J’étudie également la concurrence et les tendances du marché pour vous garantir un <strong>site web</strong> conçu pour vous démarquer. Ensuite, je réalise une maquette personnalisée en veillant à chaque détail : <strong>typographie</strong>, <strong>couleurs</strong>, <strong>mise en page</strong>, <strong>images</strong>… Mon objectif : <strong>créer un site web</strong> ou un support qui reflète votre identité, tout en étant agréable à utiliser et rapide à naviguer.
</p>

<div class="text-center mb-4">
  <a href="contact.php" class="btn btn-warning btn-lg" aria-label="Contactez-moi">
    <i class="fas fa-envelope me-2"></i>Contactez-moi
  </a>
  <p class="mt-2 text-muted small">
  Discutons de votre projet ou de vos idées créatives, réponse sous 24h !
</p>
</div>

<p class="text-center">
  J’utilise les dernières technologies et les meilleures pratiques pour <strong>créer une application web</strong> rapide, sécurisée et facile à utiliser. Je teste également rigoureusement chaque fonctionnalité afin de vous garantir la meilleure expérience possible.
</p>

  <!-- Filtres par type -->
  <form class="mb-4 d-flex flex-wrap align-items-center gap-2 justify-content-center" method="get">
    <label for="type" class="form-label mb-0 me-2 text-primary fw-bold">Filtrer par type :</label>
    <select name="type" id="type" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
      <option value="">-- Tous --</option>
      <?php foreach ($types as $t): ?>
        <option value="<?= htmlspecialchars($t) ?>" <?= ($type_filter === $t) ? 'selected' : '' ?>><?= ucfirst($t) ?></option>
      <?php endforeach; ?>
    </select>
  </form>

  <?php if (count($creations) > 0): ?>
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-4 justify-content-center">
    <?php foreach ($creations as $row): ?>
      <div class="col">
        <div class="card creation-card h-100 border-0 shadow-sm">
          <a href="creation.php?slug=<?= urlencode($row['slug']) ?>"
             aria-label="Voir la fiche détaillée de : <?= htmlspecialchars($row['title']) ?>">
            <img src="<?= !empty($row['image']) ? htmlspecialchars($row['image']) : 'images/placeholder.jpg' ?>"
                 class="card-img-top"
                 alt="Visuel de <?= htmlspecialchars($row['title']) ?>"
                 loading="lazy">
          </a>
          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?= nl2br(htmlspecialchars($row['title'])) ?></h5>
              <!-- Badges type -->
              <?php if (isset($type_map[$row['id']])): ?>
              <div class="mb-1">
                <?php foreach ($type_map[$row['id']] as $type): ?>
                  <span class="badge bg-info text-dark me-1"><?= htmlspecialchars($type) ?></span>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
            <!-- Description tronquée -->
            <p class="card-text small text-secondary mb-2">
              <?= htmlspecialchars(truncate_words($row['content'], 130)) ?>
            </p>
          
            <p class="creation_date text-muted small mb-1">
              <i class="far fa-calendar-alt me-1"></i>
              <?= $formatter->format(new DateTime($row['date'])) ?>
            </p>
            <a href="creation.php?slug=<?= urlencode($row['slug']) ?>"
               class="btn btn-outline-primary btn-sm mt-auto"
               aria-label="Voir la création <?= htmlspecialchars($row['title']) ?>">
              Voir la création
            </a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <?php else: ?>
    <div class="alert alert-info text-center">Aucune création trouvée.</div>
  <?php endif; ?>

  <!-- Pagination -->
  <?php if ($total_pages > 1): ?>
  <nav class="d-flex justify-content-center mt-4" aria-label="Pagination">
    <ul class="pagination mb-0">
      <?php if ($page > 1): ?>
        <li class="page-item">
          <a class="page-link" href="?page=<?= $page-1 ?><?= $type_filter ? '&type='.urlencode($type_filter) : '' ?>" aria-label="Page précédente">
            <i class="fas fa-chevron-left"></i> Précédent
          </a>
        </li>
      <?php endif; ?>
      <?php if ($page < $total_pages): ?>
        <li class="page-item">
          <a class="page-link" href="?page=<?= $page+1 ?><?= $type_filter ? '&type='.urlencode($type_filter) : '' ?>" aria-label="Page suivante">
            Suivant <i class="fas fa-chevron-right"></i>
          </a>
        </li>
      <?php endif; ?>
    </ul>
  </nav>
  <?php endif; ?>

  <div class="text-center my-5">
    <a href="index.php" class="btn btn-secondary" aria-label="Retour à l'accueil">
      <i class="fas fa-home me-2"></i>Retour à l'accueil
    </a>
  </div>

</main>

<?php require_once "contact_form.php"; ?>
<?php require_once "footer.php"; ?>
</body>
</html>
