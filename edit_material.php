<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include("connect.php");

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM materials WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $material = $result->fetch_assoc();
} else {
    die("Material not found.");
}

// Обработка изменения материала
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $format = $_POST['format'];
    $size = $_POST['size'];
    $file = $_FILES['file']['name'];
    $target_dir = "material/uploads/"; // Директория для сохранения файлов
    $target_file = $target_dir . basename($file);
    $update_file = false; // Флаг для обновления файла

    // Проверяем, загружается ли новый файл
    if (!empty($file)) {
        // Получаем MIME-тип файла
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $_FILES['file']['tmp_name']);
        finfo_close($finfo);

        // Разрешенные MIME-типы
        $allowed_types = ['application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'text/plain'];

        if (in_array($mime_type, $allowed_types)) {
            // Перемещение загруженного файла
            if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                $update_file = true; // Устанавливаем флаг, если файл успешно загружен
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Недопустимый формат файла. Пожалуйста, загружайте файлы формата PDF, DOCX, XLSX или TXT.";
        }
    }

    // Обновляем информацию о материале
    if ($update_file) {
        $stmt = $conn->prepare("UPDATE materials SET title = ?, format = ?, size = ?, file_path = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $title, $format, $size, $target_file, $id);
    } else {
        // Если файл не изменился, обновляем только заголовок, формат и размер
        $stmt = $conn->prepare("UPDATE materials SET title = ?, format = ?, size = ? WHERE id = ?");
        $stmt->bind_param("ssii", $title, $format, $size, $id);
    }

    if ($stmt->execute()) {
        echo "Material updated successfully.";
        header("Location: manage_materials.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
<?php $title_page = "Редактировать материалы";
include("src/head.php"); ?>

    <h1>Edit Material</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="title" value="<?php echo htmlspecialchars($material['title']); ?>" required>
        <input type="text" name="format" value="<?php echo htmlspecialchars($material['format']); ?>" required>
        <input type="text" name="size" value="<?php echo htmlspecialchars($material['size']); ?>" required>
        <input type="file" name="file" accept=".pdf, .docx, .xlsx, .txt"> <!-- Поле для загрузки нового файла -->
        <button type="submit">Update Material</button>
    </form>
    <h3>Current File:</h3>
    <a href="<?php echo $material['file_path']; ?>" download>Download Current File</a>
    <br>
    <a href="manage_materials.php">Cancel</a>

<?php include("src/footer.php"); ?>
<!-- <!DOCTYPE html>
<html>
<head>
    <title>Edit Material</title>
</head>
<body>
    
</body>
</html> -->