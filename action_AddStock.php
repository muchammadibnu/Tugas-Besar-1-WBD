<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once("connection.php");

        $amount = $_POST['amount'];
        $id = $_POST['id'];
        $sql = "UPDATE product SET amount=(SELECT amount from product where id=$id)+$amount WHERE id=$id";
        if ($conn->query($sql) == TRUE){
            $conn->close();
            echo "success";
            
        }
        else{
            $conn->close();
            echo "failed";
        }  
   }
?>