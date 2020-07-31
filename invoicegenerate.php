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
          <a href="invoiceadd.php">ADD PRODUCT TO INVOICE</a>
          <a href="signout.php">SIGN OUT</a>
        </div>
        <br>
        <?php
           $conn = mysqli_connect("localhost", "root", "", "management");
           if (!$conn)
           {
               die("Connection failed: " . mysqli_connect_error());
           }
            $id = $_GET['link'];

            $sql = "SELECT cname, contact, address, date, amount FROM invoices
                    WHERE invoiceid='$id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);

            $name=$row['cname'];
            $contact=$row['contact'];
            $date=$row['date'];
            $address=$row['address'];
            $amount=$row['amount'];
          ?>
          <h1>INVOICE</h1><br>
          <div>
            <p><?=$name?></p><br>
            <p><?=$address?>,</p>
            <p>Phone: <?=$contact?></p><br><br>
            <p>Billing Date: <?=$date?></p><br>
          </div>
        <?php
          $id = $_GET['link'];

          $table = "SELECT productname, quantity, rate, discount, cost FROM invoice_details WHERE i_id='$id'";
          $result = mysqli_query($conn, $table);
          $sno = 1;
          $subtotal = 0;
          $discount = 0;

          if (mysqli_num_rows($result) > 0)
          {
              echo
              "<table>
                  <tr>
                      <th>S.NO</th>
                      <th>PRODUCT NAME</th>
                      <th>QUANTITY</th>
                      <th>RATE</th>
                      <th>DISCOUNT (%)</th>
                      <th>AMOUNT</th>
                  </tr>";
              while($row = mysqli_fetch_assoc($result))
              {
                  echo
                  "<tr>
                      <td>".$sno."</td>
                      <td>".$row["productname"]."</td>
                      <td>".$row["quantity"]."</td>
                      <td>".$row["rate"]."</td>
                      <td>".$row["discount"]."</td>
                      <td>".$row["cost"]."</td>
                  </tr>";
                  $sno =$sno + 1;
                  $subtotal = $subtotal + $row['quantity'] * $row['rate'];
                  $discount = $discount + ($row['quantity'] * $row['rate'] - $row['cost']);
              }
              echo "</table>";
              $amount = $subtotal - $discount;
          }
          else
          {
              echo "0 results";
          }
          mysqli_close($conn);
        ?>
        <br>
        <div class="details">
          <h4>SUBTOTAL: <?=$subtotal?></h4>
          <h4>DISCOUNT: <?=$discount?></h4>
          <h4>TOTAL: <?=$amount?></h4>
        </div>
    </body>
</html>
