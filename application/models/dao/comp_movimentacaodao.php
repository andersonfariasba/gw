<?php
/* Classe(DAO): Movimentaco dos produtos
* Autor: Anderson Farias
* Última atualização: 11/07/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Comp_movimentacaoDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objMovimentacao){
        $sucess = $this->db->insert("comp_movimentacao",$objMovimentacao->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_movimentacao = $this->db->insert_id();

        return $cod_movimentacao;
    }


      public function listar($cod_produto, $tipo_movimentacao) {
   
        $this->db->from("comp_movimentacao");
        $this->db->where("id_produto", $cod_produto);
        $this->db->where("tipo_movimentacao", $tipo_movimentacao);
        $this->db->where("deletado",0);
       
        $query = $this->db->get();

        if ($query == FALSE) {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }

        $listMovimentacao = array();

        if ($query != NULL) {
            foreach ($query->result_array() as $dados) {
                $listMovimentacao[] = $this->visualizar($dados["id_movimentacao"]);
        }
        
        }
        return $listMovimentacao;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("comp_movimentacao");
    	$this->db->order_by("data","desc");
        $this->db->where("deletado",DELETADO);
        
        $data_de = $dados["data_de"];
        $data_ate = $dados["data_ate"];
    	
        if($dados["tipo_movimentacao"]!=null){
          $this->db->where("tipo_movimentacao",$dados["tipo_movimentacao"]);
        }
        
    	if ($data_de!=NULL && $data_ate!=NULL):
             
        $objDateFormat = $this->DateFormat;
        $data_de = $objDateFormat->date_mysql($data_de);
        $data_ate = $objDateFormat->date_mysql($data_ate);
        $this->db->where("DATE(data) BETWEEN '$data_de' AND '$data_ate' ");
    	endif;
    	 
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listMovimentacao = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listMovimentacao[] = $this->visualizarSimples($dados["id_movimentacao"]);
    		}
    	}
    	return $listMovimentacao;
    }


     public function visualizarSimples($id_movimentacao){
        $this->db->from("comp_movimentacao");
        $this->db->where("id_movimentacao",$id_movimentacao);
        $query = $this->db->get();
    
        if($query==FALSE){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $objMovimentacao = NULL;
    
        if($query->num_rows()>0){
            $dados = $query->row_array();
            $objMovimentacao = $this->Factory->createPojo("comp_movimentacao",$dados);
        
                //PRODUTO
                $produtoBussiness = $this->Factory->createBusiness("comp_produtos");
                $objProduto = $produtoBussiness->visualizar($objMovimentacao->getId_produto());
                $objMovimentacao->setProduto($objProduto);

                 //Fornecedor
                $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
                $objFornecedor = $fornecedorBusiness->visualizar($objMovimentacao->getId_fornecedor());
                $objMovimentacao->setFornecedor($objFornecedor);
                
                
        }
    
        return $objMovimentacao;
    
    
    }
    
    

    	
    
    public function visualizar($id_movimentacao){
    	$this->db->from("comp_movimentacao");
    	$this->db->where("id_movimentacao",$id_movimentacao);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objMovimentacao = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objMovimentacao = $this->Factory->createPojo("comp_movimentacao",$dados);

    	
                            
                
        }
    
    	return $objMovimentacao;
    
    
    }
    
    
        
    
    public function excluir($id_movimentacao){
        $this->db->where('id_movimentacao',$id_movimentacao);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("comp_movimentacao",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


    public function excluir_por_pedido($id_pedido){
        $this->db->where('id_pedido',$id_pedido);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("comp_movimentacao",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


    public function filtro_financeiro($dados) {
    
        $data_de = $dados["data_de"];
        $data_ate = $dados["data_ate"];
        
        $this->db->select("id_movimentacao");
        $this->db->order_by("data"); //ordenar pela coluna
        $this->db->from("comp_movimentacao");
        $this->db->where("tipo_movimentacao",REMOVER_MOV);
        //$this->db->where("tipo_estoque",PRODUTO);
        $this->db->where("deletado",0);
        
        
     if ($data_de != NULL && $data_ate != NULL):
                $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);

            $this->db->where("DATE(data) BETWEEN '$data_de' AND '$data_ate'");
     endif;
     
     if ($dados["id_pedido"] != NULL):
         $this->db->where("id_pedido", $dados["id_pedido"]);
       endif;
       
       $query = $this->db->get();

        if ($query == FALSE) {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }

        $listPedidos = array();

        if ($query != NULL) {
            foreach ($query->result_array() as $dados) {

                $listPedidos[] = $this->visualizarSimples($dados["id_movimentacao"]);
            }
        }
        return $listPedidos;
    }


     //MOTRAR O TOTAL DA CONTA REFERENTE A UMA DATA
     public function filtro_mov_total($dados) {
              
        //$this->db->select_sum('est_movimentacao.qtd_mov');
        $this->db->select('sum(comp_movimentacao.qtd_mov) as qtd, comp_movimentacao.tipo_movimentacao,comp_movimentacao.valor_custo, comp_produtos.descricao,comp_produtos.valor_venda');
        $this->db->from("comp_movimentacao");
        $this->db->join('comp_produtos', 'comp_produtos.id_produto = comp_movimentacao.id_produto');
        $this->db->group_by("comp_movimentacao.id_produto");

         if($dados["tipo_movimentacao"]!=null){
          $this->db->where("comp_movimentacao.tipo_movimentacao",$dados["tipo_movimentacao"]);
        }
     
      

        $data_de = $dados["data_de"];
        $data_ate = $dados["data_ate"];
           
         if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                
              $this->db->where("DATE(comp_movimentacao.data) BETWEEN '$data_de' AND '$data_ate'");
         endif;
        
        
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }


 }
?>
