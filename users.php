<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Users Data</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300"/>
        <link rel="stylesheet" href="public/css/styles.css" />
    </head>
    <body>
        <h2>MANAGE THE USER DATABASE</h2>
        <div class="menu">
            <a href='home.php'>HOME</a>"
            <a class='active' href='users.php'>USERS</a>"
            <a href="usercreate.php">CREATE A NEW USER</a>
            <a href="signout.php">SIGN OUT</a>
        </div>
        <br>
        <?php
            $conn = mysqli_connect("localhost", "root", "", "management");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT username, access, nameofuser, contactnumber FROM users";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0)
            {
                echo
                "<table>
                    <tr>
                        <th>USERNAME</th>
                        <th>ACCESS</th>
                        <th>NAME OF USER</th>
                        <th>CONTACT NUMBER</th>
                        <th>    </th>
                        <th>    </th>
                    </tr>";
                while($row = mysqli_fetch_assoc($result))
                {
                    echo
                    "<tr>
                        <td>".$row["username"]."</td>
                        <td>".$row["access"]."</td>
                        <td>".$row["nameofuser"]."</td>
                        <td>".$row["contactnumber"]."</td>
                        <td><a class='manage' href='useredit.php?link1=$row[username]'>Edit</a></td>
                        <td><a class='manage' href='users.php?link=$row[username]'>Delete</a></td>
                    </tr>";
                }
                echo "</table>";

                if(isset($_GET['link']))
                {
                    $link=$_GET['link'];
                    $sqll = "DELETE FROM users WHERE username = '$link'";

                    if (mysqli_query($conn, $sqll))
                    {
                        echo "Record deleted successfully";
                        header("Location:users.php");
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
