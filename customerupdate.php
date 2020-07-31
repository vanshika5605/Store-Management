
<?php
    $conn = mysqli_connect("localhost", "root", "", "management");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $ud_ID = $_POST["ID"];

    $ud_name = $_POST["name"];
    $ud_contact = $_POST["contact"];

    $sql="UPDATE customers
            SET customername = '$ud_name', contact = '$ud_contact'
            WHERE customerid = '$ud_ID' ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_query($conn, $sql))
    {
        echo "Record Updated";
        header("Location:customers.php");
    }
    else
    {
        echo "Not Updated";
    }
?>
