<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Future Value Calculator</title>
</head>
<body>
    <h1>Future Value Calculator</h1>
    <form action="function.php" method="POST">
        <label for="investment">Investment Amount:</label>
        <input type="number" id="investment" name="investment" required><br><br>
        
        <label for="rate">Yearly Interest Rate (%):</label>
        <input type="number" id="rate" name="rate" step="0.01" required><br><br>
        
        <label for="years">Number of Years:</label>
        <input type="number" id="years" name="years" required><br><br>
        
        <input type="submit" name="calculate" value="Calculate">
    </form>
</body>
</html>