<?php

$usernameErr = $emailErr = $passwordErr = "";
$username = $email = $password = "";
$message = "";


function validatePassword($password)
{
    return strlen($password) >= 8;
}

function saveUser($username, $email, $password)
{
    $userData = [
        'username' => $username,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT) // Mã hóa mật khẩu
    ];

    $filename = 'users.json';

    if (file_exists($filename)) {
        $jsonData = file_get_contents($filename);
        $users = json_decode($jsonData, true) ?: [];
    } else {
        $users = [];
    }

    foreach ($users as $user) {
        if ($user['username'] === $username) {
            return "Tên đăng nhập đã tồn tại!";
        }
        if ($user['email'] === $email) {
            return "Email đã được sử dụng!";
        }
    }


    $users[] = $userData;

    if (file_put_contents($filename, json_encode($users, JSON_PRETTY_PRINT))) {
        return true;
    }
    return "Có lỗi khi lưu dữ liệu!";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isValid = true;

    if (empty($_POST["username"])) {
        $usernameErr = "Vui lòng nhập tên đăng nhập";
        $isValid = false;
    } else {
        $username = trim($_POST["username"]);
        if (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
            $usernameErr = "Tên đăng nhập chỉ được chứa chữ cái, số và dấu gạch dưới";
            $isValid = false;
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Vui lòng nhập email";
        $isValid = false;
    } else {
        $email = trim($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Email không hợp lệ";
            $isValid = false;
        }
    }


    if (empty($_POST["password"])) {
        $passwordErr = "Vui lòng nhập mật khẩu";
        $isValid = false;
    } else {
        $password = $_POST["password"];
        if (!validatePassword($password)) {
            $passwordErr = "Mật khẩu phải có ít nhất 8 ký tự";
            $isValid = false;
        }
    }


    if ($isValid) {
        $result = saveUser($username, $email, $password);
        if ($result === true) {
            $message = "Đăng ký thành công!";
            $username = $email = $password = "";
        } else {
            $message = $result;
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Đăng ký người dùng</title>
    <meta charset="UTF-8">
    <style>
        .error {
            color: red;
        }

        .success {
            color: green;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 200px;
            padding: 5px;
        }
    </style>
</head>

<body>
    <h2>Đăng ký tài khoản</h2>

    <?php if ($message): ?>
        <p class="<?php echo strpos($message, 'thành công') !== false ? 'success' : 'error'; ?>">
            <?php echo $message; ?>
        </p>
    <?php endif; ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label>Tên đăng nhập:</label>
            <input type="text" name="username" value="<?php echo $username; ?>">
            <span class="error"><?php echo $usernameErr; ?></span>
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
            <span class="error"><?php echo $emailErr; ?></span>
        </div>

        <div class="form-group">
            <label>Mật khẩu:</label>
            <input type="password" name="password">
            <span class="error"><?php echo $passwordErr; ?></span>
        </div>

        <input type="submit" value="Đăng ký">
    </form>
</body>

</html>