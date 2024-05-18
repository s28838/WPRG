<?php
function fibonacciRecursive($n) {
    if ($n <= 1) {
        return $n;
    }
    return fibonacciRecursive($n - 1) + fibonacciRecursive($n - 2);
}

function fibonacciIterative($n) {
    if ($n <= 1) {
        return $n;
    }
    $fib0 = 0;
    $fib1 = 1;
    for ($i = 2; $i <= $n; $i++) {
        $fibN = $fib0 + $fib1;
        $fib0 = $fib1;
        $fib1 = $fibN;
    }
    return $fib1;
}


$n = 20; // Wartość

$start = microtime(true);
$fibRecursive = fibonacciRecursive($n);
$timeRecursive = microtime(true) - $start;

$start = microtime(true);
$fibIterative = fibonacciIterative($n);
$timeIterative = microtime(true) - $start;

echo "Fibonacci rekurencyjnie dla n=$n: $fibRecursive (czas: $timeRecursive sekund)<br>";
echo "Fibonacci iteracyjnie dla n=$n: $fibIterative (czas: $timeIterative sekund)<br>";

if ($timeRecursive > $timeIterative) {
    $faster = $timeRecursive - $timeIterative;
    echo "Funkcja iteracyjna była szybsza o $faster sekund.";
} else {
    $faster = $timeIterative - $timeRecursive;
    echo "Funkcja rekurencyjna była szybsza o $faster sekund.";
}
?>
