<?php
session_start();

function numberToWords($num) {
    $ones = array(
        0 => "zero", 1 => "one", 2 => "two", 3 => "three", 4 => "four",
        5 => "five", 6 => "six", 7 => "seven", 8 => "eight", 9 => "nine"
    );
    $teens = array(
        10 => "ten", 11 => "eleven", 12 => "twelve", 13 => "thirteen", 14 => "fourteen",
        15 => "fifteen", 16 => "sixteen", 17 => "seventeen", 18 => "eighteen", 19 => "nineteen"
    );
    $tens = array(
        2 => "twenty", 3 => "thirty", 4 => "forty", 5 => "fifty",
        6 => "sixty", 7 => "seventy", 8 => "eighty", 9 => "ninety"
    );

    switch (true) {
        case $num < 10:
            return $ones[$num];
        case $num < 20:
            return $teens[$num];
        case $num < 100:
            $ten = floor($num / 10);
            $one = $num % 10;
            return $tens[$ten] . ($one ? " " . $ones[$one] : "");
        default:
            $hundred = floor($num / 100);
            $remainder = $num % 100;
            return $ones[$hundred] . " hundred" . ($remainder ? " and " . numberToWords($remainder) : "");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["convert"])) {
    $number = intval($_POST["number"]);
    $words = numberToWords($number);
    echo "<p>The number $number in words is: $words</p>";
}
?>