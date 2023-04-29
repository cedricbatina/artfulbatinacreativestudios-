<?php
require "./functions.php"

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Include the Font Awesome CSS file -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="./stylefile.css" rel="stylesheet">
  <link rel="shortcut icon" href="./images/official_favicon48X48.ico" type="image/x-icon">


  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Artful Batina Creative Studios - Contact</title>
</head>

<body>
  <?php require 'header.php'; ?>

  <?php include_once("banner.php"); ?>
  <div class="container-fluid m-auto">
    <p text-center m-2> @rtful Batina Creative Studios fournit des solutions innovantes et personnalisées pour répondre aux besoins spécifiques de chaque client. Nous nous engageons à fournir des résultats de qualité supérieure dans un délai raisonnable, tout en veillant à ce que nos services restent abordables et accessibles.
      Faites confiance à @rtful Batina Creative Studios pour donner vie à vos idées créatives et atteindre vos objectifs commerciaux. Contactez-nous dès maintenant pour discuter de vos projets et obtenir un devis personnalisé.</p>
  </div>
  <div class="container-fluid m-auto"><?php include_once("./contact_form.php"); ?></div>
  <?php include_once("footer.php"); ?>

</body>

</html>