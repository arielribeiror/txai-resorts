<?php 

$send_email_to = "ariiel.ribeiro@gmail.com";
$email_subject = "Formulário do Site";

/*Tipo de quebra de linha*/
if(PATH_SEPARATOR == ";") $quebra_linha = "\r\n"; //Se for Windows
else $quebra_linha = "\n"; //Se "não for Windows"

$email = $_POST['email'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$text = $_POST['msg'];

if (($_POST['cd-checkbox-1']) == 'newsletter' ) {
	$newsletter = 'Sim';
} else {
	$newsletter = 'Não';
}

$emailsender = $email;
 
$headers = "MIME-Version: 1.1" .$quebra_linha;
$headers .= 'Content-type: text/html; charset=UTF-8' .$quebra_linha;
$headers .= "From: ".$emailsender.$quebra_linha;
$headers .= "Reply-To: " . $email . $quebra_linha;

$headersautoreply = "MIME-Version: 1.0" .$quebra_linha;
$headersautoreply .= 'Content-type: text/html; charset=UTF-8' .$quebra_linha;
$headersautoreply .= "From: ".$emailsender.$quebra_linha;
$headersautoreply .= "Reply-To: " . $emailsender . $quebra_linha;

$messageautoreply .= 'Obrigado pelo contato. Retornaremos em breve.<br><br>';
$messageautoreply .= 'Atensiosamente,<br>';
$messageautoreply .= 'Txai Resorts.<br>';
$messageautoreply .= '(Favor não responder)';

$message .= "<strong>Nome: </strong>".$name."<br>";  
$message .= "<strong>Telefone: </strong>".$phone."<br>";
$message .= "<strong>E-mail: </strong>".$email."<br>";
$message .= "<strong>Observação: </strong>".$text."<br>";
$message .= "<strong>Deseja receber novidades? </strong>".$newsletter."<br>";

//Enviando pro destino
if(!mail($send_email_to, $email_subject, $message, $headers ,"-r".$emailsender)){ // Se for Postfix
    $headers .= "Return-Path: " . $emailsender . $quebra_linha; // Se "não for Postfix"
    mail($send_email_to, $email_subject, $message, $headers );
}

//Enviando pro remetente (resposta automática)
if(!mail($email, $email_subject, $messageautoreply, $headersautoreply ,"-r".$emailsender)){ // Se for Postfix
    $headers .= "Return-Path: " . $emailsender . $quebra_linha; // Se "não for Postfix"
    mail($email, $email_subject, $messageautoreply, $headersautoreply );
}
 
?>



