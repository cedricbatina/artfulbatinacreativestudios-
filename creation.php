<?php
//include('./functions.php');
include('./database_connexion.php');
$date = new DateTime();

// Définir le fuseau horaire
$date->setTimezone(new DateTimeZone('Europe/Paris'));

// Définir le format de date et d'heure
$formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::SHORT)
?>
<?php if (!empty($_GET['id'])) : ?>
 <?php
 $id = (int)$_GET['id'];
 $query = "SELECT * FROM creations WHERE id ='$id' LIMIT 1";
 $result = mysqli_query($con, $query);
 ?> <?php if (mysqli_num_rows($result) > 0) : ?>
  <?php $row = mysqli_fetch_assoc($result);
  ?>

  <!DOCTYPE html>
  <html lang="fr">

  <head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link href="./stylefile.css" rel="stylesheet">
   <link rel="shortcut icon" href="./images/official_favicon48X48.ico" type="image/x-icon">


   <title>@rtful Batina Creative Studios - Création</title>
  </head>

  <body>
   <?php require_once "./header.php"; ?>
   <?php require_once("./banner.php"); ?>
   <div class="container-fluid row m-auto">
    <p>Nous sommes ravis de présenter notre dernière création, une publication unique qui repousse les limites de la créativité et de l'innovation. Notre équipe talentueuse et dévouée a travaillé avec passion pour créer cette œuvre d'art inoubliable, en utilisant les dernières technologies de pointe, des images captivantes, des graphiques fascinants et des animations impressionnantes.

     La création <span class="titre"><?php echo $row['title']; ?></span> reflète notre vision de l'avenir de la <strong>créativité </strong> et de l'innovation, et nous sommes fiers de la partager avec vous. Nous espérons qu'elle vous inspirera et suscitera votre intérêt pour nos <strong>services</strong> de <strong>design</strong>, <strong>développement web</strong>, de <strong>graphisme</strong> et de <strong>création</strong> de <strong>contenu</strong>.
     Nous croyons que cette <strong>création</strong> unique est une représentation remarquable de nos compétences et de notre savoir-faire en matière de création de contenu, et nous sommes impatients de la partager avec le monde entier. Nous sommes convaincus que vous serez émerveillés par notre travail et nous sommes ravis de vous offrir cette expérience unique et inoubliable.</p>
   </div>
   <div class="container-fluid row">


    <div class="card">
     <img src="<?= $row['image'] ?>" class=" img-thumbnail showed_creation card-img" alt="creation">
     <div class=" card-body">
      <h5 class="card-title"><?php echo nl2br(htmlspecialchars($row['title'])) ?></h5>
      <p class="card-text">
      <p class="creation_date"><?= $formatter->format(new DateTime($row['date'])) ?></p>
      <p class="card-text"><?php echo nl2br(htmlspecialchars($row['content'])) ?></p>
     </div>
     <div class="card-footer m-auto"><a href="creations.php" class="m-auto"><button class="btn btn-lg m-auto ">RETOUR</button></a></div>
    </div>
   <?php endif; ?>
  <?php endif; ?>
   </div>
   <?php require_once "./contact_form.php"; ?>

   <?php require_once "./footer.php"; ?>
  </body>

  </html>