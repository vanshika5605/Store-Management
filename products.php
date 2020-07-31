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
          <a class='active' href='products.php'>PRODUCTS</a>"
          <a href="productadd.php">ADD A NEW PRODUCT</a>
          <a href="signout.php">SIGN OUT</a>
        </div>
        <br>
        <?php
            $conn = mysqli_connect("localhost", "root", "", "management");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT itemid, itemname, quantity, cost, companyname FROM items";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0)
            {
                echo
                "<table>
                    <tr>
                        <th>ITEM_ID</th>
                        <th>ITEM NAME</th>
                        <th>QUANTITY</th>
                        <th>COST</th>
                        <th>COMPANY</th>
                        <th>UPDATE STOCK</th>
                        <th>REMOVE PRODUCT</th>
                        <th>EDIT PRODUCT DETAILS</th>
                    </tr>";
                while($row = mysqli_fetch_assoc($result))
                {
                    echo
                    "<tr>
                        <td>".$row["itemid"]."</td>
                        <td>".$row["itemname"]."</td>
                        <td>".$row["quantity"]."</td>
                        <td>".$row["cost"]."</td>
                        <td>".$row["companyname"]."</td>
                        <td><a class='manage' href='productedit.php?link1=$row[itemid]'>EDIT</a></td>
                        <td><a class='manage' href='productstock.php?link2=$row[itemid]'>UPDATE</a></td>
                        <td><a class='manage' href='products.php?link=$row[itemid]'>REMOVE</a></td>
                    </tr>";
                }
                echo "</table>";

                if(isset($_GET['link']))
                {
                    $link=$_GET['link'];
                    $sqll = "DELETE FROM items WHERE itemid = '$link'";

                    if (mysqli_query($conn, $sqll))
                    {
                        echo "Record deleted successfully";
                        header("Location:products.php");
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
