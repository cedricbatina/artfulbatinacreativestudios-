<?php
//session_start()
include("./functions.php"
)
//require "functions.php";
//check_login();
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
   <title>@rtful Batina Creative Studios - Accueil</title>
</head>


<body>

   <?php require_once "header.php"; ?>
   <?php require_once "banner.php"; ?>
   <div class="container-fluid">
      <p class="p-1">
         Nos services vont bien au-delà de la simple <strong>création de designs</strong>. Nous pouvons également vous aider à élaborer une stratégie de <strong>marketing visuel</strong> efficace pour votre entreprise, en créant des <strong>graphismes</strong> attrayants pour les <strong>réseaux sociaux</strong>, des <strong>brochures</strong>, des <strong>flyers</strong>, des <strong>cartes de visite</strong>, des <strong>affiches</strong>, des <strong>bannières</strong> et plus encore. Nous nous efforçons de fournir des <strong>designs</strong> de haute qualité à des prix compétitifs, afin que vous puissiez promouvoir votre entreprise sans dépasser votre budget.
         <strong>@rtful Batina Creative Studios</strong> collabore avec des passionnés de la <strong>création</strong> de <strong>designs</strong> innovants et <strong>créatifs</strong> qui aident nos clients à <strong>atteindre</strong> leurs <strong>objectifs</strong>. Si vous cherchez à <strong>créer</strong> une <strong>identité visuelle</strong> distinctive pour votre entreprise, <strong>contactez-nous</strong> dès aujourd'hui et laissez-nous vous aider à <strong>communiquer</strong> efficacement votre message à votre public cible. <strong>@rtful Batina Creative Studios</strong> est déterminée à vous fournir des <strong>designs</strong> exceptionnels qui vous aideront à vous démarquer dans votre marché.
         Nous évaluons vos objectifs commerciaux, votre public cible et de votre <strong> image de marque</strong>. Nous étudions également vos concurrents et les tendances actuelles du marché pour nous assurer que votre <strong>site web</strong> est <strong>conçu</strong> pour se démarquer de la concurrence. Ensuite, <strong>@rtful Batina Creative Studios</strong> travaille avec vous pour <strong>créer</strong> une maquette de votre <strong>site web</strong>. Nous prenons en compte tous les aspects de la <strong>conception</strong>, y compris la <strong>typographie</strong>, les <strong>couleurs</strong>, la <strong>mise en page</strong> et les <strong>images</strong> pour <strong>créer un site web</strong> qui non seulement reflète votre <strong>marque</strong>, mais qui est également facile à naviguer et agréable à l'œil.
      </p>
   </div>
   <div class="container-fluid">
      <button class="btn">CONTACTEZ-NOUS</button>
   </div>

   <div class="container-fluid text-center">

      <h3 class="text-center services_title mb-3">Les créations publiées</h3>
      <p class="text-center">Nous utilisons les dernières technologies et les meilleures pratiques pour <strong>créer un site web</strong> rapide, sécurisé et facile à utiliser. Nous testons également rigoureusement chaque fonctionnalité pour nous assurer que tout fonctionne correctement.</p>
      <?php

      $query = "select * from creations order by id desc";
      $query = "SELECT * FROM creations ORDER by id DESC";

      $result = mysqli_query($con, $query);

      ?>
      <?php if (mysqli_num_rows($result) > 0) : ?>


         <?php while ($row = mysqli_fetch_assoc($result)) : ?>

            <?php if (file_exists($row['image'])) : ?>
               <div class="row row-cols-1 row-cols-md-3 g-4 mb-3 mt-3">
                  <?php foreach ($result as $row) : ?>

                     <div class="card p-1">
                        <a href="creation.php?id=<?= $row['id'] ?>">
                           <img src="<?= $row['image'] ?>" class="card-img-top img-thumbnail card-img mb-2" alt="creation"></a>

                        <!-- <div class=" card-body">-->
                        <h5 class="card-title"><?php echo nl2br(htmlspecialchars($row['title'])) ?></h5>
                        <p class="creation_date"><?= $formatter->format(new DateTime($row['date'])) ?></p>



                        <!--</div>-->
                     </div>

                  <?php endforeach; ?>
               </div>

               <?php endif; ?><?php endwhile; ?>
            <?php endif; ?>
   </div>

   <br>
   <hr><br>
   <hr>

   <hr>
   </div>
   <?php require_once "contact_form.php"; ?>
   <?php require_once "footer.php"; ?>
</body>

</html>