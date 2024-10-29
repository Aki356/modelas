<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> -->
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="css/style.css">
    <title>Будущий моделист-конструктор</title>
</head>
<body>
    <a href="login.php">Авторизация админа</a><br>
    <a href="admin_panel.php">Админ панель</a><br>
    <a href="news.php">Новости</a><br>
    <a href="add_news.php">Добавить новость</a><br>
</body>
</html> -->

<?php $title_page = "Будущий моделист-конструктор";
include("src/head.php"); ?>
<div class="section1__bg">
    <img src="image/backgrounds/section1_bg.svg" alt="">
</div>
<div class="description container">
    <div class="description-div">
        <h1>ОБРАЗОВАТЕЛЬНОЕ РЕШЕНИЕ <br>
        <span>"БУДУЩИЙ МОДЕЛИСТ-КОНСТРУКТОР"</span></h1>
        <p>Учебно-методический комплекс по развитию компетенций начального технического моделирования "Будущий моделист-конструктор"<!-- набор предназначен для занятий в системе дополнительного образования и/или внеурочной деятельности образовательной организации-->.</p>
        <div class="btn-y-o section1-btn">
            <a href="about_us.php">Узнать больше ></a>
        </div>
    </div>
</div>
<div class="video_description container">
    <div class="video_description-iframe">
        <iframe
            width="720"
            height="405"
            src="https://rutube.ru/play/embed/0c62410f478f6fa79d68ad8b6aa73374"
            frameBorder="0"
            allow="clipboard-write; autoplay"
            webkitAllowFullScreen
            mozallowfullscreen
            allowFullScreen >
        </iframe>
    </div>
    <div class="video_description-div">
        <p>
        Набор "Будущий моделист-конструктор" предназначен для занятий в системе дополнительного образования и/или внеурочной деятельности образовательной организации и решает одну из основных задач по организации работы образовательных программ технической направленности без использования специального дорогостоящего оборудования, что способствует увеличению вовлеченности детей в техническое творчество. Также комплекс может быть использован при необходимости организации профильных лагерных смен, в том числе дневного пребывания на базе образовательной организации.
        </p>
    </div>
</div>
<div class="advantage container">
    <ul class="advantage_ul">
        <!-- <div class="section2__advantage_ul-li">
            <div><img src="image/team-work.png" alt=""></div>
            <li>решает одну из основных задач по организации работы образовательных программ технической направленности без использования специального дорогостоящего оборудования</li>
        </div> -->
        <div class="advantage_ul-li">
            <div><img src="image/puzzle.png" alt=""></div>
            <li>Способствует увеличению вовлеченности детей в техническое творчество</li>
        </div>
        <div class="line-v"></div>
        <div class="advantage_ul-li">
            <div><img src="image/tick.png" alt=""></div>
            <li>Готовая материально-техническая база для проведения занятий и соревнований</li>
        </div>
        <div class="line-v"></div>
        <div class="advantage_ul-li">
            <div><img src="image/education.png" alt=""></div>
            <li>Подготовка педагогов к занятиям в формате стажировок</li>
        </div>
        <div class="line-v"></div>
        <div class="advantage_ul-li">
            <div><img src="image/parent.png" alt=""></div>
            <li>Увеличение привлекательности учреждения для детей и родителей</li>
        </div>
        <div class="line-h"></div>
        <div class="advantage_ul-li">
            <div><img src="image/patriotism.png" alt=""></div>
            <li>Включение в программу патриотического воспитания школы</li>
        </div>
        <div class="line-v"></div>
        <div class="advantage_ul-li">
            <div><img src="image/science.png" alt=""></div>
            <li>Знакомство обучающихся с основами аэродинамики, основными математическими и физическими законами в процессе увлекательных занятий</li>
        </div>
        <div class="line-v"></div>
        <div class="advantage_ul-li">
            <div><img src="image/selection.png" alt=""></div>
            <li>Модели проектировались и отбирались подготовленными специалистами по модельному спорту и опытными педагогами</li>
        </div>
        <div class="line-v"></div>
        <div class="advantage_ul-li">
            <div><img src="image/evolution.png" alt=""></div>
            <li>Каждая модель логически следует из предыдущей по принципу от простого к сложному</li>
        </div>
    </ul>
</div>
<div class="educational_programs container">
    <h2>Учебные программы</h2>
    <div class="educational_programs__programs">
        <div class="educational_programs__container image-wrapper">
            <div class="educational_programs__program ">
                <img class="hover-image" src="image/backgrounds/section4_div1.jpg" alt="">
            </div>
            <p>Дополнительное образование</p>
            <div class="tooltip">
                <ul>
                    <li>Начальное техническое моделирование<div class="tooltip-l"> | 144 часа</div></li>
                    <li>Авиамоделирование<div class="tooltip-l"> | 36 часов</div></li>
                    <li>Судомоделирование<div class="tooltip-l"> | 36 часов</div></li>
                    <li>Автомоделирование<div class="tooltip-l"> | 36 часов</div></li>
                </ul>
            </div>
        </div>
        <div class="educational_programs__container image-wrapper">
            <div class="educational_programs__program ">
                <img class="hover-image" src="image/backgrounds/section4_div2.jpg" alt="">
            </div>
            <p>Профильные смены</p>
            <div class="tooltip">
                <ul>
                    <li>Техническое моделирование<div class="tooltip-l"> | 12 часов</div></li>
                    <li>Авиамоделирование<div class="tooltip-l"> | 12 часов</div></li>
                    <li>Компьютерное моделирование и программирование<div class="tooltip-l"> | 12 часов</div></li>
                    <li>Автомоделирование<div class="tooltip-l"> | 12 часов</div></li>
                    <li>Авиа-, автомоделирование<div class="tooltip-l"> | 12 часов</div></li>
                </ul>
            </div>
        </div>
        <div class="educational_programs__container image-wrapper">
            <div class="educational_programs__program ">
                <img class="hover-image" src="image/backgrounds/section4_div3.jpg" alt="">
            </div>
            <p>Инженерные классы</p>
            <div class="tooltip">
                <ul>
                    <li>Инженер авиастроительного профиля (5 класс)<div class="tooltip-l"> | 70 часов</div></li>
                    <li>Авиамоделирование<div class="tooltip-l"> | 36 часов</div></li>
                    <li>Компьютерное моделирование и программирование<div class="tooltip-l"> | 68 часов</div></li>
                </ul>
            </div>
        </div>
        <div class="educational_programs__container image-wrapper">
            <div class="educational_programs__program hover-image">
                <img src="image/backgrounds/section4_div4.jpg" alt="">
            </div>
            <p>Уроки технологии</p>
            <div class="tooltip" >
                <ul>
                    <li>Начальное техническое моделирование<div class="tooltip-l"> | 12 часов</div></li>
                    <li>Авиа-, автомоделирование<div class="tooltip-l"> | 12 часов</div></li>
                    <li>Авиамоделирование<div class="tooltip-l"> | 12 часов</div></li>
                    <li>Судомоделирование<div class="tooltip-l"> | 12 часов</div></li>
                    <li>Автомоделирование<div class="tooltip-l"> | 12 часов</div></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="communicate container">
    <div class="communicate__container">
        <h2>Появились вопросы?</h2>
        <p>Оставьте ваше сообщение, а мы вам обязательно перезвоним</p>
        <div class="btn-brown-white">
            <a href="#">Написать нам ></a>
        </div>
    </div>
</div>
<div class="news container">

</div>
<div class="products container">

</div>
<div class="methodological_support container">
    <h2>Методическое сопровождение</h2>
    <h3>Стажировки для педагогов</h3>
    <p>Для ознакомления с готовой методикой обучения и принципами работы с моделями для педагогов устраивается бесплатная стажировка.</p>
</div>

<?php include("src/footer.php"); ?>