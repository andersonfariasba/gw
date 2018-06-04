<?php
/* Classe Pojo (VO): Centro de custos
 * Autor: Anderson Farias
 * Última atualização: 03/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Fin_plano_contas_catPojo extends CI_Model {

    private $id_plano_categoria;
    private $classificacao;
    private $nome;
    private $status;
    private $tipo_conta;
    private $perfil_cliente;
    private $deletado = false;

      //status
    private static $ATIVO = "<span class='btn btn-success btn-small buttom_width'>ATIVO</span>";
    private static $BLOQUEADO = "<span class='btn btn-warning btn-small buttom_width'>BLOQUEADO</span>";
    
    public function populate($dados){
        if(isset($dados["id_plano_categoria"]))
            $this->id_plano_categoria = $dados["id_plano_categoria"];

        if(isset($dados["classificacao"]))
            $this->classificacao = $dados["classificacao"];

        if(isset($dados["nome"]))
            $this->nome = $dados["nome"];

        if(isset($dados["tipo_conta"]))
            $this->tipo_conta = $dados["tipo_conta"];

        if(isset($dados["perfil_cliente"]))
            $this->perfil_cliente = $dados["perfil_cliente"];
        
        if(isset($dados["status"]))
            $this->status = $dados["status"];
        
        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
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

    public function getTipo_conta(){
        return $this->tipo_conta;
    }

    public function setTipo_conta($tipo_conta){
        $this->tipo_conta = $tipo_conta;
    }

    public function getPerfil_cliente(){
        return $this->perfil_cliente;
    }

    public function setPerfil_cliente($perfil_cliente){
        $this->perfil_cliente = $perfil_cliente;
    }

    public function getDeletado(){
        return $this->deletado;
    }

    public function setDeletado($deletado){
        $this->deletado = $deletado;
    }




        public function statusIs($status){
        return $this->status == $status;
       }

         public function printStatus() {
        switch ($this->status) {
            case ATIVO:
                    echo fin_plano_contas_catPojo::$ATIVO;
                break;

            case BLOQUEADO:
                    echo fin_plano_contas_catPojo::$BLOQUEADO;
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
