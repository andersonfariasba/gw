<?php
/* Classe Pojo (VO): Contas a Pagar e Receber   
 * Autor: Anderson Farias
 * Última atualização: 12/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Fin_contas_pagarPojo extends CI_Model {

    private $id_conta;
    private $id_fornecedor;
    private $id_custo;
    private $id_plano;
    private $numero_nf;
    private $tipo; //define o tipo da conta
    private $descricao;
    private $valor_total;
    private $parcela_qtd;
    private $data;
    private $lanc_mensal; //se o lançamento será mensal (AINDA EM ANÁLISE)
    private $avulso; // se a conta é avulso
    private $deletado = false;
    
    private $fornecedor; //obj fornecedor
    private $custo; //obj centro de custos
    private $plano; //obj plano de contas
        
        
    public function populate($dados){
        if(isset($dados["id_conta"]))
            $this->id_conta = $dados["id_conta"];
         
       	
       if(isset($dados["id_fornecedor"]))
            $this->id_fornecedor = $dados["id_fornecedor"];
			
        if(isset($dados["id_custo"]))
            $this->id_custo = $dados["id_custo"];

         if(isset($dados["id_plano"]))
            $this->id_plano = $dados["id_plano"];

        if(isset($dados["numero_nf"]))
            $this->numero_nf = $dados["numero_nf"];
	
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

        

        public function getId_fornecedor() {
            return $this->id_fornecedor;
        }

       

        public function getId_custo() {
            return $this->id_custo;
        }

        public function getId_plano() {
            return $this->id_plano;
        }

        public function getNumero_nf() {
            return $this->numero_nf;
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

        public function getFornecedor() {
            return $this->fornecedor;
        }

        public function getCusto() {
            return $this->custo;
        }

         public function getPlano() {
            return $this->plano;
        }

        

        public function setId_conta($id_conta) {
            $this->id_conta = $id_conta;
        }

       
        public function setId_fornecedor($id_fornecedor) {
            $this->id_fornecedor = $id_fornecedor;
        }

        public function setId_cliente($id_cliente) {
            $this->id_cliente = $id_cliente;
        }

        public function setId_custo($id_custo) {
            $this->id_custo = $id_custo;
        }

        public function setId_plano($id_plano) {
            $this->id_plano = $id_plano;
        }

        public function setNumero_nf($numero_nf) {
            $this->numero_nf = $numero_nf;
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

        public function setFornecedor($fornecedor) {
            $this->fornecedor = $fornecedor;
        }

         public function setPlano($plano) {
            $this->plano = $plano;
        }

        public function setCusto($custo) {
            $this->custo = $custo;
        }

       

             public function custoIs($custo){
           return $this->id_custo == $custo;
        }

         public function fornecedorIs($fornecedor){
           return $this->id_fornecedor == $fornecedor;
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

            unset($inArray["fornecedor"]);
            unset($inArray["custo"]);
            unset($inArray["plano"]);
          
            
            return $inArray;
        }


 }
?>
