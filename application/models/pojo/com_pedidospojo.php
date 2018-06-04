<?php
/* Classe Pojo (VO): Pedidos
 * Autor: Anderson Farias
 * Última atualização: 01/10/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Com_pedidosPojo extends CI_Model {

    private $id_pedido;
    private $id_usuario;
    private $id_cliente;
    private $codigo;
    private $tipo; //orçamento ou os
    private $data_inicio;
    private $data_validade;
    private $data_final;
    private $hora_retirada;
    private $observacao;
    private $taxa_frete;
    private $desconto;
    private $desconto_perc;
    private $valor_total;
    private $valor_pago;
    private $status;
    private $escopo; //1 - PRODUTO / 2 - SERVICO
    private $endereco_entrega;
    private $ponto_entrega;
    private $cep_entrega;
    private $estado_entrega;
    private $cidade_entrega;
    
    private $id_mesa;
    private $id_garcon;
    private $qtd_pessoas_mesa;


    private $faturado;

    private $codigo_orcamento;
    private $orcamento;
    private $locacao; //flag para saber se é uma locação

    private $deletado = false;
    
    private $usuario; //obj usuário
    private $cliente; //obj cliente
    private $total_itens; //$obj referente ao R$: valor total do pedido
    private $itens_pedidos; //lista dos itens do pedido

    private $garcon;
    private $mesa;

    private $total_venda; //total lançamento

    private $objStatus; //status;
 

       
    //status
    private static $ANDAMENTO = "<span class='btn btn-info btn-sm'><strong>ANDAMENTO</strong></span>";
    private static $FINALIZADO = "<span class='btn btn-success btn-sm'><strong>FINALIZADO</strong></span>";
    private static $CANCELADO = "<span class='btn btn-danger btn-sm'><strong>CANCELADO</strong></span>";
    private static $APROVADO = "<span class='btn btn-warning btn-sm'>REALIZADO</span>";
    private static $PROCESSAMENTO = "<span class='btn btn-warning btn-sm'>EM PROCESSAMENTO</span>";
    
    
    
    
    public function populate($dados){
        if(isset($dados["id_pedido"]))
            $this->id_pedido = $dados["id_pedido"];

          if(isset($dados["codigo"]))
            $this->codigo = $dados["codigo"];

        if(isset($dados["id_usuario"]))
            $this->id_usuario = $dados["id_usuario"];

      
			
        if(isset($dados["id_cliente"]))
            $this->id_cliente = $dados["id_cliente"];

       
	       
        if(isset($dados["tipo"]))
            $this->tipo = $dados["tipo"];
        
	   if(isset($dados["data_inicio"]))
            $this->data_inicio = $dados["data_inicio"];

          if(isset($dados["data_validade"]))
            $this->data_validade = $dados["data_validade"];
	        
        if(isset($dados["data_final"]))
            $this->data_final = $dados["data_final"];

         if(isset($dados["hora_retirada"]))
            $this->hora_retirada = $dados["hora_retirada"];
        
                
        if(isset($dados["status"]))
            $this->status = $dados["status"];
        
       
        if(isset($dados["observacao"]))
            $this->observacao = $dados["observacao"];

        if(isset($dados["taxa_frete"]))
            $this->taxa_frete = $dados["taxa_frete"];
        
        if(isset($dados["desconto"]))
            $this->desconto = $dados["desconto"];

         if(isset($dados["desconto_perc"]))
            $this->desconto_perc = $dados["desconto_perc"];

         if(isset($dados["valor_pago"]))
            $this->valor_pago = $dados["valor_pago"];

         if(isset($dados["valor_total"]))
            $this->valor_total = $dados["valor_total"];
        
          if(isset($dados["escopo"]))
            $this->escopo = $dados["escopo"];

          if(isset($dados["endereco_entrega"]))
            $this->endereco_entrega = $dados["endereco_entrega"];

         if(isset($dados["ponto_entrega"]))
            $this->ponto_entrega = $dados["ponto_entrega"];

         if(isset($dados["estado_entrega"]))
            $this->estado_entrega = $dados["estado_entrega"];

         if(isset($dados["cidade_entrega"]))
            $this->cidade_entrega = $dados["cidade_entrega"];

         if(isset($dados["cep_entrega"]))
            $this->cep_entrega = $dados["cep_entrega"];

         if(isset($dados["id_mesa"]))
            $this->id_mesa = $dados["id_mesa"];

         if(isset($dados["id_garcon"]))
            $this->id_garcon = $dados["id_garcon"];

        if(isset($dados["qtd_pessoas_mesa"]))
            $this->qtd_pessoas_mesa = $dados["qtd_pessoas_mesa"];


         if(isset($dados["faturado"]))
            $this->faturado = $dados["faturado"];

          if(isset($dados["codigo_orcamento"]))
            $this->codigo_orcamento = $dados["codigo_orcamento"];
        
         
           if(isset($dados["orcamento"]))
            $this->orcamento = $dados["orcamento"];

           if(isset($dados["locacao"]))
            $this->locacao = $dados["locacao"];

        
        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
	}



    public function getId_pedido(){
        return $this->id_pedido;
    }

    public function setId_pedido($id_pedido){
        $this->id_pedido = $id_pedido;
    }


    public function getCodigo(){
        return $this->codigo;
    }

    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }


    public function getId_usuario(){
        return $this->id_usuario;
    }

    public function setId_usuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }


  

    public function getId_cliente(){
        return $this->id_cliente;
    }

    
    public function setId_cliente($id_cliente){
        $this->id_cliente = $id_cliente;
    }

  

    

    public function getTipo(){
        return $this->tipo;
    }

    public function setTipo($tipo){
        $this->tipo = $tipo;
    }

    public function getData_inicio(){
        return $this->data_inicio;
    }

    public function setData_inicio($data_inicio){
        $this->data_inicio = $data_inicio;
    }

    public function getData_validade(){
        return $this->data_validade;
    }

    public function setData_validade($data_validade){
        $this->data_validade = $data_validade;
    }

    public function getData_final(){
        return $this->data_final;
    }

    public function setData_final($data_final){
        $this->data_final = $data_final;
    }

    public function getHora_retirada(){
        return $this->hora_retirada;
    }

    public function setHora_retirada($hora_retirada){
        $this->hora_retirada = $hora_retirada;
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

    
    public function getObjStatus(){
        return $this->objStatus;
    }

    public function setObjStatus($objStatus){
        $this->objStatus = $objStatus;
    }



    public function getEscopo(){
        return $this->escopo;
    }

    public function setEscopo($escopo){
        $this->escopo = $escopo;
    }


    public function getDeletado(){
        return $this->deletado;
    }

    public function setDeletado($deletado){
        $this->deletado = $deletado;
    }

    public function getUsuario(){
        return $this->usuario;
    }

    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }

    public function getCliente(){
        return $this->cliente;
    }

    public function setCliente($cliente){
        $this->cliente = $cliente;
    }



     
    


    public function usuarioIs($usuario){
        return $this->id_usuario == $usuario;
       }

    public function garconIs($garcon){
        return $this->id_garcon == $garcon;
       }
       
    public function clienteIs($cliente){
        return $this->id_cliente == $cliente;
       }
                        
    public function statusIs($status){
        return $this->status == $status;
      }

    public function tipoIs($tipo){
        return $this->tipo == $tipo;
      }

    public function getTaxa_frete(){
        return $this->taxa_frete;
    }

    public function setTaxa_frete($taxa_frete){
        $this->taxa_frete = $taxa_frete;
    }

    public function getDesconto(){
        return $this->desconto;
    }

    public function setDesconto($desconto){
        $this->desconto = $desconto;
    }

     public function getDesconto_perc(){
        return $this->desconto_perc;
    }

    public function setDesconto_perc($desconto_perc){
        $this->desconto_perc = $desconto_perc;
    }

    public function getValor_total(){
        return $this->valor_total;
    }

    public function setValor_total($valor_total){
        $this->valor_total = $valor_total;
    }

    public function getValor_pago(){
        return $this->valor_pago;
    }

    public function setValor_pago($valor_pago){
        $this->valor_pago = $valor_pago;
    }



    public function getEndereco_entrega(){
        return $this->endereco_entrega;
    }

    public function setEndereco_entrega($endereco_entrega){
        $this->endereco_entrega = $endereco_entrega;
    }

    public function getPonto_entrega(){
        return $this->ponto_entrega;
    }

    public function setPonto_entrega($ponto_entrega){
        $this->ponto_entrega = $ponto_entrega;
    }

    public function getCep_entrega(){
        return $this->cep_entrega;
    }

    public function setCep_entrega($cep_entrega){
        $this->cep_entrega = $cep_entrega;
    }

    public function getEstado_entrega(){
        return $this->estado_entrega;
    }

    public function setEstado_entrega($estado_entrega){
        $this->estado_entrega = $estado_entrega;
    }

    public function getCidade_entrega(){
        return $this->cidade_entrega;
    }

    public function setCidade_entrega($cidade_entrega){
        $this->cidade_entrega = $cidade_entrega;
    }

     public function getFaturado(){
        return $this->faturado;
    }

    public function setFaturado($faturado){
        $this->faturado = $faturado;
    }



     public function setTotal_itens($total_itens){
        $this->total_itens = $total_itens;
    }

    public function getTotal_itens(){
        return $this->total_itens;
    }


    public function getItens_pedidos() {
         return $this->itens_pedidos;
     }

     public function setItens_pedidos($itens_pedidos) {
         $this->itens_pedidos = $itens_pedidos;
     }


     public function setTotal_venda($total_venda){
        $this->total_venda = $total_venda;
    }

    public function getTotal_venda(){
        return $this->total_venda;
    }


    public function getCodigo_orcamento(){
        return $this->codigo_orcamento;
    }

    public function setCodigo_orcamento($codigo_orcamento){
        $this->codigo_orcamento = $codigo_orcamento;
    }

    public function getId_mesa(){
        return $this->id_mesa;
    }

    public function setId_mesa($id_mesa){
        $this->id_mesa = $id_mesa;
    }

    public function getId_garcon(){
        return $this->id_garcon;
    }

    public function setId_garcon($id_garcon){
        $this->id_garcon = $id_garcon;
    }

    public function getQtd_pessoas_mesa(){
        return $this->qtd_pessoas_mesa;
    }

    public function setQtd_pessoas_mesa($qtd_pessoas_mesa){
        $this->qtd_pessoas_mesa = $qtd_pessoas_mesa;
    }

     public function getOrcamento(){
        return $this->orcamento;
    }

    public function setOrcamento($orcamento){
        $this->orcamento = $orcamento;
    }

    public function getLocacao(){
        return $this->locacao;
    }

    public function setLocacao($locacao){
        $this->locacao = $locacao;
    }

    public function getGarcon(){
        return $this->garcon;
    }

    public function setGarcon($garcon){
        $this->garcon = $garcon;
    }

    public function getMesa(){
        return $this->mesa;
    }

    public function setMesa($mesa){
        $this->mesa = $mesa;
    }

        
    public function printStatus() {
        switch ($this->status) {
            case ANDAMENTO:
                    echo com_pedidosPojo::$ANDAMENTO;
                break;

            case FINALIZADO:
                    echo com_pedidosPojo::$FINALIZADO;
                break;

            case CANCELADO:
                    echo com_pedidosPojo::$CANCELADO;
                break;

            case APROVADO:
                    echo com_pedidosPojo::$APROVADO;
                break;

            case PROCESSAMENTO:
                    echo com_pedidosPojo::$PROCESSAMENTO;
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

            unset($inArray["usuario"]);
            unset($inArray["cliente"]);
            unset($inArray["total_itens"]);
            unset($inArray['itens_pedidos']);
             unset($inArray['total_venda']);
             unset($inArray['objStatus']);
              unset($inArray['garcon']);
               unset($inArray['mesa']);
            
            
            return $inArray;
        }


 }
?>
