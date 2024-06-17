// Получаем элементы модального окна и кнопки закрытия
var modal = document.getElementById("myModal");
var modalMessage = document.getElementById("modalMessage");
var closeBtn = document.getElementById("closeBtn");

// Получаем форму и добавляем обработчик на отправку
var form = document.getElementById("bookingForm");
form.addEventListener("submit", function(event) {
    event.preventDefault(); // Отменяем стандартное действие отправки формы

    // Создаем объект FormData для сбора данных формы
    var formData = new FormData(this);

    // Отправляем данные на сервер через AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "submit_booking.php", true);
    xhr.onload = function() {
        // По окончании отправки данных, отображаем модальное окно
        modal.style.display = "block";
    };
    xhr.onerror = function() {
        console.error("Ошибка при отправке данных на сервер.");
    };
    xhr.send(formData);
});

// Закрытие модального окна при клике на крестик или кнопку "Замечательно"
closeBtn.onclick = function() {
    modal.style.display = "none";
};

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};
