<?php
function czyPierwsza($liczba) {
    for ($i = 2; $i <= sqrt($liczba); $i++) {
        if ($liczba % $i == 0) {
            return false;
        }
    }
    return $liczba > 1;
}

// Zakres
for ($j = 2; $j <= 100; $j++) {
    if (czyPierwsza($j)) {
        echo $j . "\n";
    }
}
?>
