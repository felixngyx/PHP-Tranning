<?php
// Khởi tạo các biến thông báo lỗi
$nameErr = $emailErr = $phoneErr = "";
$name = $email = $phone = "";
$message = "";

// Hàm lưu dữ liệu vào file JSON
function saveDataJSON($filename, $name, $email, $phone) {
    try {
        // Đọc dữ liệu hiện có
        $current_data = file_get_contents($filename);
        $array_data = json_decode($current_data, true);
        
        // Tạo mảng contact mới
        $contact = array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone
        );
        
        // Thêm contact mới vào mảng dữ liệu
        if ($array_data === null) {
            $array_data = array();
        }
        $array_data[] = $contact;
        
        // Chuyển đổi mảng thành JSON và lưu vào file
        $json_data = json_encode($array_data, JSON_PRETTY_PRINT);
        file_put_contents($filename, $json_data);
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// Xử lý form khi submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isValid = true;
    
    // Kiểm tra tên
    if (empty($_POST["name"])) {
        $nameErr = "Vui lòng nhập tên";
        $isValid = false;
    } else {
        $name = $_POST["name"];
    }
    
    // Kiểm tra email
    if (empty($_POST["email"])) {
        $emailErr = "Vui lòng nhập email";
        $isValid = false;
    } else {
        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Email không hợp lệ";
            $isValid = false;
        }
    }
    
    // Kiểm tra số điện thoại
    if (empty($_POST["phone"])) {
        $phoneErr = "Vui lòng nhập số điện thoại";
        $isValid = false;
    } else {
        $phone = $_POST["phone"];
    }
    
    // Nếu dữ liệu hợp lệ, lưu vào file JSON
    if ($isValid) {
        if (saveDataJSON("users.json", $name, $email, $phone)) {
            $message = "Đăng ký thành công!";
            $name = $email = $phone = ""; // Reset form
        } else {
            $message = "Có lỗi xảy ra khi lưu dữ liệu!";
        }
    }
}

// Hàm hiển thị danh sách người dùng
function displayUsers() {
    if (file_exists("users.json")) {
        $data = file_get_contents("users.json");
        $users = json_decode($data, true);
        if (!empty($users)) {
            echo "<h3>Danh sách người dùng đã đăng ký:</h3>";
            echo "<ul>";
            foreach ($users as $user) {
                echo "<li>Tên: " . $user['name'] . " | Email: " . $user['email'] . " | SĐT: " . $user['phone'] . "</li>";
            }
            echo "</ul>";
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
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <h2>Đăng ký người dùng</h2>
    <p><span class="success"><?php echo $message; ?></span></p>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div>
            <label>Tên:</label>
            <input type="text" name="name" value="<?php echo $name; ?>">
            <span class="error"><?php echo $nameErr; ?></span>
        </div>
        <br>
        <div>
            <label>Email:</label>
            <input type="text" name="email" value="<?php echo $email; ?>">
            <span class="error"><?php echo $emailErr; ?></span>
        </div>
        <br>
        <div>
            <label>Điện thoại:</label>
            <input type="text" name="phone" value="<?php echo $phone; ?>">
            <span class="error"><?php echo $phoneErr; ?></span>
        </div>
        <br>
        <input type="submit" value="Đăng ký">
    </form>

    <?php displayUsers(); ?>
</body>
</html>