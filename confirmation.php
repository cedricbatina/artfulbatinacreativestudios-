<?php
include('./database_connexion.php');
$date = new DateTime();

// Définir le fuseau horaire
$date->setTimezone(new DateTimeZone('Europe/Paris'));

// Définir le format de date et d'heure
$formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::SHORT);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Vérifie si la page a été appelée via une requête POST
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];
  $mail = new PHPMailer(true);
  try {
    // Configuration du serveur SMTP
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = 'smtp.mail.yahoo.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->Username   = 'id_cdo_bat@yahoo.com';
    $mail->Password   = 'dwzozjxescsowfev';
    // Configuration de l'email
    $mail->setFrom($_POST['email'], $_POST['name']);
    $mail->addAddress('id_cdo_bat@yahoo.com
', 'Cédric Batina');
    $mail->Subject = 'Message du site web Artful Batina Creative Studios';
    $mail->Body = $_POST['message'];
    // Envoi de l'email
    $mail->send();
    echo 'Message envoyé avec succès';
  } catch (Exception $e) {
    echo "Erreur lors de l'envoi du message: {$mail->ErrorInfo}";
    echo $_POST['name'];
    echo $_POST['email'];
    echo $_POST['message'];
  }
  //$mail->smtpClose();
  //print_r($mail);
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Include the Font Awesome CSS file -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="shortcut icon" href="./images/official_favicon48X48.ico" type="image/x-icon">

  <link href="./stylefile.css" rel="stylesheet">


  <title>@rtful Batina Creative Studios - Confirmation d'envoi de message</title>
</head>

<body>
  <?php require_once "header.php"; ?>
  <?php require_once "banner.php"; ?>


  <div class="container-fluid">

    <?php if (($mail->send()) && (empty($mail->ErrorInfo))) : ?>
      <div class="container-fluid">
        <h3 class="text-center services_title">CONFIRMATION D'ENVOI</h3>
        <p>Cher <?= $_POST['name']; ?>,
          Nous tenons à vous remercier pour votre visite sur notre site et pour avoir pris le temps de nous contacter. Nous apprécions votre intérêt pour notre entreprise et nous sommes impatients de répondre à toutes vos questions et de vous fournir les informations que vous recherchez.
          Nous avons bien reçu votre message et nous y répondrons dans les meilleurs délais. En attendant, n'hésitez pas à naviguer sur notre site pour en apprendre davantage sur nos services et nos réalisations.</p>
      </div>
      <div class="card-footer m-auto"><a href="creations.php" class="m-auto"><button class="btn btn-lg m-auto ">RETOUR</button></a></div>
  </div>
<?php else : ?>
  <h3 class="text-center services_title">ERREUR D'ENVOI</h3>
  <p>Cher utilisateur,

    Nous sommes désolés, mais il y a eu une erreur lors de l'envoi de votre message. Veuillez réessayer ultérieurement ou nous contacter directement à l'adresse e-mail suivante : [adresse e-mail de contact de l'entreprise].

    Nous tenons à vous remercier pour votre intérêt pour notre entreprise et nous sommes impatients de répondre à toutes vos questions et de vous fournir les informations que vous recherchez.

    Encore une fois, merci d'avoir choisi @rtful Batina Creative Studios. Nous sommes heureux de vous compter parmi nos visiteurs et clients potentiels.

    Cordialement,
    L'équipe @rtful Batina Creative Studios</p>
  </div>
  <div class="card-footer m-auto"><a href="creations.php" class="m-auto"><button class="btn btn-lg m-auto ">NAVIGUER VERS LES CRÉATIONS</button></a></div>
  </div>

<?php endif; ?>
</div>

<?php require "footer.php"; ?>

</body>

</html>