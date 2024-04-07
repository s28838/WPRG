<?php
$owoce = ["jabłko", "banan", "pomarańcza"];

foreach ($owoce as $owoc) {
    for ($i = strlen($owoc) - 1; $i >= 0; $i--) {
        echo $owoc[$i];
    }
    echo $owoc[0] == 'p' ? " - zaczyna się na 'p'\n" : "\n";
}
?>
