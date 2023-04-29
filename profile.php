<?php
session_start();
require "functions.php";

//check_login();

if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == 'post_delete') {
  //delete your post
  $id = $_GET['id'] ?? 0;
  $user_id = $_SESSION['info']['id'];

  // $query = "select * from creations where id = '$id' && user_id = '$user_id' limit 1";
  $query = "SELECT * FROM creations WHERE id = '$id' && user_id = '$suser_id' LIMIT 1";
  $result = mysqli_query($con, $query);
  if (mysqli_num_rows($result) > 0) {

    $row = mysqli_fetch_assoc($result);
    if (file_exists($row['image'])) {
      unlink($row['image']);
    }
  }

  $query = "delete from creations where id = '$id' && user_id = '$user_id' limit 1";
  $result = mysqli_query($con, $query);

  header("Location: profile.php");
  die;
} elseif ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == "post_edit") {
  //post edit
  $id = $_GET['id'] ?? 0;
  $user_id = $_SESSION['info']['id'];

  $image_added = false;
  if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0 && $_FILES['image']['type'] == "image/jpeg" || $_FILES['image']['type'] == "image/jpg" || $_FILES['image']['type'] == "image/png" || $_FILES['image']['type'] == "image/pdf") {
    //file was uploaded
    $folder = "uploads/";
    if (!file_exists($folder)) {
      mkdir($folder, 0777, true);
    }

    $image = $folder . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], $image);

    $query = "select * from creations where id = '$id' && user_id = '$user_id' limit 1";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {

      $row = mysqli_fetch_assoc($result);
      if (file_exists($row['image'])) {
        unlink($row['image']);
      }
    }

    $image_added = true;
  }

  $title = addslashes($_POST['title']);
  $content = addslashes($_POST['content']);

  if ($image_added == true) {
    $query = "update creations set title ='$title', content = '$content',image = '$image' where id = '$id' && user_id = '$user_id' limit 1";
  } else {
    $query = "update creations set title = '$title', content = '$content' where id = '$id' && user_id = '$user_id' limit 1";
  }

  $result = mysqli_query($con, $query);

  header("Location: profile.php");
  die;
} elseif ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == 'delete') {
  //delete your profile
  $id = $_SESSION['info']['id'];
  $query = "delete from users where id = '$id' limit 1";
  $result = mysqli_query($con, $query);

  if (file_exists($_SESSION['info']['image'])) {
    unlink($_SESSION['info']['image']);
  }

  $query = "delete from creations where user_id = '$id'";
  $result = mysqli_query($con, $query);

  header("Location: logout.php");
  die;
} elseif ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['username'])) {
  //profile edit
  $image_added = false;
  if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0 && $_FILES['image']['type'] == "image/jpeg" || $_FILES['image']['type'] == "image/jpg" || $_FILES['image']['type'] == "image/png" || $_FILES['image']['type'] == "image/pdf") {
    //file was uploaded
    $folder = "uploads/";
    if (!file_exists($folder)) {
      mkdir($folder, 0777, true);
    }

    $image = $folder . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], $image);

    if (file_exists($_SESSION['info']['image'])) {
      unlink($_SESSION['info']['image']);
    }

    $image_added = true;
  }

  $username = addslashes($_POST['username']);
  $email = addslashes($_POST['email']);
  $password = addslashes($_POST['password']);
  $id = $_SESSION['info']['id'];

  if ($image_added == true) {
    $query = "update users set username = '$username',email = '$email',password = '$password',image = '$image' where id = '$id' limit 1";
  } else {
    $query = "update users set username = '$username',email = '$email',password = '$password' where id = '$id' limit 1";
  }

  $result = mysqli_query($con, $query);

  $query = "select * from users where id = '$id' limit 1";
  $result = mysqli_query($con, $query);

  if (mysqli_num_rows($result) > 0) {

    $_SESSION['info'] = mysqli_fetch_assoc($result);
  }

  header("Location: profile.php");
  die;
} elseif ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['title']) && !empty($_POST['content'])) {
  //adding post
  $image = "";
  if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0 && $_FILES['image']['type'] == "image/jpeg" || $_FILES['image']['type'] == "image/jpg" || $_FILES['image']['type'] == "image/png" || $_FILES['image']['type'] == "image/pdf") {
    //file was uploaded
    $folder = "uploads/";
    if (!file_exists($folder)) {
      mkdir($folder, 0777, true);
    }

    $image = $folder . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], $image);
  }



  $title = addslashes($_POST['title']);
  $content = addslashes($_POST['content']);
  $user_id = $_SESSION['info']['id'];
  $date = date('Y-m-d H:i:s');

  $query = "insert into creations (title,content,image,date,user_id) values ('$title','$content','$image','$date','$user_id')";

  $result = mysqli_query($con, $query);

  header("Location: profile.php");
  die;
}


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

  <title>@rtful Batina Creative Studios - Profil</title>
</head>

<body>

  <?php require "header.php"; ?>
  <?php require "banner.php"; ?>

  <div class="container-fluid">

    <?php if (!empty($_GET['action']) && $_GET['action'] == 'post_delete' && !empty($_GET['id'])) : ?>

      <?php
      $id = (int)$_GET['id'];
      $query = "select * from creations where id = '$id' limit 1";
      $result = mysqli_query($con, $query);
      ?>

      <?php if (mysqli_num_rows($result) > 0) : ?>
        <?php $row = mysqli_fetch_assoc($result); ?>

        <h3>Are you sure you want to delete this post?!</h3>
        <form method=" POST" enctype="multipart/form-data" style="margin: auto;padding:10px;">

          <img src="<?= $row['image'] ?>" style="width:100%;height:200px;object-fit: cover;"><br>
          <div><?= $row['content'] ?></div><br>
          <input type="hidden" name="action" value="post_delete">

          <button>Delete</button>
          <a href="profile.php">
            <button type="button">Cancel</button>
          </a>
        </form>
      <?php endif; ?>
    <?php elseif (!empty($_GET['action']) && $_GET['action'] == 'post_edit' && !empty($_GET['id'])) : ?>

      <?php
      $id = (int)$_GET['id'];
      $query = "select * from creations where id = '$id' limit 1";
      $result = mysqli_query($con, $query);
      ?>

      <?php if (mysqli_num_rows($result) > 0) : ?>
        <?php $row = mysqli_fetch_assoc($result); ?>
        <h5>Edit a post</h5>
        <form method="post" enctype="multipart/form-data">
          <div class="m-auto text-center"> <img src="<?= $row['image'] ?>">
          </div>
          <div class="card input-group m-2 form-control"> Image : <input class="m-2" type="file" name="image"> </div> <br>
          <div class="card form-control">
            <div class="card-header">Titre : <input class="title_input m-auto" type="text" name="title" value="<?= $row['title'] ?>"></div>
          </div>
          <div class=" card card-body">Contenu : <textarea class="edit_content" name="content"><?= $row['content'] ?></textarea>
            <input type="hidden" name="action" value="post_edit">
          </div>
          <br>

          <div class="card-footer"><button class="btn btn-lg">Save</button>
            <a href="profile.php">
              <button type="button" class="btn btn-lg">Cancel</button>
            </a>


          </div>
        </form>
      <?php endif; ?>

    <?php elseif (!empty($_GET['action']) && $_GET['action'] == 'edit') : ?>

      <h2 style="text-align: center;">Edit profile</h2>

      <form method="post" enctype="multipart/form-data" ">
    <img src=" <?php echo $_SESSION['info']['image'] ?>">
        image: <input type="file" name="image"><br>
        <input value="<?php echo $_SESSION['info']['username'] ?>" type="text" name="username" placeholder="Username" required><br>
        <input value="<?php echo $_SESSION['info']['email'] ?>" type="email" name="email" placeholder="Email" required><br>
        <input value="<?php echo $_SESSION['info']['password'] ?>" type="password" name="password" placeholder="Password" required><br>

        <button>Save</button>
        <a href="profile.php">
          <button type="button">Cancel</button>
        </a>
      </form>

    <?php elseif (!empty($_GET['action']) && $_GET['action'] == 'delete') : ?>

      <h2 style="text-align: center;">Are you sure you want to delete your profile??</h2>

      <div style="margin: auto;max-width: 600px;text-align: center;">
        <form method="post" style="margin: auto;padding:10px;">

          <img src="<?php echo $_SESSION['info']['image'] ?>" style="width: 100px;height: 100px;object-fit: cover;margin: auto;display: block;">
          <div><?php echo $_SESSION['info']['username'] ?></div>
          <div><?php echo $_SESSION['info']['email'] ?></div>
          <input type="hidden" name="action" value="delete">
          <button>Delete</button>
          <a href="profile.php">
            <button type="button">Cancel</button>
          </a>
        </form>
      </div>

    <?php else : ?>

      <h2 style="text-align: center;">User Profile</h2>
      <br>
      <div ">
    <div>
     <td><img src=" <?php echo $_SESSION['info']['image'] ?>" style="border-radius:50%;margin:10px;width:100px;height:100px;object-fit: cover;">
        </td>
      </div>
      <div>
        <td><?php echo $_SESSION['info']['username'] ?></td>
      </div>

      <div>
        <td><?php echo $_SESSION['info']['email'] ?></td>
      </div>

      <a href="profile.php?action=edit">
        <button>Edit profile</button>
      </a>

      <a href="profile.php?action=delete">
        <button>Delete profile</button>
      </a>

  </div>
  <br>
  <hr>
  <h5 class="text-center">PUBLIER UNE <strong>CRÉATION</strong></h5>
  <form method="post" class="card" enctype="multipart/form-data">

    <div class="card-header"> image: <input type="file" name="image"><br></div>
    <div class="card-header form-control">Titre: <input type="text" name="title"></div><br>
    <div class="card-body ">Description: <textarea class="edit_content" name="content"></textarea></div><br>

    <button class="btn btn-lg">PUBLIER</button>
  </form>

  <hr>
  <creations>
    <?php
      $id = $_SESSION['info']['id'];
      $query = "select * from creations where user_id = '$id' order by id desc limit 10";

      $result = mysqli_query($con, $query);
    ?>

    <?php if (mysqli_num_rows($result) > 0) : ?>

      <?php while ($row = mysqli_fetch_assoc($result)) : ?>

        <?php
          $user_id = $row['user_id'];
          $query = "select username,image from users where id = '$user_id' limit 1";
          $result2 = mysqli_query($con, $query);

          $user_row = mysqli_fetch_assoc($result2);
        ?>
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-3 mb-3">
          <?php foreach ($result as $row) : ?>

            <div class="card ">
              <a href="creations.php">
                <img src="<?= $row['image'] ?>" class=" card-img-top img-thumbnail " alt="creation">
              </a>
              <div class=" card-body">
                <h5 class="card-title"><?php echo nl2br(htmlspecialchars($row['title'])) ?></h5>
                <p class="card-text">
                <p class="creation_date"><?= $formatter->format(new DateTime($row['date'])) ?></p>

                <p class="card-text"><?php echo nl2br(htmlspecialchars(substr($row['content'], 0, 200))) ?></p>
              </div>
              <div class="card-footer m-auto"> <a href="profile.php?action=post_edit&id=<?= $row['id'] ?>">
                  <button class="btn btn-lg col-md-6 m-1">Edit</button>
                </a>

                <a href="profile.php?action=post_delete&id=<?= $row['id'] ?>">
                  <button class="btn btn-lg col-md-6 m-1 ">Delete</button>
                </a>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

      <?php endwhile; ?>
    <?php endif; ?>
  </creations>
<?php endif; ?>

<?php require "contact_form.php"; ?>

</div>
<?php require "footer.php"; ?>

</body>

</html>