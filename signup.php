<?php
require "functions.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $username = addslashes($_POST['username']);
  $email = addslashes($_POST['email']);
  $password = addslashes($_POST['password']);
  $date = date('Y-m-d H:i:s');

  $query = "INSERT INTO users (username,email,password,date) VALUES ('$username','$email','$password','$date')";

  $result = mysqli_query($con, $query);

  header("Location: login.php");
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
  <title>@rtful Batina Creative Studios - Accueil</title>
</head>

<body>

  <?php require "header.php"; ?>
  <?php require "banner.php"; ?>

  <div class="container">
    <div class="card">
      <div class="card-header">
        <h3>Sign Up</h3>
      </div>
      <div class="card-body">
        <form action="" method="POST">
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
            <input type="text" name="username" class="form-control" placeholder="Username" required autocomplete="off" aria-label="Username" aria-describedby="basic-addon1">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-key"></i></span>
            <input type="email" name="email" class="form-control" placeholder="Email" required autocomplete="off" aria-label="email" aria-describedby="basic-addon1">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-lock"></i></span>
            <input type="password" name="password" class="form-control" placeholder="Password" required autocomplete="off" aria-label="password" aria-describedby="basic-addon1">
          </div>
          <div class="form-group">
            <button class="btn btn-lg signup">Signup</button>

          </div>
        </form>

      </div>
      <div class="card-footer">
        <p class="text-center"> Already have an account? - <a href="login.php"> Sign In</a></p>
      </div>
    </div>
  </div>

  <!-- <div class="card">
   <div class="card-header">
    <h3>Sign Up</h3>
   </div>
   <div class="card-body">
    <form action="">
     <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
      <input type="text" class="form-control" placeholder="Enter your username" required autocomplete="off" aria-label="name" aria-describedby="basic-addon1" name="name">
     </div>
     <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-lock"></i></span>
      <input type="email" class="form-control" placeholder="Email" required autocomplete="off" aria-label="email" aria-describedby="basic-addon1" name="email">
     </div>
     <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-key"></i></span>
      <input type="password" class="form-control" placeholder="Enter your password" required autocomplete="off" aria-label="password" aria-describedby="basic-addon1" name="password">
     </div>

     <div class="form-group">
      <input type="submit" name="register" id="register" value="Sign Up" class="btn signup">
     </div>
    </form>

   </div>
   <div class="card-footer">
    <p class="text-center"> Already have an account? - <a href="login.php"> Sign In</a></p>
   </div>
  </div>
 </div>-->

  <?php require "footer.php"; ?>

  <hr>


</body>

</html>