<?php
/* Classe Pojo (VO): Contas a Pagar e Receber   
 * Autor: Anderson Farias
 * Última atualização: 12/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Fin_contas_receberPojo extends CI_Model {

    private $id_conta;
    private $id_pedido;
    private $id_custo;
    private $id_cliente;
    private $tipo; //define o tipo da conta
    private $descricao;
    private $valor_total;
    private $parcela_qtd;
    private $data;
    private $lanc_mensal; //se o lançamento será mensal (AINDA EM ANÁLISE)
    private $avulso; // se a conta é avulso
    private $deletado = false;
    
    private $custo; //obj centro de custos
    private $pedido;
    private $cliente;
                
    
    public function populate($dados){

       if(isset($dados["id_conta"]))
            $this->id_conta = $dados["id_conta"];
         
       if(isset($dados["id_pedido"]))
            $this->id_pedido = $dados["id_pedido"];
			
        if(isset($dados["id_custo"]))
            $this->id_custo = $dados["id_custo"];

          if(isset($dados["id_cliente"]))
            $this->id_cliente = $dados["id_cliente"];
	
        if(isset($dados["tipo"]))
            $this->tipo = $dados["tipo"];
	
        if(isset($dados["descricao"]))
            $this->descricao = $dados["descricao"];
	
        if(isset($dados["valor_total"]))
            $this->valor_total = $dados["valor_total"];
        
	if(isset($dados["parcela_qtd"]))
            $this->parcela_qtd = $dados["parcela_qtd"];
	
        if(isset($dados["data"]))
            $this->data = $dados["data"];
	
        if(isset($dados["lanc_mensal"]))
            $this->lanc_mensal = $dados["lanc_mensal"];
	
        if(isset($dados["avulso"]))
            $this->avulso = $dados["avulso"];
	
    if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
	}
	
	
        
        public function getId_conta() {
            return $this->id_conta;
        }

        

        public function getId_pedido() {
            return $this->id_pedido;
        }
      
        public function getId_custo() {
            return $this->id_custo;
        }

        public function getId_cliente() {
            return $this->id_cliente;
        }

        public function getTipo() {
            return $this->tipo;
        }

        public function getDescricao() {
            return $this->descricao;
        }

        public function getValor_total() {
            return $this->valor_total;
        }

        public function getParcela_qtd() {
            return $this->parcela_qtd;
        }

        public function getData() {
            return $this->data;
        }

        public function getLanc_mensal() {
            return $this->lanc_mensal;
        }

        public function getAvulso() {
            return $this->avulso;
        }

        public function getDeletado() {
            return $this->deletado;
        }

        
        public function getCusto() {
            return $this->custo;
        }

        public function getPedido() {
            return $this->pedido;
        }

        public function setPedido($pedido) {
            $this->pedido = $pedido;
        }

         public function getCliente() {
            return $this->cliente;
        }

        public function setCliente($cliente) {
            $this->cliente = $cliente;
        }

        

        public function setId_conta($id_conta) {
            $this->id_conta = $id_conta;
        }

        public function setId_pedido($id_pedido) {
            $this->id_pedido = $id_pedido;
        }

       
        public function setId_cliente($id_cliente) {
            $this->id_cliente = $id_cliente;
        }

        public function setId_custo($id_custo) {
            $this->id_custo = $id_custo;
        }

        public function setTipo($tipo) {
            $this->tipo = $tipo;
        }

        public function setDescricao($descricao) {
            $this->descricao = $descricao;
        }

        public function setValor_total($valor_total) {
            $this->valor_total = $valor_total;
        }

        public function setParcela_qtd($parcela_qtd) {
            $this->parcela_qtd = $parcela_qtd;
        }

        public function setData($data) {
            $this->data = $data;
        }

        public function setLanc_mensal($lanc_mensal) {
            $this->lanc_mensal = $lanc_mensal;
        }

        public function setAvulso($avulso) {
            $this->avulso = $avulso;
        }

        public function setDeletado($deletado) {
            $this->deletado = $deletado;
        }

       
        public function setCusto($custo) {
            $this->custo = $custo;
        }

        public function custoIs($custo){
           return $this->id_custo == $custo;
        }

         public function clienteIs($cliente){
           return $this->id_cliente == $cliente;
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

           
            unset($inArray["custo"]);
            unset($inArray["pedido"]);
            unset($inArray["cliente"]);
          
          
            
            return $inArray;
        }


 }
?>
