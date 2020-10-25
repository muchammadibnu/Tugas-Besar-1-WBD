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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chocolate Page</title>
    <link rel='stylesheet' type='text/css' media='screen' href='css/ChocolatePage.css'>
</head>
<body>
    <header>
        <nav>
            <a href="DashboardPage.php">Home</a>
            <a href="ChocolateAddNewPage.php">Add New Chocolate</a>
            <div class="search">
                <form action="">
                    <input type="search" placeholder="Search" required>
                </form>
            </div>
            <a href="action_logout.php">Log out</a>
        </nav>
    </header>
    <div class="chocolate">
        <?php
            $chocoID = $_GET["chocoID"];
            $sql = "SELECT name, price, sold, amount, description, photo FROM product where id=$chocoID";
            $result = $conn->query($sql);
            if ($result->num_rows >0){
                $row = $result->fetch_assoc();
            }
            else{
                echo "<script type='text/javascript'>alert('NOT FOUND');</script>";
                echo "<script type='text/javascript'>document.location.href='index.php';</script>"; 
            }
        ?>
        <h2><?php echo $row["name"]; ?></h2>
        <div class="chocolateDetail">
            <img src="<?php echo $row["photo"]; ?>" alt="<?php echo $row["name"]; ?>">
            <div class="detail">
                <h3><span>Amount Sold:</span> <?php echo $row["sold"]; ?></h3>
                <h3><span>Price:</span> Rp <?php 
                    $price = $row["price"];
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
                    echo $str ?>,00</h3>
                <h3><span>Amount:</span> <?php echo $row["amount"]; ?></h3>
                <h3><span>Description<span></h3>
                <p><?php echo $row["description"]; ?></p>
            </div>
        </div>
    </div>
    <div class="BuyNow">
        <a href="ChocolateBuyPage.php?chocoID=<?php echo $_GET["chocoID"];?>">Buy Now</a>
    </div>
</body>
</html>