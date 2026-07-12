<?php
//if (session_status() === PHP_SESSION_NONE) session_start();

function get_env($key, $default = null) {
 // .env dans le dossier du projet
 $envPath = __DIR__ . '/.env';
 static $env = null;
 if ($env === null && file_exists($envPath)) {
     foreach (file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
         if (strpos($line, '=') !== false && substr(trim($line), 0, 1) !== '#') {
             [$k, $v] = explode('=', $line, 2);
             $env[trim($k)] = trim($v);
         }
     }
 }
 return $env[$key] ?? getenv($key) ?? $default;
}

$login_code = get_env('LOGIN_CODE', 'change_me_NOW');


if (empty($_SESSION['private_access'])) {
    $error = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     if (isset($_POST['access_code']) && $_POST['access_code'] === $login_code) 
      // ...
   {
            $_SESSION['private_access'] = true;
            // Redirige vers la même page pour afficher le formulaire réel (évite le POST)
            header("Location: " . basename($_SERVER['PHP_SELF']));
            exit;
        } else {
            $error = "Code d’accès incorrect.";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Accès réservé – @rtful Batina Creative Studios</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="./css/stylefile.css" rel="stylesheet">
    </head>
    <body class="bg-light d-flex align-items-center" style="min-height:100vh">
        <div class="container my-5" style="max-width: 420px;">
            <div class="card shadow">
                <div class="card-header text-center bg-dark text-white">
                    <h1 class="h5 mb-0">
                        <i class="fas fa-lock me-2"></i>
                        Accès privé réservé
                    </h1>
                </div>
                <div class="card-body">
                    <p class="mb-4 text-center text-muted">
                        Cette page est réservée à l’administrateur. Veuillez entrer le code d’accès pour continuer.
                    </p>
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger" role="alert"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    <form method="post" autocomplete="off">
                        <div class="mb-3">
                            <label for="access_code" class="form-label">
                                Code d’accès <span class="text-danger">*</span>
                            </label>
                            <input type="password"
                                   id="access_code"
                                   name="access_code"
                                   class="form-control"
                                   required
                                   autocomplete="off"
                                   aria-label="Code d’accès"
                                   autofocus>
                        </div>
                        <button class="btn btn-primary w-100" type="submit">
                            <i class="fas fa-key me-2"></i>Valider
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    </body>
    </html>
    <?php
    exit;
}
?>
