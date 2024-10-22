<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include("connect.php");

$error_message = ""; // Переменная для хранения сообщения об ошибке


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $sku = $_POST['sku'];
    $description = $_POST['description'];
    $part_count = $_POST['part_count'];
    $age_group = $_POST['age_group'];
    $child_count = $_POST['child_count'];
    $file = $_FILES['image']['name']; // Получаем имя файла

    // Проверка на заполнение полей
    if (empty($name) || empty($sku) || empty($description) || empty($part_count) || empty($age_group) || empty($child_count) || empty($file)) {
        $error_message = "Пожалуйста, заполните все поля.";
    } else {
        // Перемещение загруженного файла
        $target_dir = "product/uploads/"; // Директория для сохранения файлов
        $target_file = $target_dir . basename($file);

        // Получаем MIME-тип и размер файла
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $_FILES['image']['tmp_name']);
        finfo_close($finfo);

        // Разрешенные MIME-типы для изображений
        $allowed_image_types = ['image/jpeg', 'image/png', 'image/gif'];

        if (in_array($mime_type, $allowed_image_types)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                // Запись информации о товаре в базу данных
                $stmt = $conn->prepare("INSERT INTO products (name, sku, description, part_count, age_group, child_count, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssiiss", $name, $sku, $description, $part_count, $age_group, $child_count, $target_file);

                if ($stmt->execute()) {
                    echo "Product added successfully.";
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Недопустимый формат изображения. Пожалуйста, загружайте файлы формата JPEG, PNG или GIF.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>
    <h1>Add Product</h1>
    <?php if ($error_message): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="text" name="sku" placeholder="SKU" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="number" name="part_count" placeholder="Part Count" required>
        <input type="text" name="age_group" placeholder="Age Group" required>
        <input type="number" name="child_count" placeholder="Child Count" required>
        <input type="file" name="image" accept=".jpg,.jpeg,.png,.gif" required> <!-- Поле для загрузки изображения -->
        <button type="submit">Add Product</button>
    </form>
    <a href="admin_panel.php">Back to Admin Panel</a>
</body>
</html>
