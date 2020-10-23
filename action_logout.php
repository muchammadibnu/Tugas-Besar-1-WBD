<?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        require_once('connection.php');
     
        $login_string = md5($_COOKIE['login_string']); 

        $sql = "DELETE FROM cookie_data WHERE login_string = '$login_string'";
        if ($conn->query($sql) === TRUE) {
            $conn->close();
            setcookie('login_string', '', 1, '/');   // unset cookie
            header("Location: login.php");
        } else {
            $conn->close();
            echo "Error updating record: " . $conn->error;
        }
    }
?>