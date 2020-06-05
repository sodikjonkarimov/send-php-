<?php
/**
 * Created by PhpStorm.
 * User: Sodikjon Karimov
 * Date: 20.06.2013
 * Time: 20:13
 */
//Aval Mailerni yuklab serverga joylang
require 'PHPMailerAutoload.php';
//Bu funksiya xabar yuboruvchining IPsini aniqlaydi
function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
 
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
      
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
 //https://github.com/PHPMailer/PHPMailer shu yerdan Mailer ko‘chirib olishingiz mumkun.   
$mail = new PHPMailer;

//$mail->SMTPDebug = 3;

$mail->isSMTP();

$mail->Host = 'localhost';
$mail->SMTPAuth = true;
$mail->Username = 'domendanochilgan@pochtangiz';
$mail->Password = 'parol';
$mail->Port = 25;
$mail->SMTPSecure = false;
$mail->SMTPAutoTLS = false;


////"noreplysiznindomening@.uz"
$mail->setFrom('', 'Mailer');
////"sizningpochtangiz@gmail va hakozo"
$mail->addAddress('Jo`natiladigan pochta');



$mail->isHTML(true);
//Umumiy mavzu
$mail->Subject = 'Mavzu: Murojaatnoma'; 
//Postlarda xatolik bo‘lmasligi uchun e’tiborli bo‘ling
$mail->Body    = "Telefon raqam: ".$_POST['phone']."\n<br/><br/>Ism: ".$_POST['name']."\n<br/><br/>Xabarnoma: ".$_POST['message']."\n<br/><br/>IP manzil: ".$_SERVER['REMOTE_ADDR']."\n<br/><br/>";
$mail->AltBody = strip_tags($mail->Body);
$phone = $_POST['phone'];
$phone = htmlspecialchars($phone);
$phone = urldecode($phone);
$phone = trim($phone);

//Ip manzil kerak bo‘lmasa uni shunchaki o‘chirib qo‘yishingiz mumkin 


//Sahifani o'zida alert berish xohlasangiz HTML sahifani o‘zida qo‘ying 
if(!$mail->send()) {
    echo 'Xabar yuborilmadi';
    echo 'Xatolik aniqlandi: ' . $mail->ErrorInfo;
} else {
  echo '<script language="javascript">';
echo 'alert("Murojattingiz qabul qilindi!")';
echo '</script>';
//Yuborilgandan so‘ng kerakli sahifaga yo‘naltirish P.S. Bu yerda bosh sahifa ko‘rsatilgan
header("refresh:1;url=index.html");   
}