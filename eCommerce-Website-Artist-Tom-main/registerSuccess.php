<?php

    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" class="">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e89f7f9e54.js" crossorigin="anonymous"></script>
    <title>Register Success</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/header-logo.png" />

</head>
<body>
  <div class="index-login-signup" style="max-width: 50vw; margin:auto;">
      <img class="login-logo" src="assets/logo-white.jpg" style="max-width: 80px;"/>
      <h2>Register Success</h2>
      <p style="text-align: center;">You have registered your account successfully. Click the sign in button below to sign into your account!</p>
      <hr>
      <a href="login.php"><button class="register-button" type="submit" name="submit">Sign In</button></a>
  </div>





</body>


<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topNavigation") {
    x.className += " responsive";
  } else {
    x.className = "topNavigation";
  }
}
</script>