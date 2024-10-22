<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include("connect.php");

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    die("Product not found.");
}

// Обработка изменения товара
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $sku = $_POST['sku'];
    $description = $_POST['description'];
    $part_count = $_POST['part_count'];
    $age_group = $_POST['age_group'];
    $child_count = $_POST['child_count'];
    $file = $_FILES['image']['name']; // Получаем имя файла
    $update_file = false; // Флаг для обновления файла

    // Проверяем, загружается ли новый файл
    if (!empty($file)) {
        // Перемещение загруженного файла
        $target_dir = "product/uploads/"; // Директория для сохранения файлов
        $target_file = $target_dir . basename($file);

        // Получаем MIME-тип файла
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $_FILES['image']['tmp_name']);
        finfo_close($finfo);

        // Разрешенные MIME-типы для изображений
        $allowed_image_types = ['image/jpeg', 'image/png', 'image/gif'];

        if (in_array($mime_type, $allowed_image_types)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $update_file = true; // Устанавливаем флаг, если файл успешно загружен
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Недопустимый формат изображения. Пожалуйста, загружайте файлы формата JPEG, PNG или GIF.";
        }
    }

    // Обновляем информацию о товаре
    if ($update_file) {
        $stmt = $conn->prepare("UPDATE products SET name = ?, sku = ?, description = ?, part_count = ?, age_group = ?, child_count = ?, image = ? WHERE id = ?");
        $stmt->bind_param("ssiiisii", $name, $sku, $description, $part_count, $age_group, $child_count, $target_file, $id);
    } else {
        // Если файл не изменился, обновляем только заголовок, формат, описание и размер
        $stmt = $conn->prepare("UPDATE products SET name = ?, sku = ?, description = ?, part_count = ?, age_group = ?, child_count = ? WHERE id = ?");
        $stmt->bind_param("ssiiisi", $name, $sku, $description, $part_count, $age_group, $child_count, $id);
    }

    if ($stmt->execute()) {
        echo "Product updated successfully.";
        header("Location: manage_products.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
        <input type="text" name="sku" value="<?php echo htmlspecialchars($product['sku']); ?>" required>
        <textarea name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>
        <input type="number" name="part_count" value="<?php echo htmlspecialchars($product['part_count']); ?>" required>
        <input type="text" name="age_group" value="<?php echo htmlspecialchars($product['age_group']); ?>" required>
        <input type="number" name="child_count" value="<?php echo htmlspecialchars($product['child_count']); ?>" required>
        <input type="file" name="image" accept=".jpg,.jpeg,.png,.gif"> <!-- Поле для загрузки нового изображения -->
        <button type="submit">Update Product</button>
    </form>
    <h3>Current Image:</h3>
    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="Current Image" style="max-width: 200px;">
    <br>
    <a href="manage_products.php">Cancel</a>
</body>
</html>
