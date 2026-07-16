<?php
declare(strict_types=1);
session_start();ini_set('display_errors','0');header('Content-Type: application/json; charset=utf-8');
$lang=in_array($_POST['lang']??'fr',['fr','en','pt'],true)?$_POST['lang']:'fr';
$m=[
'fr'=>['invalid'=>'Requête invalide.','wait'=>'Veuillez patienter avant un nouvel envoi.','fields'=>'Vérifiez les champs obligatoires.','captcha'=>'La réponse anti-robot est incorrecte.','send'=>'Le message n’a pas pu être envoyé.','success'=>'Votre message a bien été envoyé.'],
'en'=>['invalid'=>'Invalid request.','wait'=>'Please wait before submitting another message.','fields'=>'Check the required fields.','captcha'=>'The anti-spam answer is incorrect.','send'=>'The message could not be sent.','success'=>'Your message has been sent.'],
'pt'=>['invalid'=>'Pedido inválido.','wait'=>'Aguarde antes de enviar outra mensagem.','fields'=>'Verifique os campos obrigatórios.','captcha'=>'A resposta anti-spam está incorreta.','send'=>'Não foi possível enviar a mensagem.','success'=>'A sua mensagem foi enviada.']
][$lang];
function out(bool $ok,string $message,int $code=200):never{http_response_code($code);echo json_encode($ok?['success'=>true,'message'=>$message]:['success'=>false,'errors'=>[$message]],JSON_UNESCAPED_UNICODE);exit;}
if($_SERVER['REQUEST_METHOD']!=='POST'||strcasecmp($_SERVER['HTTP_X_REQUESTED_WITH']??'','XMLHttpRequest')!==0)out(false,$m['invalid'],403);
if(!hash_equals($_SESSION['artful_csrf']??'',(string)($_POST['csrf_token']??''))||!empty($_POST['website']))out(false,$m['invalid'],403);
if(time()-(int)($_SESSION['artful_contact_last']??0)<45)out(false,$m['wait'],429);
$name=trim((string)($_POST['name']??''));$email=trim((string)($_POST['email']??''));$subject=trim((string)($_POST['subject']??''));$message=trim((string)($_POST['message']??''));$captcha=(int)($_POST['captcha']??0);
if($name===''||!filter_var($email,FILTER_VALIDATE_EMAIL)||$subject===''||$message===''||!isset($_POST['rgpd']))out(false,$m['fields'],422);
if(!isset($_SESSION['captcha'])||$captcha!==(int)$_SESSION['captcha'])out(false,$m['captcha'],422);
$clean=static fn(string $v):string=>str_replace(["\r","\n"],' ',strip_tags($v));
$body="Language: {$lang}\nName: ".$clean($name)."\nOrganisation: ".$clean((string)($_POST['organisation']??''))."\nEmail: ".$clean($email)."\nPhone: ".$clean((string)($_POST['phone']??''))."\nType: ".$clean((string)($_POST['motif']??''))."\n\n".$message;
$headers=['From: Artful Batina Creative Studios <contact@artfulbatinacreativestudios.fr>','Reply-To: '.$clean($email),'Content-Type: text/plain; charset=UTF-8'];
if(!mail('contact@artfulbatinacreativestudios.fr','[Artful '.strtoupper($lang).'] '.$clean($subject),$body,implode("\r\n",$headers)))out(false,$m['send'],500);
$_SESSION['artful_contact_last']=time();unset($_SESSION['captcha']);out(true,$m['success']);
