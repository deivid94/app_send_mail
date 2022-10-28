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
  public $status = array('codigo_status'=> null, 'descricao_status'=> '');
  
  public function __GET($atributo){ //pegar atributos
    return $this->$atributo;
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

  

  if ($mensagem->mensagemValida()){
    echo 'Mensagem nao é valida';
    header('Location: index.php');//retorna para index.
  }

  //Instantiation and passing `true` enables exceptions
  $mail = new PHPMailer(true);

  try {
    //Server settings
    $mail->SMTPDebug = false;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'md031194@gmail.com';                     //SMTP username
    $mail->Password   = 'nbzzspksgmnvmpxl';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('remtentePrivado@sendmail.com', 'Remetente privado');
    $mail->addAddress($mensagem-> __get('para'));     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = ($mensagem-> __get('assunto'));
    $mail->Body    = ($mensagem-> __get('mensagem'));
    $mail->AltBody = 'é necessario um cliente com suporte em html';

    $mail->send();
    $mensagem->status['codigo_status'] = 1;
    $mensagem->status['descricao_status'] = 'E-mail enviado com sucesso';
    
}   catch (Exception $e) {
  $mensagem->status['codigo_status'] = 2;
    $mensagem->status['descricao_status'] = "Nao foi possivel enviar este email. tente novamante {$mail->ErrorInfo}";
    
}   
?>

<html>
  <head>
    <meta charset="utf8"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
  <div class="container">
  <div class="py-3 text-center">
				<img class="d-block mx-auto mb-2" src="logo.png" alt="" width="72" height="72">
				<h2>Send Mail</h2>
				<p class="lead">Seu app de envio de e-mails particular!</p>
			</div>
      <div class="row">
        <div class="col-md-12">
          <? if($mensagem->status['codigo_status'] == 1){ ?>

            <div class="container">
              <h1 class="display-4 text-success">Sucesso</h1>
              <p><?= $mensagem->status['descricao_status']?></p>
              <a href="index.php" class="btn btn-success btn-lg mt-5 text-white">Voltar</a>
            </div>


            <?}?>
            <? if($mensagem->status['codigo_status'] == 2){ ?>
            .<div class="container">
              <h1 class="display-4 text-danger">Ops!</h1>
              <p><?= $mensagem->status['descricao_status']?></p>
              <a href="index.php" class="btn btn-danger btn-lg mt-5 text-white">Voltar</a>
            </div>
            <?}?>
          
        </div>
      </div>
  </div>
</body>
    </html>