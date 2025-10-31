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
    <title>АвтоМаркет — лучшие машины!</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Orbitron:wght@600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            font-family: 'Poppins', sans-serif;
            color: #fff;
            display: flex;
            flex-direction: column;
            background: url('https://images.unsplash.com/photo-1502877338535-766e1452684a?auto=format&fit=crop&w=1950&q=80') no-repeat center center fixed;
            background-size: cover;
        }

        header {
            background: rgba(0, 0, 0, 0.9);
            text-align: center;
            padding: 25px 20px;
            color: #fff;
            box-shadow: 0 3px 10px rgba(0,0,0,0.4);
        }

        header h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 36px;
            margin-bottom: 5px;
            letter-spacing: 1px;
        }

        header p {
            font-size: 18px;
            font-weight: 600;
            color: #ddd;
        }

        main {
            flex: 1;
            max-width: 1000px;
            margin: 40px auto;
            padding: 40px 30px;
            background: rgba(0, 0, 0, 0.6);
            border-radius: 12px;
            box-shadow: 0 4px 25px rgba(0,0,0,0.3);
            text-align: center;
        }

        main h2 {
            font-size: 26px;
            color: #00d2ff;
            margin-bottom: 10px;
        }

        p {
            line-height: 1.7;
            color: #ddd;
            margin-bottom: 25px;
        }

        section {
            margin-bottom: 40px;
        }

        .features {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .feature {
            background: rgba(0, 0, 0, 0.85);
            padding: 25px;
            border-radius: 10px;
            width: 220px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.4);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .feature:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.6);
        }

        .feature h3 {
            color: #00d2ff;
            margin-bottom: 10px;
        }

        .feature p {
            color: #ddd;
            line-height: 1.5;
        }

        .cta-button {
            display: inline-block;
            margin-top: 30px;
            padding: 14px 28px;
            background: linear-gradient(90deg, #00d2ff, #3a47d5);
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            transition: transform 0.3s, background 0.3s;
        }

        .cta-button:hover {
            transform: scale(1.05);
            background: linear-gradient(90deg, #3a47d5, #00d2ff);
        }

        footer {
            background: rgba(0, 0, 0, 0.85);
            text-align: center;
            padding: 15px;
            color: #aaa;
            font-size: 14px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        footer a {
            color: #00d2ff;
            text-decoration: none;
            font-weight: 600;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<header>
    <h1>АвтоМаркет</h1>
    <p>Ваш идеальный автомобиль — легко и быстро!</p>
</header>

<main>
    <section>
        <h2>О нас</h2>
        <p>
            Добро пожаловать в <strong>АвтоМаркет</strong> — онлайн-площадку, где качество и надёжность объединяются в каждом автомобиле.  
            Мы предлагаем лучшие предложения от официальных дилеров и проверенных продавцов, чтобы покупка машины стала лёгкой и безопасной.
        </p>
    </section>

    <section>
        <h2>Наши преимущества</h2>
        <div class="features">
            <div class="feature">
                <h3>🚗 Огромный выбор</h3>
                <p>Сотни автомобилей разных брендов, моделей и классов.</p>
            </div>
            <div class="feature">
                <h3>💰 Честные цены</h3>
                <p>Без скрытых комиссий и неожиданных платежей.</p>
            </div>
            <div class="feature">
                <h3>🛡️ Гарантия</h3>
                <p>Каждая машина проходит тщательную проверку перед продажей.</p>
            </div>
            <div class="feature">
                <h3>📦 Онлайн-бронирование</h3>
                <p>Покупайте и бронируйте авто, не выходя из дома.</p>
            </div>
        </div>
    </section>

    <section>
        <h2>Контакты</h2>
        <p>
            📍 Москва, Ленинский проспект, 58<br>
            ☎️ +7 (999) 555-44-33<br>
            ✉️ info@automarket.ru
        </p>
    </section>

    <a href="catalog.php" class="cta-button">Перейти в каталог автомобилей</a>
</main>

<footer>
    &copy; <?= date('Y') ?> АвтоМаркет — лучшие машины! Разработано с ❤️ <a href="#">AutoWeb</a>
</footer>

</body>
</html>
