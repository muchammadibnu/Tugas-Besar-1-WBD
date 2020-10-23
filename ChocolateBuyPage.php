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
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chocolaye Buy Page</title>
    <link rel='stylesheet' type='text/css' media='screen' href='css/ChocolateBuyPage.css'>
</head>
<body>
    <header>
        <p>haaaaaa</p>
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
        <h2>Buy Chocolate</h2>
        <div class="chocolateDetail">
            <img src="<?php echo $row["photo"]; ?>" alt="<?php echo $row["name"]; ?>">
            <div class="detail">
            <h2><?php echo $row["name"]; ?></h2>
                <h3>Amount sold: <?php echo $row["sold"]; ?></h3>
                <h3>Price: Rp <?php 
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
                <h3>Amount remaining: <?php echo $row["amount"]; ?></h3>
                <h3>Description</h3>
                <p><?php echo $row["description"]; ?></p>
                <div class="amount">
                    <div class="amountToBuy">
                        <h3>Amount to buy:</h3>
                        <div class="countAmount">
                            <a onclick="doDecreaseAmountStock(<?php echo $row['price']; ?>)"><b>-</b></a>
                            <p>1</p>
                            <a onclick="doAddAmountStock(<?php echo $row['amount']; ?>, <?php echo $row['price']; ?>)"><b>+</b></a>
                        </div>
                    </div>
                    <div class="totalPrice">
                        <h3>Total price:</h3>
                        <h2>Rp <?php echo $str;?>,00</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="Address">
        <form id="formBuy">
            <label for="address">Address:</label><br>
            <textarea name="address" id="addr" placeholder="Insert your address"></textarea><br><br>   
            <div class="submit">
                <input type="submit" value="Buy">
                <a href="ChocolatePage.php?chocoID=<?php echo $_GET["chocoID"];?>">Cancel</a>
            </div>
        </form>
    </div>
    <script src="scripts/scriptBuy.js"></script>
</body>
</html>