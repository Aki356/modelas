<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include("connect.php");

$error_message = ""; // Переменная для хранения сообщения об ошибке

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $format = $_POST['format'];
    $size = $_POST['size'];
    $file = $_FILES['file']['name'];

    // Проверка на заполнение полей
    if (empty($title) || empty($format) || empty($size) || empty($file)) {
        $error_message = "Пожалуйста, заполните все поля.";
    } else {
        // Загрузка файла
        $target_dir = "material/uploads/"; // Директория для сохранения файлов
        $target_file = $target_dir . basename($file);

        // Перемещение загруженного файла
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
            // Запись информации о материале в базу данных
            $stmt = $conn->prepare("INSERT INTO materials (title, format, size, file_path) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $title, $format, $size, $target_file);

            if ($stmt->execute()) {
                echo "Material added successfully.";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Material</title>
</head>
<body>
    <h1>Add Material</h1>
    <?php if ($error_message): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Title" required>
        <input type="text" name="format" placeholder="Format (e.g., PDF, DOCX)" required>
        <input type="text" name="size" placeholder="Size (e.g., 1MB, 234KB)" required>
        <input type="file" name="file" accept=".pdf, .docx, .xlsx, .txt" required>
        <button type="submit">Add Material</button>
    </form>
    <a href="admin_panel.php">Back to Admin Panel</a>
</body>
</html>
