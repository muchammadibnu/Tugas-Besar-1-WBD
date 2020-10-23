<?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        require_once('connection.php');
     
        $username = $_GET['username'];

        $sql = "select count(*) as cnt from user where username = '$username'" ;
        $result = $conn->query($sql);
        $conn->close();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row["cnt"] == 0){
                echo 'valid';
            }
            else{
                echo 'invalid';
            }
            
        } else {
            echo "error";
        }
    }
?>