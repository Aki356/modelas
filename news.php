<?php
include("connect.php");


$result = $conn->query("SELECT * FROM news ORDER BY created_at DESC");
?>
<?php $title_page = "Новости сайта";
include("src/head.php"); ?>
    <div class="directory_path container">
        <ul>
            <li>
                <a href="index.php">Главная</a>
            </li>
            <li>
                <span>Новости</span>
            </li>
        </ul>
    </div>
    <div class="news container">
        <h1>Новости</h1>
        <div class="news__items">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="news__item">
                <a href="news_detail.php?id=<?php echo $row['id']; ?>">
                    <div class="news__item-img">
                        <?php if ($row['image']): ?>
                            <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>">
                        <?php endif; ?>
                    </div>
                </a>
                <p class="news__date"><?php echo $row['created_at']; ?></p>
                <p><a class="news-h2" href="news_detail.php?id=<?php echo $row['id']; ?>">
                    <?php echo $row['title']; ?>
                </a></p>
            </div>
        <?php endwhile; ?>
        </div>
    </div>

<?php include("src/footer.php"); ?>

<!-- <!DOCTYPE html>
<html>
<head>
    <title>News</title>
    <style>
        
    </style>
</head>
<body>
    
</body>
</html> -->

<?php
$conn->close();
?>