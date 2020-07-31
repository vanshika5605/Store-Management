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
            <a class='active' href='customers.php'>CUSTOMERS</a>"
            <a href="signout.php">SIGN OUT</a>
        </div>
        <br><br>
        <?php
            $conn = mysqli_connect("localhost", "root", "", "management");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT customerid, customername, contact, invoices FROM customers";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0)
            {
                echo
                "<table>
                    <tr>
                        <th>CUSTOMER_ID</th>
                        <th>CUSTOMER NAME</th>
                        <th>CONTACT NUMBER</th>
                        <th>INVOICES</th>
                        <th>    </th>
                        <th>    </th>
                    </tr>";
                while($row = mysqli_fetch_assoc($result))
                {
                    echo
                    "<tr>
                        <td>".$row["customerid"]."</td>
                        <td>".$row["customername"]."</td>
                        <td>".$row["contact"]."</td>
                        <td>".$row["invoices"]."</td>
                        <td><a class='manage' href='customeredit.php?link1=$row[customerid]'>Edit</a></td>
                        <td><a class='manage' href='customers.php?link=$row[customerid]'>Delete</a></td>
                    </tr>";
                }
                echo "</table>";

                if(isset($_GET['link']))
                {
                    $link=$_GET['link'];
                    $sqll = "DELETE FROM customers WHERE customerid = '$link'";

                    if (mysqli_query($conn, $sqll))
                    {
                        echo "Record deleted successfully";
                        header("Location:customers.php");
                    }
                    else
                    {
                        echo "Error deleting record: " . mysqli_error($conn);
                    }
                }
            }
            else
            {
                echo "0 results";
            }
            mysqli_close($conn);
        ?>
    </body>
</html>
