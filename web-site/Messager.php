<?php
$servername = "localhost";
$username = "vovchip7_12";
$password = "w7&Kqpmt";
$dbname = "vovchip7_12";

// Создаем подключение к базе данных
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получаем данные из формы
$name = $_POST['name'];
$email = $_POST['email'];
$country = $_POST['country'];
$remarks = $_POST['remarks'];

// Подготавливаем SQL запрос для вставки данных в таблицу
$sql = "INSERT INTO messages (name, email, country, remarks) VALUES ('$name', '$email', '$country', '$remarks')";

// Выполняем запрос
if ($conn->query($sql) === TRUE) {
    // Формируем сообщение для отправки по email
    $to = $email;
    $subject = "Подтверждение отправки сообщения";
    $message = "Дорогой(ая) $name,\n\n";
    $message .= "Ваше сообщение успешно получено.\n";
    $message .= "Мы свяжемся с вами в ближайшее время.\n\n";
    $message .= "С уважением,\nКоманда Wanderlust Adventures";

    // Отправляем письмо
    $headers = "From: no-reply@wanderlustadventures.com\r\n";
    $headers .= "Reply-To: no-reply@wanderlustadventures.com\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($to, $subject, $message, $headers)) {
        // Возвращаем успешный HTTP статус
        http_response_code(200);
    } else {
        // Возвращаем ошибку сервера при отправке письма
        http_response_code(500);
        echo "Ошибка при отправке письма.";
    }
} else {
    // Возвращаем ошибку сервера при сохранении в базу данных
    http_response_code(500);
    echo "Ошибка при сохранении сообщения: " . $conn->error;
}

// Закрываем соединение с базой данных
$conn->close();
?>
