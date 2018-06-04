<?php
/* Classe Pojo (VO): Categorias
 * Autor: Anderson Farias
 * Última atualização: 28/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Est_categoriasPojo extends CI_Model {

    private $id_categoria;
    private $categoria;
    private $deletado = false;
    
    public function populate($dados){
        if(isset($dados["id_categoria"]))
            $this->id_categoria = $dados["id_categoria"];

        if(isset($dados["categoria"]))
            $this->categoria = $dados["categoria"];
        
        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
	}
        
        public function getId_categoria() {
            return $this->id_categoria;
        }

        public function getCategoria() {
            return $this->categoria;
        }

        public function getDeletado() {
            return $this->deletado;
        }

        public function setId_categoria($id_categoria) {
            $this->id_categoria = $id_categoria;
        }

        public function setCategoria($categoria) {
            $this->categoria = $categoria;
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
