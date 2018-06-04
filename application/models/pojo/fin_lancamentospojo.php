<?php
/* Classe Pojo (VO): Lançamentos   
 * Autor: Anderson Farias
 * Última atualização: 12/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Fin_lancamentosPojo extends CI_Model {

    private $id_lancamento;
    private $id_conta;
    private $id_forma;
    private $id_bandeira;
    private $id_boleto;  //em análise e desenvolvimento
    private $id_conta_banco;
    private $parcela;
    private $valor_titulo;
    private $multa;
    private $juros;
    private $descricao;
    private $data_vencimento;
    private $data_pagamento;
    private $pagamento_antecipado;
    private $observacao; 
    private $deletado = false;
    private $status; //obj status
    
    private $conta; //obj conta
    private $forma; //obj forma
    private $bandeira; //obj Bandeira
    private $conta_banco; //obj Conta bancária         
    
    
     //RECEBIMENTOS
    public static $ABERTO_CR = "<span class='btn btn-danger btn-small buttom_width'>AGUARDANDO</span>";
    public static $PAGO_CR = "<span class='btn btn-success btn-small buttom_width'>APROVADO</span>";
    public static $CANCELADO_CR = "<span class='btn btn-warning btn-small buttom_width'>CANCELADO</span>";
    //public static $APROVADO_CR = "<span class='btn btn-info btn-small buttom_width'>APROVADO</span>";

     //PAGAMENTOS
    public static $ABERTO = "<span class='btn btn-danger btn-small buttom_width'>ABERTO</span>";
    public static $PAGO = "<span class='btn btn-success btn-small buttom_width'>PAGO</span>";
    public static $CANCELADO = "<span class='btn btn-warning btn-small buttom_width'>CANCELADO</span>";
    public static $APROVADO = "<span class='btn btn-info btn-small buttom_width'>AUTORIZADO</span>";


  
    
    public function populate($dados){
        if(isset($dados["id_lancamento"]))
            $this->id_lancamento = $dados["id_lancamento"];

        if(isset($dados["id_conta"]))
            $this->id_conta = $dados["id_conta"];
			
        if(isset($dados["id_forma"]))
            $this->id_forma = $dados["id_forma"];

        if(isset($dados["id_bandeira"]))
            $this->id_bandeira = $dados["id_bandeira"];
	
        if(isset($dados["id_forma"]))
            $this->id_forma = $dados["id_forma"];

          if(isset($dados["id_conta_banco"]))
            $this->id_conta_banco = $dados["id_conta_banco"];
	
         if(isset($dados["id_boleto"]))
            $this->id_boleto = $dados["id_boleto"];
         
          if(isset($dados["status"]))
            $this->status = $dados["status"];
	 
         if(isset($dados["parcela"]))
            $this->parcela = $dados["parcela"];
	
         if(isset($dados["valor_titulo"]))
            $this->valor_titulo = $dados["valor_titulo"];
         
     	 if(isset($dados["multa"]))
            $this->multa = $dados["multa"];
	
         if(isset($dados["juros"]))
            $this->juros = $dados["juros"];
	
         
         if(isset($dados["descricao"]))
            $this->descricao = $dados["descricao"];
	
        if(isset($dados["data_vencimento"]))
            $this->data_vencimento = $dados["data_vencimento"];
        
	    if(isset($dados["data_pagamento"]))
            $this->data_pagamento = $dados["data_pagamento"];

         if(isset($dados["observacao"]))
            $this->observacao = $dados["observacao"];

    if(isset($dados["pagamento_antecipado"]))
            $this->pagamento_antecipado = $dados["pagamento_antecipado"];
	
       if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
	}
        
        
        public function getId_lancamento() {
            return $this->id_lancamento;
        }

        public function getId_conta() {
            return $this->id_conta;
        }

        public function getId_forma() {
            return $this->id_forma;
        }


       public function getId_conta_banco() {
            return $this->id_conta_banco;
        }


        public function getId_bandeira() {
            return $this->id_bandeira;
        }

        public function getId_boleto() {
            return $this->id_boleto;
        }

        public function getParcela() {
            return $this->parcela;
        }

        public function getValor_titulo() {
            return $this->valor_titulo;
        }

        public function getMulta() {
            return $this->multa;
        }

        public function getJuros() {
            return $this->juros;
        }

        public function getDescricao() {
            return $this->descricao;
        }

        public function getData_vencimento() {
            return $this->data_vencimento;
        }

        public function getData_pagamento() {
            return $this->data_pagamento;
        }

          public function getPagamento_antecipado() {
            return $this->pagamento_antecipado;
        }

        public function getObservacao() {
            return $this->observacao;
        }

        public function getDeletado() {
            return $this->deletado;
        }

        public function getStatus() {
            return $this->status;
        }

        public function getConta() {
            return $this->conta;
        }

        public function getForma() {
            return $this->forma;
        }

        public function getConta_banco() {
            return $this->conta_banco;
        }

        public function getBandeira() {
            return $this->bandeira;
        }

        public function setId_lancamento($id_lancamento) {
            $this->id_lancamento = $id_lancamento;
        }

        public function setId_conta($id_conta) {
            $this->id_conta = $id_conta;
        }

        public function setId_forma($id_forma) {
            $this->id_forma = $id_forma;
        }

          public function setId_conta_banco($id_conta_banco) {
            $this->id_conta_banco = $id_conta_banco;
        }

        public function setId_bandeira($id_bandeira) {
            $this->id_bandeira = $id_bandeira;
        }

        public function setId_boleto($id_boleto) {
            $this->id_boleto = $id_boleto;
        }

        public function setParcela($parcela) {
            $this->parcela = $parcela;
        }

        public function setValor_titulo($valor_titulo) {
            $this->valor_titulo = $valor_titulo;
        }

        public function setMulta($multa) {
            $this->multa = $multa;
        }

        public function setJuros($juros) {
            $this->juros = $juros;
        }

        public function setDescricao($descricao) {
            $this->descricao = $descricao;
        }

        public function setData_vencimento($data_vencimento) {
            $this->data_vencimento = $data_vencimento;
        }

        public function setData_pagamento($data_pagamento) {
            $this->data_pagamento = $data_pagamento;
        }

        public function setPagamento_antecipado($pagamento_antecipado) {
            $this->pagamento_antecipado = $pagamento_antecipado;
        }

        
        public function setObservacao($observacao) {
            $this->observacao = $observacao;
        }

        public function setDeletado($deletado) {
            $this->deletado = $deletado;
        }

        public function setStatus($status) {
            $this->status = $status;
        }

        public function setConta($conta) {
            $this->conta = $conta;
        }

        public function setForma($forma) {
            $this->forma = $forma;
        }

         public function setConta_banco($conta_banco) {
            $this->conta_banco = $conta_banco;
        }


        public function setBandeira($bandeira) {
            $this->bandeira = $bandeira;
        }
        
        public function statusIs($status){
        return $this->status == $status;
       }

       public function formaIs($forma){
           return $this->id_forma == $forma;
       }

       public function bandeiraIs($bandeira){
           return $this->id_bandeira == $bandeira;
       }

     public function contaBancoIs($conta_banco){
           return $this->id_conta_banco == $conta_banco;
       }
       
      
        public function printStatusPagar() {
        switch ($this->status) {
            case ABERTO:
                    echo fin_lancamentosPojo::$ABERTO;
                break;

            case PAGO:
                    echo fin_lancamentosPojo::$PAGO;
                break;
            
            case CANCELADO:
                    echo fin_lancamentosPojo::$CANCELADO;
                break;

            case APROVADO:
                    echo fin_lancamentosPojo::$APROVADO;
                break;


            default:
         break;
        }
    }


     public function printStatusReceber() {
        switch ($this->status) {
            case ABERTO:
                    echo fin_lancamentosPojo::$ABERTO_CR;
                break;

            case PAGO:
                    echo fin_lancamentosPojo::$PAGO_CR;
                break;
            
            case CANCELADO:
                    echo fin_lancamentosPojo::$CANCELADO_CR;
                break;

            case APROVADO:
                    echo fin_lancamentosPojo::$APROVADO_CR;
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

         
            unset($inArray["conta"]);
            unset($inArray["forma"]);
            unset($inArray["bandeira"]);
            unset($inArray["conta_banco"]);
           
            return $inArray;
        }


 }
?>
