<?php
/* Classe Pojo (VO): Formas de Pagamentos
 * Autor: Anderson Farias
 * Última atualização: 03/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Fin_formas_recebimentosPojo extends CI_Model {

    private $id_forma;
    private $forma;
    private $tipo;
    private $maximo_parcela;
    private $qtd_dia_compensa;
    private $taxa;
    private $data_vencimento_manual;

    //DADOS USADOS ANTERIORMENTE, NÃO USADO NESTA NOVA LÓGICA
    private $cartao; //se é um cartão
    private $status;
    private $crAntecipado = NAO; 

    //FINAL DADOS

    private $status_financeiro;

    private $taxa_tipo;
    private $id_tabela_nome;
    
    private $deletado = false;
    
   
    //status
    private static $ATIVO = "<span class='btn btn-success btn-small buttom_width'>ATIVO</span>";
    private static $BLOQUEADO = "<span class='btn btn-warning btn-small buttom_width'>BLOQUEADO</span>";

    //status
    private static $TAXA_UNICA = "<span class='btn btn-success btn-small buttom_width'>Taxa Unica</span>";
    private static $TAXA_TABELA = "<span class='btn btn-warning btn-small buttom_width'>Taxa por Tabela</span>";

     //status financeiro
    //RECEBIMENTOS
    public static $ABERTO = "<span class='btn btn-danger btn-small buttom_width'>PENDENTE</span>";
    public static $PAGO = "<span class='btn btn-success btn-small buttom_width'>RECEBIDO</span>";
    public static $CANCELADO = "<span class='btn btn-warning btn-small buttom_width'>CANCELADO</span>";
    public static $APROVADO = "<span class='btn btn-info btn-small buttom_width'>APROVADO</span>";
    
  public function populate($dados){
        if(isset($dados["id_forma"]))
            $this->id_forma = $dados["id_forma"];

        if(isset($dados["forma"]))
            $this->forma = $dados["forma"];
        
        if(isset($dados["tipo"]))
            $this->tipo = $dados["tipo"];

        if(isset($dados["maximo_parcela"]))
            $this->maximo_parcela = $dados["maximo_parcela"];
        
        if(isset($dados["qtd_dia_compensa"]))
            $this->qtd_dia_compensa = $dados["qtd_dia_compensa"];

        if(isset($dados["taxa"]))
            $this->taxa = $dados["taxa"];
        
                
        if(isset($dados["cartao"]))
            $this->cartao = $dados["cartao"];
      
        if(isset($dados["status"]))
            $this->status = $dados["status"];
        
        if(isset($dados["crAntecipado"]))
            $this->crAntecipado = $dados["crAntecipado"];

          if(isset($dados["data_vencimento_manual"]))
            $this->data_vencimento_manual = $dados["data_vencimento_manual"];

         if(isset($dados["status_financeiro"]))
            $this->status_financeiro = $dados["status_financeiro"];

         if(isset($dados["taxa_tipo"]))
            $this->taxa_tipo = $dados["taxa_tipo"];

         if(isset($dados["id_tabela_nome"]))
            $this->id_tabela_nome = $dados["id_tabela_nome"];
                
      
        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
	}
        
        
        public function getId_forma() {
            return $this->id_forma;
        }

        public function getForma() {
            return $this->forma;
        }

        public function getStatus() {
            return $this->status;
        }

         public function getStatus_financeiro() {
            return $this->status_financeiro;
        }

        public function getCrAntecipado() {
            return $this->crAntecipado;
        }

        public function getDeletado() {
            return $this->deletado;
        }

        public function setId_forma($id_forma) {
            $this->id_forma = $id_forma;
        }

        public function setForma($forma) {
            $this->forma = $forma;
        }

        public function setStatus($status) {
            $this->status = $status;
        }

         public function setStatus_financeiro($status_financeiro) {
            $this->status_financeiro = $status_financeiro;
        }

        public function setCrAntecipado($crAntecipado) {
            $this->crAntecipado = $crAntecipado;
        }

        
               
        public function getCartao() {
            return $this->cartao;
        }

        public function setCartao($cartao) {
            $this->cartao = $cartao;
        }

         public function getData_vencimento_manual() {
            return $this->data_vencimento_manual;
        }

        public function setData_vencimento_manual($data_vencimento_manual) {
            $this->data_vencimento_manual = $data_vencimento_manual;
        }

        
        
        public function setDeletado($deletado) {
            $this->deletado = $deletado;
        }

    public function getTipo(){
        return $this->tipo;
    }

    public function setTipo($tipo){
        $this->tipo = $tipo;
    }

    public function getMaximo_parcela(){
        return $this->maximo_parcela;
    }

    public function setMaximo_parcela($maximo_parcela){
        $this->maximo_parcela = $maximo_parcela;
    }

    public function getQtd_dia_compensa(){
        return $this->qtd_dia_compensa;
    }

    public function setQtd_dia_compensa($qtd_dia_compensa){
        $this->qtd_dia_compensa = $qtd_dia_compensa;
    }

    public function getTaxa(){
        return $this->taxa;
    }

    public function setTaxa($taxa){
        $this->taxa = $taxa;
    }

  
  public function getTaxa_tipo(){
        return $this->taxa_tipo;
    }

    public function setTaxa_tipo($taxa_tipo){
        $this->taxa_tipo = $taxa_tipo;
    }

    public function getId_tabela_nome(){
        return $this->id_tabela_nome;
    }

    public function setId_tabela_nome($id_tabela_nome){
        $this->id_tabela_nome = $id_tabela_nome;
    }
        
        
       public function statusIs($status){
        return $this->status == $status;
       }

        public function tabelaIs($tabela){
        return $this->id_tabela_nome == $tabela;
       }

     public function taxaTipoIs($taxa_tipo){
        return $this->taxa_tipo == $taxa_tipo;
       }

        public function statusFinanceiroIs($status_financeiro){
        return $this->status_financeiro == $status_financeiro;
       }
        
        public function printStatus() {
        switch ($this->status) {
            case ATIVO:
                    echo fin_formas_recebimentosPojo::$ATIVO;
                break;

            case BLOQUEADO:
                    echo fin_formas_recebimentosPojo::$BLOQUEADO;
                break;
            
            default:
         
            break;
        }
    }

     public function printTaxa() {
        switch ($this->status) {
            case TAXA_UNICA:
                    echo fin_formas_recebimentosPojo::$TAXA_UNICA;
                break;

            case TAXA_TABELA:
                    echo fin_formas_recebimentosPojo::$TAXA_TABELA;
                break;
            
            default:
         
            break;
        }
    }


     public function printStatusFinanceiro() {
        switch ($this->status_financeiro) {
            case ABERTO:
                    echo fin_formas_recebimentosPojo::$ABERTO;
                break;

            case PAGO:
                    echo fin_formas_recebimentosPojo::$PAGO;
                break;
            
            case CANCELADO:
                    echo fin_formas_recebimentosPojo::$CANCELADO;
                break;

            case APROVADO:
                    echo fin_formas_recebimentosPojo::$APROVADO;
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

            return $inArray;
        }


 }
?>
