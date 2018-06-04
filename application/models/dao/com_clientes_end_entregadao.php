<?php
/* Classe(DAO): Clientes endereço de entrega
* Autor: Anderson Farias
* Última atualização: 03/07/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Com_clientes_end_entregaDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objCliente){
        $sucess = $this->db->insert("com_clientes_end_entrega",$objCliente->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_cliente = $this->db->insert_id();

        return $cod_cliente;
    }
    
    
  

    //listar clientes para o orçamento
    public function listar($id_cliente) {
        
        $this->db->from("com_clientes_end_entrega");
        $this->db->where("deletado",DELETADO);
        $this->db->where("id_cliente",$id_cliente);
        
      
         
        $query = $this->db->get();
    
        if ($query == FALSE) {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
    
        $listClientes = array();
    
        if ($query != NULL) {
            foreach ($query->result_array() as $dados) {
    
                $listClientes[] = $this->visualizar($dados["id_endereco"]);
            }
        }
        return $listClientes;
    }



    public function visualizar_por_cliente($id_cliente){
        $this->db->from("com_clientes_end_entrega");
        $this->db->where("id_cliente",$id_cliente);
        $this->db->order_by("id_endereco","desc");
        
        $query = $this->db->get();
    
        if($query==FALSE){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $objEndereco = NULL;
    
        if($query->num_rows()>0){
            $dados = $query->row_array();
            $objEndereco = $this->Factory->createPojo("com_clientes_end_entrega",$dados);
                
        }
    
        return $objEndereco;
    
    
    }
    
    
    
    public function visualizar($id_endereco){
    	$this->db->from("com_clientes_end_entrega");
    	$this->db->where("id_endereco",$id_endereco);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objCliente = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objCliente = $this->Factory->createPojo("com_clientes_end_entrega",$dados);
                
        }
    
    	return $objCliente;
    
    
    }
    
    
    public function alterar($objCliente){
    	$this->db->where('id_endereco',$objCliente->getId_endereco());
    	$sucess = $this->db->update("com_clientes_end_entrega",$objCliente->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    

 }
?>
