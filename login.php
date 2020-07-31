<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Welcome to your Store</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300"/>
        <link rel="stylesheet" href="public/css/styles.css" />
    </head>
    <body>
        <h1>STORE MANAGEMENT SYSTEM</h1>
        <div class="container">
          <h2>WELCOME</h2>
          <form action="<?php $_PHP_SELF ?>" method="POST">
              <label for="uname">Username:</label><br>
              <input type="text" placeholder="Enter username" name="uname" required><br>
              <label for="psw">Password:</label><br>
              <input type="password" placeholder="Enter password" name="psw" required><br>
              <button type="submit">LOGIN</button>
          </form>
        <?php
        session_start();
        if(isset($_POST['uname']))
        {
            $conn = mysqli_connect("localhost", "root", "", "management");
            if (!$conn)
            {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT * FROM users WHERE username = '$_POST[uname]' AND password = '$_POST[psw]' ";
            $result = mysqli_query($conn, $sql);

            $row  = mysqli_fetch_array($result);
            if (is_array($row))
            {
                $_SESSION["id"] = $row['id'];
                $_SESSION["name"] = $row['name'];
                if ($row["access"]=="admin")
                {
                    $_SESSION["access"] = "admin";
                }
                else if ($row["access"]=="manager")
                {
                    $_SESSION["access"] = "manager";
                }
                else if ($row["access"]=="customer")
                {
                    $_SESSION["access"] = "customer";
                }
                header("Location: home.php");
            }
            else
            {
                echo "The username or password are incorrect!";
            }

            mysqli_close($conn);
        }
        ?>
        <br><br>
        <p>New User? Create Account.</p>
        <button type="button" onclick="window.location.href = 'signup.html';">SIGN UP</button>
      </div>
    </body>
</html>
