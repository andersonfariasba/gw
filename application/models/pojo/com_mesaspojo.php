<?php
/* Classe Pojo (VO): Cargos dos colaboradores
 * Autor: Anderson Farias
 * Última atualização: 26/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Com_mesasPojo extends CI_Model {

    private $id_mesa;
    private $capacidade;
    private $nome;
    private $status;
    private $deletado = false;

      //status
    private static $ATIVO = "<span class='btn btn-success btn-small buttom_width'>ATIVO</span>";
    private static $BLOQUEADO = "<span class='btn btn-warning btn-small buttom_width'>INATIVO</span>";
    
    
 
   public function populate($dados){
        if(isset($dados["id_mesa"]))
            $this->id_mesa = $dados["id_mesa"];

        if(isset($dados["capacidade"]))
            $this->capacidade = $dados["capacidade"];

        if(isset($dados["nome"]))
            $this->nome = $dados["nome"];

           if(isset($dados["status"]))
            $this->status = $dados["status"];
			
	if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
        
    }
	
	
    public function getId_mesa() {
        return $this->id_mesa;
    }


    public function getCapacidade() {
        return $this->capacidade;
    }



    public function getNome() {
        return $this->nome;
    }

    public function getStatus() {
            return $this->status;
        }


    public function getDeletado() {
        return $this->deletado;
    }

    public function setId_mesa($id_mesa) {
        $this->id_mesa = $id_mesa;
    }

     public function setCapacidade($capacidade) {
        $this->capacidade = $capacidade;
    }

      public function setStatus($status) {
            $this->status = $status;
        }

    public function setNome($nome) {
        $this->nome = $nome;
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
                    echo com_mesasPojo::$ATIVO;
                break;

            case BLOQUEADO:
                    echo com_mesasPojo::$BLOQUEADO;
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
