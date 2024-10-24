</div>
<!-- Модальное окно -->
<div id="modal" class="modal" onclick="hideModal();">
      <span class="close">&times;</span>
      <div class="modal-content">
        <img id="modal-image">
      </div>
    </div>
<footer>
        <div class="bottom">
            <div class="footer__logo">
                <img src="image/logo.png" alt="">
            </div>
            <div class="footer__menu">
                <ul>
                    <!-- <li><a href="menu.php">Меню</a></li>
                    <li><a href="contacts.php">Контакты</a></li> -->
                </ul>
            </div>
            <p>Все права защищены</p>
        </div>
    </footer>
    
    <script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
    <!-- <script src="vendors/slick/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://snipp.ru/cdn/maskedinput/jquery.maskedinput.min.js"></script>
    <script src="js/main.js"> </script>
    <script src="js/js.js"></script> -->
    <script>
        // Получаем элементы модального окна и изображения
        const modal = document.getElementById("modal");
        const modalImage = document.getElementById("modal-image");

        // Отображаем модальное окно и устанавливаем источник изображения
        function displayModal(img)
        {
            modal.style.display = "block";
            modalImage.src = img.src;
        }

        // Скрываем содержимое модального окна, если пользователь кликнул вне его
        function hideModal()
        {  
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    <script type="text/javascript">
    $(document).ready(function(){ //Вызов функции по загрузке интерфейса
    var tempScrollTop, currentScrollTop = $(window).scrollTop(); //объявление переменных и присвоение им значений
    $(window).scroll(function(){ //Вызов функции при прокрутке страницы
        currentScrollTop = $(window).scrollTop(); //присвоение переменной нового значения
        if (currentScrollTop > $('header').height()) { //Проверка условия 'переменная больше высоты шапки'
            $('body').addClass('fixed-header'); // создание класса 'fixed-header' в селекторе 'body'
            if ( tempScrollTop > currentScrollTop ) { //Проверка условия 'значение переменной до вызова функции больше значения после её вызова'
            $('header').addClass('show'); //создание класса 'show' в селекторе 'header'
            } else { // выполнение, если второе условие не прошло проверку
            $('header').removeClass('show'); //удаление класса 'show' в селекторе 'header'
            }
        } else { // выполнение, если первое условие не прошло проверку
            $('body').removeClass('fixed-header'); // удаление класса 'fixed-header' в селекторе 'body'
            $('header').removeClass('show'); //удаление класса 'show' в селекторе 'header'
        }
            tempScrollTop = currentScrollTop; //присвоение одной переменной значение другой
    });
    });
    </script>
    <!-- <script>
        $('.mask-phone').mask('+7 (999) 999-99-99');
    </script>
    <script>
    if(sessionStorage.getItem("message")){
        alert(sessionStorage.getItem("message"));
        sessionStorage.removeItem("message");
    }
</script> -->
</body>
</html>