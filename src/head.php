<?php 
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            <?php 
            if($title_page == ""  || empty($title_page)){
                echo "Будущий моделист-конструктор";
            }
            else{
                echo $title_page;
            }
            ?>
        </title>
        <!-- <link rel="stylesheet" href="vendors/slick/slick.css">
        <link rel="stylesheet" href="vendors/slick/slick-theme.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/mobile.css">
        <link rel="icon" href="image/logo.jpg">
        <script>
            if (typeof sessionStorage === 'undefined') {
                alert("sessionStorage не работает!");
            }
            </script>
</head>
<body>
    <!-- <div id="preloader">
        <div class="spinner"></div>
    </div> -->
    <header>
        <div class="top container">
            <div class="top__logo">
                <a href="index.php"><img src="image/logo.jpg" alt="Логотип"></a>
            </div>
            <div class="top__menu">
                <ul>
                    <li><a href="about_us.php">О комплексе</a></li>
                    <li><a href="view_materials.php">Материалы</a></li>
                    <li><a href="view_products.php">Товары</a></li>
                    <li><a href="news.php">Новости</a></li>
                    <?php 
            // if(!empty($_SESSION['login'])){
                //     if($_SESSION['login'] == 'admin'){
                    //         echo $panel_a;
                    //         echo $all_orders;
                    //     }
                    // }
                    ?>
            </ul>
        </div>
        <div class="top__email_number">
            <div class="top__number">
                <div class="top__pict">
                    <img src="image/phone-call.png" alt="Телефон">
                </div>
                <div class="top__text">
                    <p><a href="tel:+79939312004">+79939312004</a></p>
                </div>
            </div>
            <div class="top__email">
                <p><a href="mailto:lubovv.glotova@yandex.ru">lubovv.glotova@yandex.ru</a></p>
            </div>
        </div>
        
    </header>
    <div class="classBody">