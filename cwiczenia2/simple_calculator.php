<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prosty Kalkulator</title>
</head>
<body>
    <h1>Prosty Kalkulator</h1>
    <form action="simple_calculator.php" method="post">
        <label for="number1">Liczba 1:</label>
        <input type="number" id="number1" name="number1" required><br><br>
        <label for="number2">Liczba 2:</label>
        <input type="number" id="number2" name="number2" required><br><br>
        <label for="operation">Wybierz działanie:</label>
        <select name="operation" id="operation" required>
            <option value="add">Dodawanie</option>
            <option value="subtract">Odejmowanie</option>
            <option value="multiply">Mnożenie</option>
            <option value="divide">Dzielenie</option>
        </select><br><br>
        <button type="submit">Oblicz</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $number1 = $_POST['number1'];
        $number2 = $_POST['number2'];
        $operation = $_POST['operation'];
        $result = 0;
        
        switch ($operation) {
            case 'add':
                $result = $number1 + $number2;
                break;
            case 'subtract':
                $result = $number1 - $number2;
                break;
            case 'multiply':
                $result = $number1 * $number2;
                break;
            case 'divide':
                if ($number2 != 0) {
                    $result = $number1 / $number2;
                } else {
                    echo "Nie można dzielić przez zero!";
                    return;
                }
                break;
        }
        echo "Wynik: $result";
    }
    ?>
</body>
</html>
