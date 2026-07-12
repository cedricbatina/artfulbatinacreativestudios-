<?php
session_start();
require_once "functions.php";

// (Décommente si tu veux l'accès réservé)
 require_once "private-access.php";

$error = '';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $date     = date('Y-m-d H:i:s');

    if (!$username || !$email || !$password) {
        $error = "Tous les champs sont obligatoires.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email invalide.";
    } else {
        // Vérifie unicité email
        $stmt = mysqli_prepare($con, "SELECT id FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $error = "Cet email est déjà utilisé.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = mysqli_prepare($con, "INSERT INTO users (username, email, password, date) VALUES (?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hash, $date);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: login.php?inscription=ok");
                exit;
            } else {
                $error = "Erreur lors de l'inscription.";
            }
            mysqli_stmt_close($stmt);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Inscription – @rtful Batina Creative Studios</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous">
  <link href="./css/stylefile.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php require "header.php"; ?>
<?php require "banner.php"; ?>
<div class="container my-5" style="max-width: 440px;">
  <div class="card shadow-sm">
    <div class="card-header text-center bg-dark text-white">
      <h1 class="h4 mb-0"><i class="fas fa-user-plus me-2"></i>Créer un compte</h1>
    </div>
    <div class="card-body">
      <?php if ($error): ?>
        <div class="alert alert-danger" role="alert"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>
      <form action="" method="POST" autocomplete="off">
        <div class="mb-3">
          <label for="username" class="form-label">Nom d'utilisateur <span class="text-danger">*</span></label>
          <input type="text" name="username" id="username" class="form-control" required autofocus>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Adresse email <span class="text-danger">*</span></label>
          <input type="email" name="email" id="email" class="form-control" required autocomplete="email">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Mot de passe <span class="text-danger">*</span></label>
          <input type="password" name="password" id="password" class="form-control" required autocomplete="new-password">
        </div>
        <div class="d-grid">
          <button class="btn btn-primary btn-lg" type="submit"><i class="fas fa-user-plus me-2"></i>S'inscrire</button>
        </div>
      </form>
    </div>
    <div class="card-footer text-center">
      <span>Déjà un compte ?</span> <a href="login.php" class="fw-bold">Connexion</a>
    </div>
  </div>
</div>
<?php require "footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" crossorigin="anonymous"></script>
</body>
</html>
