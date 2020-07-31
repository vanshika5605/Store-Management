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
            <a href="users.php">USERS</a>
            <a class="active" href="usercreate.php">CREATE A NEW USER</a>
            <a href="signout.php">SIGN OUT</a>
        </div>
        <div class="container">
          <form action="<?php $_PHP_SELF ?>" method="POST">
              <label for="nameofuser">Name:</label>
              <input type="text" name="nameofuser" required><br>
              <label for="contact">Contact:</label>
              <input type="text" name="contact" required><br>
              <label for="username">Username:</label>
              <input type="text" name="username" required><br>
              <label for="pass">Password:</label>
              <input type="password" name="pass" required><br>
              <label for="access">Access(Admin/Manager/Customer):</label>
              <input type="text" name="access" required>
              <br><br>
              <button type="submit">CREATE USER</button>
          </form>
        </div>
    </body>
    <?php
    if(isset($_POST['username']))
    {
        $conn = mysqli_connect("localhost", "root", "", "management");
        if (!$conn)
        {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM users WHERE username = '$_POST[username]'";
        $result = mysqli_query($conn, $sql);


        if (mysqli_num_rows($result) == 0)
        {
            if ($_POST['access']=='admin')
            {
                $sql1 = "SELECT * FROM users WHERE access = 'admin'";
                $result1 = mysqli_query($conn, $sql1);

                if (mysqli_num_rows($result1) == 1)
                {
                    echo "Admin already exists, there cannot be two admins.";
                }
                else
                {
                    $sql = "INSERT INTO users (username, password, access, nameofuser, contactnumber)
                    values ('$_POST[username]','$_POST[pass]','$_POST[access]','$_POST[nameofuser]','$_POST[contact]')";

                    if (mysqli_query($conn, $sql))
                    {
                        echo "New User created successfully";
                    }
                    else
                    {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                }
            }
            else
            {
                $sql = "INSERT INTO users (username, password, access, nameofuser, contactnumber)
                values ('$_POST[username]','$_POST[pass]','$_POST[access]','$_POST[nameofuser]','$_POST[contact]')";

                if (mysqli_query($conn, $sql))
                {
                    echo "New User created successfully";
                }
                else
                {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }

                if ($_POST['access']=='customer')
                    {
                        $sql1 = "INSERT INTO customers (username, customername, contact, invoices)
                        values ('$_POST[username]','$_POST[nameofuser]','$_POST[contact]', 0)";
                        if (mysqli_query($conn, $sql1))
                        {
                            echo "New Customer created successfully";
                        }
                        else
                        {
                            echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
                        }
                    }
            }
        }
        else
        {
            echo "Username already taken.";
        }

        mysqli_close($conn);
    }
    ?>
</html>
