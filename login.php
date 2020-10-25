<!DOCTYPE html>
<?php
    $isAlreadyLoggedIn = FALSE;
    if (isset($_COOKIE['login_string'])){
        require("connection.php");
        $login_string = md5($_COOKIE['login_string']);

        $sql = "SELECT username FROM cookie_data WHERE login_string = '$login_string'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            $isAlreadyLoggedIn = TRUE;
        }
        $conn->close();
    }
    if ($isAlreadyLoggedIn){
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
          <input type="text" id="email" name="email" placeholder="Email">
          <input type="password" id="password" name="password" placeholder="Password">
          <br><br>
          <button type="submit">login</button>
          <p class="message">Not registered? <a href="register.php">Create an account</a></p>
      </form>
    </div>

<script src="scripts/scriptLogin.js"> </script>
</body>
</html>
         