<?php
/* Classe Pojo (VO): Perfil de usuários
 * Autor: Anderson Farias
 * Última atualização: 23/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Acesso_perfilPojo extends CI_Model {

    private $id_perfil;
    private $perfil;
    private $status;
    private $deletado = false;


      //status
    private static $ATIVO = "<span class='btn btn-success btn-sm buttom_width'>ATIVO</span>";
    private static $BLOQUEADO = "<span class='btn btn-warning btn-sm buttom_width'>BLOQUEADO</span>";
    
    
    public function populate($dados){
        if(isset($dados["id_perfil"]))
            $this->id_perfil = $dados["id_perfil"];

        if(isset($dados["perfil"]))
            $this->perfil = $dados["perfil"];

         if(isset($dados["status"]))
            $this->status = $dados["status"];
			
        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
	}
	
	
	public function setId_perfil($id_perfil) {
		$this->id_perfil = $id_perfil;
	}
		
	public function getId_perfil() {
		return $this->id_perfil;
	}
	
	public function setPerfil($perfil) {
		$this->perfil = $perfil;
	}

	public function getStatus() {
            return $this->status;
    }

	
	public function getPerfil() {
		return $this->perfil;
	}

	 public function setStatus($status) {
            $this->status = $status;
        }
	
	public function setDeletado($deletado) {
		$this->deletado = $deletado;
	}
	
	public function getDeletado() {
		return $this->deletado;
	}
        
    public function perfilIs($perfil){
           return $this->id_perfil == $perfil;
    }

     public function statusIs($status){
        return $this->status == $status;
       }
        
    public function printStatus() {
        switch ($this->status) {
            case ATIVO:
                    echo acesso_perfilPojo::$ATIVO;
                break;

            case BLOQUEADO:
                    echo acesso_perfilPojo::$BLOQUEADO;
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
