<?php
    $conn = mysqli_connect("localhost", "root", "", "management");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $ud_ID = $_POST["ID"];

    $ud_quantity = $_POST["quantity"] + $_POST["newStock"];

    $sql="UPDATE items
            SET quantity = '$ud_quantity'
            WHERE itemid = '$ud_ID' ";
            
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
