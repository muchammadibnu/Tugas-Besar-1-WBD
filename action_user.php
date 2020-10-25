<?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        require_once('connection.php');
     
        $username = $_GET['username'];
        $email = $_GET['email'];

        $isValid = FALSE;

        $sql = "select count(*) as cnt from user where username = '$username'" ;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row["cnt"] == 0){
                $sql = "select count(*) as cnt from user where email = '$email'" ;
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    if ($row["cnt"] == 0){
                        $isValid = TRUE;
                    }
                }
            }
        } 
        $conn->close();

        if ($isValid){
            echo "valid";
        }
        else{
            echo "invalid";
        }

    }
?>