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
    <title>Register</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/header-logo.png" />

</head>
<body>
    <form action="includes/signup.inc.php" method="post" style="max-width: 50vw; margin:auto;">
        <div class="index-login-signup">
            <img class="login-logo" src="assets/logo-white.jpg" style="max-width: 80px;"/>
            <h2>Register</h2>
            <hr>
            <label for="username"><b>Username</b></label>
            <input type="text" name="username" placeholder="Username">
            <label for="pwd"><b>Password</b></label>
            <input type="password" name="pwd" placeholder="Password">
            <label for="pwdrepeat"><b>Repeat Password</b></label>
            <input type="password" name="pwdrepeat" placeholder="Repeat Password">
            <label for="email"><b>Email</b></label>
            <input type="text" name="email" placeholder="Email">
            <p style="color:red" class="text-center"><?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>
            <button class="register-button" type="submit" name="submit">Sign Up</button>
        </div>
    </form>





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