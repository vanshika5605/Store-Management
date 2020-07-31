
<?php
    $conn = mysqli_connect("localhost", "root", "", "management");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $ud_ID = $_POST["ID"];

    $ud_name = $_POST["name"];
    $ud_cost = $_POST["cost"];
    $ud_company = $_POST["company"];

    $sql="UPDATE items
            SET itemname = '$ud_name', cost = '$ud_cost', companyname = '$ud_company'
            WHERE itemid = '$ud_ID' ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_query($conn, $sql))
    {
        echo "Record Updated";
        header("Location:products.php");
    }
    else
    {
        echo "Not Updated";
    }
?>
