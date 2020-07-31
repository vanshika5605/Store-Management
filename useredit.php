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
          <a href='users.php'>USERS</a>"
          <a href="usercreate.php">CREATE A NEW USER</a>
          <a href="signout.php">SIGN OUT</a>
        </div>
        <br>
        <?php
            $conn = mysqli_connect("localhost", "root", "", "management");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $user = $_GET['link1'];
            $sql = "SELECT * FROM users WHERE username = '$user'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result)>=1)
            {
              while($row = mysqli_fetch_array($result))
              {
                  $uname = $row['username'];
                  $name = $row['nameofuser'];
                  $contact = $row['contactnumber'];
              }

        ?>
        <div class="container">
          <form action="userupdate.php" method="post">
              <input type="hidden" name="ID" value="<?=$user;?>">
              <input type="hidden" name="uname" value="<?=$uname;?>">
              Username:<br>
              <?=$uname?><br><br>
              Name:<br>
              <input type="text" name="name" value="<?=$name;?>"><br>
              Contact Number:<br>
              <input type="text" name="contact" value="<?=$contact?>"><br>
              <button type="Submit">SUBMIT</Button>
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
