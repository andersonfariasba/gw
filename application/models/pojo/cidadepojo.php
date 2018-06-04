<?php
/* Classe Pojo (VO): Categorias
 * Autor: Anderson Farias
 * Última atualização: 28/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class CidadePojo extends CI_Model {

    private $ct_id;
    private $ct_nome;
    private $ct_uf;
    private $ct_ibge;
    
    public function populate($dados){

        if(isset($dados["ct_id"]))
            $this->ct_id = $dados["ct_id"];

        if(isset($dados["ct_nome"]))
            $this->ct_nome = $dados["ct_nome"];

        if(isset($dados["ct_uf"]))
            $this->ct_uf = $dados["ct_uf"];

        if(isset($dados["ct_ibge"]))
            $this->ct_ibge = $dados["ct_ibge"];

        
}
        
  public function getCt_id(){
        return $this->ct_id;
    }

    public function setCt_id($ct_id){
        $this->ct_id = $ct_id;
    }

    public function getCt_nome(){
        return $this->ct_nome;
    }

    public function setCt_nome($ct_nome){
        $this->ct_nome = $ct_nome;
    }

    public function getCt_uf(){
        return $this->ct_uf;
    }

    public function setCt_uf($ct_uf){
        $this->ct_uf = $ct_uf;
    }

    public function getCt_ibge(){
        return $this->ct_ibge;
    }

    public function setCt_ibge($ct_ibge){
        $this->ct_ibge = $ct_ibge;
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
