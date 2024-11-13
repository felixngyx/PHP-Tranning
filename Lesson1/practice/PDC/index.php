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
    <form action="./function.php" method="post">
        <h2>Product Discount Calculator</h2>
        <label for="">Product Description</label>
        <input type="text" name="productDescription">
        <label for="">List Price</label>
        <input type="number" name="listPrice">
        <label for="">Discount Percent</label>
        <input type="number" name="discountPercent">
        <button type="submit" name="caculator">Calculate Discount</button>
        <?php 
        if (isset($_SESSION["err"]) && $_SESSION["err"] != "") {
            echo $_SESSION["err"];
            unset($_SESSION["err"]);
        }
        ?>
    </form>
    <style>
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 90vh;
        }

        input {
            margin: 10px;
            padding: 10px;
            width: 300px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            margin: 10px;
            padding: 10px;
            width: 300px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
    </style>
</body>
</html>