<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once("connection.php");

        $amount = $_POST['amount'];
        $chocolateName = $_POST['name'];
        $totalPrice = $_POST['price'];
        $address = $_POST["address"];
        date_default_timezone_set("Asia/Jakarta");
        $date = date("Y-m-d");
        $time = date("H:i:s");
        $login_string = md5($_COOKIE['login_string']);
        $sql = "SELECT amount FROM product WHERE name='$chocolateName'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            if($row["amount"] >=$amount){
                $sql ="SELECT username FROM cookie_data WHERE login_string='$login_string'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0){
                    $row = $result->fetch_assoc();
                    $username = $row["username"];
                    $sql = "INSERT INTO transaction(chocolate_name,amount,total_price,date,time,address,username) VALUES('$chocolateName', $amount, $totalPrice, '$date', '$time', '$address', '$username')";
                    if ($conn->query($sql) == TRUE){
                        $sql = "UPDATE product SET amount=(SELECT amount from product where name='$chocolateName')-$amount, sold=(SELECT sold from product where name='$chocolateName')+$amount WHERE name='$chocolateName'";
                        if ($conn->query($sql) == TRUE){
                            $conn->close();
                            echo "success";
                        }
                        else{
                            echo $conn->error;
                            $conn->close();
                        } 
                    }
                    else{
                        echo $conn->error;
                        $conn->close();
                    }
                }
                else{
                    echo $conn->error;
                    $conn->close();
                }
            }
            else{
                echo "failed";
                $conn->close();
            }
        }
        else{
            echo $conn->error;
            $conn->close();
        }
   }
?>