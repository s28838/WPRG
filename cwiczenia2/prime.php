<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Sprawdzenie liczby pierwszej</title>
</head>
<body>
    <h1>Sprawdzenie liczby pierwszej</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="number">Wpisz liczbę:</label>
        <input type="text" id="number" name="number" required>
        <button type="submit">Sprawdź</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $number = $_POST['number'];
        if (!is_numeric($number) || $number < 2 || $number != round($number)) {
            echo "Proszę wpisać liczbę całkowitą dodatnią większą niż 1.";
        } else {
            $isPrime = isPrime($number);
            $result = $isPrime ? "jest" : "nie jest";
            echo "Liczba $number $result liczbą pierwszą.<br>";
            echo "Liczba iteracji: " . $GLOBALS['iterations'];
        }
    }

    function isPrime($num) {
        $GLOBALS['iterations'] = 0;
        if ($num <= 1) return false;
        if ($num <= 3) return true;
        if ($num % 2 == 0 || $num % 3 == 0) return false;

        for ($i = 5; $i * $i <= $num; $i += 6) {
            $GLOBALS['iterations']++;
            if ($num % $i == 0 || $num % ($i + 2) == 0) return false;
        }
        return true;
    }
    ?>
</body>
</html>
