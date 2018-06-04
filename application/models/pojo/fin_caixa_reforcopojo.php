<?php
/* Classe Pojo (VO): Categorias
 * Autor: Anderson Farias
 * Última atualização: 28/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Fin_caixa_reforcoPojo extends CI_Model {

    private $id_reforco;
    private $data;
    private $hora;
    private $valor_inicial;
    private $usuario;
    private $observacao;
    private $data_operacao;
    private $deletado = false;
    
    public function populate($dados){
        if(isset($dados["id_reforco"]))
            $this->id_reforco = $dados["id_reforco"];

        if(isset($dados["data"]))
            $this->data = $dados["data"];

         if(isset($dados["hora"]))
            $this->hora = $dados["hora"];

         if(isset($dados["valor_inicial"]))
            $this->valor_inicial = $dados["valor_inicial"];

         if(isset($dados["usuario"]))
            $this->usuario = $dados["usuario"];

         if(isset($dados["observacao"]))
            $this->observacao = $dados["observacao"];

         if(isset($dados["data_operacao"]))
            $this->data_operacao = $dados["data_operacao"];
        
        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
	}
        
    
    public function getId_reforco(){
        return $this->id_reforco;
    }

    public function setId_reforco($id_reforco){
        $this->id_reforco = $id_reforco;
    }

    public function getData(){
        return $this->data;
    }

    public function setData($data){
        $this->data = $data;
    }

    public function getHora(){
        return $this->hora;
    }

    public function setHora($hora){
        $this->hora = $hora;
    }

    public function getValor_inicial(){
        return $this->valor_inicial;
    }

    public function setValor_inicial($valor_inicial){
        $this->valor_inicial = $valor_inicial;
    }

    public function getUsuario(){
        return $this->usuario;
    }

    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }

    public function getObservacao(){
        return $this->observacao;
    }

    public function setObservacao($observacao){
        $this->observacao = $observacao;
    }

    public function getData_operacao(){
        return $this->data_operacao;
    }

    public function setData_operacao($data_operacao){
        $this->data_operacao = $data_operacao;
    }

    public function getDeletado(){
        return $this->deletado;
    }

    public function setDeletado($deletado){
        $this->deletado = $deletado;
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
