<?php
$servername = "localhost";
$username = "vovchip7_12";
$password = "w7&Kqpmt";
$dbname = "vovchip7_12";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$participants = $_POST['participants'];
$remarks = $_POST['remarks'];
$tour = $_POST['tour'];

$sql = "INSERT INTO bookings (name, email, phone, participants, remarks, tour)
VALUES ('$name', '$email', '$phone', '$participants', '$remarks', '$tour')";

if ($conn->query($sql) === TRUE) {
    // Формирование сообщения для отправки по email
    $to = $email;
    $subject = "Подтверждение бронирования на тур";
    $message = "
    <html>
    <head>
        <title>Подтверждение бронирования</title>
    </head>
    <body>
        <h2>Добро пожаловать в Wanderlust Adventures!</h2>
        <p>Уважаемый(ая) $name,</p>
        <p>Вы успешно записались на тур <strong>$tour</strong>.</p>
        <p>Пожалуйста, приходите по адресу: ул. Пку, дом 13б, чтобы продолжить оформление записи.</p>
        <p>Рабочие часы: с понедельника по субботу с 10:00 до 19:30.</p>
        <p>Ваши данные:</p>
        <ul>
            <li><strong>Имя:</strong> $name</li>
            <li><strong>Email:</strong> $email</li>
            <li><strong>Телефон:</strong> $phone</li>
            <li><strong>Количество участников:</strong> $participants</li>
            <li><strong>Замечания:</strong> $remarks</li>
        </ul>
        <p>Спасибо, что выбрали нас! До встречи на туре.</p>
        <p>С наилучшими пожеланиями,<br>Команда Wanderlust Adventures</p>
    </body>
    </html>";

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: Wanderlust-adventure@gmail.com" . "\r\n";

    if(mail($to, $subject, $message, $headers)) {
    }
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>