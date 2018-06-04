<?php
/* Classe Pojo (VO): Cargos dos colaboradores
 * Autor: Anderson Farias
 * Última atualização: 26/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Rh_cargosPojo extends CI_Model {

    private $id_cargo;
    private $cargo;
    private $status;
    private $deletado = false;

      //status
    private static $ATIVO = "<span class='btn btn-success btn-small buttom_width'>ATIVO</span>";
    private static $BLOQUEADO = "<span class='btn btn-warning btn-small buttom_width'>BLOQUEADO</span>";
    
    
 
   public function populate($dados){
        if(isset($dados["id_cargo"]))
            $this->id_cargo = $dados["id_cargo"];

        if(isset($dados["cargo"]))
            $this->cargo = $dados["cargo"];

           if(isset($dados["status"]))
            $this->status = $dados["status"];
			
	if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
        
    }
	
	
    public function getId_cargo() {
        return $this->id_cargo;
    }

    public function getCargo() {
        return $this->cargo;
    }

    public function getStatus() {
            return $this->status;
        }


    public function getDeletado() {
        return $this->deletado;
    }

    public function setId_cargo($id_cargo) {
        $this->id_cargo = $id_cargo;
    }

      public function setStatus($status) {
            $this->status = $status;
        }

    public function setCargo($cargo) {
        $this->cargo = $cargo;
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
                    echo rh_cargosPojo::$ATIVO;
                break;

            case BLOQUEADO:
                    echo rh_cargosPojo::$BLOQUEADO;
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

            return $inArray;
        }


 }
?>
