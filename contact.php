<?php
header('Content-Type: text/html; charset=utf-8');

$nome = $_POST['name'];
$email = $_POST['email'];
$mensagem = $_POST['message'];
$msgFinal = "
<h4> Chegou uma mensagem no seu site! </h4>
<p><strong> Nome: </strong> $nome </p>
<p><strong> E-mail: </strong> $email </p>
<p><strong> Mensagem: </strong> $mensagem </p>			
";

require_once('src/PHPMailer.php');
require_once('src/SMTP.php');
require_once('src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
	//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'eitorbernardes@gmail.com';
	$mail->Password = 'charmander';
	$mail->Port = 587;

	$mail->setFrom('eitorbernardes@gmail.com');
	$mail->addAddress('eitorbernardes@gmail.com');

	$mail->isHTML(true);
	$mail->Subject = 'Chegou uma mensagem para você!';
	$mail->Body = $msgFinal;
	$mail->AltBody = $mensagem;

	if($mail->send()) {
		echo 'Email enviado com sucesso';
	} else {
		echo 'Email nao enviado';
	}
} catch (Exception $e) {
	echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
}

header('Location: index.html');