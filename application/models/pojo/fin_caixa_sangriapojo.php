<?php
/* Classe Pojo (VO): Categorias
 * Autor: Anderson Farias
 * Última atualização: 28/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Fin_caixa_sangriaPojo extends CI_Model {

    private $id_sangria;
    private $data;
    private $hora;
    private $valor_retirada;
    private $usuario;
    private $observacao;
    private $data_operacao;
    private $deletado = false;
    
    public function populate($dados){
        if(isset($dados["id_sangria"]))
            $this->id_sangria = $dados["id_sangria"];

        if(isset($dados["data"]))
            $this->data = $dados["data"];

         if(isset($dados["hora"]))
            $this->hora = $dados["hora"];

         if(isset($dados["valor_retirada"]))
            $this->valor_retirada = $dados["valor_retirada"];

         if(isset($dados["usuario"]))
            $this->usuario = $dados["usuario"];

         if(isset($dados["observacao"]))
            $this->observacao = $dados["observacao"];

         if(isset($dados["data_operacao"]))
            $this->data_operacao = $dados["data_operacao"];
        
        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
	}
        
    
    public function getId_sangria(){
        return $this->id_sangria;
    }

    public function setId_sangria($id_sangria){
        $this->id_sangria = $id_sangria;
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

    public function getValor_retirada(){
        return $this->valor_retirada;
    }

    public function setValor_retirada($valor_retirada){
        $this->valor_retirada = $valor_retirada;
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
