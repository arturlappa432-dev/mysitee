<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['username'];
    $card_number = trim($_POST['card_number']);
    $card_name = trim($_POST['card_name']);
    $expiry_date = trim($_POST['expiry_date']);
    $cvv = trim($_POST['cvv']);

    // Подключение к БД
    $host = 'localhost';
    $db   = 'user_system';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);

        // SQL-запрос для вставки данных
        $stmt = $pdo->prepare("INSERT INTO payment (username, card_number, card_name, expiry_date, cvv) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$username, $card_number, $card_name, $expiry_date, $cvv]);

        echo "<h2>Оплата успешно проведена!</h2>";
        echo "<p>Спасибо за покупку, $username.</p>";

    } catch (PDOException $e) {
        echo "Ошибка при оплате: " . $e->getMessage();
    }
}
?>
