<?php
/* Classe Pojo (VO): Operadoras de Cartão   
 * Autor: Anderson Farias
 * Última atualização: 23/01/2016
 * Contato: andersonjfarias@yahoo.com.br
 */
class Fin_operadoras_cartaoPojo extends CI_Model {

    private $id_operadora;
    private $empresa;
    private $central_atendimento;
    private $representante_nome;
    private $representante_tel;  //em análise e desenvolvimento
    private $email;
    private $site;
    private $endereco;
    private $bairro;
    private $cidade;
    private $estado;
    private $observacao; 
    private $deletado = false;
    private $status; //obj status
    
       

   //status
    private static $ATIVO = "<span class='btn btn-success btn-small buttom_width'>ATIVO</span>";
    private static $BLOQUEADO = "<span class='btn btn-warning btn-small buttom_width'>BLOQUEADO</span>";
    
    
    
    
    public function populate($dados){
        if(isset($dados["id_operadora"]))
            $this->id_operadora = $dados["id_operadora"];

        if(isset($dados["empresa"]))
            $this->empresa = $dados["empresa"];
			
        if(isset($dados["central_atendimento"]))
            $this->central_atendimento = $dados["central_atendimento"];

        if(isset($dados["representante_nome"]))
            $this->representante_nome = $dados["representante_nome"];
	
        if(isset($dados["representante_tel"]))
            $this->representante_tel = $dados["representante_tel"];
	
         if(isset($dados["email"]))
            $this->email = $dados["email"];
         
         if(isset($dados["site"]))
            $this->site = $dados["site"];

         if(isset($dados["endereco"]))
            $this->endereco = $dados["endereco"];

         if(isset($dados["bairro"]))
            $this->bairro = $dados["bairro"];

         if(isset($dados["cidade"]))
            $this->cidade = $dados["cidade"];

          if(isset($dados["estado"]))
            $this->estado = $dados["estado"];

         if(isset($dados["observacao"]))
            $this->observacao = $dados["observacao"];
        
         if(isset($dados["status"]))
            $this->status = $dados["status"];
	       
	
       if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
	}
        


        
    
    public function getId_operadora(){
        return $this->id_operadora;
    }

    public function setId_operadora($id_operadora){
        $this->id_operadora = $id_operadora;
    }

    public function getEmpresa(){
        return $this->empresa;
    }

    public function setEmpresa($empresa){
        $this->empresa = $empresa;
    }

    public function getCentral_atendimento(){
        return $this->central_atendimento;
    }

    public function setCentral_atendimento($central_atendimento){
        $this->central_atendimento = $central_atendimento;
    }

    public function getRepresentante_nome(){
        return $this->representante_nome;
    }

    public function setRepresentante_nome($representante_nome){
        $this->representante_nome = $representante_nome;
    }

    public function getRepresentante_tel(){
        return $this->representante_tel;
    }

    public function setRepresentante_tel($representante_tel){
        $this->representante_tel = $representante_tel;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getSite(){
        return $this->site;
    }

    public function setSite($site){
        $this->site = $site;
    }

    public function getEndereco(){
        return $this->endereco;
    }

    public function setEndereco($endereco){
        $this->endereco = $endereco;
    }

    public function getBairro(){
        return $this->bairro;
    }

    public function setBairro($bairro){
        $this->bairro = $bairro;
    }

    public function getCidade(){
        return $this->cidade;
    }

    public function setCidade($cidade){
        $this->cidade = $cidade;
    }


    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($estado){
        $this->estado = $estado;
    }

    public function getObservacao(){
        return $this->observacao;
    }

    public function setObservacao($observacao){
        $this->observacao = $observacao;
    }

    public function getDeletado(){
        return $this->deletado;
    }

    public function setDeletado($deletado){
        $this->deletado = $deletado;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }




    public function statusIs($status){
        return $this->status == $status;
      
       }

        
      
      public function printStatus() {
        switch ($this->status) {
            case ATIVO:
                    echo fin_operadoras_cartaoPojo::$ATIVO;
                break;

            case BLOQUEADO:
                    echo fin_operadoras_cartaoPojo::$BLOQUEADO;
                break;
            
            default:
         
            break;
        }
    }
    

        	
	        
                
        public function toArray(){
            $inArray = array();
            foreach(get_object_vars($this) as $attribute => $value){
                if(is_float($this->$attribute)){
                    $inArray[$attribute] = number_format($this->$attribute,4,".","");
                }
                else
                {
                    $inArray[$attribute] = $this->$attribute;
                }
            }       
           
            return $inArray;
        }


 }
?>
