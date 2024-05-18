<?php
session_start();

// Zdefiniuj użytkownika
$valid_username = "admin";
$valid_password = "password";

// Logowanie
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['logged_in'] = true;
        setcookie("username", $username, time() + 3600); // Ciasteczko z loginem, ważne przez 1 godzinę
    } else {
        $login_error = "Nieprawidłowe dane logowania.";
    }
}

// Wylogowanie
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION);
    header("Location: " . $_SERVER['PHP_SELF']);
}

// Zapisu stanu
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_form'])) {
    setcookie("firstname", $_POST['firstname'], time() + 3600); // Ustawienie ciasteczek dla każdego pola formularza
    setcookie("lastname", $_POST['lastname'], time() + 3600);
    setcookie("address", $_POST['address'], time() + 3600);
}

// Czyszczenie
if (isset($_POST['clear_form'])) {
    setcookie("firstname", "", time() - 3600);
    setcookie("lastname", "", time() - 3600);
    setcookie("address", "", time() - 3600);
    header("Location: " . $_SERVER['PHP_SELF']);
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Rezerwacja hotelu</title>
</head>
<body>
<?php
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Zalogowany
    echo "<p>Witaj, " . (isset($_COOKIE['username']) ? $_COOKIE['username'] : "Użytkowniku") . "!</p>";
    ?>
    <form method="post" action="">
        <label for="firstname">Imię:</label>
        <input type="text" id="firstname" name="firstname" value="<?= $_COOKIE['firstname'] ?? '' ?>"><br><br>
        <label for="lastname">Nazwisko:</label>
        <input type="text" id="lastname" name="lastname" value="<?= $_COOKIE['lastname'] ?? '' ?>"><br><br>
        <label for="address">Adres:</label>
        <input type="text" id="address" name="address" value="<?= $_COOKIE['address'] ?? '' ?>"><br><br>
        <button type="submit" name="save_form">Zapisz formularz</button>
        <button type="submit" name="clear_form">Wyczyść formularz</button>
    </form>
    <a href="?logout">Wyloguj się</a>
    <?php
} else {
    // Niezalogowany
    echo "<p>Nie masz dostępu do tej części strony. Zaloguj się, aby kontynuować.</p>";
    if (isset($login_error)) {
        echo "<p>$login_error</p>";
    }
    ?>
    <form method="post" action="">
        <label for="username">Login:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit" name="login">Zaloguj się</button>
    </form>
    <?php
}
?>
</body>
</html>
