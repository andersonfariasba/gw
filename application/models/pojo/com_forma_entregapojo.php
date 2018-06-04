<?php
/* Classe Pojo (VO): Categorias
 * Autor: Anderson Farias
 * Última atualização: 28/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Com_forma_entregaPojo extends CI_Model {

    private $id_forma;
    private $forma;
    private $situacao;
    private $deletado = false;

     //status
    private static $ATIVO = "<span class='btn btn-success btn-small buttom_width'>ATIVO</span>";
    private static $BLOQUEADO = "<span class='btn btn-warning btn-small buttom_width'>BLOQUEADO</span>";
    
    public function populate($dados){
   
        if(isset($dados["id_forma"]))
            $this->id_forma = $dados["id_forma"];

        if(isset($dados["forma"]))
            $this->forma = $dados["forma"];

        if(isset($dados["situacao"]))
            $this->situacao = $dados["situacao"];
        
        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
	   }
        
        public function getId_forma(){
        return $this->id_forma;
    }

    public function setId_forma($id_forma){
        $this->id_forma = $id_forma;
    }

    public function getForma(){
        return $this->forma;
    }

    public function setForma($forma){
        $this->forma = $forma;
    }

    public function getSituacao(){
        return $this->situacao;
    }

    public function setSituacao($situacao){
        $this->situacao = $situacao;
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
        
        public function printStatus() {
        switch ($this->situacao) {
            case ATIVO:
                    echo com_forma_entregaPojo::$ATIVO;
                break;

            case BLOQUEADO:
                    echo com_forma_entregaPojo::$BLOQUEADO;
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
