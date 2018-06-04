<?php
/* Classe Pojo (VO): Categorias
 * Autor: Anderson Farias
 * Última atualização: 28/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Com_status_itensPojo extends CI_Model {

    private $id_status;
    private $status;
    private $situacao;
    private $cor;
    private $deletado = false;

     //status
    private static $ATIVO = "<span class='btn btn-success btn-small buttom_width'>ATIVO</span>";
    private static $BLOQUEADO = "<span class='btn btn-warning btn-small buttom_width'>BLOQUEADO</span>";
    
    public function populate($dados){
   
        if(isset($dados["id_status"]))
            $this->id_status = $dados["id_status"];

        if(isset($dados["status"]))
            $this->status = $dados["status"];

         if(isset($dados["cor"]))
            $this->cor = $dados["cor"];

        if(isset($dados["situacao"]))
            $this->situacao = $dados["situacao"];
        
        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
	   }
        
        public function getId_status(){
        return $this->id_status;
    }

    public function setId_status($id_status){
        $this->id_status = $id_status;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function getSituacao(){
        return $this->situacao;
    }

    public function setSituacao($situacao){
        $this->situacao = $situacao;
    }

    public function getCor(){
        return $this->cor;
    }

    public function setCor($cor){
        $this->cor = $cor;
    }

    public function getDeletado(){
        return $this->deletado;
    }

    public function setDeletado($deletado){
        $this->deletado = $deletado;
    }


     public function situacaoIs($situacao){
        return $this->situacao == $situacao;
      }

        public function corIs($cor){
        return $this->cor == $cor;
    }
        
        public function printStatus() {
        switch ($this->situacao) {
            case ATIVO:
                    echo com_status_itensPojo::$ATIVO;
                break;

            case BLOQUEADO:
                    echo com_status_itensPojo::$BLOQUEADO;
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
