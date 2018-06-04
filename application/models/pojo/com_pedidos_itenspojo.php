<?php
/* Classe Pojo (VO): Pedidos itens
 * Autor: Anderson Farias
 * Última atualização: 11/10/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Com_pedidos_itensPojo extends CI_Model {

    private $id_item;
    private $id_pedido;
    private $id_produto;
    private $id_status;
    private $produto_nome;
    private $data_inclusao;
    
    private $data_inicio;
    private $data_prev_entrega;
    private $data_entrega_final;

    private $valor_unitario;
    private $qtd; 
    private $qtd_entregue;
    private $desconto;
    private $descricao;
    
    private $forma_entrega;
    private $conferente;

    private $deletado = false;
    
    private $pedido; //obj pedido
    private $produto; //obj produto
    private $status;

       
      
    
    public function populate($dados){
      
        if(isset($dados["id_item"]))
            $this->id_item = $dados["id_item"];

        if(isset($dados["id_pedido"]))
            $this->id_pedido = $dados["id_pedido"];

        if(isset($dados["id_produto"]))
            $this->id_produto = $dados["id_produto"];

          if(isset($dados["id_status"]))
            $this->id_status = $dados["id_status"];

         if(isset($dados["produto_nome"]))
            $this->produto_nome = $dados["produto_nome"];
			
        if(isset($dados["data_inclusao"]))
            $this->data_inclusao = $dados["data_inclusao"];

        if(isset($dados["data_inicio"]))
            $this->data_inicio = $dados["data_inicio"];

        if(isset($dados["data_prev_entrega"]))
            $this->data_prev_entrega = $dados["data_prev_entrega"];

        if(isset($dados["data_entrega_final"]))
            $this->data_entrega_final = $dados["data_entrega_final"];
        

	
       
        if(isset($dados["valor_unitario"]))
            $this->valor_unitario = $dados["valor_unitario"];
        
	    if(isset($dados["qtd"]))
       
            $this->qtd = $dados["qtd"];

           if(isset($dados["qtd_entregue"]))
       
            $this->qtd_entregue = $dados["qtd_entregue"];
	        
        if(isset($dados["desconto"]))
            $this->desconto = $dados["desconto"];
        
                
        if(isset($dados["descricao"]))
            $this->descricao = $dados["descricao"];

        if(isset($dados["forma_entrega"]))
            $this->forma_entrega = $dados["forma_entrega"];

         if(isset($dados["conferente"]))
            $this->conferente = $dados["conferente"];

        
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

    public function getData_inicio(){
        return $this->data_inicio;
    }

    public function setData_inicio($data_inicio){
        $this->data_inicio = $data_inicio;
    }

    public function getData_prev_entrega(){
        return $this->data_prev_entrega;
    }

    public function setData_prev_entrega($data_prev_entrega){
        $this->data_prev_entrega = $data_prev_entrega;
    }

    public function getData_entrega_final(){
        return $this->data_entrega_final;
    }

    public function setData_entrega_final($data_entrega_final){
        $this->data_entrega_final = $data_entrega_final;
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

    public function getId_status(){
        return $this->id_status;
    }

    public function setId_status($id_status){
        $this->id_status = $id_status;
    }

    public function getQtd_entregue(){
        return $this->qtd_entregue;
    }

    public function setQtd_entregue($qtd_entregue){
        $this->qtd_entregue = $qtd_entregue;
    }

     public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function getForma_entrega(){
        return $this->forma_entrega;
    }

    public function setForma_entrega($forma_entrega){
        $this->forma_entrega = $forma_entrega;
    }

    public function getConferente(){
        return $this->conferente;
    }

    public function setConferente($conferente){
        $this->conferente = $conferente;
    }


      public function statusIs($status){
           return $this->id_status == $status;
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
             unset($inArray["status"]);
            return $inArray;
        }


 }
?>
