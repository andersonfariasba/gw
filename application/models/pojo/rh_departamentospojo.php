<?php
/* Classe Pojo (VO): Departamento dos colaboradores
 * Autor: Anderson Farias
 * Última atualização: 03/01/2016
 * Contato: andersonjfarias@yahoo.com.br
 */
class Rh_departamentosPojo extends CI_Model {

    private $id_departamento;
    private $departamento;
    private $status;
    private $deletado = false;

      //status
    private static $ATIVO = "<span class='btn btn-success btn-small buttom_width'>ATIVO</span>";
    private static $BLOQUEADO = "<span class='btn btn-warning btn-small buttom_width'>BLOQUEADO</span>";
    
    
 
   public function populate($dados){
        if(isset($dados["id_departamento"]))
            $this->id_departamento = $dados["id_departamento"];

        if(isset($dados["departamento"]))
            $this->departamento = $dados["departamento"];

           if(isset($dados["status"]))
            $this->status = $dados["status"];
			
	if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
        
    }
	
	
    public function getId_departamento() {
        return $this->id_departamento;
    }

    public function getDepartamento() {
        return $this->departamento;
    }

    public function getStatus() {
            return $this->status;
        }


    public function getDeletado() {
        return $this->deletado;
    }

    public function setId_departamento($id_departamento) {
        $this->id_departamento = $id_departamento;
    }

      public function setStatus($status) {
            $this->status = $status;
        }

    public function setDepartamento($departamento) {
        $this->departamento = $departamento;
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
                    echo rh_departamentosPojo::$ATIVO;
                break;

            case BLOQUEADO:
                    echo rh_departamentosPojo::$BLOQUEADO;
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
