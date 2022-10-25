<?php
 require "./bibliotecas/PHPMailer/Exception.php";
 require "./bibliotecas/PHPMailer/OAuth.php";
 require "./bibliotecas/PHPMailer/PHPmailer.php";
 require "./bibliotecas/PHPMailer/POP3.php";
 require "./bibliotecas/PHPMailer/SMTP.php";

 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;

class mensagem {
  private $para = null;
  private $assunto = null;
  private $mensagem = null;
  
  public function __GET($atributo){ //pegar atributos
    return $this->atributo;
  }

  public function __SET($atributo,$valor){ //atribuir valores ao atributos.
    $this->$atributo = $valor;

  }

  public function mensagemValida(){
    if (empty($this->para) || empty($this->assunto) || empty($this->mensagem))
    return false;
    
  }
}  

  $mensagem = new Mensagem();
  $mensagem->__SET('para',$_POST['para']);
  $mensagem->__SET('assunto',$_POST['assunto']);
  $mensagem->__SET('mensagem',$_POST['mensagem']);

  if (!$mensagem->mensagemValida()){
    echo 'Mensagem nao é valida';
    die();
  }

  //Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = false;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'user@example.com';                     //SMTP username
    $mail->Password   = 'secret';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
    $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    //Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Nao foi possivel enviar este email tente novamente';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>