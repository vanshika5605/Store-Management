
<?php
    $conn = mysqli_connect("localhost", "root", "", "management");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $ud_ID = $_POST["ID"];

    $ud_username = $_POST["uname"];
    $ud_name = $_POST["name"];
    $ud_contact = $_POST["contact"];

    $sql="UPDATE users
            SET nameofuser = '$ud_name', contactnumber = '$ud_contact'
            WHERE username = '$ud_username' ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_query($conn, $sql))
    {
        echo "Record Updated";
        header("Location:users.php");
    }
    else
    {
        echo "Not Updated";
    }
?>
