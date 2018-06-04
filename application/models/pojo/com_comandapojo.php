<?php
/* Classe Pojo (VO): Pedidos itens
 * Autor: Anderson Farias
 * Última atualização: 11/10/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Com_comandaPojo extends CI_Model {

    private $id_comanda;
    private $id_pedido;
    private $id_produto;
    private $qtd;
    private $data;
    private $deletado = false;
    
    private $pedido; //obj pedido
    private $produto; //obj produto

       
      
    
    public function populate($dados){
      
        if(isset($dados["id_comanda"]))
            $this->id_comanda = $dados["id_comanda"];

        if(isset($dados["id_pedido"]))
            $this->id_pedido = $dados["id_pedido"];

        if(isset($dados["id_produto"]))
            $this->id_produto = $dados["id_produto"];
			
        if(isset($dados["data"]))
            $this->data = $dados["data"];
	
         if(isset($dados["qtd"]))
       
            $this->qtd = $dados["qtd"];
	        
        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
	}



    public function getId_comanda(){
        return $this->id_comanda;
    }

    public function setId_comanda($id_comanda){
        $this->id_comanda = $id_comanda;
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

    public function getData(){
        return $this->data;
    }

    public function setData($data){
        $this->data = $data;
    }

   
    public function getQtd(){
        return $this->qtd;
    }

    public function setQtd($qtd){
        $this->qtd = $qtd;
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
