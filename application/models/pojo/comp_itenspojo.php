<?php
/* Classe Pojo (VO): Pedidos itens
 * Autor: Anderson Farias
 * Última atualização: 11/10/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Comp_itensPojo extends CI_Model {

    private $id_item;
    private $id_solicitacao;
    private $id_fornecedor;
    private $id_obra;
    private $id_custo;
    private $id_produto;
    private $data_inclusao;
    private $qtd; 
    private $descricao;
    private $deletado = false;
    
    private $solicitacao; //obj pedido
    private $produto; //obj produto
    private $obra;
    private $custo;

       
      
    
    public function populate($dados){
      
        if(isset($dados["id_item"]))
            $this->id_item = $dados["id_item"];

        if(isset($dados["id_solicitacao"]))
            $this->id_solicitacao = $dados["id_solicitacao"];

        if(isset($dados["id_fornecedor"]))
            $this->id_fornecedor = $dados["id_fornecedor"];

        if(isset($dados["id_obra"]))
            $this->id_obra = $dados["id_obra"];

        if(isset($dados["id_custo"]))
            $this->id_custo = $dados["id_custo"];
        
        if(isset($dados["id_produto"]))
          $this->id_produto = $dados["id_produto"];
       
			
        if(isset($dados["data_inclusao"]))
            $this->data_inclusao = $dados["data_inclusao"];
	
        if(isset($dados["qtd"]))
             $this->qtd = $dados["qtd"];
	        
                        
        if(isset($dados["descricao"]))
            $this->descricao = $dados["descricao"];
        
        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
	}



    public function getId_item(){
        return $this->id_item;
    }

    public function setId_item($id_item){
        $this->id_item = $id_item;
    }

    public function getId_solicitacao(){
        return $this->id_solicitacao;
    }

    public function setId_solicitacao($id_solicitacao){
        $this->id_solicitacao = $id_solicitacao;
    }

    public function getId_fornecedor(){
        return $this->id_fornecedor;
    }

    public function setId_fornecedor($id_fornecedor){
        $this->id_fornecedor = $id_fornecedor;
    }

    public function getId_obra(){
        return $this->id_obra;
    }

    public function setId_obra($id_obra){
        $this->id_obra = $id_obra;
    }

    public function getId_produto(){
        return $this->id_produto;
    }

    public function setId_produto($id_produto){
        $this->id_produto = $id_produto;
    }

    public function getData_inclusao(){
        return $this->data_inclusao;
    }

    public function setData_inclusao($data_inclusao){
        $this->data_inclusao = $data_inclusao;
    }

    public function getQtd(){
        return $this->qtd;
    }

    public function setQtd($qtd){
        $this->qtd = $qtd;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    public function getDeletado(){
        return $this->deletado;
    }

    public function getId_custo(){
        return $this->id_custo;
    }

    public function setId_custo($id_custo){
        $this->id_custo = $id_custo;
    }

    public function getCusto(){
        return $this->custo;
    }

    public function setCusto($custo){
        $this->custo = $custo;
    }

    public function setDeletado($deletado){
        $this->deletado = $deletado;
    }

    public function getSolicitacao(){
        return $this->solicitacao;
    }

    public function setSolicitacao($solicitacao){
        $this->solicitacao = $solicitacao;
    }

    public function getProduto(){
        return $this->produto;
    }

    public function setProduto($produto){
        $this->produto = $produto;
    }

    public function getObra(){
        return $this->obra;
    }

    public function setObra($obra){
        $this->obra = $obra;
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

            unset($inArray["solicitacao"]);
            unset($inArray["produto"]);
            unset($inArray["obra"]);
            unset($inArray["custo"]);

            return $inArray;
        }


 }
?>
