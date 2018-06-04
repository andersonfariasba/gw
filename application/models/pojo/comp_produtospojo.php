<?php
/* Classe Pojo (VO): Produtos
 * Autor: Anderson Farias
 * Última atualização: 30/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Comp_produtosPojo extends CI_Model {

    private $id_produto;
    private $id_unidade;
    private $id_categoria;
    private $id_fornecedor;
    private $tipo; //produto ou serviço
    private $codigo;
    private $referencia;
    private $descricao;
    private $valor_custo;
    private $valor_venda;
    private $qtd_minima;
    private $localizacao;
    private $observacao;
    private $abater_estoque;
    private $qtdEstoque;
    private $status;
    private $habilitado_venda;
    private $deletado = false;
    
    private $unidade; //obj unidade
    private $categoria; //obj categoria
    private $fornecedor; //obj fornecedor
       
    //status
    private static $ATIVO = "ATIVO";
    private static $BLOQUEADO = "BLOQUEADO";
    
    
    public function populate($dados){
        if(isset($dados["id_produto"]))
            $this->id_produto = $dados["id_produto"];

        if(isset($dados["id_unidade"]))
            $this->id_unidade = $dados["id_unidade"];
			
        if(isset($dados["id_categoria"]))
            $this->id_categoria = $dados["id_categoria"];
	
        if(isset($dados["id_fornecedor"]))
            $this->id_fornecedor = $dados["id_fornecedor"];
	
        if(isset($dados["tipo"]))
            $this->tipo = $dados["tipo"];
        
	if(isset($dados["codigo"]))
            $this->codigo = $dados["codigo"];
	
        if(isset($dados["referencia"]))
            $this->referencia = $dados["referencia"];
	        
        if(isset($dados["descricao"]))
            $this->descricao = $dados["descricao"];
        
        if(isset($dados["valor_custo"]))
            $this->valor_custo = $dados["valor_custo"];
        
	if(isset($dados["valor_venda"]))
            $this->valor_venda = $dados["valor_venda"];
	
        if(isset($dados["qtd_minima"]))
            $this->qtd_minima = $dados["qtd_minima"];
        
       
        if(isset($dados["localizacao"]))
            $this->localizacao = $dados["localizacao"];
       
        if(isset($dados["observacao"]))
            $this->observacao = $dados["observacao"];


        if(isset($dados["abater_estoque"]))
            $this->abater_estoque = $dados["abater_estoque"];
       
        
        if(isset($dados["status"]))
            $this->status = $dados["status"];
       
        if(isset($dados["habilitado_venda"]))
            $this->habilitado_venda = $dados["habilitado_venda"];
            
        if(isset($dados["data_cadastro"]))
            $this->data_cadastro = $dados["data_cadastro"];
        
        
        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
	}
	
	
	
        public function getId_produto() {
            return $this->id_produto;
        }

        public function getId_unidade() {
            return $this->id_unidade;
        }

        public function getId_categoria() {
            return $this->id_categoria;
        }

        public function getId_fornecedor() {
            return $this->id_fornecedor;
        }

        public function getTipo() {
            return $this->tipo;
        }

        public function getCodigo() {
            return $this->codigo;
        }

        public function getReferencia() {
            return $this->referencia;
        }

        public function getDescricao() {
            return $this->descricao;
        }

        public function getValor_custo() {
            return $this->valor_custo;
        }

        public function getValor_venda() {
            return $this->valor_venda;
        }

        public function getQtd_minima() {
            return $this->qtd_minima;
        }

        public function getAbater_estoque() {
            return $this->abater_estoque;
        }

        public function getHabilitado_venda() {
            return $this->habilitado_venda;
        }

        public function getStatus() {
            return $this->status;
        }

        public function getDeletado() {
            return $this->deletado;
        }

        public function setId_produto($id_produto) {
            $this->id_produto = $id_produto;
        }

        public function setId_unidade($id_unidade) {
            $this->id_unidade = $id_unidade;
        }

        public function setId_categoria($id_categoria) {
            $this->id_categoria = $id_categoria;
        }

        public function setId_fornecedor($id_fornecedor) {
            $this->id_fornecedor = $id_fornecedor;
        }

        public function setTipo($tipo) {
            $this->tipo = $tipo;
        }

        public function setCodigo($codigo) {
            $this->codigo = $codigo;
        }

        public function setReferencia($referencia) {
            $this->referencia = $referencia;
        }

        public function setDescricao($descricao) {
            $this->descricao = $descricao;
        }

        public function setValor_custo($valor_custo) {
            $this->valor_custo = $valor_custo;
        }

        public function setValor_venda($valor_venda) {
            $this->valor_venda = $valor_venda;
        }

        public function setAbater_estoque($abater_estoque) {
            $this->abater_estoque = $abater_estoque;
        }

        public function setQtd_minima($qtd_minima) {
            $this->qtd_minima = $qtd_minima;
        }

        public function setHabilitado_venda($habilitado_venda) {
            $this->habilitado_venda = $habilitado_venda;
        }

        public function setStatus($status) {
            $this->status = $status;
        }

        public function setDeletado($deletado) {
            $this->deletado = $deletado;
        }
        
        public function getUnidade() {
            return $this->unidade;
        }

        public function getCategoria() {
            return $this->categoria;
        }

        public function getFornecedor() {
            return $this->fornecedor;
        }

        public function setUnidade($unidade) {
            $this->unidade = $unidade;
        }

        public function setCategoria($categoria) {
            $this->categoria = $categoria;
        }

        public function setFornecedor($fornecedor) {
            $this->fornecedor = $fornecedor;
        }
        
        public function getLocalizacao() {
            return $this->localizacao;
        }

        public function setLocalizacao($localizacao) {
            $this->localizacao = $localizacao;
        }
        
        public function getObservacao() {
            return $this->observacao;
        }

        public function setObservacao($observacao) {
            $this->observacao = $observacao;
        }

        public function getQtdEstoque() {
        return $this->qtdEstoque;
        }

        public function setQtdEstoque($qtdEstoque) {
        $this->qtdEstoque = $qtdEstoque;
        }
        
       public function categoriaIs($categoria){
        return $this->id_categoria == $categoria;
       }
       
       public function unidadeIs($unidade){
        return $this->id_unidade == $unidade;
       }
       
       public function fornecedorIs($fornecedor){
        return $this->id_fornecedor == $fornecedor;
       }

               
                

       public function statusIs($status){
        return $this->status == $status;
      }
        
        public function printStatus() {
        switch ($this->status) {
            case ATIVO:
                    echo comp_produtosPojo::$ATIVO;
                break;

            case BLOQUEADO:
                    echo comp_produtosPojo::$BLOQUEADO;
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

            unset($inArray["unidade"]);
            unset($inArray["categoria"]);
            unset($inArray["fornecedor"]);
            unset($inArray['qtdEstoque']);
            return $inArray;
        }


 }
?>
