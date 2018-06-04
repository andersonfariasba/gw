<?php
/* Classe Pojo (VO): Pedidos itens
 * Autor: Anderson Farias
 * Última atualização: 11/10/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Comp_pedidos_itensPojo extends CI_Model {

    private $id_pedido_item;
    private $id_pedido;
    private $id_produto;
    private $id_obra;
    private $id_custo;
    private $valor_unitario;
    private $qtd;
    private $qtd_recebida;
    private $descricao;
    private $data_entrega;
    private $status;
    private $deletado = false;

    private $pedido; //obj pedido
    private $produto; //obj produto
    private $custo;
    private $obra;

       
      
    
    public function populate($dados){
      
        if(isset($dados["id_pedido_item"]))
            $this->id_pedido_item = $dados["id_pedido_item"];

        if(isset($dados["id_pedido"]))
            $this->id_pedido = $dados["id_pedido"];

        if(isset($dados["id_produto"]))
            $this->id_produto = $dados["id_produto"];
			
        if(isset($dados["id_obra"]))
            $this->id_obra = $dados["id_obra"];

          if(isset($dados["id_custo"]))
            $this->id_custo = $dados["id_custo"]; 
	
       
        if(isset($dados["valor_unitario"]))
            $this->valor_unitario = $dados["valor_unitario"];
        
	    if(isset($dados["qtd"]))
            $this->qtd = $dados["qtd"];

         if(isset($dados["qtd_recebida"]))
            $this->qtd_recebida = $dados["qtd_recebida"];
	        
        if(isset($dados["desconto"]))
            $this->desconto = $dados["desconto"];
        
                
        if(isset($dados["descricao"]))
            $this->descricao = $dados["descricao"];

         if(isset($dados["data_entrega"]))
            $this->data_entrega = $dados["data_entrega"];

         if(isset($dados["status"]))
            $this->status = $dados["status"];
        
        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
	}



    public function getId_pedido_item(){
        return $this->id_pedido_item;
    }

    public function setId_pedido_item($id_pedido_item){
        $this->id_pedido_item = $id_pedido_item;
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

    public function getId_obra(){
        return $this->id_obra;
    }

    public function setId_obra($id_obra){
        $this->id_obra = $id_obra;
    }

    public function getId_custo(){
        return $this->id_custo;
    }

    public function setId_custo($id_custo){
        $this->id_custo = $id_custo;
    }

    public function getQtd(){
        return $this->qtd;
    }

    public function setQtd($qtd){
        $this->qtd = $qtd;
    }

     public function getQtd_recebida(){
        return $this->qtd_recebida;
    }

    public function setQtd_recebida($qtd_recebida){
        $this->qtd_recebida = $qtd_recebida;
    }

     public function getValor_unitario(){
        return $this->valor_unitario;
    }

    public function setValor_unitario($valor_unitario){
        $this->valor_unitario = $valor_unitario;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    public function getData_entrega(){
        return $this->data_entrega;
    }

    public function setData_entrega($data_entrega){
        $this->data_entrega = $data_entrega;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
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

    public function getCusto(){
        return $this->custo;
    }

    public function setCusto($custo){
        $this->custo = $custo;
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

            unset($inArray["pedido"]);
            unset($inArray["produto"]);
            unset($inArray["custo"]);
            unset($inArray["obra"]);

            return $inArray;
        }


 }
?>
