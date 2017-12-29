<?php
	if($_POST){
		$to_Email = "rsp@yandex.ru"; 
		$subject = 'Запрос обратного звонка '.$_POST["user_name"]; 

		if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {

			$answer_serv = json_encode(
				array( 'text' => 'Возникла ошибка при отправке данных'
				)
			);

			die($answer_serv);
		} 

	if(!isset($_POST["user_name"]) || !isset($_POST["user_phone"])) {
		$answer_serv = json_encode(array('type'=>'error', 'text' => 'Заполните форму'));
	
	die($answer_serv);
	}

	$user_Name = filter_var($_POST["user_name"], FILTER_SANITIZE_STRING);
	$user_Phone = filter_var($_POST["user_phone"], FILTER_SANITIZE_STRING);

	if(strlen($user_Name)<3){

		$answer_serv = json_encode(array('text' => 'Поле Имя слишком короткое или пустое'));
		die($answer_serv);
	}
	
	if(!is_numeric($user_Phone)){
		$answer_serv = json_encode(array('text' => 'Номер телефона может состоять только из цифр'));
	
		die($answer_serv);
	}

	$message = "Имя: ".$user_Name.". Телефон: ".$user_Phone;

	if(!mail($to_Email, $subject, $message, "From: rsp@yandex.ru \r\n")){
		$answer_serv = json_encode(array('text' => 'Не могу отправить почту! Пожалуйста, проверьте ваши настройки PHP почты.'));
	die($answer_serv);
	}
	else{
		$answer_serv = json_encode(array('text' => 'Спасибо! '.$user_Name .', ваше сообщение отправлено.'));
	
		die($answer_serv);
	}
	}
?>