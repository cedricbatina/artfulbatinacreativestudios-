<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//use PHPMailer\PHPMailer\SMTP;

require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
require './PHPMailer/src/Exception.php';
//require_once "modules/class.phpmailer.php";
//require_once('modules/class.smtp.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 $name = $_POST['name'];
 $email = $_POST['email'];
 $message = $_POST['message'];
 $mail = new PHPMailer(true);
 try {
  // Configuration du serveur SMTP
  $mail->SMTPDebug = 2;
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'cedricbatina2021@gmail.com';
  $mail->Password = 'Elijahbatina@2008';
  $mail->Port = 587;
  $mail->SMTPSecure = 'tls';
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Accepter SSL

  // Configuration de l'email
  $mail->setFrom($_POST['email'], $_POST['name']);
  $mail->addAddress('cedricbatina2021@gmail.com', 'Cédric Batina');
  $mail->Subject = 'Message du site web Artful Batina Creative Studios';
  $mail->Body = $_POST['message'];
  // Envoi de l'email
  $mail->send();
  echo 'Message envoyé avec succès';
 } catch (Exception $e) {
  echo "Erreur lors de l'envoi du message: {$mail->ErrorInfo}";
  //echo $_POST['name'];
  //echo $_POST['email'];
  //echo $_POST['message'];
 }
 //$mail->smtpClose();
}
