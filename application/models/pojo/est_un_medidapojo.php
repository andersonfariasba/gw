<?php
/* Classe Pojo (VO): Unidade Medida
 * Autor: Anderson Farias
 * Última atualização: 27/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Est_un_medidaPojo extends CI_Model {

    private $id_unidade;
    private $unidade;
    private $sigla;
    private $deletado = false;
    
    public function populate($dados){
        if(isset($dados["id_unidade"]))
            $this->id_unidade = $dados["id_unidade"];

        if(isset($dados["unidade"]))
            $this->unidade = $dados["unidade"];
        
        if(isset($dados["sigla"]))
            $this->sigla = $dados["sigla"];
			
        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
	}
        
        public function getId_unidade() {
            return $this->id_unidade;
        }

        public function getUnidade() {
            return $this->unidade;
        }

        public function getDeletado() {
            return $this->deletado;
        }

        public function setId_unidade($id_unidade) {
            $this->id_unidade = $id_unidade;
        }

        public function setUnidade($unidade) {
            $this->unidade = $unidade;
        }
        
        public function getSigla() {
            return $this->sigla;
        }

        public function setSigla($sigla) {
            $this->sigla = $sigla;
        }

        
        public function setDeletado($deletado) {
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
