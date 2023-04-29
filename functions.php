<?php

require "./database_connexion.php";


// Définir la date et l'heure actuelles
$date = new DateTime('now', new DateTimeZone('Europe/Paris'));


// Définir le fuseau horaire
//$date->setTimezone(new DateTimeZone('Europe/Paris'));

// Définir le format de date et d'heure
$formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::SHORT);

// Afficher la date et l'heure formatées
// echo $formatter->format($date);

function check_login()
{
 if (empty($_SESSION['info'])) {

  header("Location: login.php");
  die;
 }
}
