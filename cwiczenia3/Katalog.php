<?php
function manageDirectory($path, $directoryName, $operation = 'read') {
    $fullPath = rtrim($path, '/') . '/' . $directoryName;

    switch ($operation) {
        case 'create':
            if (!file_exists($fullPath)) {
                mkdir($fullPath, 0777, true);
                echo "Katalog '$directoryName' został stworzony w ścieżce '$path'.<br>";
            } else {
                echo "Katalog '$directoryName' już istnieje w ścieżce '$path'.<br>";
            }
            break;
        case 'delete':
            if (is_dir($fullPath) && count(scandir($fullPath)) == 2) { // sprawdzanie, czy katalog jest pusty
                rmdir($fullPath);
                echo "Katalog '$directoryName' został usunięty z ścieżki '$path'.<br>";
            } else {
                echo "Katalog '$directoryName' nie istnieje lub nie jest pusty w ścieżce '$path'.<br>";
            }
            break;
        case 'read':
        default:
            if (is_dir($fullPath)) {
                $files = scandir($fullPath);
                echo "Zawartość katalogu '$directoryName' w ścieżce '$path':<br>";
                foreach ($files as $file) {
                    if ($file !== "." && $file !== "..") {
                        echo $file . "<br>";
                    }
                }
            } else {
                echo "Katalog '$directoryName' nie istnieje w ścieżce '$path'.<br>";
            }
            break;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $path = $_POST['path'];
    $directoryName = $_POST['directoryName'];
    $operation = $_POST['operation'];
    manageDirectory($path, $directoryName, $operation);
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zarządzanie katalogami</title>
</head>
<body>
<h1>Zarządzanie katalogami</h1>
<form method="post">
    <label for="path">Ścieżka:</label>
    <input type="text" id="path" name="path" required><br><br>

    <label for="directoryName">Nazwa katalogu:</label>
    <input type="text" id="directoryName" name="directoryName" required><br><br>

    <label for="operation">Operacja:</label>
    <select id="operation" name="operation">
        <option value="read">Odczyt</option>
        <option value="delete">Usuń</option>
        <option value="create">Stwórz</option>
    </select><br><br>

    <button type="submit">Wykonaj</button>
</form>
</body>
</html>
