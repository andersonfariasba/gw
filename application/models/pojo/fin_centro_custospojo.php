<?php
/* Classe Pojo (VO): Centro de custos
 * Autor: Anderson Farias
 * Última atualização: 03/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Fin_centro_custosPojo extends CI_Model {

    private $id_custo;
    private $custo;
    private $status;
    private $deletado = false;

      //status
    private static $ATIVO = "<span class='btn btn-success btn-small buttom_width'>ATIVO</span>";
    private static $BLOQUEADO = "<span class='btn btn-warning btn-small buttom_width'>BLOQUEADO</span>";
    
    public function populate($dados){
        if(isset($dados["id_custo"]))
            $this->id_custo = $dados["id_custo"];

        if(isset($dados["custo"]))
            $this->custo = $dados["custo"];


        if(isset($dados["status"]))
            $this->status = $dados["status"];
        
        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
	}
        
        
        public function getId_custo() {
            return $this->id_custo;
        }

        public function getCusto() {
            return $this->custo;
        }

         public function getStatus() {
            return $this->status;
        }

        public function getDeletado() {
            return $this->deletado;
        }

        public function setId_custo($id_custo) {
            $this->id_custo = $id_custo;
        }

        public function setStatus($status) {
            $this->status = $status;
        }

        public function setCusto($custo) {
            $this->custo = $custo;
        }

        public function setDeletado($deletado) {
            $this->deletado = $deletado;
        }

          public function statusIs($status){
        return $this->status == $status;
       }

         public function printStatus() {
        switch ($this->status) {
            case ATIVO:
                    echo fin_centro_custosPojo::$ATIVO;
                break;

            case BLOQUEADO:
                    echo fin_centro_custosPojo::$BLOQUEADO;
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
