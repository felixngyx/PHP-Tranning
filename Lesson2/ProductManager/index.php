<?php
session_start();
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = array();
}

function addProduct($name, $price, $quantity) {
    if (empty($name) || !is_numeric($price) || !is_numeric($quantity)) {
        return false;
    }
    
    $product = array(
        'name' => $name,
        'price' => $price,
        'quantity' => $quantity
    );
    
    $_SESSION['products'][] = $product;
    return true;
}

function displayProducts($products) {
    if (empty($products)) {
        echo "Không có sản phẩm nào.";
        return;
    }
    
    foreach ($products as $product) {
        printf("Tên: %s | Giá: %s VNĐ | Số lượng: %d<br>",
            $product['name'],
            number_format($product['price']),
            $product['quantity']
        );
    }
}


function searchProduct($products, $keyword) {
    $result = array();
    $keyword = strtolower($keyword);
    
    foreach ($products as $product) {
        if (strpos(strtolower($product['name']), $keyword) !== false) {
            $result[] = $product;
        }
    }
    return $result;
}


function sortProductsByName($products) {
    usort($products, function($a, $b) {
        return strcmp(strtolower($a['name']), strtolower($b['name']));
    });
    return $products;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                if (addProduct($_POST['name'], $_POST['price'], $_POST['quantity'])) {
                    echo "Thêm sản phẩm thành công!";
                } else {
                    echo "Vui lòng nhập đầy đủ thông tin hợp lệ!";
                }
                break;
                
            case 'search':
                $searchResults = searchProduct($_SESSION['products'], $_POST['keyword']);
                break;
                
            case 'sort':
                $_SESSION['products'] = sortProductsByName($_SESSION['products']);
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quản lý Sản phẩm</title>
    <meta charset="UTF-8">
</head>
<body>
    <h2>Thêm Sản phẩm Mới</h2>
    <form method="post">
        <input type="hidden" name="action" value="add">
        Tên sản phẩm: <input type="text" name="name" required><br>
        Giá: <input type="number" name="price" required><br>
        Số lượng: <input type="number" name="quantity" required><br>
        <input type="submit" value="Thêm sản phẩm">
    </form>

    <h2>Tìm kiếm Sản phẩm</h2>
    <form method="post">
        <input type="hidden" name="action" value="search">
        <input type="text" name="keyword">
        <input type="submit" value="Tìm kiếm">
    </form>

    <form method="post">
        <input type="hidden" name="action" value="sort">
        <input type="submit" value="Sắp xếp theo tên">
    </form>

    <h2>Danh sách Sản phẩm</h2>
    <?php
    if (isset($searchResults)) {
        displayProducts($searchResults);
    } else {
        displayProducts($_SESSION['products']);
    }
    ?>
</body>
</html>