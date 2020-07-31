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
          <a href="productadd.php">ADD A NEW PRODUCT</a>
          <a href="signout.php">SIGN OUT</a>
        </div>
        <br>
        <?php
            $conn = mysqli_connect("localhost", "root", "", "management");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $id = $_GET['link2'];
            $sql = "SELECT * FROM items WHERE itemid = '$id' ";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result)>=1)
            {
              while($row = mysqli_fetch_array($result))
              {
                  $name = $row['itemname'];
                  $stock = $row['quantity'];
              }
        ?>
        <div class="container">
          <form action="productstockupdate.php" method="post">
              <input type="hidden" name="ID" value="<?=$id;?>">
              <input type="hidden" name="quantity" value="<?=$stock;?>">
              Product ID:<br />
              <?=$id?>
              <br><br>
              Product Name:<br />
              <?=$name?>
              <br><br>
              New Stock: <input type="text" name="newStock">
              <br><br>
              <button type="submit">UPDATE CHANGES</button>
          </form>
        </div>
        <?php
            }
            else
            {
                echo 'No entry found. <a href="javascript:history.back()">Go back</a>';
            }
        ?>
    </body>
</html>
