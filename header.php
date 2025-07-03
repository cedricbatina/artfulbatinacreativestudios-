<header class="container-fluid bg-light py-2 shadow-sm sticky-top">
  <nav class="navbar navbar-expand-lg navbar-light container">
<a href="index.php" class="navbar-brand d-flex align-items-center flex-wrap">

  <span class="site_name m-0 h6 text-break">
    @rtful Batina<br class="d-sm-none"> Creative Studios
  </span>
</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
      aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon text-white"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="mainNavbar">
      <ul class="navbar-nav text-center">
        <li class="nav-item mx-2">
          <a href="index.php" class="nav-link text-white  <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Accueil</a>
        </li>
        <li class="nav-item mx-2">
          <a href="creations.php" class="nav-link text-white <?php echo basename($_SERVER['PHP_SELF']) == 'creations.php' ? 'active' : ''; ?>">Créations</a>
        </li>
        <li class="nav-item mx-2">
          <a href="contact.php" class="nav-link text-white <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">Contact</a>
        </li>
        <?php if (empty($_SESSION["info"])) : ?>
          <li class="nav-item mx-2"><a href="login.php" class="nav-link text-white">Log In</a></li>
        <?php else : ?>
          <li class="nav-item mx-2"><a href="profile.php" class="nav-link text-white">Profil</a></li>
          <li class="nav-item mx-2"><a href="logout.php" class="nav-link text-white>Log Out</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>
</header>
