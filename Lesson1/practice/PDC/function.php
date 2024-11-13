<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["caculator"])) {
        if (!empty($_POST["productDescription"] && !empty($_POST["listPrice"]) && !empty($_POST["discountPercent"]))) {
            $productDescription = $_POST["productDescription"];
            $listPrice = $_POST["listPrice"];
            $discountPercent = $_POST["discountPercent"];
            if ($listPrice < 0 || $discountPercent < 0) {
                $_SESSION["err"] = "List Price and Discount Percent must be greater than 0";
                header("Location: ./index.php");
                exit();
            }
            if ($productDescription != "" && $productDescription != "") {
                $_SESSION["productDescription"] = $productDescription;
            }
            $_SESSION["discountAmount"] = $listPrice * $discountPercent * 0.01;
            $_SESSION["discountPrice"] = $listPrice - $_SESSION["discountAmount"];
            header("Location: ./display_discount.php");
        } else {
            $_SESSION["err"] = "Please fill all the fields";
            header("Location: ./index.php");
            exit();
        }
        $_SESSION["productDescription"] = $productDescription;
        header("Location: ./display_discount.php");
        exit();
    } else {
        header("Location: ./index.php");
        exit();
    }
}