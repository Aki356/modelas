<?php
session_start();

// Если пользователь уже авторизован, перенаправляем на админ-панель
if (isset($_SESSION['username'])) {
    header('Location: admin_panel.php');
    exit();
}

include("connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        
        if (password_verify($password, $hashed_password)) {
            $_SESSION['username'] = $username;
            header('Location: admin_panel.php'); // Перенаправление на админ-панель
            exit();
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "No user found with that username.";
    }

    $stmt->close();
}

$conn->close();
?>

<?php $title_page = "Вход в панель администратора";
include("src/head.php"); ?>

<form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

<?php include("src/footer.php"); ?>

<!-- <!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>
    
</body>
</html> -->
