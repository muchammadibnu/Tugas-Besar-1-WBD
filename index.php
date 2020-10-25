<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php echo "HELLOOOO"; ?>
    <?php 
        if (isset($_COOKIE['login_string'])){
            echo "already login<br>";
            echo "<a href='transaction.php'>transaction page</a><br>";
            echo "<a href='ChocolatePage.php?chocoID=1'>Buy page</a><br>";
            echo "<a href='ChocolateStockPage.php?chocoID=1'>Add Stock page</a><br>";
            echo "<a href='action_logout.php'>LOGOUT</a><br>";
            echo "<a href='DashboardPage.php'>Dashboard page</a>";
        }    
        else{
            echo "belum login<br>";
            echo "<a href='login.php'>LOGIN</a>";
        }
    ?>
    
</body>
</html>