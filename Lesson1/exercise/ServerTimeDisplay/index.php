<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Time Display</title>
</head>

<body>
    <title>
        Thời gian hiện tại
    </title>
    <span>
        <?php date_default_timezone_set('Asia/Ho_Chi_Minh') ?>
        Bây giờ là: <?php echo date('Y-M-d h:m:s') ?>
    </span>
</body>

</html>