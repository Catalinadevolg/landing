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

 if(!isset($_POST["polz_name"]) || !isset($_POST["polz_email"]) || !isset($_POST["polz_message"]))
 {
 $otvet_serv = json_encode(array('type'=>'error', 'text' => 'Заполните форму'));
 die($otvet_serv);
 }

 $user_Name = htmlspecialchars($_POST["polz_name"]);
 $user_Email = htmlspecialchars($_POST["polz_email"]);
 $user_Message = htmlspecialchars($_POST["polz_message"]);
 
 $user_Name = urldecode($user_Name);
 $user_Email = urldecode($user_Email);
 $user_Message = urldecode($user_Message);
 
 $user_Name = trim($user_Name);
 $user_Email = trim($user_Email);
 $user_Message = trim($user_Message);

 //$user_Name = filter_var($_POST["polz_name"], FILTER_SANITIZE_STRING);
 //$user_Email = filter_var($_POST["polz_email"], FILTER_SANITIZE_STRING);
 //$user_Message = filter_var($_POST["polz_message"], FILTER_SANITIZE_STRING);

 if(strlen($user_Name)<3)
 {
 $otvet_serv = json_encode(array('text' => 'Поле Имя слишком короткое или пустое'));
 die($otvet_serv);
 }
  if(!filter_var($user_Email, FILTER_VALIDATE_EMAIL))
 {
 $otvet_serv = json_encode(array('text' => 'E-mail указан неверно'));
 die($otvet_serv);
 }

 $message = "Имя: ".$user_Name.". E-mail: ".$user_Email.". Сообщение: ".$user_Message;

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