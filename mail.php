<?php

/************************************************************************************
 * Отправ каданных на e-mail
 ***********************************************************************************/

//Принимаем данные
$name=$_POST['user_name'];
$phone=$_POST['user_phone'];

//Тут указываем на какой ящик посылать письмо info@geotop.msk.ru
$to = "info@geotop.msk.ru";
//Далее идет тема и само сообщение
$subject = "Заказ звонка c geo-yar.ru";
$message = "
Форма с Ярославского сайта<br />
Указано:<br />Имя: ".htmlspecialchars($name)."<br />
Телефон: ".htmlspecialchars($phone);
$headers = "From: geo-yar.ru <geo-yar16@yandex.ru>\r\nContent-type: text/html; charset=utf8 \r\n";
if ($name!="") mail ($to, $subject, $message, $headers);
header("Location: ".$_SERVER['HTTP_REFERER']);
?>