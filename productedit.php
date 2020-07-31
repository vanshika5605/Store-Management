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
        <br><br>
        <?php
            $conn = mysqli_connect("localhost", "root", "", "management");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $id = $_GET['link1'];
            $sql = "SELECT * FROM items WHERE itemid = '$id' ";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result)>=1)
            {
              while($row = mysqli_fetch_array($result))
              {
                  $name = $row['itemname'];
                  $cost = $row['cost'];
                  $company = $row['companyname'];
              }
        ?>
        <div class="container">
          <form action="productupdate.php" method="post">
              <input type="hidden" name="ID" value="<?=$id;?>">
              Product ID:<br />
              <?=$id?>
              <br><br>
              Product Name:
              <input type="text" name="name" value="<?=$name;?>"><br>
              Cost per Unit:
              <input type="text" name="cost" value="<?=$cost?>"><br>
              Company: <input type="text" name="company" value="<?=$company?>">
              <br><br>
              <button type="submit">SUBMIT</button>
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
