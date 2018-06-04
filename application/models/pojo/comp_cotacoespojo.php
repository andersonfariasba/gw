<?php
/* Classe Pojo (VO): Pedidos itens
 * Autor: Anderson Farias
 * Última atualização: 11/10/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Comp_cotacoesPojo extends CI_Model {

    private $id_cotacao;
    private $id_item;
    private $id_produto;
    private $id_fornecedor;
    private $data_inclusao;
    private $valor;
    private $qtd; 
    private $data_entrega;
    private $observacao;
    private $deletado = false;
    private $status;
    private $lancada; //lançada pela diretoria
    private $flag_parcial; //marca os itens aprovados caso tenha pedidos parciais
    //Flag Parcial da cotação: (em conjunto com a flag lançada = 1)
    // "" não foi lançada pela responsável da cotação
    // = 0 lançada para aprovação da diretoria
    // = 1 lançada pela diretoria
    
    private $item; //obj item
    private $fornecedor; //obj forncedor

     //status
    private static $COTACAO_ANDAMENTO = "<span class='btn btn-danger btn-sm buttom_width'>ANDAMENTO</span>";
    private static $COTACAO_APROVADA = "<span class='btn btn-warning btn-sm buttom_width'>APROVADO</span>";
    
  
             
    
    public function populate($dados){
      
       
          if(isset($dados["id_cotacao"]))
            $this->id_cotacao = $dados["id_cotacao"];

        if(isset($dados["id_item"]))
            $this->id_item = $dados["id_item"];

         if(isset($dados["id_produto"]))
            $this->id_produto = $dados["id_produto"];

       
        if(isset($dados["id_fornecedor"]))
            $this->id_fornecedor = $dados["id_fornecedor"];

      			
        if(isset($dados["data_inclusao"]))
            $this->data_inclusao = $dados["data_inclusao"];

         if(isset($dados["data_entrega"]))
            $this->data_entrega = $dados["data_entrega"];
	
         if(isset($dados["valor"]))
             $this->valor = $dados["valor"];

        if(isset($dados["qtd"]))
             $this->qtd = $dados["qtd"];
	        
                        
        if(isset($dados["observacao"]))
            $this->observacao = $dados["observacao"];
        
        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];

         if(isset($dados["status"]))
            $this->status = $dados["status"];

          if(isset($dados["lancada"]))
            $this->lancada = $dados["lancada"];

          if(isset($dados["flag_parcial"]))
            $this->flag_parcial = $dados["flag_parcial"];
	}



    public function getId_cotacao(){
        return $this->id_cotacao;
    }

    public function setId_cotacao($id_cotacao){
        $this->id_cotacao = $id_cotacao;
    }

    public function getId_item(){
        return $this->id_item;
    }

    public function setId_item($id_item){
        $this->id_item = $id_item;
    }

     public function getId_produto(){
        return $this->id_produto;
    }

    public function setId_produto($id_produto){
        $this->id_produto = $id_produto;
    }

    public function getId_fornecedor(){
        return $this->id_fornecedor;
    }

    public function setId_fornecedor($id_fornecedor){
        $this->id_fornecedor = $id_fornecedor;
    }

    public function getData_inclusao(){
        return $this->data_inclusao;
    }

    public function setData_inclusao($data_inclusao){
        $this->data_inclusao = $data_inclusao;
    }

    public function getValor(){
        return $this->valor;
    }

    public function setValor($valor){
        $this->valor = $valor;
    }

    public function getQtd(){
        return $this->qtd;
    }

    public function setQtd($qtd){
        $this->qtd = $qtd;
    }

    public function getData_entrega(){
        return $this->data_entrega;
    }

    public function setData_entrega($data_entrega){
        $this->data_entrega = $data_entrega;
    }

    public function getObservacao(){
        return $this->observacao;
    }

    public function setObservacao($observacao){
        $this->observacao = $observacao;
    }

    public function getLancada(){
        return $this->lancada;
    }

    public function setLancada($lancada){
        $this->lancada = $lancada;
    }

     public function getFlag_parcial(){
        return $this->flag_parcial;
    }

    public function setFlag_parcial($flag_parcial){
        $this->flag_parcial = $flag_parcial;
    }

    public function getDeletado(){
        return $this->deletado;
    }

    public function setDeletado($deletado){
        $this->deletado = $deletado;
    }

    public function getStatus() {
            return $this->status;
    }

     public function setStatus($status) {
            $this->status = $status;
    }



    public function getItem(){
        return $this->item;
    }

    public function setItem($item){
        $this->item = $item;
    }

    public function getFornecedor(){
        return $this->fornecedor;
    }

    public function setFornecedor($fornecedor){
        $this->fornecedor = $fornecedor;
    }


     public function statusIs($status){
        return $this->status == $status;
       }
        
    public function printStatus() {
        switch ($this->status) {
            case COTACAO_ANDAMENTO:
                    echo comp_cotacoesPojo::$COTACAO_ANDAMENTO;
                break;

            case COTACAO_APROVADA:
                    echo comp_cotacoesPojo::$COTACAO_APROVADA;
                break;
            
            default:
         
            break;
        }
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

            unset($inArray["item"]);
            unset($inArray["fornecedor"]);
            

            return $inArray;
        }


 }
?>
