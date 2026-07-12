<?php
// migrate_passwords.php
require "functions.php";

$result = mysqli_query($con, "SELECT id, password FROM users");
if (!$result) {
    die('Erreur SQL : ' . mysqli_error($con));
}

while ($row = mysqli_fetch_assoc($result)) {
    $userId = $row['id'];
    $plain = $row['password'];

    // On vérifie si ce n'est pas déjà un hash
    if (strlen($plain) < 60 || !preg_match('/^\$2y\$/', $plain)) {
        $hash = password_hash($plain, PASSWORD_DEFAULT);
        $escapedHash = mysqli_real_escape_string($con, $hash);
        $update = mysqli_query($con, "UPDATE users SET password = '$escapedHash' WHERE id = $userId");
        if ($update) {
            echo "Utilisateur $userId : migré<br>";
        } else {
            echo "Erreur sur $userId : " . mysqli_error($con) . "<br>";
        }
    } else {
        echo "Utilisateur $userId : déjà sécurisé<br>";
    }
}

echo "<strong>Migration terminée.</strong>";
?>
