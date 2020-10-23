<!DOCTYPE html>
<?php
    if (isset($_COOKIE['login_string'])){
        echo "<script type='text/javascript'>alert('You already logged in, please loggout first');</script>";
        echo "<script type='text/javascript'>document.location.href='index.php';</script>"; 
    }
?>  
<html>
<head>
    <title>Register Page</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <div class="form-auth">
      <h2>Willy Wangky Choco Factory</h2>
      <br>
      <div class="errorNotif" id="errorNotifRegister"></div>
      <form id="formRegister">
          <input type="text" id="username" name="username" placeholder="Username">
          <input type="text" id="email" name="email" placeholder="Email">
          <input type="password" id="password" name="password" placeholder="Password">
          <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm password">
          <br><br>
          <button type="submit">Register</button>
          <p class="message">Already have account? <a href="login.php">Login</a></p>
      </form>
    </div>

<script src="scripts/scriptRegister.js"> </script>

</body>
</html>


         