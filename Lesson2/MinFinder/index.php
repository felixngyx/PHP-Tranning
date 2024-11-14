<?php
class MinFinder {
    public function findMin($arr) {
        if (empty($arr)) {
            return -1; 
        }
        
        $min = $arr[0];
        $index = 0; 
        
        for ($i = 1; $i < count($arr); $i++) {
            if ($arr[$i] < $min) {
                $min = $arr[$i];
                $index = $i;
            }
        }
        
        return $index;
    }
}


$minFinder = new MinFinder();

$arr1 = [4, 12, 7, 8, 1, 6, 9];
$arr2 = [1, 2, 3, 4, 5];
$arr3 = [-1, -5, 0, 2, -9, 4];

echo "Mảng 1: " . implode(", ", $arr1) . "\n";
echo "Vị trí phần tử nhỏ nhất: " . $minFinder->findMin($arr1) . "\n";
echo "Giá trị nhỏ nhất: " . $arr1[$minFinder->findMin($arr1)] . "\n\n";

echo "Mảng 2: " . implode(", ", $arr2) . "\n";
echo "Vị trí phần tử nhỏ nhất: " . $minFinder->findMin($arr2) . "\n";
echo "Giá trị nhỏ nhất: " . $arr2[$minFinder->findMin($arr2)] . "\n\n";

echo "Mảng 3: " . implode(", ", $arr3) . "\n";
echo "Vị trí phần tử nhỏ nhất: " . $minFinder->findMin($arr3) . "\n";
echo "Giá trị nhỏ nhất: " . $arr3[$minFinder->findMin($arr3)] . "\n";
?> 