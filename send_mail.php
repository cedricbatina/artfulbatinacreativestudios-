<?php
require "functions.php";

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;



require 'vendor/autoload.php'; // inclure le fichier d'autoload de PHPMailer

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Vérifie si la page a été appelée via une requête POST
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  $mail = new PHPMailer(true); // initialiser l'objet PHPMailer

  // Configuration SMTP
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'cedricbatina2021@gmail.com';
  $mail->Password = 'Elijahbatina@2008';
  $mail->SMTPSecure = 'tls';
  $mail->Port = 587;
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Accepter SSL

  // Configuration de l'e-mail
  $mail->setFrom($_POST['email'], $_POST['name']);
  $mail->addAddress('cedricbatina2021@gmail.com', 'Cédric Batina');
  $mail->Subject = 'New message from ' . $name;
  $mail->Body = $message;

  // Envoyer l'e-mail
  if ($mail->send()) {
    echo 'Message sent successfully';
  } else {
    echo 'Error sending message: ' . $mail->ErrorInfo;
    echo '';
  }
  $mail->smtpClose();
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
  <link href="./stylefile.css" rel="stylesheet">
  <link rel="shortcut icon" href="./images/official_favicon48X48.ico" type="image/x-icon">


  <title>@rtful Batina Creative Studios - Confirmation d'envoi de mail</title>
</head>

<body>
  <?php require_once "header.php"; ?>
  <?php require_once "banner.php"; ?>


  <div class="container-fluid">

    <?php if (mail($to, $subject, $mail_body, $headers)) : ?>
      <div class="container-fluid">
        <h3>Erreur dans l'envoi du message</h3>
        <p>Cher utilisateur,
          Nous tenons à vous remercier pour votre visite sur notre site et pour avoir pris le temps de nous contacter. Nous apprécions votre intérêt pour notre entreprise et nous sommes impatients de répondre à toutes vos questions et de vous fournir les informations que vous recherchez.
          Nous avons bien reçu votre message et nous y répondrons dans les meilleurs délais. En attendant, n'hésitez pas à naviguer sur notre site pour en apprendre davantage sur nos services et nos réalisations.</p>
      </div>
    <?php else : ?>
      <h3>Erreur dans l'envoi du message</h3>
      <p>Cher utilisateur,

        Nous tenons à vous remercier pour votre visite sur notre site et pour avoir pris le temps de nous contacter. Nous apprécions votre intérêt pour notre entreprise et nous sommes impatients de répondre à toutes vos questions et de vous fournir les informations que vous recherchez.
        Nous avons bien reçu votre message et nous y répondrons dans les meilleurs délais. En attendant, n'hésitez pas à naviguer sur notre site pour en apprendre davantage sur nos services et nos réalisations.
        Encore une fois, merci d'avoir choisi @rtful Batina Creative Studios. Nous sommes heureux de vous compter parmi nos visiteurs et clients potentiels.
        Cordialement,
        L'équipe @rtful Batina Creative Studios</p>
  </div>
<?php endif; ?>
</div>

<?php require "footer.php"; ?>

</body>

</html>