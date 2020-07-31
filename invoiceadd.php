<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Invoice Data</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300"/>
        <link rel="stylesheet" href="public/css/styles.css" />
    </head>
    <body>
        <h2>MANAGE THE INVOICE DATABASE</h2>
        <div class="menu">
          <a href='home.php'>HOME</a>
          <a href='invoices.php'>INVOICES</a>
          <a href="invoicecreate.php">CREATE A NEW INVOICE</a>
          <a class='active' href="invoiceadd.php">ADD PRODUCT TO INVOICE</a>
          <a href="signout.php">SIGN OUT</a>
        </div>
        <br><br>
        <div class="container">
          <form action="<?php $_PHP_SELF ?>" method="post">
            <?php
              $conn = mysqli_connect("localhost", "root", "", "management");
              if (!$conn) {
                  die("Connection failed: " . mysqli_connect_error());
              }
            ?>
            <label for="id">Invoice Id</label><br />
            <select name="id">
              <?php
                $sql = "SELECT invoiceid FROM invoices";
                $result = mysqli_query($conn, $sql);

                while($row = mysqli_fetch_assoc($result)){
                  echo "<option>".$row['invoiceid']."</option>";
                }
              ?>
            </select><br /><br>
            <label for="pname">Product Name</label><br>
            <select name="pname">
              <?php
                $sql = "SELECT itemname FROM items";
                $result = mysqli_query($conn, $sql);

                while($row = mysqli_fetch_assoc($result)){
                  echo "<option>".$row['itemname']."</option>";
                }
              ?>
            </select><br><br>
            <label for="quantity">Quantity</label>
            <input type="text" name="quantity"><br>
            <label for="discount">Discount %</label>
            <input type="text" name="discount"><br><br>
            <button type="submit">ADD</button>
          </form>
        </div>
    </body>
</html>

<?php
if(isset($_POST['id']))
{
   $conn = mysqli_connect("localhost", "root", "", "management");
   if (!$conn)
   {
       die("Connection failed: " . mysqli_connect_error());
   }

        $id=$_POST['id'];
        $pname=$_POST['pname'];
        $quantity=$_POST['quantity'];
        $discount=$_POST['discount'];

        $amt = "SELECT amount FROM invoices WHERE invoiceid='$id'";
        $frate = "SELECT cost,quantity FROM items WHERE itemname='$pname'";
        $result1 = mysqli_query($conn, $frate);
        $row1 = mysqli_fetch_array($result1);
        $rate = $row1['cost'];
        $stock = $row1['quantity'];
        $final = $stock - $quantity;
        $result2 = mysqli_query($conn, $amt);
        $row2 = mysqli_fetch_array($result2);
        $oldamt = $row2['amount'];

        $cost = ($quantity * $rate) - (($quantity * $rate * $discount)/100);
        $newamt = $oldamt + $cost;

        $sql = "INSERT into invoice_details(i_id, productname, quantity, rate, discount, cost)
        VALUES ('$id','$pname','$quantity','$rate','$discount','$cost')";

        if (mysqli_query($conn, $sql))
        {
            $updatei = "UPDATE items
                    SET quantity = '$final'
                    WHERE itemname = '$pname'";
            $updateamount = "UPDATE invoices SET amount='$newamt' WHERE invoiceid='$id'";

            if (mysqli_query($conn, $updatei) && mysqli_query($conn, $updateamount))
            {
                header("Location:invoices.php");
            }
            else
            {
                echo "Not Updated";
            }
        }
        else
        {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
}
?>
