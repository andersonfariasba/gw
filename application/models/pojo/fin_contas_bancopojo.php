<?php
/* Classe Pojo (VO): Cargos dos colaboradores
 * Autor: Anderson Farias
 * Última atualização: 26/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Fin_contas_bancoPojo extends CI_Model {

    private $id_conta_banco;
    private $id_filial; //filial
    private $banco;
    private $agencia;
    private $conta;
    private $observacao;
    private $gerente;
    private $telefone;
    private $central_atendimento;
    private $status;
    private $deletado = false;

    private $filial; //obj filial

      //status
    private static $ATIVO = "<span class='btn btn-success btn-small buttom_width'>ATIVO</span>";
    private static $BLOQUEADO = "<span class='btn btn-warning btn-small buttom_width'>BLOQUEADO</span>";
    
    
 
   public function populate($dados){
        if(isset($dados["id_conta_banco"]))
            $this->id_conta_banco = $dados["id_conta_banco"];

        if(isset($dados["id_filial"]))
            $this->id_filial = $dados["id_filial"];

        if(isset($dados["banco"]))
            $this->banco = $dados["banco"];

        if(isset($dados["agencia"]))
            $this->agencia = $dados["agencia"];

        if(isset($dados["conta"]))
            $this->conta = $dados["conta"];

         if(isset($dados["observacao"]))
            $this->observacao = $dados["observacao"];

          if(isset($dados["gerente"]))
            $this->gerente = $dados["gerente"];

          if(isset($dados["telefone"]))
            $this->telefone = $dados["telefone"];

          if(isset($dados["central_atendimento"]))
            $this->central_atendimento = $dados["central_atendimento"];

        if(isset($dados["status"]))
            $this->status = $dados["status"];
			
    	if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
        
    }
	
	
public function getId_conta_banco(){
        return $this->id_conta_banco;
    }

    public function setId_conta_banco($id_conta_banco){
        $this->id_conta_banco = $id_conta_banco;
    }

    public function getId_filial(){
        return $this->id_filial;
    }

    public function setId_filial($id_filial){
        $this->id_filial = $id_filial;
    }

    public function getBanco(){
        return $this->banco;
    }

    public function setBanco($banco){
        $this->banco = $banco;
    }

    public function getAgencia(){
        return $this->agencia;
    }

    public function setAgencia($agencia){
        $this->agencia = $agencia;
    }

    public function getConta(){
        return $this->conta;
    }

    public function setConta($conta){
        $this->conta = $conta;
    }

    public function getObservacao(){
        return $this->observacao;
    }

    public function setObservacao($observacao){
        $this->observacao = $observacao;
    }

    public function getGerente(){
        return $this->gerente;
    }

    public function setGerente($gerente){
        $this->gerente = $gerente;
    }

    public function getTelefone(){
        return $this->telefone;
    }

    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }

    public function getCentral_atendimento(){
        return $this->central_atendimento;
    }

    public function setCentral_atendimento($central_atendimento){
        $this->central_atendimento = $central_atendimento;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function getDeletado(){
        return $this->deletado;
    }

    public function setDeletado($deletado){
        $this->deletado = $deletado;
    }

    public function getFilial(){
        return $this->filial;
    }

    public function setFilial($filial){
        $this->filial = $filial;
    }

    public function statusIs($status){
        return $this->status == $status;
    }

      public function filialIs($filial){
           return $this->id_filial == $filial;
        }



        
    public function printStatus() {
        switch ($this->status) {
            case ATIVO:
                    echo fin_contas_bancoPojo::$ATIVO;
                break;

            case BLOQUEADO:
                    echo fin_contas_bancoPojo::$BLOQUEADO;
                break;
            
            default:
         
            break;
        }
    }
    

        	      

    public function toArray()
     {
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

            unset($inArray["filial"]);
            return $inArray;
        }


 }
?>
