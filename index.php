<?php
session_start();
$message = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $message = "Пожалуйста, заполните все поля.";
    } else {
        try {
            $host = 'localhost';
            $db = 'user_system';
            $user = 'root';
            $pass = '';
            $charset = 'utf8mb4';

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

            $pdo = new PDO($dsn, $user, $pass, $options);

            $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
            $stmt->execute([$username]);
            $userRow = $stmt->fetch();

            // ✅ Исправленный блок if/else
            if ($userRow && password_verify($password, $userRow['password'])) {
                $_SESSION['username'] = $userRow['username'];
                $success = true;
                $message = "Авторизация успешна! Сейчас вы будете перенаправлены...";
                header("Refresh: 2; URL=main.php");
            } else {
                $message = "Неверный логин или пароль.";
            }

        } catch (PDOException $e) {
            $message = "Ошибка подключения к базе данных: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Вход</title>
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
        .login-box {
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
            box-sizing: border-box;
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
            color: <?= $success ? 'green' : 'red' ?>;
        }
        .register-link {
            display: block;
            margin-top: 10px;
            font-size: 14px;
            color: #2196F3;
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Вход</h2>
    <?php if ($message): ?>
        <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <?php if (!$success): ?>
        <form method="POST" action="">
            <label for="username">Логин:</label>
            <input type="text" id="username" name="username" required />

            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required />

            <input type="submit" value="Войти" />
        </form>
    <?php endif; ?>

    <a href="register.php" class="register-link">Регистрация</a>
</div>

</body>
</html>
