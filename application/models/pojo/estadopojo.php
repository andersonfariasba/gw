<?php
/* Classe Pojo (VO): Categorias
 * Autor: Anderson Farias
 * Última atualização: 28/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class EstadoPojo extends CI_Model {

    private $uf_id;
    private $uf_nome;
    private $uf_uf;
    private $uf_ibge;
    private $uf_sl;
    private $uf_ddd;
    
    public function populate($dados){

        if(isset($dados["uf_id"]))
            $this->uf_id = $dados["uf_id"];

        if(isset($dados["uf_nome"]))
            $this->uf_nome = $dados["uf_nome"];

        if(isset($dados["uf_uf"]))
            $this->uf_uf = $dados["uf_uf"];

        if(isset($dados["uf_ibge"]))
            $this->uf_ibge = $dados["uf_ibge"];

        if(isset($dados["uf_sl"]))
            $this->uf_sl = $dados["uf_sl"];

        if(isset($dados["uf_ddd"]))
            $this->uf_ddd = $dados["uf_ddd"];
}
        
        public function getUf_id(){
        return $this->uf_id;
    }

    public function setUf_id($uf_id){
        $this->uf_id = $uf_id;
    }

    public function getUf_nome(){
        return $this->uf_nome;
    }

    public function setUf_nome($uf_nome){
        $this->uf_nome = $uf_nome;
    }

    public function getUf_uf(){
        return $this->uf_uf;
    }

    public function setUf_uf($uf_uf){
        $this->uf_uf = $uf_uf;
    }

    public function getUf_ibge(){
        return $this->uf_ibge;
    }

    public function setUf_ibge($uf_ibge){
        $this->uf_ibge = $uf_ibge;
    }

    public function getUf_sl(){
        return $this->uf_sl;
    }

    public function setUf_sl($uf_sl){
        $this->uf_sl = $uf_sl;
    }

    public function getUf_ddd(){
        return $this->uf_ddd;
    }

    public function setUf_ddd($uf_ddd){
        $this->uf_ddd = $uf_ddd;
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
