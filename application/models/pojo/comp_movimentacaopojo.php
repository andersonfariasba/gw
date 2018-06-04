<?php
/* Classe Pojo (VO): Movimentação dos produtos
 * Autor: Anderson Farias
 * Última atualização: 11/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Comp_movimentacaoPojo extends CI_Model {

    private $id_movimentacao;
    private $tipo_movimentacao; //entrada ou retirada
    private $id_produto;
    private $id_pedido;
    private $id_fornecedor;
    private $id_usuario;
    private $descricao;
    private $responsavel;
    private $qtd_mov;
    private $valor_unitario;
    private $valor_custo;
    private $valor_total;
    private $data;
    private $tipo_retirada; //saida manual ou via compra
    private $deletado = false;
    
    private $produto; //Obj Produto
    private $pedido; //Obj Pedido
    private $fornecedor; //Obj Fornecedor
    
    public function populate($dados){
        if(isset($dados["id_movimentacao"]))
            $this->id_movimentacao = $dados["id_movimentacao"];

        if(isset($dados["tipo_movimentacao"]))
            $this->tipo_movimentacao = $dados["tipo_movimentacao"];
        
        if(isset($dados["id_produto"]))
            $this->id_produto = $dados["id_produto"];
        
        if(isset($dados["id_pedido"]))
            $this->id_pedido = $dados["id_pedido"];
        
        if(isset($dados["id_fornecedor"]))
            $this->id_fornecedor = $dados["id_fornecedor"];
        
        if(isset($dados["id_usuario"]))
            $this->id_usuario = $dados["id_usuario"];
        
       if(isset($dados["descricao"]))
            $this->descricao = $dados["descricao"];

       if(isset($dados["responsavel"]))
            $this->responsavel = $dados["responsavel"];

       
        if(isset($dados["qtd_mov"]))
            $this->qtd_mov = $dados["qtd_mov"];
        
        if(isset($dados["valor_unitario"]))
            $this->valor_unitario = $dados["valor_unitario"];

        if(isset($dados["valor_custo"]))
            $this->valor_custo = $dados["valor_custo"];
        
        if(isset($dados["valor_total"]))
            $this->valor_total = $dados["valor_total"];
        
        if(isset($dados["data"]))
            $this->data = $dados["data"];
        
        if(isset($dados["tipo_retirada"]))
            $this->tipo_retirada = $dados["tipo_retirada"];
        
        
        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
	}
        
        
        public function getId_movimentacao() {
            return $this->id_movimentacao;
        }

        public function getTipo_movimentacao() {
            return $this->tipo_movimentacao;
        }

        public function getId_produto() {
            return $this->id_produto;
        }

        public function getId_pedido() {
            return $this->id_pedido;
        }

        public function getId_fornecedor() {
            return $this->id_fornecedor;
        }

        public function getDescricao() {
            return $this->descricao;
        }

        public function getQtd_mov() {
            return $this->qtd_mov;
        }

        public function getValor_unitario() {
            return $this->valor_unitario;
        }

         public function getValor_custo() {
            return $this->valor_custo;
        }

        public function getValor_total() {
            return $this->valor_total;
        }

        public function getData() {
            return $this->data;
        }

        public function getTipo_retirada() {
            return $this->tipo_retirada;
        }

        public function getDeletado() {
            return $this->deletado;
        }

        public function setId_movimentacao($id_movimentacao) {
            $this->id_movimentacao = $id_movimentacao;
        }

        public function setTipo_movimentacao($tipo_movimentacao) {
            $this->tipo_movimentacao = $tipo_movimentacao;
        }

        public function setId_produto($id_produto) {
            $this->id_produto = $id_produto;
        }

        public function setId_pedido($id_pedido) {
            $this->id_pedido = $id_pedido;
        }

        public function setId_fornecedor($id_fornecedor) {
            $this->id_fornecedor = $id_fornecedor;
        }

        public function setDescricao($descricao) {
            $this->descricao = $descricao;
        }

        public function setQtd_mov($qtd_mov) {
            $this->qtd_mov = $qtd_mov;
        }

        public function setValor_unitario($valor_unitario) {
            $this->valor_unitario = $valor_unitario;
        }


        public function setValor_custo($valor_custo) {
            $this->valor_custo = $valor_custo;
        }

        public function setValor_total($valor_total) {
            $this->valor_total = $valor_total;
        }

        public function setData($data) {
            $this->data = $data;
        }

        public function setTipo_retirada($tipo_retirada) {
            $this->tipo_retirada = $tipo_retirada;
        }

        public function setDeletado($deletado) {
            $this->deletado = $deletado;
        }
        
        public function getId_usuario() {
            return $this->id_usuario;
        }

        public function getResponsavel() {
            return $this->responsavel;
        }

        public function getProduto() {
            return $this->produto;
        }

        public function getPedido() {
            return $this->pedido;
        }

        public function getFornecedor() {
            return $this->fornecedor;
        }

        public function setId_usuario($id_usuario) {
            $this->id_usuario = $id_usuario;
        }

        public function setResponsavel($responsavel) {
            $this->responsavel = $responsavel;
        }

        public function setProduto($produto) {
            $this->produto = $produto;
        }

        public function setPedido($pedido) {
            $this->pedido = $pedido;
        }

        public function setFornecedor($fornecedor) {
            $this->fornecedor = $fornecedor;
        }
        
        //Verifica o tipo da movimentação
        public function printMovimentacao(){
            if($this->tipo_movimentacao==ENTRADA){
                echo "<span class='btn btn-success btn-small buttom_width'>ENTRADA</span>";
            }
            else if($this->tipo_movimentacao==SAIDA){
           
                echo "<span class='btn btn-danger btn-small buttom_width'>SAÍDA</span>";
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
            unset($inArray["produto"]);
            unset($inArray["fornecedor"]);
            unset($inArray["pedido"]);
            
            return $inArray;
        }


 }
?>
