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
          <a class='active' href="invoicecreate.php">CREATE A NEW INVOICE</a>
          <a href="invoiceadd.php">ADD PRODUCT TO INVOICE</a>
          <a href="signout.php">SIGN OUT</a>
        </div>
        <br><br>
        <div class="container">
          <p>Invoice Id will be generated automatically.</p><br />
          <form action="<?php $_PHP_SELF ?>" method="post">
            <label for="cname">Customer Name</label>
            <input type="text" name="cname" required>
            <label for="contact">Contact</label>
            <input type="text" name="contact" required>
            <label for="address">Address</label>
            <input type="text" name="address">
            <label for="date">Date</label>
            <input type="date" name="date" required>
            <br /><br />
            <button type="submit">CREATE</button>
          </form>
        </div>
    </body>
</html>

<?php
if(isset($_POST['cname']))
{
   $conn = mysqli_connect("localhost", "root", "", "management");
   if (!$conn)
   {
       die("Connection failed: " . mysqli_connect_error());
   }

        $name=$_POST['cname'];
        $contact=$_POST['contact'];
        $date=$_POST['date'];
        $address=$_POST['address'];

        $sql = "insert into invoices(cname,contact,address,date) VALUES ('$name','$contact','$address','$date')";

        if (mysqli_query($conn, $sql))
        {
            echo "New Invoice created successfully";
            header("Location:invoices.php");
        }
        else
        {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
}
?>
