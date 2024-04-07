<?php
$tekst = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";

$slowa = explode(" ", $tekst);
$znakiInterpunkcyjne = ['.', ',', '\'', '"', ':', ';', '-', '!', '?'];

foreach ($slowa as $index => $slowo) {
    foreach ($znakiInterpunkcyjne as $znak) {
        if (strpos($slowo, $znak) !== false) {
            unset($slowa[$index]);
            break;
        }
    }
}

$tablicaAsocjacyjna = [];
$slowa = array_values($slowa); 
for ($i = 0; $i < count($slowa); $i += 2) {
    if (isset($slowa[$i + 1])) {
        $tablicaAsocjacyjna[$slowa[$i]] = $slowa[$i + 1];
    }
}

foreach ($tablicaAsocjacyjna as $klucz => $wartosc) {
    echo "{$klucz}: {$wartosc}\n";
}
?>
