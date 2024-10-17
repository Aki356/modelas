<?php 
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Будущий моделист-конструктор</title>
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
                <li><a href="view_materials.php">Материалы</a></li>
                <li><a href="#">Товары</a></li>
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
        <div class="top__number">
            <div class="top__pict">
                <img src="image/number.png" alt="">
            </div>
            <div class="top__text">
                <p><a href="tel:+79939312004">+79939312004</a></p>
            </div>
        </div>
            <!-- <div class="top__korz-account none_korz-account">
                <a class="korz-img" href="korzina.php"><img src="images/korz.png" alt=""></a>                
                <a class="account-img" href="<?= $account?>"><img src="<?= $photo_user?>" alt=""></a> -->
                <!-- <a href="auth.php"><img src="images/account.png" alt=""></a> -->
            <!-- </div> -->
            <!-- <div class="mob-btn">
                <img src="images/mob-btn.png" alt="">
            </div>
            <div class="mob-menu">
                <div class="mob-menu__logo">
                    <img src="images/logo.png" alt="">
                </div>
                <div class="mob-menu__top"></div>
                <div class="mob-menu__menu">
                    <ul>
                        <li><a href="menu.php">Меню</a></li>
                        <li><a href="contacts.php">Контакты</a></li>
                        <?php 
                        // if(!empty($_SESSION['login'])){
                        //     if($_SESSION['login'] == 'admin'){
                        //         echo $panel_a;
                        //         echo $all_orders;
                        //     }
                        // }
                        ?>
                    </ul>
                    
                    <div class="top__korz-account">
                        <a class="korz-img" href="korzina.php"><img src="images/korz.png" alt=""></a>                
                        <a class="account-img" href="<?= $account?>"><img src="<?= $photo_user?>" alt=""></a> -->
                        <!-- <a href="auth.php"><img src="images/account.png" alt=""></a> -->
                    <!-- </div>
                </div>
            </div> -->
        </div>
        <?php
        // error_reporting(E_ALL);
        // ini_set('display_errors', 'On');
        ?>
    </header>