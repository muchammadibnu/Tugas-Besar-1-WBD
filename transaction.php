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

    if (!$isAlreadyLoggedIn){
        echo "<script type='text/javascript'>alert('You have to login first');</script>";
        echo "<script type='text/javascript'>document.location.href='login.php';</script>"; 
    }
?>
<html>
<head>
    <title>Transaction Page</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <h1>Transaction History</h1>
    <div class='container'>
        <?php 
            require("connection.php");
            $login_string = md5($_COOKIE['login_string']);
        
            $sql = "SELECT username FROM cookie_data WHERE login_string = '$login_string'";
            $result = $conn->query($sql);
            $isAdaTransaction = FALSE;
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $username = $row['username'];
            
                $sql = "SELECT chocolate_name, amount, total_price, `date`, `time`, `address` 
                        FROM `transaction` WHERE username = '$username' ORDER BY `date` DESC";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $isAdaTransaction = TRUE;
                    echo "<table id='transactionTable'>";
                    echo '
                        <tr>
                            <th>Chocolate Name</th>
                            <th>Amount</th> 
                            <th>Total Price</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>address</th>
                        </tr>
                    ';
                    while($row = $result->fetch_assoc()) {
                        echo '
                            <tr>
                                <td><a href=chocolate_detail?chocolate_name='.$row['chocolate_name'].'>'.$row['chocolate_name'].'</a></td>
                                <td>'.$row['amount'].'</td> 
                                <td>'.$row['total_price'].'</td>
                                <td>'.date('j F Y',strtotime($row['date'])).'</td>
                                <td>'.$row['time'].'</td>
                                <td>'.$row['address'].'</td>
                            </tr>
                        ';
                    }
                    echo '</table>';
                }
            }

            if (!$isAdaTransaction){
                echo '<p>There are no transaction yet</p>';
            }
            $conn->close();
        ?>
    <div>

</body>
</html>