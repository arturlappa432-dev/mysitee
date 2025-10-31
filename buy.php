<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Оформление покупки — АвтоМаркет</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Orbitron:wght@600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('images/background.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            max-width: 500px;
            margin: 80px auto;
            padding: 40px 30px;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 12px;
            box-shadow: 0 4px 25px rgba(0,0,0,0.3);
            text-align: center;
            flex: 1;
        }

        h1 {
            color: #00d2ff;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            font-size: 14px;
            color: #ddd;
            margin-bottom: 8px;
            display: block;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            font-size: 16px;
            box-sizing: border-box;
            margin-top: 8px;
        }

        .form-group input:focus {
            outline: none;
            background: rgba(0, 255, 255, 0.2);
        }

        .confirm-btn {
            background: #00d2ff;
            color: #000;
            padding: 15px 25px;
            font-weight: 600;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 20px;
            text-decoration: none;
        }

        .confirm-btn:hover {
            background: #00a3cc;
            color: #fff;
        }

        footer {
            background: rgba(0, 0, 0, 0.85);
            text-align: center;
            padding: 15px;
            color: #aaa;
            font-size: 14px;
            border-top: 1px solid rgba(255,255,255,0.1);
            margin-top: auto;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Оформление покупки</h1>
    <p>Введите данные своей банковской карты, чтобы завершить покупку.</p>

    <form action="confirmation.php" method="POST">
        <div class="form-group">
            <label for="card_number">Номер карты</label>
            <input type="text" id="card_number" name="card_number" placeholder="Номер карты" required maxlength="19">
        </div>

        <div class="form-group">
            <label for="card_name">Имя владельца</label>
            <input type="text" id="card_name" name="card_name" placeholder="Имя владельца" required>
        </div>

        <div class="form-group">
            <label for="expiry_date">Срок действия</label>
            <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" required maxlength="5">
        </div>

        <div class="form-group">
            <label for="cvv">CVV (CVC)</label>
            <input type="text" id="cvv" name="cvv" placeholder="CVV" required maxlength="3">
        </div>

        <button type="submit" class="confirm-btn">Подтвердить оплату</button>
    </form>
</div>

<footer>
    &copy; <?= date('Y') ?> АвтоМаркет — лучшие машины! Разработано с качеством!</a>
</footer>

</body>
</html>
