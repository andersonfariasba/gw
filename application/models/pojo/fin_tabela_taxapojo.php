<?php
/* Classe Pojo (VO): Comissoes
 * Autor: Anderson Farias
 * Última atualização: 23/07/2016
 * Contato: andersonjfarias@yahoo.com.br
 */
class Fin_tabela_taxaPojo extends CI_Model {

    private $id_tabela_taxa;
    private $id_tabela_nome;
    private $parcela_inicio;
    private $parcela_fim;
    private $taxa;
    private $deletado = false;        
    
    public function populate($dados){
        
        if(isset($dados["id_tabela_taxa"]))
            $this->id_tabela_taxa = $dados["id_tabela_taxa"];

         if(isset($dados["id_tabela_nome"]))
            $this->id_tabela_nome = $dados["id_tabela_nome"];

        if(isset($dados["parcela_inicio"]))
            $this->parcela_inicio = $dados["parcela_inicio"];

         if(isset($dados["parcela_fim"]))
            $this->parcela_fim = $dados["parcela_fim"];

        if(isset($dados["taxa"]))
            $this->taxa = $dados["taxa"];
        
        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
    }
		
	
    public function getId_tabela_taxa(){
        return $this->id_tabela_taxa;
    }

    public function setId_tabela_taxa($id_tabela_taxa){
        $this->id_tabela_taxa = $id_tabela_taxa;
    }

    
    public function getId_tabela_nome(){
        return $this->id_tabela_nome;
    }

    public function setId_tabela_nome($id_tabela_nome){
        $this->id_tabela_nome = $id_tabela_nome;
    }


    public function getParcela_inicio(){
        return $this->parcela_inicio;
    }

    public function setParcela_inicio($parcela_inicio){
        $this->parcela_inicio = $parcela_inicio;
    }

    public function getParcela_fim(){
        return $this->parcela_fim;
    }

    public function setParcela_fim($parcela_fim){
        $this->parcela_fim = $parcela_fim;
    }

    public function getTaxa(){
        return $this->taxa;
    }

    public function setTaxa($taxa){
        $this->taxa = $taxa;
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
