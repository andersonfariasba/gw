<?php
/* Classe Pojo (VO): Centro de custos
 * Autor: Anderson Farias
 * Última atualização: 03/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Fin_plano_contasPojo extends CI_Model {

    private $id_plano;
    private $id_plano_categoria;
    private $classificacao;
    private $nome;
    private $status;
    private $deletado = false;

    private $grupo; 

      //status
    private static $ATIVO = "<span class='btn btn-success btn-small buttom_width'>ATIVO</span>";
    private static $BLOQUEADO = "<span class='btn btn-warning btn-small buttom_width'>BLOQUEADO</span>";
    
    public function populate($dados){
         if(isset($dados["id_plano"]))
            $this->id_plano = $dados["id_plano"];

        if(isset($dados["id_plano_categoria"]))
            $this->id_plano_categoria = $dados["id_plano_categoria"];

        if(isset($dados["classificacao"]))
            $this->classificacao = $dados["classificacao"];

        if(isset($dados["nome"]))
            $this->nome = $dados["nome"];

               
        if(isset($dados["status"]))
            $this->status = $dados["status"];
        
        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
	}
        
        
       
     public function getId_plano(){
        return $this->id_plano;
    }

    public function setId_plano($id_plano){
        $this->id_plano = $id_plano;
    }

    public function getId_plano_categoria(){
        return $this->id_plano_categoria;
    }

    public function setId_plano_categoria($id_plano_categoria){
        $this->id_plano_categoria = $id_plano_categoria;
    }

    public function getClassificacao(){
        return $this->classificacao;
    }

    public function setClassificacao($classificacao){
        $this->classificacao = $classificacao;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
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

     public function getGrupo(){
        return $this->grupo;
    }

    public function setGrupo($grupo){
        $this->grupo = $grupo;
    }




        public function statusIs($status){
        return $this->status == $status;
       }

         public function printStatus() {
        switch ($this->status) {
            case ATIVO:
                    echo fin_plano_contasPojo::$ATIVO;
                break;

            case BLOQUEADO:
                    echo fin_plano_contasPojo::$BLOQUEADO;
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

            unset($inArray["grupo"]);
            return $inArray;
        }


 }
?>
