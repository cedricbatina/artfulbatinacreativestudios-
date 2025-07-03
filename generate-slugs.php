<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require './database_connexion.php';

// Fonction simple de "slugification"
function slugify($text) {
    $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text); // Enlève accents
    $text = preg_replace('~[^\pL\d]+~u', '-', $text); // remplace espaces, etc par -
    $text = preg_replace('~[^-\w]+~', '', $text);      // enlève tout sauf lettres, chiffres, -
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);          // plusieurs - > un seul
    $text = strtolower($text);
    return $text ?: 'n-a';
}

$sql = "SELECT id, title FROM creations";
$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_assoc($result)) {
    $slug = slugify($row['title']);
    // pour garantir l'unicité, ajoute l'id à la fin si jamais un doublon est possible
    $slug = $slug . '-' . $row['id'];
    $update = "UPDATE creations SET slug='" . mysqli_real_escape_string($con, $slug) . "' WHERE id=" . intval($row['id']);
    mysqli_query($con, $update);
    echo "ID " . $row['id'] . " -> Slug : $slug\n";
}
?>
