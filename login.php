<!DOCTYPE html>
<?php
    if (isset($_COOKIE['login_string'])){
        echo "<script type='text/javascript'>alert('You already logged in');</script>";
        echo "<script type='text/javascript'>document.location.href='index.php';</script>"; 
    }
?>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <div class="form-auth">
      <h2>Willy Wangky Choco Factory</h2>
      <br>
      <div class="errorNotif" id="errorNotifLogin"></div>
      <form id="formLogin">
          <input type="text" id="username" name="username" placeholder="Username">
          <input type="password" id="password" name="password" placeholder="Password">
          <br><br>
          <button type="submit">login</button>
          <p class="message">Not registered? <a href="register.php">Create an account</a></p>
      </form>
    </div>

<script src="scripts/scriptLogin.js"> </script>
</body>
</html>
         