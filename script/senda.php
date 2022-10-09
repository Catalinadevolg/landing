<?php
 if($_POST)
 {
 $to_Email = "mrv@globalsctrans.ru"; 
 $subject = 'Запрос обратного звонка '.$_POST["polz_name"]; 

 if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {

 $otvet_serv = json_encode(
 array( 
 'text' => 'Возникла ошибка при отправке данных'
 ));

 die($otvet_serv);
 } 

 if(!isset($_POST["polz_name"]) || !isset($_POST["polz_tel"]))
 {
 $otvet_serv = json_encode(array('type'=>'error', 'text' => 'Заполните форму'));
 die($otvet_serv);
 }

 $user_Name = htmlspecialchars($_POST["polz_name"]);
 $user_Phone = htmlspecialchars($_POST["polz_tel"]);
 
 $user_Name = urldecode($user_Name);
 $user_Phone = urldecode($user_Phone);
 
 $user_Name = trim($user_Name);
 $user_Phone = trim($user_Phone);

 //$user_Name = filter_var($_POST["polz_name"], FILTER_SANITIZE_STRING);
 //$user_Phone = filter_var($_POST["polz_tel"], FILTER_SANITIZE_STRING);

 if(strlen($user_Name)<3)
 {
 $otvet_serv = json_encode(array('text' => 'Поле Имя слишком короткое или пустое'));
 die($otvet_serv);
 }
 if(!is_numeric($user_Phone))
 {
 $otvet_serv = json_encode(array('text' => 'Номер телефона может состоять только из цифр'));
 die($otvet_serv);
 }

 $message = "Имя: ".$user_Name.". Телефон: ".$user_Phone;

 if(!mail($to_Email, $subject, $message, "From: gsc@globalsctrans.ru \r\n"))
 {
 $otvet_serv = json_encode(array('text' => 'Не могу отправить почту! Пожалуйста, проверьте ваши настройки PHP почты.'));
 die($otvet_serv);
 }else{
 $otvet_serv = json_encode(array('text' => 'Спасибо! '.$user_Name .', ваше сообщение отправлено.'));
 die($otvet_serv);
 }
 }
 ?>