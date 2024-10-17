<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Обработка выхода из аккаунта
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php'); // Перенаправление на страницу входа
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Админ панель</title>
</head>
<body>
    <h1>Админ панель</h1>
    <h2>Управление новостями</h2>
    <ul>
        <li><a href="news.php">Просмотреть все новости</a></li>
        <li><a href="add_news.php">Добавить Новости</a></li>
        <li><a href="manage_news.php">Управление существующими новостями</a></li>
    </ul>
      <h2>Управление материалами</h2>
    <ul>
        <li><a href="add_material.php">Добавить новый материал</a></li>
        <li><a href="manage_materials.php">Управление существующими материалами</a></li>
         <li><a href="view_materials.php">Просмотр материалов для пользователей</a></li> <!-- Добавленная ссылка -->
    </ul>
    </ul>
    <form method="get" action="">
        <button type="submit" name="logout">Выйти</button>
    </form>
</body>
</html>
