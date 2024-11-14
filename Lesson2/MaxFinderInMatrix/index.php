<!DOCTYPE html>
<html>
<head>
    <title>Tìm phần tử lớn nhất trong ma trận</title>
    <meta charset="UTF-8">
    <style>
        table { border-collapse: collapse; }
        td { padding: 5px; border: 1px solid black; }
        .max-value { background-color: yellow; }
    </style>
</head>
<body>
    <h2>Tìm phần tử lớn nhất trong ma trận</h2>
    
    <?php
    function findMaxInMatrix($matrix) {
        $rows = count($matrix);
        $cols = count($matrix[0]);
        $maxValue = $matrix[0][0];
        $maxRow = 0;
        $maxCol = 0;
        
        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $cols; $j++) {
                if ($matrix[$i][$j] > $maxValue) {
                    $maxValue = $matrix[$i][$j];
                    $maxRow = $i;
                    $maxCol = $j;
                }
            }
        }
        
        return [
            'value' => $maxValue,
            'row' => $maxRow,
            'col' => $maxCol
        ];
    }

    function displayMatrix($matrix, $maxRow = -1, $maxCol = -1) {
        echo "<table>";
        foreach ($matrix as $i => $row) {
            echo "<tr>";
            foreach ($row as $j => $value) {
                $class = ($i === $maxRow && $j === $maxCol) ? ' class="max-value"' : '';
                echo "<td$class>$value</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    // Xử lý form khi submit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['rows']) && isset($_POST['cols'])) {
            $rows = intval($_POST['rows']);
            $cols = intval($_POST['cols']);
            
            $matrix = [];
            for ($i = 0; $i < $rows; $i++) {
                for ($j = 0; $j < $cols; $j++) {
                    $value = $_POST["value_${i}_${j}"] ?? 0;
                    $matrix[$i][$j] = floatval($value);
                }
            }
            
            $result = findMaxInMatrix($matrix);
            echo "<h3>Ma trận của bạn:</h3>";
            displayMatrix($matrix, $result['row'], $result['col']);
            echo "<p>Phần tử lớn nhất là: " . $result['value'] . 
                 " tại vị trí [" . ($result['row'] + 1) . "][" . ($result['col'] + 1) . "]</p>";
        }
    }
    ?>

    <form method="post" action="">
        <h3>Nhập kích thước ma trận:</h3>
        <div>
            Số hàng: <input type="number" name="rows" min="1" max="10" required>
            Số cột: <input type="number" name="cols" min="1" max="10" required>
            <input type="submit" value="Tạo ma trận">
        </div>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && 
        isset($_POST['rows']) && isset($_POST['cols']) && 
        !isset($_POST["value_0_0"])) {
        
        $rows = intval($_POST['rows']);
        $cols = intval($_POST['cols']);
        
        echo "<h3>Nhập giá trị cho ma trận:</h3>";
        echo "<form method='post'>";
        echo "<input type='hidden' name='rows' value='$rows'>";
        echo "<input type='hidden' name='cols' value='$cols'>";
        
        echo "<table>";
        for ($i = 0; $i < $rows; $i++) {
            echo "<tr>";
            for ($j = 0; $j < $cols; $j++) {
                echo "<td><input type='number' step='any' name='value_${i}_${j}' required></td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        
        echo "<br><input type='submit' value='Tìm max'>";
        echo "</form>";
    }
    ?>
</body>
</html>