<?php
/* Classe Pojo (VO): Pedidos itens
 * Autor: Anderson Farias
 * Última atualização: 11/10/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Com_pedidos_itens_locPojo extends CI_Model {

    private $id_item;
    private $id_pedido;
    private $id_produto;
    private $produto_nome;
    private $data_inclusao;
    private $valor_unitario;
    private $qtd; 
    private $desconto;
    private $descricao;
    private $deletado = false;
    
    private $pedido; //obj pedido
    private $produto; //obj produto

       
      
    
    public function populate($dados){
      
        if(isset($dados["id_item"]))
            $this->id_item = $dados["id_item"];

        if(isset($dados["id_pedido"]))
            $this->id_pedido = $dados["id_pedido"];

        if(isset($dados["id_produto"]))
            $this->id_produto = $dados["id_produto"];

         if(isset($dados["produto_nome"]))
            $this->produto_nome = $dados["produto_nome"];
			
        if(isset($dados["data_inclusao"]))
            $this->data_inclusao = $dados["data_inclusao"];
	
       
        if(isset($dados["valor_unitario"]))
            $this->valor_unitario = $dados["valor_unitario"];
        
	    if(isset($dados["qtd"]))
       
            $this->qtd = $dados["qtd"];
	        
        if(isset($dados["desconto"]))
            $this->desconto = $dados["desconto"];
        
                
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

    public function getId_pedido(){
        return $this->id_pedido;
    }

    public function setId_pedido($id_pedido){
        $this->id_pedido = $id_pedido;
    }

    public function getId_produto(){
        return $this->id_produto;
    }

    public function setId_produto($id_produto){
        $this->id_produto = $id_produto;
    }

     public function getProduto_nome(){
        return $this->produto_nome;
    }

    public function setProduto_nome($produto_nome){
        $this->produto_nome = $produto_nome;
    }

    public function getData_inclusao(){
        return $this->data_inclusao;
    }

    public function setData_inclusao($data_inclusao){
        $this->data_inclusao = $data_inclusao;
    }

    public function getValor_unitario(){
        return $this->valor_unitario;
    }

    public function setValor_unitario($valor_unitario){
        $this->valor_unitario = $valor_unitario;
    }

    public function getQtd(){
        return $this->qtd;
    }

    public function setQtd($qtd){
        $this->qtd = $qtd;
    }

    public function getDesconto(){
        return $this->desconto;
    }

    public function setDesconto($desconto){
        $this->desconto = $desconto;
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

    public function setDeletado($deletado){
        $this->deletado = $deletado;
    }

    public function getPedido(){
        return $this->pedido;
    }

    public function setPedido($pedido){
        $this->pedido = $pedido;
    }

    public function getProduto(){
        return $this->produto;
    }

    public function setProduto($produto){
        $this->produto = $produto;
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

            unset($inArray["pedido"]);
            unset($inArray["produto"]);
            return $inArray;
        }


 }
?>
