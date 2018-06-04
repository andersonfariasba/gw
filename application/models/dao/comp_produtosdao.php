<?php
/* Classe(DAO): Produtos
* Autor: Anderson Farias
* Última atualização: 30/06/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Comp_produtosDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objProduto){
        $sucess = $this->db->insert("comp_produtos",$objProduto->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_produto = $this->db->insert_id();

        return $cod_produto;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("comp_produtos");
    	$this->db->order_by("descricao");
    	$this->db->where("deletado",DELETADO);
        $this->db->where("tipo",PRODUTO);
        
        if($dados==null){
            $this->db->where_not_in('id_categoria',6);
    	}

    	if ($dados["descricao"] != NULL):
    		$this->db->like("descricao", $dados["descricao"]);
    	endif;
        
        if ($dados["codigo"] != NULL):
    		$this->db->where("codigo", $dados["codigo"]);
    	endif;

        if ($dados["id_categoria"] != NULL):
            $this->db->where("id_categoria", $dados["id_categoria"]);
        endif;

        if ($dados["id_fornecedor"] != NULL):
            $this->db->where("id_fornecedor", $dados["id_fornecedor"]);
        endif;
    	 


        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listProdutos = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listProdutos[] = $this->visualizar($dados["id_produto"]);
    		}
    	}
    	
        return $listProdutos;
    }



     public function listar_produto_servico() {
        
        $this->db->from("comp_produtos");
        $this->db->order_by("descricao");
        $this->db->where("deletado",DELETADO);
        $this->db->where("habilitado_venda",SIM);
        
        $query = $this->db->get();
    
        if ($query == FALSE) {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
    
        $listProdutos = array();
    
        if ($query != NULL) {
            foreach ($query->result_array() as $dados) {
    
                $listProdutos[] = $this->visualizar($dados["id_produto"]);
            }
        }
        
        return $listProdutos;
    }



    
    
    public function visualizar($id_produto){
    	$this->db->from("comp_produtos");
    	$this->db->where("id_produto",$id_produto);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objProduto = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objProduto = $this->Factory->createPojo("comp_produtos",$dados);
                
                //Unidade de Medida
                $unidadeBusiness = $this->Factory->createBusiness("est_un_medida");
                $objUnidade = $unidadeBusiness->visualizar($objProduto->getId_unidade());
                $objProduto->setUnidade($objUnidade);
                
                //Categoria
                $categoriaBusiness = $this->Factory->createBusiness("comp_categorias");
                $objCategoria = $categoriaBusiness->visualizar($objProduto->getId_categoria());
                $objProduto->setCategoria($objCategoria);
                
                //Fornecedor
                $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
                $objFornecedor = $fornecedorBusiness->visualizar($objProduto->getId_fornecedor());
                $objProduto->setFornecedor($objFornecedor);
                
                //Movimentação
                $est_movimentacaoBusiness = $this->Factory->createBusiness("comp_movimentacao");
                $qtdEstoque = $est_movimentacaoBusiness->qtdEstoque($objProduto->getId_produto());
                $objProduto->setQtdEstoque($qtdEstoque);
                
        }
    
    	return $objProduto;
    
    
    }
    
    
    public function alterar($objProduto){
    	$this->db->where('id_produto',$objProduto->getId_produto());
    	$sucess = $this->db->update("comp_produtos",$objProduto->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_produto){
        $this->db->where('id_produto',$id_produto);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("comp_produtos",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }



      public function ajax_listar_produto($dados){
        $this->db->from("comp_produtos");
        $this->db->order_by("descricao","asc");
        $this->db->limit(50);
        
        if($dados["descricao"]!=NULL){
         $this->db->like("descricao", $dados["descricao"]);   
        }

        if($dados["codigo"]!=NULL){
         $this->db->where("codigo", $dados["codigo"]);   
        }



        $this->db->where("deletado",DELETADO);
        $this->db->where("habilitado_venda",SIM);

        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }

        $listProduto = array();

          if($query!=NULL){
              foreach ($query->result_array() as $dados){

                // $objBandeira = $this->Factory->createPojo("fin_bandeira_cartao",$dados);
                // $listBandeira[] = $objBandeira;

                $listProduto[] = array(
               'id_produto'   => $dados['id_produto'],
               'descricao'    => $dados['descricao'],
               'valor_venda'  => $dados['valor_venda'],
               'codigo'   => $dados['codigo'],
               );
                  
          }

          }

          return $listProduto;

    }


    public function listar_categoria($id_categoria){
        $this->db->from("comp_produtos");
        $this->db->order_by("descricao");
        $this->db->where("id_categoria",$id_categoria);
            $this->db->where("deletado",DELETADO);
            
        
        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }

        $listProdutos = array();

          if($query!=NULL){
              foreach ($query->result_array() as $dados){

                  $objProdutos = $this->Factory->createPojo("comp_produtos",$dados);
                  $listProdutos[] = $objProdutos;
                                
                              
                //Categoria
                //$categoriaBusiness = $this->Factory->createBusiness("est_categorias");
                //$objCategoria = $categoriaBusiness->visualizar($objProduto->getId_categoria());
                //$objProduto->setCategoria($objCategoria);
                  
                  
                  
              }
          }

          return $listProdutos;

    }
    


  }

?>
