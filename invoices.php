<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Invoice Data</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300"/>
        <link rel="stylesheet" href="public/css/styles.css" />
    </head>
    <body>
        <h2>MANAGE INVOICES</h2>
        <div class="menu">
          <a href='home.php'>HOME</a>"
          <a class='active' href='invoices.php'>INVOICES</a>"
          <a href="invoicecreate.php">CREATE A NEW INVOICE</a>
          <a href="invoiceadd.php">ADD PRODUCT TO INVOICE</a>
          <a href="signout.php">SIGN OUT</a>
        </div>
        <br><br>
        <?php
            $conn = mysqli_connect("localhost", "root", "", "management");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT invoiceid, cname, contact, address, date, amount FROM invoices";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0)
            {
                echo
                "<table>
                    <tr>
                        <th>INVOICE NUMBER</th>
                        <th>CUSTOMER NAME</th>
                        <th>CONTACT NUMBER</th>
                        <th>DATE OF BILLING</th>
                        <th>ADDRESS</th>
                        <th>TOTAL BILLING AMOUNT</th>
                        <th>GENERATE</th>
                    </tr>";
                while($row = mysqli_fetch_assoc($result))
                {
                    echo
                    "<tr>
                        <td>".$row["invoiceid"]."</td>
                        <td>".$row["cname"]."</td>
                        <td>".$row["contact"]."</td>
                        <td>".$row["date"]."</td>
                        <td>".$row["address"]."</td>
                        <td>".$row["amount"]."</td>
                        <td><a class='manage' href='invoicegenerate.php?link=$row[invoiceid]'>Click to generate</a></td>
                    </tr>";
                }
                echo "</table>";
            }
            else
            {
                echo "0 results";
            }
            mysqli_close($conn);
        ?>
    </body>
</html>
