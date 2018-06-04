<?php
/* Classe(DAO): Pedidos Itens
* Autor: Anderson Farias
* Última atualização: 11/10/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Com_pedidos_itensDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objItem){
        $sucess = $this->db->insert("com_pedidos_itens",$objItem->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_iten = $this->db->insert_id();

        return $cod_iten;
    }
    
    
    public function listar($id_pedido) {
     	
    	$this->db->from("com_pedidos_itens");
    	$this->db->order_by("id_item","desc");
    	$this->db->where("id_pedido",$id_pedido);
        $this->db->where("deletado",0);
    	
        
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listItens = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listItens[] = $this->visualizar($dados["id_item"]);
    		}
    	}
    	return $listItens;
    }
    
    

    
	
    
    public function visualizar($id_item){
    	$this->db->from("com_pedidos_itens");
    	$this->db->where("id_item",$id_item);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objItem = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objItem = $this->Factory->createPojo("com_pedidos_itens",$dados);
                
                //Pedidos
                $pedidosBusiness = $this->Factory->createBusiness("com_pedidos");
                $objPedido = $pedidosBusiness->visualizar_simples($objItem->getId_pedido());
                $objItem->setPedido($objPedido);
                
                //Produto
                $produtoBusiness = $this->Factory->createBusiness("est_produtos");
                $objProduto = $produtoBusiness->visualizar($objItem->getId_produto());
                $objItem->setProduto($objProduto);

                $statusBusiness = $this->Factory->createBusiness("com_status_itens");
                $objStatus = $statusBusiness->visualizar($objItem->getId_status());
                $objItem->setStatus($objStatus);


    	}
    
    	return $objItem;
    
    
    }


      public function item_validar($id_pedido,$id_produto){
        $this->db->from("com_pedidos_itens");
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
            $objItem = $this->Factory->createPojo("com_pedidos_itens",$dados);
                
        }
    
        return $objItem;
    
    
    }

     
     public function editar_manual($dados){
        $this->db->where('id_item',$dados['id_item']);
        
        $sucess = $this->db->update("com_pedidos_itens",$dados);
         
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
     }

    
    
    public function alterar($objItem){
    	$this->db->where('id_item',$objItem->getId_item());
    	$sucess = $this->db->update("com_pedidos_itens",$objItem->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_item){
        $this->db->where('id_item',$id_item);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("com_pedidos_itens",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


     public function excluir_por_pedido($id_pedido){
        $this->db->where('id_pedido',$id_pedido);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("com_pedidos_itens",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


     public function valor_total($id_pedido){
        $query = $this->db->select_sum('valor_unitario * qtd', 'Amount');
        $query =$this->db->where("id_pedido",$id_pedido);
         $query =$this->db->where("deletado",DELETADO);
        $query = $this->db->get('com_pedidos_itens');
        $result = $query->result();

        return $result[0]->Amount;
            
    }



  

 }
?>
