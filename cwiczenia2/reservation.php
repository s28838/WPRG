<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Formularz rezerwacji hotelu</title>
</head>
<body>
    <h1>Rezerwacja hotelu</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['people_info'])) {
        // Podsumowanie rezerwacji z informacjami o wszystkich osobach
        $people = $_POST['people'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $address = $_POST['address'];
        $credit_card = $_POST['credit_card'];
        $email = $_POST['email'];
        $arrival_date = $_POST['arrival_date'];
        $arrival_time = $_POST['arrival_time'];
        $extra_bed = isset($_POST['extra_bed']) ? 'Tak' : 'Nie';
        $amenities = isset($_POST['amenities']) ? $_POST['amenities'] : [];

        echo "<h1>Podsumowanie rezerwacji</h1>";
        echo "Ilość osób: $people<br>";
        echo "Dane osoby rezerwującej: $firstname $lastname, Adres: $address, E-mail: $email<br>";
        echo "Numer karty kredytowej: " . str_repeat('*', strlen($credit_card) - 4) . substr($credit_card, -4) . "<br>";
        echo "Data przyjazdu: $arrival_date o godzinie $arrival_time<br>";
        echo "Dodatkowe łóżko dla dziecka: $extra_bed<br>";

        echo "Udogodnienia:<br>";
        if (!empty($amenities)) {
            foreach ($amenities as $amenity) {
                echo "- " . htmlspecialchars($amenity) . "<br>";
            }
        } else {
            echo "Brak wybranych udogodnień.<br>";
        }

        echo "<h2>Dane gości:</h2>";
        for ($i = 1; $i <= $people; $i++) {
            echo "Osoba $i: " . htmlspecialchars($_POST["guest_firstname_$i"]) . " " . htmlspecialchars($_POST["guest_lastname_$i"]) . "<br>";
        }

    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Wyświetlanie formularzy dla każdej osoby
        $people = $_POST['people'];
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="people" value="<?php echo $people; ?>">
            <input type="hidden" name="firstname" value="<?php echo $_POST['firstname']; ?>">
            <input type="hidden" name="lastname" value="<?php echo $_POST['lastname']; ?>">
            <input type="hidden" name="address" value="<?php echo $_POST['address']; ?>">
            <input type="hidden" name="credit_card" value="<?php echo $_POST['credit_card']; ?>">
            <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
            <input type="hidden" name="arrival_date" value="<?php echo $_POST['arrival_date']; ?>">
            <input type="hidden" name="arrival_time" value="<?php echo $_POST['arrival_time']; ?>">
            <input type="hidden" name="extra_bed" value="<?php echo isset($_POST['extra_bed']) ? 'Tak' : ''; ?>">
            <?php
            for ($i = 1; $i <= $people; $i++) {
                echo "<h3>Osoba $i</h3>";
                echo "<label for='guest_firstname_$i'>Imię:</label>";
                echo "<input type='text' id='guest_firstname_$i' name='guest_firstname_$i' required><br><br>";
                echo "<label for='guest_lastname_$i'>Nazwisko:</label>";
                echo "<input type='text' id='guest_lastname_$i' name='guest_lastname_$i' required><br><br>";
            }
            echo "<button type='submit' name='people_info'>Prześlij dane gości</button>";
            echo "</form>";
        } else {
            // Wyświetlanie głównego formularza rezerwacji
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="people">Ilość osób:</label>
                <select id="people" name="people" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select><br><br>

                <label for="firstname">Imię:</label>
                <input type="text" id="firstname" name="firstname" required><br><br>

                <label for="lastname">Nazwisko:</label>
                <input type="text" id="lastname" name="lastname" required><br><br>

                <label for="address">Adres:</label>
                <input type="text" id="address" name="address" required><br><br>

                <label for="credit_card">Numer karty kredytowej:</label>
                <input type="text" id="credit_card" name="credit_card" pattern="\\d{16}" placeholder="1234123412341234" required><br><br>

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required><br><br>

                <label for="arrival_date">Data przyjazdu:</label>
                <input type="date" id="arrival_date" name="arrival_date" required><br><br>

                <label for="arrival_time">Godzina przyjazdu:</label>
                <input type="time" id="arrival_time" name="arrival_time" required><br><br>

                <label for="extra_bed">Dodatkowe łóżko dla dziecka:</label>
                <input type="checkbox" id="extra_bed" name="extra_bed"><br><br>

                <label for="amenities">Udogodnienia:</label>
                <select id="amenities" name="amenities[]" multiple>
                    <option value="air_conditioning">Klimatyzacja</option>
                    <option value="ashtray">Popielniczka dla palaczy</option>
                </select><br><br>

                <button type="submit">Zarezerwuj</button>
            </form>
            <?php
        }
        ?>
</body>
</html>
