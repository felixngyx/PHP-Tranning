<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form action="" method="post">
        <h2 class="title">Login</h2>
        <input type="text" name="username" max="30" placeholder="Enter username...">
        <input type="password" name="password" max="30" placeholder="Enter password...">
        <button type="submit" name="login">Login</button>
    </form>

    <style>
        .title {
            text-align: center;
        }

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

    <?php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        if ($username === "admin" && $password === "admin") {
            echo "<h2 class='noti'>Welcome <span style='color:red'>" . $username . "</span> to website</h2>";
        } else {
            echo "<h2 class='noti'><span style='color:red'>Login Error</span></h2>";
        }
    }
    ?>

</body>

</html>