<?php
function fibonacci($n) {
    $fib = [0, 1];
    for ($i = 2; $i <= $n; $i++) {
        $fib[$i] = $fib[$i - 1] + $fib[$i - 2];
    }
    return $fib;
}

$N = 10;
$fibSequence = fibonacci($N);

$counter = 1;
foreach ($fibSequence as $value) {
    if ($value % 2 != 0) {
        echo "{$counter}: {$value}\n";
        $counter++;
    }
}
?>