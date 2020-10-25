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
    }

    if (!$isAlreadyLoggedIn){
        echo "<script type='text/javascript'>alert('You have to login first');</script>";
        echo "<script type='text/javascript'>document.location.href='login.php';</script>"; 
    }
    $sql = "SELECT * FROM cookie_data WHERE login_string = '$login_string'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0){
        echo "<script type='text/javascript'>alert('You have to login first');</script>";
        echo "<script type='text/javascript'>document.location.href='login.php';</script>"; 
    }
    else{
        $row = $result -> fetch_assoc();
        $username = $row["username"];
        $sql = "SELECT role FROM user WHERE username = '$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            $row = $result -> fetch_assoc();
            if($row["role"]!="user"){
                echo "<script type='text/javascript'>alert('User restricted');</script>";
                echo "<script type='text/javascript'>document.location.href='index.php';</script>"; 
            }
        }
        else{
            echo "<script type='text/javascript'>alert('Server goes wrong');</script>";
            echo "<script type='text/javascript'>document.location.reload();</script>"; 
        }
    }
?>
<html>
<head>
    <title>Transaction Page</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel='stylesheet' type='text/css' media='screen' href='css/ChocolatePage.css'>

</head>
<body>
    <header>
        <nav>
            <a href="DashboardPage.php">Home</a>
            <a href="transaction.php">History</a>
            <div class="search">
                <form action="">
                    <input type="search" placeholder="Search" required>
                </form>
            </div>
            <a href="action_logout.php">Log out</a>
        </nav>
    </header>
    
    <div class='container'>
        <h1>Transaction History</h1>
        <?php 
            require("connection.php");
            $login_string = md5($_COOKIE['login_string']);
        
            $sql = "SELECT username FROM cookie_data WHERE login_string = '$login_string'";
            $result = $conn->query($sql);
            $isAdaTransaction = FALSE;
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $username = $row['username'];
            
                // catat mapping chocolate name ke chocolate id
                $mapNameToId = array();
                $sql = "SELECT id,`name` FROM product";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $mapNameToId[$row['name']] = $row['id'];
                    }
                }

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
                        $price = $row["total_price"];
                        $str ="";
                        $count=0;
                        while($price>=1){
                            $str = ($price % 10).$str;
                            $price = floor($price / 10);
                            $count = $count + 1;
                            if($count % 3 ==0){
                                $str=".".$str;
                            }
                        }
                        echo '
                            <tr>
                                <td><a href=ChocolatePage.php?chocoID='.$mapNameToId[$row['chocolate_name']].'>'.$row['chocolate_name'].'</a></td>
                                <td>'.$row['amount'].'</td> 
                                <td>Rp '.$str.',00</td>
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