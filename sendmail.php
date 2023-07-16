<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';

$mail = new HPHMailer(true);
$mail->CharSet = 'UTF-8';
$mail->setLanguage('uk', 'phpmailer/language/');
$mail->IsHTML(true);

//від кого лист
$mail->setForm('', 'Клієнт');
//Кому відправити
$mail->addAddress('fox.amnel.@gmail.com');
//Тема листа
$mail->Subject = 'Новий запис';

//Тіло листа
$body = '<h1>У вас новий запис</h1>';

if(trim(!empty($_POST['name']))) {
    $body.='<p><strong>Name:</strong>'.$_POST['name'].'</p>';
}
if(trim(!empty($_POST['email']))) {
    $body.='<p><strong>E-mail:</strong> '.$_POST['email'].'</p>';
}

if(trim(!empty($_POST['message']))) {
    $body.='<p><strong>Повідомлення:</strong> '.$_POST['message'].'</p>';
}

$mail->Body = $body;

//Відправляємо
if (!&mail->send()) {
    $message = 'Помилка';
} else {
    $message = 'Данні відправлені!';
}

$response = ['message' => $message];

header('Content-type: application/json');
echo json_encode($response);
?>