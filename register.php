<?php
session_start();
$message = '';
$success = false;

// Параметры подключения к базе данных
$host = 'localhost';
$db   = 'user_system';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    exit('Ошибка подключения к базе данных: ' . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    if (empty($username) || empty($password) || empty($password_confirm)) {
        $message = "Пожалуйста, заполните все поля.";
    } elseif ($password !== $password_confirm) {
        $message = "Пароли не совпадают.";
    } else {
        // Проверяем, существует ли логин
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $userExists = $stmt->fetchColumn();

        if ($userExists) {
            $message = "Пользователь с таким логином уже существует.";
        } else {
            // Хешируем пароль
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            // Добавляем пользователя
            $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
            $stmt->execute([$username, $passwordHash]);

            // Создаем сессию после успешной регистрации
            $_SESSION['username'] = $username;

            // Перенаправляем на main.php
            header("Location: main.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Регистрация</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-box {
            background: white;
            padding: 30px 40px;
            width: 320px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            border-radius: 10px;
            text-align: center;
        }

        input[type=text], input[type=password] {
            width: 100%;
            padding: 10px;
            margin: 12px 0 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type=submit] {
            padding: 12px;
            width: 100%;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 18px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        .message {
            margin-bottom: 15px;
            font-weight: bold;
            color: red;
        }
    </style>
</head>
<body>

<div class="register-box">
    <h2>Регистрация</h2>
    <?php if ($message): ?>
        <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="username">Логин:</label>
        <input type="text" id="username" name="username" required />

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required />

        <label for="password_confirm">Подтверждение пароля:</label>
        <input type="password" id="password_confirm" name="password_confirm" required />

        <input type="submit" value="Зарегистрироваться" />
    </form>
</div>

</body>
</html>
