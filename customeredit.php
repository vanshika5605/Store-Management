<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Customers Data</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300"/>
        <link rel="stylesheet" href="public/css/styles.css" />
    </head>
    <body>
        <h2>MANAGE THE CUSTOMER DATABASE</h2>
        <div class="menu">
          <a href='home.php'>HOME</a>"
          <a href='customers.php'>CUSTOMERS</a>"
          <a href="signout.php">SIGN OUT</a>
        </div>
        <?php
            $conn = mysqli_connect("localhost", "root", "", "management");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $id = $_GET['link1'];
            $sql = "SELECT * FROM customers WHERE customerid = '$id' ";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result)>=1)
            {
              while($row = mysqli_fetch_array($result))
              {
                  $name = $row['customername'];
                  $contact = $row['contact'];
                  $invoices = $row['invoices'];
              }
        ?>
        <div class="container">
          <form action="customerupdate.php" method="post">
              <input type="hidden" name="ID" value="<?=$id;?>">
              Customer ID:<br>
              <?=$id?>
              <br><br>
              Customer Name:
              <input type="text" name="name" value="<?=$name;?>"><br>
              Contact Number:
              <input type="text" name="contact" value="<?=$contact?>"><br>
              <button type="Submit">SUBMIT</button>
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
