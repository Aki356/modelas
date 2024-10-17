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
    <!-- <script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script> -->
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