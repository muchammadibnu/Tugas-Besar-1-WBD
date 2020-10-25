<!DOCTYPE html>
<?php
    if (!isset($_COOKIE['login_string'])){
        echo "<script type='text/javascript'>alert('You have to login first');</script>";
        echo "<script type='text/javascript'>document.location.href='login.php';</script>"; 
    }
    require_once("connection.php");
    $login_string = md5($_COOKIE['login_string']);
    $sql = "SELECT * FROM cookie_data WHERE login_string = '$login_string'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0){
        echo "<script type='text/javascript'>alert('You have to login first');</script>";
        echo "<script type='text/javascript'>document.location.href='login.php';</script>"; 
    }
    if (!isset($_COOKIE['login_string'])){
        echo "<script type='text/javascript'>alert('You have to login first');</script>";
        echo "<script type='text/javascript'>document.location.href='login.php';</script>"; 
    }
    require_once("connection.php");
    $login_string = md5($_COOKIE['login_string']);
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

<!-- include_once('connection.php');
$query_user = "SELECT * FROM user";
$result_user = mysql_query($query_user); -->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' media='screen' href='css/DashboardPage.css'>
    <title>Dashboard</title>
</head>
<body>

    <!--- Navigation Bar --->
    <nav>
        <a href="#">Home</a>
        <a href="#">History</a>
        <div class="search">
            <form method="post">
                <input type="search" placeholder="Search" required>
            </form>
        </div>
        <a href="action_logout.php">Log out</a>
    </nav>
    
    <div class="hello">
        <p>Hello, admin</p>
    </div>

    <div class="view-all">
        <a href="">View all chocolate</a>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    
    <div class="container">
        <?php
            require 'connection.php';

            $query_choco = "SELECT * FROM product";
            $query_running = $conn->query($query_choco);
            if ($query_running->num_rows != 0){
                while($row = mysqli_fetch_array($query_running))
                {
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <img src="<?php echo $row['photo']; ?>" class="card-img" alt="Image">
                            <h2 class="card-title"><?php echo $row['name']; ?></h2>
                            <p class="card-amount-sold">Amount sold: <?php echo $row['amount']; ?></p>
                            <p class="card-price">Price : <?php echo $row['price']; ?></p>
                        </div>
                    </div>
                    <?php
                }
            }
            
            
            else {
                echo "Chocolate not found";
            }
        ?>
        <!--- Card Chocolate --->
        <!-- <div class="card">
            <div class="card-body">
                <img src="" class="card-img" alt="Chocolate">
                <h2 class="card-title">Dummy </h2>
                <p class="card-amount-sold">Amount sold: </p>
                <p class="card-price">Price : </p>
            </div>
        </div>
    
        <div class="card">
            <div class="card-body">
                <img src="" class="card-img" alt="Chocolate">
                <h2 class="card-title">Dummy </h2>
                <p class="card-amount-sold">Amount sold: </p>
                <p class="card-price">Price : </p>
            </div>
        </div>
    
        <div class="card">
            <div class="card-body">
                <img src="" class="card-img" alt="Chocolate">
                <h2 class="card-title">Dummy </h2>
                <p class="card-amount-sold">Amount sold: </p>
                <p class="card-price">Price : </p>
            </div>
        </div> -->
    </div>
</body>
</html>

