<?php
//print_r($_POST);

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

  if ($mensagem->mensagemValida()){
    echo 'Mensagem é valida';
  } else {
    echo 'Mensagem nao é valida';
  }

?>