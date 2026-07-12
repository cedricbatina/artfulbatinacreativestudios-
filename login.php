<?php
session_start();
require_once "functions.php";

// (Décommente si accès limité)
 require_once "private-access.php";

$error = '';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($email && $password) {
        // Préparation de la requête sécurisée
        $stmt = mysqli_prepare($con, "SELECT * FROM users WHERE email = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($user = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $user['password'])) {
                // Authentification OK
                $_SESSION['info'] = [
                 'id'       => $user['id'],
                 'username' => $user['username'],
                 'email'    => $user['email'],
                 'image'    => $user['image'] ?? '',
             ];
             
                header("Location: profile.php");
                exit;
            } else {
                $error = "Adresse email ou mot de passe incorrect.";
            }
        } else {
            $error = "Adresse email ou mot de passe incorrect.";
        }
        mysqli_stmt_close($stmt);
    } else {
        $error = "Tous les champs sont obligatoires.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
     <!-- FAVICONS & ICONS -->
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="./images/official_favicon.png">
  <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon_16x16.png">
  <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon_16x16.ico">
  <link rel="icon" href="./images/favicon.ico" type="image/x-icon">
  <link rel="manifest" href="/site.webmanifest">
    <title>Connexion – @rtful Batina Creative Studios</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous">
    <link href="./css/stylefile.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php require "header.php"; ?>
<?php require "banner.php"; ?>

<div class="container my-5" style="max-width: 430px;">
    <div class="card shadow-sm">
        <div class="card-header text-center bg-dark text-white">
            <h1 class="h4 mb-0"><i class="fas fa-user-circle me-2"></i>Connexion</h1>
        </div>
        <div class="card-body">
            <?php if ($error): ?>
                <div class="alert alert-danger" role="alert"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form action="" method="POST" autocomplete="off">
                <div class="mb-3">
                    <label for="email" class="form-label">Adresse email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" class="form-control" required autocomplete="email" autofocus>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe <span class="text-danger">*</span></label>
                    <input type="password" name="password" id="password" class="form-control" required autocomplete="current-password">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                    </button>
                </div>
            </form>
            <div class="text-center mt-3 small">
                <a href="forgot_password.php">Mot de passe oublié ?</a>
            </div>
        </div>
        <div class="card-footer text-center">
            <span>Pas encore de compte ?</span> <a href="signup.php" class="fw-bold">Inscription</a>
        </div>
    </div>
</div>

<?php require "footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" crossorigin="anonymous"></script>
</body>
</html>
