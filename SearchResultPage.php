<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' media='screen' href='css/SearchResultPage.css'>
    <title>Search Result Page</title>
</head>
<body>
        <!--- Navigation Bar --->
        <nav>
        <a href="#">Home</a>
        <a href="#">History</a>
        <div class="search">
            <form method="POST">
                <input type="search" placeholder="Search" required>
                <input type="submit" name="submit">
            </form>
        </div>
        <a href="#">Log out</a>

    </nav>
    
</body>
</html>

<?php

require 'connection.php';
$index = 1;
if (isset($_POST["submit"])) {
    $str = $_POST["submit"];
    $query_search = "SELECT * FROM 'product' WHERE name = '$str'";
    $query_running = $con->query($query_search);

    if($row = $query_running->fetch())
    {
        ?>
        <br><br><br>
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
<?php
    }
            else {
                echo "Chocolate tidak ditemukan";
            }
}
?>