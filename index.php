<?php
//session_start();
//require "./database_connexion.php";

require "functions.php";
//check_login();
?>

<!DOCTYPE html>
<html>

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


  <div class="container-fluid m-auto">
    <p class=" p-1">L'entreprise <strong>@rtful Batina Creative Studios</strong> propose aux entreprises des <strong>solutions web personnalisées</strong>. Elle est spécialisée dans la <strong>création</strong>, <strong>l'optimisation</strong> et la <strong>maintenance</strong> de <strong>sites internet</strong> vitrines et <strong>e-commerces</strong> ainsi que le <strong>developpement de vos applications web</strong>. <br>
      <strong>@rtful Batina Creative Studios</strong> vous accompagne également pas à pas dans</strong> la <strong>conception </strong> de l'<strong>identité visuelle</strong> de votre entreprise. Nous créons ensemble toute la <strong>communication visuelle</strong>, c'est-à-dire la <strong>création du logo</strong>, le <strong>design</strong> et l'<strong>emballage</strong> du <strong>produit</strong>, le <strong>web design</strong>, la <strong> publicité</strong> et le <strong>marketing numérique</strong>. <strong>@rtflul Batina Creative Studios</strong> offre une gamme complète de services pour aider les entreprises à réussir en ligne. Que vous vouliez <strong>améliorer</strong> votre <strong>référencement naturel</strong>, <strong>augmenter</strong> votre <strong>présence</strong> sur les <strong>réseaux sociaux</strong> ou,<strong> lancer</strong> une <strong>campagne publicitaire</strong> <strong>en ligne</strong>, <strong>@rtful Batina Creative Studios</strong> est là pour vous apporter la solution.
    </p>
    <p class=" p-1"> <strong>@rtful Batina Creative Studios</strong> travaille aussi avec une équipe expérimentée des passionnés en <strong>infographie</strong>, des professionnels du <strong>marketing numérique et visuel</strong>, du <strong>design graphique</strong>. @rtful Batina Creative Studios est dédiée à <strong>fournir des solutions de marketing numérique</strong> innovantes et efficaces pour aider nos clients à accroître sa visibilité pour atteindre de nouveaux potentiels clients et à <strong> atteindre</strong> leurs <strong>objectifs en ligne</strong>. <strong>@rtful Batina Creative Studios</strong> s'<strong>engage</strong> à fournir un <strong>service</strong> de <strong>qualité supérieure</strong> à chaque fois.</p>
    <p class="p-1"><strong>@rtful Batina Creative Studios</strong> est très fière de servir et de participer à la création et au développement d'entreprises, particulièrement au niveau local et régionnales, celles de <strong>Gradignan</strong> et de la région de <strong>Bordeaux</strong>. Nous sommes impatients de travailler avec vous pour faire croître votre entreprise en ligne. <strong>Contactez-nous</strong> dès aujourd'hui pour en savoir plus sur nos services de marketing numérique et pour obtenir un <strong>devis personnalisé</strong>.</p>
    <p class="p-1">Nous offrons une gamme complète de services d'<strong>édition</strong>, de <strong>marketing numérique</strong>, notamment le <strong>référencement local</strong>, le <strong>marketing</strong> des <strong>médias sociaux</strong>, le <strong>marketing</strong> par e-mail, la <strong>publicité</strong> en ligne, le marketing de contenu, la <strong>conception de sites web</strong>, des <strong>formations</strong> en <strong>graphisme</strong> et en <strong>programmation</strong>. Nous sommes également experts en analytics et en <strong> optimisation</strong> de conversions, ce qui signifie que nous pouvons vous aider à <strong>maximiser</strong> votre retour sur investissement en ligne.</p>
  </div>

  <br>


  <?php

  $query = "SELECT * FROM creations ORDER BY id DESC LIMIT 3";

  $result = mysqli_query($con, $query);
  ?>
  <?php if (mysqli_num_rows($result) > 0) : ?>
    <div class="container-fluid text-center m-auto">

      <h3 class="text-center services_title m-3">DERNIÈRES <strong>CRÉATIONS</strong></h3>


      <?php while ($row = mysqli_fetch_assoc($result)) : ?>

        <?php if (file_exists($row['image'])) : ?>
          <div class="row row-cols-1 row-cols-md-3 g-4 mt-3 mb-3">
            <?php foreach ($result as $row) : ?>

              <div class="card  ">
                <a href="creations.php">
                  <img src="<?= $row['image'] ?>" class=" card-img-top img-thumbnail " alt="creation">
                </a>
                <div class=" card-body">
                  <h5 class="card-title"><?php echo nl2br(htmlspecialchars($row['title'])) ?></h5>
                  <p class="card-text">
                  <p class="creation_date"><?= $formatter->format(new DateTime($row['date'])) ?></p>

                  <p class="card-text"><strong><?php echo nl2br(htmlspecialchars(substr($row['content'], 0, 200))) ?></strong></p>
                </div>
              </div>
            <?php endforeach; ?>
          </div>

        <?php endif; ?>
        <br>

      <?php endwhile; ?> <a href="creations.php" class="m-auto"><button class="btn m-3 ">VOIR TOUTES LES <strong>CRÉATIONS</strong></button></a>
    <?php endif; ?><br><br>
    <hr>
    </div>
    <h3 class="services_title text-center m-3">SERVICES</h3>
    <div class="row">
      <div class="col">
        <h4 class="text-center">Developpement web</h4>
        <p class="text-center p-4"><strong>@rtful Batina Creative Studios</strong> vous aide à <strong>créer un site web</strong> beau et fonctionnel qui reflète la personnalité de votre <strong>marque</strong> et répond aux <strong>besoins</strong> de votre entreprise. <strong>@rtful Batina Creative Studios</strong> s'appuie sur des outils et langages modernes pour <strong>créer des sites internet</strong> réactifs et conviviaux qui s'affichent parfaitement sur tous les appareils.
          Une fois la <strong>conception</strong> approuvée, nous passons à la phase de <strong>développement</strong> du <strong>site web</strong>.
        </p>
      </div>
      <div class="col">
        <h4 class="text-center">Graphisme</h4>
        <p class="text-center p-4">Chez <strong>@rtful Batina Creative Studios</strong>, notre objectif est de fournir à nos clients des <strong>designs</strong> visuellement attrayants qui captivent leur public et transmettent efficacement le message de leur marque. Que vous ayez besoin d'un nouveau <strong>logo</strong>, d'une <strong>mise en page</strong> pour votre <strong>site web</strong>, d'<strong>illustrations</strong> pour un livre, d'une <strong>animation</strong> <strong>2D</strong> ou <strong>3D</strong> pour une <strong>vidéo promotionnelle</strong>, ou même d'un <strong>design d'emballage</strong> pour votre nouveau produit, <strong>@rtful Batina Creative Studios</strong> a la solution.
        </p>
      </div>
      <div class="col">
        <h4 class="text-center">Formations</h4>
        <p class="text-center p-4">Nos formations en <strong>graphisme</strong> et en <strong>programmation</strong> couvrent une large gamme de sujets, allant de la <strong>conception</strong> de base à des <strong>compétences</strong> plus avancées telles que la <strong>création de logos</strong>, la <strong>création d'animations</strong>, pour les médias sociaux. Nous utilisons des logiciels de pointe tels que <strong>Photoshop</strong>, <strong>Illustrator</strong>, <strong>HTML</strong>, <strong>CSS</strong>, <strong>JavaScript</strong>, la <strong>création de sites</strong> dynamiques, <strong>WordPress</strong> et <strong>InDesign</strong> pour aider nos apprenants à maîtriser les <strong>compétences</strong> nécessaires pour exceller dans leur domaine.
        </p>
      </div>
      <div class="col">
        <h4 class="text-center">Rédaction de contenu</h4>
        <p class="text-center p-4">
          La rédaction de <strong>contenu web</strong> aide nos clients à <strong>créer</strong> un <strong>contenu</strong> de haute qualité pour leurs <strong>sites web</strong>, en se concentrant sur l'<strong>optimisation</strong> pour les moteurs de recherche <strong>SEO</strong>, ainsi que sur l'<strong>expérience utilisateur (UX)</strong> .
          En utilisant notre service de rédaction de <strong>contenu web</strong>, vous êtes assuré que votre <strong>site web</strong> soit bien positionné dans les résultats des <strong>moteurs de recherche</strong>, ce qui aidera à atteindre un public plus large.
        </p>
      </div>
    </div>

    </div>
    <br>
    <hr>
    <?php require "contact_form.php"; ?>


    </div>

    <?php require "footer.php"; ?>

</body>

</html>