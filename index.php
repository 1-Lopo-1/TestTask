<?php
    // Подключаем файл с настройками базы данных
    require 'connectDB.php';

    // Запрос для получение всех необходимых данных из 2-х таблиц, с их последующей группировкой
    $query = "SELECT c.*, col.name as collection_name 
              FROM cars c 
              JOIN collections col ON c.collection_id = col.id 
              ORDER BY col.id, c.id";
    // Выполнение запроса в бд
    $result = $connection->query($query);

    // Создание пустого списка для получение данных из запроса
    $collections = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $collections[$row['collection_name']][] = $row;
        }
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог автомобилей</title>
    <!-- Подключаем файл стилей -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <!-- Проверка на то что список не -->
        <?php if (empty($collections)): ?>
            <p>Коллекции пусты</p>
        <?php else: ?>
            <?php foreach ($collections as $collectionName => $cars): ?>
                <div class="grid">
                    <!-- Заголовок коллекции -->
                    <div class="collection-title">
                        <?= htmlspecialchars($collectionName) ?>
                    </div>
                    <!-- Карточки автомобилей -->
                    <?php foreach ($cars as $car): ?>
                        <div class="card">
                            <h3><?= htmlspecialchars($car['name']) ?></h3>
                            <div class="price"><?= number_format($car['price'], 0, ',', ' ') ?> ₽</div>
                            <div class="collection">Коллекция: <?= htmlspecialchars($collectionName) ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>