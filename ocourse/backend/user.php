<?php
// Ellenőrizd, hogy a POST változók léteznek-e, mielőtt használod őket
if (isset($_POST['name']) && isset($_POST['password'])) {
    // Adatok begyűjtése az űrlapról
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // A jelszó titkosítása

    // Adatbázis kapcsolódási adatok
    $servername = "localhost";
    $username = "root";
    $dbpassword = "";
    $dbname = "ocourse";

    // Kapcsolódás a MySQL-hez
    $conn = new mysqli($servername, $username, $dbpassword, $dbname);

    // Kapcsolódás ellenőrzése
    if ($conn->connect_error) {
        die("Kapcsolódási hiba: " . $conn->connect_error);
    }

    // SQL lekérdezés az adatok beszúrására
    $sql = "INSERT INTO users (name, password) VALUES ('$name', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Sikeres regisztráció!";
    } else {
        echo "Hiba történt: " . $conn->error;
    }

    // Kapcsolat bezárása
    $conn->close();
} else {
    echo "Hiba: Az űrlap nem tartalmazza a szükséges adatokat.";
}
?>
