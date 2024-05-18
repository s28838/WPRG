<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Data Urodzenia</title>
</head>
<body>
<h1>Podaj swoją datę urodzenia</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
    <input type="date" name="birthdate" required>
    <button type="submit">Wyślij</button>
</form>

<?php
if (isset($_GET['birthdate']) && !empty($_GET['birthdate'])) {
    $birthdate = $_GET['birthdate'];
    echo "<h2>Informacje o Twojej dacie urodzenia:</h2>";
    echo "Dzień tygodnia: " . dayOfWeek($birthdate) . "<br>";
    echo "Ukończone lata: " . calculateAge($birthdate) . "<br>";
    echo "Dni do następnych urodzin: " . daysUntilBirthday($birthdate) . "<br>";
}

function dayOfWeek($date) {
    return date('l', strtotime($date));
}

function calculateAge($date) {
    $dob = new DateTime($date);
    $now = new DateTime();
    return $dob->diff($now)->y;
}

function daysUntilBirthday($date) {
    $dob = new DateTime($date);
    $now = new DateTime();
    $nextBirthday = $dob->modify('+' . $dob->diff($now)->y . ' years');
    if ($nextBirthday < $now) {
        $nextBirthday->modify('+1 year');
    }
    return $now->diff($nextBirthday)->days;
}
?>
</body>
</html>
