<?php
/* Classe(DAO): Pedidos Itens
* Autor: Anderson Farias
* Última atualização: 11/10/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Com_comandaDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objItem){
        $sucess = $this->db->insert("com_comanda",$objItem->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_iten = $this->db->insert_id();

        return $cod_iten;
    }
    
    
    public function listar($id_pedido) {
     	
    	$this->db->from("com_comanda");
    	$this->db->order_by("id_comanda","desc");
    	$this->db->where("id_pedido",$id_pedido);
        $this->db->where("deletado",0);
    	
        
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listItens = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listItens[] = $this->visualizar($dados["id_comanda"]);
    		}
    	}
    	return $listItens;
    }
    
    

    
	
    
    public function visualizar($id_item){
    	$this->db->from("com_comanda");
    	$this->db->where("id_comanda",$id_item);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objItem = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objItem = $this->Factory->createPojo("com_comanda",$dados);
                
                //Pedidos
                //$pedidosBusiness = $this->Factory->createBusiness("com_pedidos");
                //$objPedido = $pedidosBusiness->visualizar($objItem->getId_pedido());
                //$objItem->setPedido($objPedido);
                
                //Produto
                $produtoBusiness = $this->Factory->createBusiness("est_produtos");
                $objProduto = $produtoBusiness->visualizar($objItem->getId_produto());
                $objItem->setProduto($objProduto);

    	}
    
    	return $objItem;
    
    
    }


      public function item_validar($id_pedido,$id_produto){
        $this->db->from("com_comanda");
        $this->db->where("id_pedido",$id_pedido);
        $this->db->where("id_produto",$id_produto);
        $this->db->where("deletado",0);

        $query = $this->db->get();
    
        if($query==FALSE){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $objItem = NULL;
    
        if($query->num_rows()>0){
            $dados = $query->row_array();
            $objItem = $this->Factory->createPojo("com_comanda",$dados);
                
        }
    
        return $objItem;
    
    
    }
    
    
    public function alterar($objItem){
    	$this->db->where('id_comanda',$objItem->getId_comanda());
    	$sucess = $this->db->update("com_comanda",$objItem->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_item){
        $this->db->where('id_comanda',$id_item);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("com_comanda",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }




  

 }
?>
