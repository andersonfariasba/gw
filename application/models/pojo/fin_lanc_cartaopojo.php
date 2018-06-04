<?php
/* Classe Pojo (VO): Contas a Pagar e Receber   
 * Autor: Anderson Farias
 * Última atualização: 12/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Fin_lanc_cartaoPojo extends CI_Model {

    private $id_lanc_cartao;
    private $id_pedido;
    private $tipo_cartao;
    private $id_forma;
    private $id_fornecedor;
    private $descricao;
    private $data_transacao;
    private $data_vencimento;
    private $numero_documento;
    private $valor_parcela; 
    private $qtd_parcela;
    private $valor_total;
    private $observacao;
    private $status;
    private $deletado = false;
    
    private $fornecedor; //obj fornecedor
    private $pedido; //obj pedido compra
    private $forma; //obj pedido compra
 
    
      //PAGAMENTOS
    public static $ABERTO = "<span class='btn btn-danger btn-small buttom_width'>ABERTO</span>";
    public static $PAGO = "<span class='btn btn-success btn-small buttom_width'>PAGO</span>";    
        
    public function populate($dados){
        if(isset($dados["id_lanc_cartao"]))
            $this->id_lanc_cartao = $dados["id_lanc_cartao"];
         
        if(isset($dados["id_pedido"]))
            $this->id_pedido = $dados["id_pedido"];

        if(isset($dados["tipo_cartao"]))
            $this->tipo_cartao = $dados["tipo_cartao"];

        if(isset($dados["id_forma"]))
            $this->id_forma = $dados["id_forma"];
	
       if(isset($dados["id_fornecedor"]))
            $this->id_fornecedor = $dados["id_fornecedor"];
			
       if(isset($dados["descricao"]))
            $this->descricao = $dados["descricao"];

     if(isset($dados["data_vencimento"]))
            $this->data_vencimento = $dados["data_vencimento"];

    if(isset($dados["data_transacao"]))
            $this->data_transacao = $dados["data_transacao"];

    if(isset($dados["numero_documento"]))
            $this->numero_documento = $dados["numero_documento"];

    if(isset($dados["valor_parcela"]))
            $this->valor_parcela = $dados["valor_parcela"];

     if(isset($dados["qtd_parcela"]))
            $this->qtd_parcela = $dados["qtd_parcela"];
	
      if(isset($dados["valor_total"]))
            $this->valor_total = $dados["valor_total"];
        
	 	
        if(isset($dados["observacao"]))
            $this->observacao = $dados["observacao"];
	
        
        if(isset($dados["status"]))
            $this->status = $dados["status"];
               
                
        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
	}
	
	
        
    public function getId_lanc_cartao(){
        return $this->id_lanc_cartao;
    }

    public function setId_lanc_cartao($id_lanc_cartao){
        $this->id_lanc_cartao = $id_lanc_cartao;
    }

    public function getId_pedido(){
        return $this->id_pedido;
    }

    public function setId_pedido($id_pedido){
        $this->id_pedido = $id_pedido;
    }

    public function getTipo_cartao(){
        return $this->tipo_cartao;
    }

    public function setTipo_cartao($tipo_cartao){
        $this->tipo_cartao = $tipo_cartao;
    }

    public function getId_forma(){
        return $this->id_forma;
    }

    public function setId_forma($id_forma){
        $this->id_forma = $id_forma;
    }

    public function getId_fornecedor(){
        return $this->id_fornecedor;
    }

    public function setId_fornecedor($id_fornecedor){
        $this->id_fornecedor = $id_fornecedor;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    public function getData_transacao(){
        return $this->data_transacao;
    }

    public function setData_transacao($data_transacao){
        $this->data_transacao = $data_transacao;
    }

    public function getData_vencimento(){
        return $this->data_vencimento;
    }

    public function setData_vencimento($data_vencimento){
        $this->data_vencimento = $data_vencimento;
    }

    public function getNumero_documento(){
        return $this->numero_documento;
    }

    public function setNumero_documento($numero_documento){
        $this->numero_documento = $numero_documento;
    }

    public function getValor_parcela(){
        return $this->valor_parcela;
    }

    public function setValor_parcela($valor_parcela){
        $this->valor_parcela = $valor_parcela;
    }

    public function getQtd_parcela(){
        return $this->qtd_parcela;
    }

    public function setQtd_parcela($qtd_parcela){
        $this->qtd_parcela = $qtd_parcela;
    }

    public function getValor_total(){
        return $this->valor_total;
    }

    public function setValor_total($valor_total){
        $this->valor_total = $valor_total;
    }

    public function getObservacao(){
        return $this->observacao;
    }

    public function setObservacao($observacao){
        $this->observacao = $observacao;
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

    public function getFornecedor(){
        return $this->fornecedor;
    }

    public function setFornecedor($fornecedor){
        $this->fornecedor = $fornecedor;
    }

    public function getPedido(){
        return $this->pedido;
    }

    public function setPedido($pedido){
        $this->pedido = $pedido;
    }

    public function getForma(){
        return $this->forma;
    }

    public function setForma($forma){
        $this->forma = $forma;
    }


   public function fornecedorIs($fornecedor){
           return $this->id_fornecedor == $fornecedor;
        }

   public function formaIs($forma){
           return $this->id_forma == $forma;
        }

                
      
                
      public function statusIs($status){
        return $this->status == $status;
      }
        
        public function printStatus() {
        switch ($this->status) {
            case PAGO:
                    echo fin_lanc_cartaoPojo::$PAGO;
                break;

            case ABERTO:
                    echo fin_lanc_cartaoPojo::$ABERTO;
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

            unset($inArray["fornecedor"]);
            unset($inArray["pedido"]);
            unset($inArray["forma"]);
            
            return $inArray;
        }


 }
?>
