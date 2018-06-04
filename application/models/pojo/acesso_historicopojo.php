<?php
/* Classe Pojo (VO): Histórico de Acesso
 * Autor: Anderson Farias
 * Última atualização: 04/03/2017
 * Contato: andersonjfarias@yahoo.com.br
 */
class Acesso_historicoPojo extends CI_Model {

    private $id_acesso;
    private $id_usuario;
    private $data;
    private $responsavel;
    private $operacao;


      //status
    private static $ATIVO = "<span class='btn btn-success btn-sm buttom_width'>ATIVO</span>";
    private static $BLOQUEADO = "<span class='btn btn-warning btn-sm buttom_width'>BLOQUEADO</span>";
    
    
    public function populate($dados){
        if(isset($dados["id_acesso"]))
            $this->id_acesso = $dados["id_acesso"];

        if(isset($dados["id_usuario"]))
            $this->id_usuario = $dados["id_usuario"];

         if(isset($dados["data"]))
            $this->data = $dados["data"];
			
        if(isset($dados["responsavel"]))
            $this->responsavel = $dados["responsavel"];

        if(isset($dados["operacao"]))
            $this->operacao = $dados["operacao"];
	}
	
	
	public function getId_acesso(){
        return $this->id_acesso;
    }

    public function setId_acesso($id_acesso){
        $this->id_acesso = $id_acesso;
    }

    public function getId_usuario(){
        return $this->id_usuario;
    }

    public function setId_usuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }

    public function getData(){
        return $this->data;
    }

    public function setData($data){
        $this->data = $data;
    }

    public function getResponsavel(){
        return $this->responsavel;
    }

    public function setResponsavel($responsavel){
        $this->responsavel = $responsavel;
    }

    public function getOperacao(){
        return $this->operacao;
    }

    public function setOperacao($operacao){
        $this->operacao = $operacao;
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
