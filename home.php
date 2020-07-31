<!DOCTYPE html>
<?php
    session_start();
    $access=$_SESSION['access'];
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Store</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300"/>
        <link rel="stylesheet" href="public/css/styles.css" />
    </head>
    <body>
        <h2>WELCOME</h2>
          <?php
            echo "<div class='menu'>
              <a class='active' href='home.php'>HOME</a>";
            if($access == "admin"){
              echo "<a href='users.php'>USERS</a>
              <a href='customers.php'>CUSTOMERS</a>
              <a href='products.php'>PRODUCTS</a>";
            }
            else if($access == "manager"){
              echo "<a href='items.php'>PRODUCTS</a>
              <a href='companies.php'>COMPANIES</a>";
            }
            echo "<a href='invoices.php'>INVOICES</a>
            <a href='signout.php'>SIGN OUT</a>
            </div>";
          ?>
    </body>
</html>
