<?php
/* Classe Pojo (VO): Categorias
 * Autor: Anderson Farias
 * Última atualização: 28/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Est_motivo_movPojo extends CI_Model {

    private $id_motivo;
    private $descricao;
    private $tipo;
    private $deletado = false;

    //status
    private static $ENTRADA = "<span class='btn btn-success btn-small btn-sm' style='width:170px;'>REQ. DE ENTRADA</span>";
    private static $TRANSFERENCIA = "<span class='btn btn-warning btn-small btn-sm' style='width:170px;'>TRANSFERÊNCIA</span>";
     private static $SAIDA = "<span class='btn btn-danger btn-small btn-sm' style='width:170px;'>REQ SAÍDA</span>";
    
    
    public function populate($dados){
        if(isset($dados["id_motivo"]))
            $this->id_motivo = $dados["id_motivo"];

        if(isset($dados["descricao"]))
            $this->descricao = $dados["descricao"];

         if(isset($dados["tipo"]))
            $this->tipo = $dados["tipo"];
        
        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
	}
        
    public function getId_motivo(){
        return $this->id_motivo;
    }

    public function setId_motivo($id_motivo){
        $this->id_motivo = $id_motivo;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function setTipo($tipo){
        $this->tipo = $tipo;
    }

    public function getDeletado(){
        return $this->deletado;
    }

    public function setDeletado($deletado){
        $this->deletado = $deletado;
    }

     public function tipoIs($tipo){
        return $this->tipo == $tipo;
      }
        
        public function printTipo() {
        switch ($this->tipo) {
            case TIPO_MOT_ENTRADA:
                    echo est_motivo_movPojo::$ENTRADA;
                break;

            case TIPO_MOT_TRANSF:
                    echo est_motivo_movPojo::$TRANSFERENCIA;
                break;

            case TIPO_MOT_SAIDA:
                    echo est_motivo_movPojo::$SAIDA;
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
