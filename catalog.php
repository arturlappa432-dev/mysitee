<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$cars = [
    [
        'name' => 'Toyota Camry',
        'price' => '2 000 000 ₸',
        'image' => 'images/medium_with_watermark_toyota-camry-almati-almaty-4601.jpg',
        'description' => 'Двигатель: 2.5L, Мощность: 181 л.с., Автомат, Седан',
        'year' => 2021,
        'fuel' => 'Бензин',
        'mileage' => '15 000 км',
        'drive' => 'Передний привод',
        'seats' => 5,
        'color' => 'Серебристый',
        'features' => 'ABS, Подушки безопасности, Климат-контроль, Мультимедиа'
    ],
    [
        'name' => 'BMW X5',
        'price' => '5 500 000 ₸',
        'image' => 'images/BMW-X5M-F95-rendering-1-830x553.jpg',
        'description' => 'Двигатель: 3.0L, Мощность: 340 л.с., Автомат, Кроссовер',
        'year' => 2022,
        'fuel' => 'Бензин',
        'mileage' => '10 000 км',
        'drive' => 'Полный привод',
        'seats' => 5,
        'color' => 'Черный',
        'features' => 'Камера 360°, Навигация, Адаптивный круиз-контроль, Подогрев сидений'
    ],
    [
        'name' => 'Mercedes-Benz E-Class',
        'price' => '4 800 000 ₸',
        'image' => 'images/03_e_class_high_tech_silver_selected.jpg',
        'description' => 'Двигатель: 2.0L, Мощность: 197 л.с., Автомат, Седан',
        'year' => 2021,
        'fuel' => 'Дизель',
        'mileage' => '20 000 км',
        'drive' => 'Задний привод',
        'seats' => 5,
        'color' => 'Серебристый',
        'features' => 'Подушки безопасности, Климат-контроль, Подогрев руля, Мультимедиа'
    ],
    [
        'name' => 'Audi Q7',
        'price' => '6 200 000 ₸',
        'image' => 'images/A241887_large.jpg',
        'description' => 'Двигатель: 3.0L, Мощность: 333 л.с., Автомат, Внедорожник',
        'year' => 2022,
        'fuel' => 'Бензин',
        'mileage' => '5 000 км',
        'drive' => 'Полный привод',
        'seats' => 7,
        'color' => 'Темно-серый',
        'features' => 'Камера 360°, Панорамная крыша, Навигация, Подогрев сидений'
    ]
];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Каталог автомобилей — АвтоМаркет</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Orbitron:wght@600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        html, body {
            height: 100%;
            font-family: 'Poppins', sans-serif;
            color: #fff;
            display: flex;
            flex-direction: column;
            background: url('images/background.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        header {
            background: rgba(0, 0, 0, 0.95);
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
            font-weight: 700;
            color: #ddd;
        }

        main {
            flex: 1;
            max-width: 1200px;
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
            margin-bottom: 30px;
        }

        .car-grid {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .car-card {
            background: rgba(0, 0, 0, 0.85);
            border-radius: 10px;
            width: 280px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.4);
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
        }

        .car-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.6);
        }

        .car-card img {
            width: 100%;
            height: 160px;
            object-fit: cover;
        }

        .car-card-content {
            padding: 15px;
            text-align: center;
            flex: 1;
        }

        .car-card-content h3 {
            color: #00d2ff;
            margin-bottom: 8px;
        }

        .car-card-content p {
            color: #ddd;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 8px;
        }

        .car-card-content .price {
            font-weight: 700;
            font-size: 16px;
            color: #00ff99;
            margin-bottom: 10px;
        }

        .buy-btn {
            background: #00d2ff;
            color: #000;
            border: none;
            padding: 10px 15px;
            margin: 10px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .buy-btn:hover {
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
    <p>Лучшие автомобили для вас!</p>
</header>

<main>
    <h2>Каталог автомобилей</h2>
    <div class="car-grid">
        <?php foreach ($cars as $car): ?>
            <div class="car-card">
                <img src="<?= $car['image'] ?>" alt="<?= htmlspecialchars($car['name']) ?>">
                <div class="car-card-content">
                    <h3><?= htmlspecialchars($car['name']) ?></h3>
                    <p><?= htmlspecialchars($car['description']) ?></p>
                    <p>Год выпуска: <?= $car['year'] ?> | Пробег: <?= $car['mileage'] ?> | Привод: <?= htmlspecialchars($car['drive']) ?> | Цвет: <?= htmlspecialchars($car['color']) ?></p>
                    <p>Особенности: <?= htmlspecialchars($car['features']) ?></p>
                    <p class="price"><?= $car['price'] ?></p>
                    <a class="buy-btn" href="buy.php?car=<?= urlencode($car['name']) ?>">Купить</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

    <footer>
        &copy; <?= date('Y') ?> АвтоМаркет — лучшие машины! Разработано с ❤️ <a href="#">AutoWeb</a>
    </footer>

</body>
</html>