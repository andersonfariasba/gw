<?php
/* Classe Pojo (VO): Pedidos
 * Autor: Anderson Farias
 * Última atualização: 01/10/2015
 * Contato: andersonjfarias@yahoo.com.br
 */


class Comp_pedidosPojo extends CI_Model {

   
     private $id_pedido;
     private $id_solicitacao;
     private $id_fornecedor;
     private $id_transportadora;
     private $codigo;
     private $data;
     private $valor_nf;
     private $desconto;
     private $numero_nf;
     private $valor_transportadora;
     private $forma_pagamento;
     private $data_vencimento;
     private $data_envio_financeiro;
     private $data_entrega;
     private $observacao;
     private $id_status;
     private $arquivo;
     private $faturar;
     
     private $endereco_entrega;
     private $contato;
     private $conhecimento_transportadora;

     private $deletado = false;


     private $fornecedor;
     private $transportadora;
     private $objStatus; //status;
     private $solicitacao;
  
   
      
    
    
    public function populate($dados){
        if(isset($dados["id_pedido"]))
            $this->id_pedido = $dados["id_pedido"];
        
        if(isset($dados["id_solicitacao"]))
            $this->id_solicitacao = $dados["id_solicitacao"];

        if(isset($dados["id_fornecedor"]))
            $this->id_fornecedor = $dados["id_fornecedor"];

        if(isset($dados["id_transportadora"]))
            $this->id_transportadora = $dados["id_transportadora"];

        if(isset($dados["codigo"]))
            $this->codigo = $dados["codigo"];

        if(isset($dados["data"]))
            $this->data = $dados["data"];

         if(isset($dados["valor_nf"]))
            $this->valor_nf = $dados["valor_nf"];

         if(isset($dados["desconto"]))
            $this->desconto = $dados["desconto"];

         if(isset($dados["numero_nf"]))
            $this->numero_nf = $dados["numero_nf"];

         if(isset($dados["valor_transportadora"]))
            $this->valor_transportadora = $dados["valor_transportadora"];

         if(isset($dados["forma_pagamento"]))
            $this->forma_pagamento = $dados["forma_pagamento"];

          if(isset($dados["data_vencimento"]))
            $this->data_vencimento = $dados["data_vencimento"];

          if(isset($dados["data_envio_financeiro"]))
            $this->data_envio_financeiro = $dados["data_envio_financeiro"];

          if(isset($dados["data_entrega"]))
            $this->data_entrega = $dados["data_entrega"];

          if(isset($dados["observacao"]))
            $this->observacao = $dados["observacao"];

         if(isset($dados["id_status"]))
            $this->id_status = $dados["id_status"];

         if(isset($dados["arquivo"]))
            $this->arquivo = $dados["arquivo"];

         if(isset($dados["faturar"]))
            $this->faturar = $dados["faturar"];

        if(isset($dados["endereco_entrega"]))
            $this->endereco_entrega = $dados["endereco_entrega"];

         if(isset($dados["contato"]))
            $this->contato = $dados["contato"];

        if(isset($dados["conhecimento_transportadora"]))
            $this->conhecimento_transportadora = $dados["conhecimento_transportadora"];



        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
	}


    public function getId_pedido(){
        return $this->id_pedido;
    }

    public function setId_pedido($id_pedido){
        $this->id_pedido = $id_pedido;
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

    public function getId_transportadora(){
        return $this->id_transportadora;
    }

    public function setId_transportadora($id_transportadora){
        $this->id_transportadora = $id_transportadora;
    }

    public function getCodigo(){
        return $this->codigo;
    }

    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }

    public function getData(){
        return $this->data;
    }

    public function setData($data){
        $this->data = $data;
    }

    public function getValor_nf(){
        return $this->valor_nf;
    }

    public function setValor_nf($valor_nf){
        $this->valor_nf = $valor_nf;
    }

     public function getDesconto(){
        return $this->desconto;
    }

    public function setDesconto($desconto){
        $this->desconto = $desconto;
    }

     public function getNumero_nf(){
        return $this->numero_nf;
    }

    public function setNumero_nf($numero_nf){
        $this->nuemro_nf = $numero_nf;
    }

    public function getValor_transportadora(){
        return $this->valor_transportadora;
    }

    public function setValor_transportadora($valor_transportadora){
        $this->valor_transportadora = $valor_transportadora;
    }

    public function getForma_pagamento(){
        return $this->forma_pagamento;
    }

    public function setForma_pagamento($forma_pagamento){
        $this->forma_pagamento = $forma_pagamento;
    }

    public function getData_vencimento(){
        return $this->data_vencimento;
    }

    public function setData_vencimento($data_vencimento){
        $this->data_vencimento = $data_vencimento;
    }

    public function getData_envio_financeiro(){
        return $this->data_envio_financeiro;
    }

    public function setData_envio_financeiro($data_envio_financeiro){
        $this->data_envio_financeiro = $data_envio_financeiro;
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

    public function getArquivo(){
        return $this->arquivo;
    }

    public function setArquivo($arquivo){
        $this->arquivo = $arquivo;
    }

     public function getFaturar(){
        return $this->faturar;
    }

    public function setFaturar($faturar){
        $this->faturar = $faturar;
    }

    public function getId_status(){
        return $this->id_status;
    }

    public function setId_status($id_status){
        $this->id_status = $id_status;
    }

    public function getEndereco_entrega(){
        return $this->endereco_entrega;
    }

    public function setEndereco_entrega($endereco_entrega){
        $this->endereco_entrega = $endereco_entrega;
    }

    public function getContato(){
        return $this->contato;
    }

    public function setContato($contato){
        $this->contato = $contato;
    }

     public function getConhecimento_transportadora(){
        return $this->conhecimento_transportadora;
    }

    public function setConhecimento_transportadora($conhecimento_transportadora){
        $this->conhecimento_transportadora = $conhecimento_transportadora;
    }

    public function getDeletado(){
        return $this->deletado;
    }

    public function setDeletado($deletado){
        $this->deletado = $deletado;
    }

    public function getFornecedor(){
        return $this->fornecedor;
    }

    public function setFornecedor($fornecedor){
        $this->fornecedor = $fornecedor;
    }

    public function getTransportadora(){
        return $this->transportadora;
    }

    public function setTransportadora($transportadora){
        $this->transportadora = $transportadora;
    }

    
    public function getSolicitacao(){
        return $this->solicitacao;
    }

    public function setSolicitacao($solicitacao){
        $this->solicitacao = $solicitacao;
    }


     public function getObjStatus(){
        return $this->objStatus;
    }

    public function setObjStatus($objStatus){
        $this->objStatus = $objStatus;
    }

     public function statusIs($objStatus){
           return $this->id_status == $objStatus;
    }

    public function transportadoraIs($transportadora){
           return $this->id_transportadora == $transportadora;
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

            unset($inArray["transportadora"]);
            unset($inArray["fornecedor"]);
            unset($inArray['objStatus']);
            unset($inArray['solicitacao']);
           
           
            
            return $inArray;
        }


 }
?>
