<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once('connection.php');
     
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $role = 'user';

        $sql = "INSERT INTO user (username, email, `password`, `role`) VALUES('$username','$email','$password','$role')";
        if ($conn->query($sql) === TRUE) {
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
                echo "failed to set cookie login_string";
            }

        } else {
            $conn->close();
            echo "Error updating record: " . $conn->error;
        }
    }
?>