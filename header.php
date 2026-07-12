<header class="main-header shadow-sm sticky-top border-bottom" role="banner">
  <nav class="navbar navbar-expand-lg navbar-dark container" aria-label="Navigation principale">
    <a href="index.php" class="navbar-brand d-flex align-items-center py-0 text-decoration-none" aria-label="Accueil">
      <img src="./images/pictures/official_logo_@bc_transparent.png"
           alt="Logo Artful Batina Creative Studios"
           style="height:38px; width:auto; border-radius: 9px; background:#fff; padding:2px;">
      <span class="site_name ms-2 fw-bold text-light" style="font-size:1.13rem;letter-spacing:0.5px;">
        @rtful Batina Creative Studios
      </span>
    </a>
    <button class="navbar-toggler border-0 shadow-none"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mainNavbar"
            aria-controls="mainNavbar"
            aria-expanded="false"
            aria-label="Ouvrir le menu">
      <span class="navbar-toggler-icon" style="filter: invert(1) brightness(2);"></span>
    </button>

    <div class="collapse navbar-collapse flex-grow-0" id="mainNavbar">
      <ul class="navbar-nav align-items-center ms-auto gap-lg-2">
        <?php
        $page = basename($_SERVER['PHP_SELF']);
        function navActive($f) { global $page; return ($page==$f) ? 'active' : ''; }
        ?>
        <li class="nav-item">
          <a href="index.php" class="nav-link px-3 <?= navActive('index.php') ?>">Accueil</a>
        </li>
        <li class="nav-item">
          <a href="creations.php" class="nav-link px-3 <?= navActive('creations.php') ?>">Publications</a>
        </li>
        <li class="nav-item">
          <a href="about-me.php" class="nav-link px-3 <?= navActive('about-me.php') ?>">À propos</a>
        </li>
         <li class="nav-item">
          <a href="batinacedric.php" class="nav-link px-3 <?= navActive('about-me.php') ?>">Cédric Batina</a>
        </li>
        <li class="nav-item">
          <a href="contact.php" class="nav-link px-3 <?= navActive('contact.php') ?>">Contact</a>
        </li>
        <?php if (empty($_SESSION["info"])) : ?>
        <li class="nav-item d-lg-none"><a href="login.php" class="nav-link px-3">Connexion</a></li>
        <?php else : ?>
        <li class="nav-item d-lg-none"><a href="profile.php" class="nav-link px-3">Profil</a></li>
        <li class="nav-item d-lg-none"><a href="logout.php" class="nav-link px-3">Déconnexion</a></li>
        <?php endif; ?>
      </ul>
      <!-- Social desktop only -->
      <?php include "social_links.php"; ?>

   
      <!-- Connexion/Profil desktop -->
      <?php if (empty($_SESSION["info"])) : ?>
        <a href="login.php" class="btn btn-outline-light ms-3 d-none d-lg-inline" style="border-radius:22px;font-size:.97em;">Connexion</a>
      <?php else : ?>
        <a href="profile.php" class="btn btn-outline-light ms-3 d-none d-lg-inline" style="border-radius:22px;font-size:.97em;">Profil</a>
        <a href="logout.php" class="btn btn-outline-secondary ms-2 d-none d-lg-inline" style="border-radius:22px;font-size:.97em;">Déconnexion</a>
      <?php endif; ?>
    </div>
  </nav>
</header>
