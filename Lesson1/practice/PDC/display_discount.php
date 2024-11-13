<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    session_start(); 
    ?>

    <h2>Product Discount Calculator</h2>
    <?php 
     if(isset($_SESSION["discountAmount"]) && $_SESSION["discountAmount"] != "" && $_SESSION["discountPrice"] != 0 && $_SESSION["productDescription"] != "") {
        echo "Product Description: " . $_SESSION["productDescription"] . "<br>";
        echo "Discount Amount: " . $_SESSION["discountAmount"] . "<br>";
        echo "Discount Price: " . $_SESSION["discountPrice"] . "<br>";
        unset($_SESSION["discountAmount"]);
     }
     else{
        header("Location: ./index.php");
     }
     ?>
</body>
</html>