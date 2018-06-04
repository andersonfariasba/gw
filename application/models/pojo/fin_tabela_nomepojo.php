<?php
/* Classe Pojo (VO): Comissoes
 * Autor: Anderson Farias
 * Última atualização: 23/07/2016
 * Contato: andersonjfarias@yahoo.com.br
 */
class Fin_tabela_nomePojo extends CI_Model {

    private $id_tabela_nome;
    private $nome;
    private $deletado = false;        
    
    public function populate($dados){
        
        if(isset($dados["id_tabela_nome"]))
            $this->id_tabela_nome = $dados["id_tabela_nome"];

        if(isset($dados["nome"]))
            $this->nome = $dados["nome"];
               
        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
    }
		
	
    public function getId_tabela_nome(){
        return $this->id_tabela_nome;
    }

    public function setId_tabela_nome($id_tabela_nome){
        $this->id_tabela_nome = $id_tabela_nome;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
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

        //unset($inArray["cargo"]);
        return $inArray;
    }


 }


?>
