<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prime Numbers Less Than 100</title>
</head>
<body>
    <h1>Prime Numbers Less Than 100</h1>
    <?php
    function isPrime($num) {
        if ($num <= 1) {
            return false;
        }
        for ($i = 2; $i <= sqrt($num); $i++) {
            if ($num % $i == 0) {
                return false;
            }
        }
        return true;
    }

    for ($i = 2; $i < 100; $i++) {
        if (isPrime($i)) {
            echo $i . " ";
        }
    }
    ?>
</body>
</html>