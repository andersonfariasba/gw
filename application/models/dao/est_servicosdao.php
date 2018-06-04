<?php
/* Classe(DAO): Serviços
* Autor: Anderson Farias
* Última atualização: 12/07/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Est_servicosDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objProduto){
        $sucess = $this->db->insert("est_produtos",$objProduto->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_produto = $this->db->insert_id();

        return $cod_produto;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("est_produtos");
    	$this->db->order_by("descricao");
    	$this->db->where("deletado",DELETADO);
        $this->db->where("tipo",SERVICO);
    	
    	if ($dados["descricao"] != NULL):
    		$this->db->like("descricao", $dados["descricao"]);
    	endif;
        
        if ($dados["codigo"] != NULL):
    		$this->db->where("codigo", $dados["codigo"]);
    	endif;

        if ($dados["id_categoria"] != NULL):
            $this->db->where("id_categoria", $dados["id_categoria"]);
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
    
    
    public function visualizar($id_produto){
    	$this->db->from("est_produtos");
    	$this->db->where("id_produto",$id_produto);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objProduto = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objProduto = $this->Factory->createPojo("est_servicos",$dados);
                
                
                //Categoria
                $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
                $objCategoria = $categoriaBusiness->visualizar($objProduto->getId_categoria());
                $objProduto->setCategoria($objCategoria);
                
                
        }
    
    	return $objProduto;
    
    
    }
    
    
    public function alterar($objProduto){
    	$this->db->where('id_produto',$objProduto->getId_produto());
    	$sucess = $this->db->update("est_produtos",$objProduto->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_produto){
        $this->db->where('id_produto',$id_produto);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("est_produtos",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


 }
?>
