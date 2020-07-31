<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Products Data</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300"/>
        <link rel="stylesheet" href="public/css/styles.css" />
    </head>
    <body>
        <h2>MANAGE THE PRODUCT DATABASE</h2>
        <div class="menu">
          <a href='home.php'>HOME</a>"
          <a href='products.php'>PRODUCTS</a>"
          <a class='active' href="productadd.php">ADD A NEW PRODUCT</a>
          <a href="signout.php">SIGN OUT</a>
        </div>
        <div class="container">
          <form method = "POST" action = "<?php $_PHP_SELF ?>">
              <label for="itemname">Name:</label>
              <input type="text" name="itemname" required><br>
              <label for="quantity">Initial Quantity:</label>
              <input type="text" name="quantity" required><br>
              <label for="cost">Cost:</label>
              <input type="text" name="cost" required><br>
              <label for="company">Company:</label>
              <input type="text" name="company" required><br><br>
              <button type="submit">ADD PRODUCT</button>
          </form>
        </div>
        <?php
        if(isset($_POST['itemname'])){
          $conn = mysqli_connect("localhost", "root", "", "management");
          if (!$conn)
          {
              die("Connection failed: " . mysqli_connect_error());
          }
          $sql = "INSERT INTO items (itemname, quantity, cost, companyname)
          values ('" . $_POST['itemname'] . "','" . $_POST['quantity'] . "','" . $_POST['cost'] . "','" . $_POST['company'] . "')";

          if (mysqli_query($conn, $sql)) {
              echo "New Product added successfully";
              header("Location:products.php");
          } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }

          mysqli_close($conn);
        }

        ?>
    </body>
</html>
