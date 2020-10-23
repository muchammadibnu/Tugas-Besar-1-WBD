<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once("connection.php");

        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM user WHERE username='$username' AND `password`='$password'";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $login_string = uniqid(rand(), true);
            $hashed_login_string = md5( $login_string);

            $sql = "INSERT INTO cookie_data (login_string, username) VALUES('$hashed_login_string','$username')";
            if ($conn->query($sql) == TRUE){
                $conn->close();
                setcookie('login_string', $login_string, time()+60*60*24*365, '/');
                echo "success";
                
            }
            else{
                $conn->close();
                echo "failed";
            }
        } 
        else {
            $conn->close();
            echo "failed";
        }
   }
?>