<?php
session_start();
require "./functions.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

 $email = mysqli_real_escape_string($con, $_POST['email']);
 $password = mysqli_real_escape_string($con, $_POST['password']);

 $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";

 $result = mysqli_query($con, $query);

 if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);

  $_SESSION['info'] = $row;

  //$_SESSION['user_id'] = $row['id'];
  //$_SESSION['user_name'] = $row['name'];

  header("Location: profile.php");
  die();
 } else {
  $error = "Wrong email or password";
 }
}
?>


<!DOCTYPE html>
<html>

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
 <link href="./stylefile.css" rel="stylesheet">
 <title>@rtful Batina Creative Studios - Home</title>
</head>

<body>

 <?php require "header.php"; ?>
 <?php require "banner.php"; ?>




 <div class="container">
  <?php

  if (!empty($error)) {
   echo "<div>" . $error . "</div>";
  }

  ?>
  <div class="card">
   <div class="card-header">
    <h3>Sign In</h3>
   </div>
   <div class="card-body">
    <form action="" method="POST">
     <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
      <input type="email" name="email" placeholder="Email" class="form-control" required autocomplete="off" aria-label="email" aria-describedby="email-help"><br>

     </div>
     <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-key"></i></span>
      <input type="password" name="password" class="form-control" placeholder="Password" required autocomplete="off" aria-label="password" aria-describedby="basic-addon1">
     </div>

     <div class="form-group">
      <button class="btn btn-lg">CONNEXION</button>

     </div>
    </form>

   </div>
   <div class="card-footer">
    <p class="text-center">Don't have an account? <a href="signup.php"> Sign Up</a></p>
   </div>
  </div>
 </div>
 <?php require "footer.php"; ?>

</body>

</html>