<?php
header('Content-Type: text/html; charset=utf-8');

$cidade = $_POST['cidadeContato'];
$site = "";
$nome = $_POST['name'];
$email = $_POST['email'];
$mensagem = $_POST['message'];
$msgFinal = "
<h4> Chegou uma mensagem no site! </h4>
<p><strong> Nome: </strong> $nome</p>
<p><strong> Cidade: </strong> $cidade</p>
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

if($nome == "" || $email == "" || $mensagem == ""){
	$msgOk = "Erro ao enviar a mensagem! Campo(s) vazio(s):<br>";
	if($nome == ""){
		$msgOk .= "<li class='aviso'>Nome</li>";
	}
	if($email == ""){
		$msgOk .= "<li class='aviso'>E-mail</li>";
	}
	if($mensagem == ""){
		$msgOk .= "<li class='aviso'>Mensagem</li>";
	}

}else{

	try {
		//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
		$mail->isSMTP();
		$mail->Host = '45.6.108.7';
		$mail->SMTPAuth = true;
		$mail->Username = 'contato@redetjnet.com.br';
		$mail->Password = 'Tjnet8284@';
		$mail->Port = 587;
		$mail->SMTPOptions = array(
	                    'ssl' => array(
	                        'verify_peer' => false,
	                        'verify_peer_name' => false,
	                        'allow_self_signed' => true
	                    )
	                );

		$mail->setFrom($email);
		$mail->addAddress('contato@redetjnet.com.br');
		$mail->AddCC($email);

		$mail->isHTML(true);
		$mail->CharSet = 'UTF-8';
		$mail->Encoding = 'base64';
		$mail->Subject = 'Mensagem enviada para TJNET';
		$mail->Body = $msgFinal;
		$mail->AltBody = $mensagem;

		if($mail->send()) {
			$msgOk = "Mensagem enviada com sucesso! <span class='aviso'>Verifique sua caixa de spam!</span>";
		} else {
			$msgOk = "Erro ao enviar a mensagem!";
		}
	} catch (Exception $e) {
			$msgOk = "Erro ao enviar a mensagem!";
	}

}

if($cidade == "Coxim"){
	$site = "cxm.php";
}

if($cidade == "Rio Verde"){
	$site = "rv.php";
}

if($cidade == "Pedro Gomes"){
	$site = "pgm.php";
}

if($cidade == "São Gabriel do Oeste"){
	$site = "sgo.php";
}

if($cidade == "Costa Rica"){
	$site = "crc.php";
}

require_once($site);
?>