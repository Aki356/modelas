<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include("connect.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_FILES['image']['name'];

    // Проверка на заполнение полей
    if (empty($title) || empty($content)) {
        $error_message = "Пожалуйста, заполните все поля.";
    } elseif (empty($image)) {
        $error_message = "Пожалуйста, добавьте изображение.";
    } else {
        // Загрузка изображения
        $fileExtension = pathinfo($image, PATHINFO_EXTENSION);
        $newFilename = uniqid('news_', true) . '.' . $fileExtension;
        $target_dir = "image/uploads/"; // Директория для сохранения изображений
        $target_file = $target_dir . $newFilename;

        // Перемещение загруженного файла
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $stmt = $conn->prepare("INSERT INTO news (title, content, image) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $title, $content, $target_file);

            if ($stmt->execute()) {
                echo "News added successfully.";
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
    <title>Add News</title>
</head>
<body>
    <h1>Add News</h1>
    <?php if ($error_message): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="content" placeholder="Content" required></textarea>
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">Add News</button>
    </form>
</body>
</html>
