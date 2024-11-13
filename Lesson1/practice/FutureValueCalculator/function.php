<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["calculate"])) {
    $investment = floatval($_POST["investment"]);
    $rate = floatval($_POST["rate"]) / 100;
    $years = intval($_POST["years"]);
    
    $futureValue = $investment;
    for ($i = 0; $i < $years; $i++) {
        $futureValue += $futureValue * $rate;
    }
    
    echo "<h1>Future Value Calculator</h1>";
    echo "<p>Investment Amount: $" . number_format($investment, 2) . "</p>";
    echo "<p>Yearly Interest Rate: " . ($rate * 100) . "%</p>";
    echo "<p>Number of Years: $years</p>";
    echo "<p>Future Value: $" . number_format($futureValue, 2) . "</p>";
}
?>