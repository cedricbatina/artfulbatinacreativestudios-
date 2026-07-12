<?php
session_start();
require_once "functions.php"; // Doit charger $con

// --- Sécurité : vérifie session utilisateur ---
$user = $_SESSION['info'] ?? null;
if (!$user || !isset($user['username'], $user['email'])) {
  header("Location: login.php");
  exit;
}
$user_id = $user['id'];

//---------------------//
//    TRAITEMENT PHP   //
//---------------------//

// --- DELETE POST ---
if ($_SERVER['REQUEST_METHOD'] == "POST" && ($_POST['action'] ?? '') === 'post_delete') {
  $id = intval($_POST['id'] ?? 0);
  $q = mysqli_prepare($con, "SELECT image FROM creations WHERE id=? AND user_id=?");
  mysqli_stmt_bind_param($q, "ii", $id, $user_id); mysqli_stmt_execute($q); $res = mysqli_stmt_get_result($q);
  if ($row = mysqli_fetch_assoc($res)) { if ($row['image'] && file_exists($row['image'])) unlink($row['image']); }
  $q = mysqli_prepare($con, "DELETE FROM creations WHERE id=? AND user_id=?");
  mysqli_stmt_bind_param($q, "ii", $id, $user_id); mysqli_stmt_execute($q);
  header("Location: profile.php"); exit;
}

// --- EDIT POST ---
if ($_SERVER['REQUEST_METHOD'] == "POST" && ($_POST['action'] ?? '') === 'post_edit') {
  $id = intval($_POST['id'] ?? 0);
  $title = trim($_POST['title'] ?? '');
  $content = trim($_POST['content'] ?? '');
  $image = '';
  if (!empty($_FILES['image']['name'])) {
    $folder = "uploads/"; if (!file_exists($folder)) mkdir($folder, 0777, true);
    $image = $folder . time() . '_' . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $image);
    // Remove old
    $q = mysqli_prepare($con, "SELECT image FROM creations WHERE id=? AND user_id=?");
    mysqli_stmt_bind_param($q, "ii", $id, $user_id); mysqli_stmt_execute($q); $res = mysqli_stmt_get_result($q);
    if ($row = mysqli_fetch_assoc($res)) { if ($row['image'] && file_exists($row['image'])) unlink($row['image']); }
    $q = mysqli_prepare($con, "UPDATE creations SET title=?, content=?, image=? WHERE id=? AND user_id=?");
    mysqli_stmt_bind_param($q, "sssii", $title, $content, $image, $id, $user_id); mysqli_stmt_execute($q);
  } else {
    $q = mysqli_prepare($con, "UPDATE creations SET title=?, content=? WHERE id=? AND user_id=?");
    mysqli_stmt_bind_param($q, "ssii", $title, $content, $id, $user_id); mysqli_stmt_execute($q);
  }
  header("Location: profile.php"); exit;
}

// --- DELETE PROFILE ---
if ($_SERVER['REQUEST_METHOD'] == "POST" && ($_POST['action'] ?? '') === 'delete_profile') {
  $q = mysqli_prepare($con, "DELETE FROM users WHERE id=?");
  mysqli_stmt_bind_param($q, "i", $user_id); mysqli_stmt_execute($q);
  $q = mysqli_prepare($con, "SELECT image FROM creations WHERE user_id=?");
  mysqli_stmt_bind_param($q, "i", $user_id); mysqli_stmt_execute($q); $res = mysqli_stmt_get_result($q);
  while ($row = mysqli_fetch_assoc($res)) { if ($row['image'] && file_exists($row['image'])) unlink($row['image']); }
  $q = mysqli_prepare($con, "DELETE FROM creations WHERE user_id=?");
  mysqli_stmt_bind_param($q, "i", $user_id); mysqli_stmt_execute($q);
  if ($user['image'] && file_exists($user['image'])) unlink($user['image']);
  session_destroy();
  header("Location: logout.php"); exit;
}

// --- EDIT PROFILE ---
if ($_SERVER['REQUEST_METHOD'] == "POST" && ($_POST['action'] ?? '') === 'edit_profile') {
  $username = trim($_POST['username'] ?? '');
  $email    = trim($_POST['email'] ?? '');
  $password = trim($_POST['password'] ?? '');
  $image = $user['image'];
  if (!empty($_FILES['image']['name'])) {
    $folder = "uploads/"; if (!file_exists($folder)) mkdir($folder, 0777, true);
    $image = $folder . time() . '_' . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $image);
    if ($user['image'] && file_exists($user['image'])) unlink($user['image']);
  }
  // (!) Pour la production, il faut hasher le mot de passe !
  $q = mysqli_prepare($con, "UPDATE users SET username=?, email=?, password=?, image=? WHERE id=?");
  mysqli_stmt_bind_param($q, "ssssi", $username, $email, $password, $image, $user_id); mysqli_stmt_execute($q);
  $res = mysqli_query($con, "SELECT * FROM users WHERE id = $user_id LIMIT 1");
  $_SESSION['info'] = mysqli_fetch_assoc($res);
  header("Location: profile.php"); exit;
}

// --- AJOUTER UNE CREATION ---
if ($_SERVER['REQUEST_METHOD'] == "POST" && ($_POST['action'] ?? '') === 'add_creation') {
  $title   = trim($_POST['title'] ?? '');
  $content = trim($_POST['content'] ?? '');
  $url     = trim($_POST['url'] ?? '');
  if ($url === '') {
    $url = null; // facultatif
  }

  $image = '';
  if (!empty($_FILES['image']['name'])) {
    $folder = "uploads/";
    if (!file_exists($folder)) {
      mkdir($folder, 0777, true);
    }
    $image = $folder . time() . '_' . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $image);
  }

  $date = date('Y-m-d H:i:s');

  // On insère aussi l'URL dans la table creations
  $q = mysqli_prepare(
    $con,
    "INSERT INTO creations (title, url, content, image, user_id, date) VALUES (?, ?, ?, ?, ?, ?)"
  );
  mysqli_stmt_bind_param($q, "ssssis", $title, $url, $content, $image, $user_id, $date);
  mysqli_stmt_execute($q);

  header("Location: profile.php");
  exit;
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profil – @rtful Batina Creative Studios</title>
  <meta name="description" content="Profil utilisateur et gestion de vos créations sur Artful Batina Creative Studios.">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="./css/stylefile.css" rel="stylesheet">
  <link href="./css/profile.css" rel="stylesheet">
  <link rel="shortcut icon" href="./images/official_favicon48X48.ico" type="image/x-icon">

</head>
<body>
<?php require "header.php"; ?>
<?php require "banner.php"; ?>
<main class="container my-5" aria-labelledby="profile-title">

  <!-- PROFIL UTILISATEUR -->
  <section class="profile-hero" aria-label="Profil utilisateur">
    <img src="<?= htmlspecialchars($user['image']) ?>" alt="Photo de profil de <?= htmlspecialchars($user['username']) ?>">
    <div>
      <h1 id="profile-title" class="h3 mb-1"><?= htmlspecialchars($user['username']) ?></h1>
      <p class="mb-2 text-muted"><?= htmlspecialchars($user['email']) ?></p>
      <div class="profile-btns d-flex flex-wrap gap-2">
        <a href="profile.php?action=edit" class="btn btn-outline-dark btn-sm" aria-label="Modifier le profil"><i class="fas fa-user-edit me-1"></i>Modifier</a>
        <a href="profile.php?action=delete" class="btn btn-outline-danger btn-sm" aria-label="Supprimer le profil" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre profil ? Cette action est irréversible.');"><i class="fas fa-user-times me-1"></i>Supprimer</a>
        <a href="logout.php" class="btn btn-secondary btn-sm" aria-label="Déconnexion"><i class="fas fa-sign-out-alt me-1"></i>Déconnexion</a>
      </div>
    </div>
  </section>

  <!-- MODAL/FORMULAIRES SPECIAUX -->
  <?php if (!empty($_GET['action']) && $_GET['action'] == 'edit'): ?>
    <!-- ... (voir code précédent, inchangé) ... -->
  <?php elseif (!empty($_GET['action']) && $_GET['action'] == 'delete'): ?>
    <!-- ... (idem, inchangé) ... -->
  <?php elseif (!empty($_GET['action']) && $_GET['action'] == 'post_edit' && !empty($_GET['id'])): ?>
    <!-- ... (idem, inchangé) ... -->
  <?php elseif (!empty($_GET['action']) && $_GET['action'] == 'post_delete' && !empty($_GET['id'])): ?>
    <!-- ... (idem, inchangé) ... -->
  <?php endif; ?>

  <!-- AJOUTER UNE CREATION (toujours affiché) -->
  <section class="mb-4">
    <h2 class="h5 mb-3 text-primary"><i class="fas fa-plus-circle me-2"></i>Publier une nouvelle création</h2>
    <form method="post" class="card p-3 p-md-4 shadow-sm mb-4" enctype="multipart/form-data" aria-label="Publier une création">
      <div class="mb-2">
        <label for="creation-image" class="form-label">Image</label>
        <input id="creation-image" type="file" name="image" class="form-control" accept="image/*,.pdf">
      </div>
      <div class="mb-2">
        <label for="creation-title" class="form-label">Titre</label>
        <input id="creation-title" type="text" name="title" class="form-control" required>
      </div>
      <!-- 🆕 URL du projet (facultatif) -->
    <div class="mb-2">
      <label for="creation-url" class="form-label">Lien du projet (facultatif)</label>
      <input id="creation-url"
             type="url"
             name="url"
             class="form-control"
             placeholder="https://exemple.com">
    </div>
      <div class="mb-3">
        <label for="creation-content" class="form-label">Description</label>
        <textarea id="creation-content" name="content" class="form-control" rows="3" required></textarea>
      </div>
      <input type="hidden" name="action" value="add_creation">
      <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane me-2"></i>Publier</button>
    </form>
  </section>

  <!-- LISTE CREATIONS -->
  <section>
    <h2 class="h5 mb-3 text-primary"><i class="fas fa-palette me-2"></i>Vos créations</h2>
    <?php
      $query = "SELECT * FROM creations WHERE user_id = $user_id ORDER BY id DESC LIMIT 10";
      $result = mysqli_query($con, $query);
    ?>
    <?php if ($result && mysqli_num_rows($result) > 0) : ?>
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
          <div class="col">
            <div class="card h-100 border-0 shadow-sm">
              <img src="<?= htmlspecialchars($row['image']) ?>" class="card-img-top img-fluid" style="height:170px;object-fit:cover;" alt="<?= htmlspecialchars($row['title']) ?>">
              <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                <p class="creation_date"><?= date('d/m/Y', strtotime($row['date'])) ?></p>
                <p class="card-text"><?= nl2br(htmlspecialchars(substr($row['content'], 0, 180))) ?><?= strlen($row['content'])>180?'…':'' ?></p>
              </div>
              <div class="card-footer d-flex justify-content-between gap-2">
                <a href="profile.php?action=post_edit&id=<?= $row['id'] ?>" class="btn btn-outline-dark btn-sm" aria-label="Modifier la création"><i class="fas fa-edit"></i></a>
                <a href="profile.php?action=post_delete&id=<?= $row['id'] ?>" class="btn btn-outline-danger btn-sm" aria-label="Supprimer la création"
                  onclick="return confirm('Confirmer la suppression de cette création ?');"><i class="fas fa-trash-alt"></i></a>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <p class="text-muted">Aucune création pour le moment.</p>
    <?php endif; ?>
  </section>

</main>
<?php require "footer.php"; ?>
</body>
</html>
