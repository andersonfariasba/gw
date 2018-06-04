<?php
/* Classe(DAO): Clientes
* Autor: Anderson Farias
* Última atualização: 03/07/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Com_clientesDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objCliente){
        $sucess = $this->db->insert("com_clientes",$objCliente->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_cliente = $this->db->insert_id();

        return $cod_cliente;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("com_clientes");
    	$this->db->order_by("nome_fantasia","asc");
        $this->db->where_not_in('id_cliente',PAD_CAD_CLIENTE);
    	$this->db->where("deletado",DELETADO);

        if ($dados==NULL):
            $this->db->limit(100);
        endif;
    	

    	if ($dados["nome_fantasia"] != NULL):
    		$this->db->like("nome_fantasia", $dados["nome_fantasia"]);
    	endif;
        
        if ($dados["cnpj_cpf"] != NULL):
    		$this->db->where("cnpj_cpf", $dados["cnpj_cpf"]);
    	endif;

       

        if(isset($dados['tipo'])){ 
            if ($dados["tipo"] != NULL):
            $this->db->where("tipo", $dados["tipo"]);
            endif;
         }


         if ($dados["status"] != NULL):
    		$this->db->where("status", $dados["status"]);
    	endif;

        
        if(isset($dados['data_cadastro'])){
         if($dados["data_cadastro"] != NULL){
             $objDateFormat = $this->DateFormat;
             $data_cadastro = $objDateFormat->date_mysql($dados['data_cadastro']);
 
             $this->db->where("DATE(data_cadastro) BETWEEN '$data_cadastro' AND '$data_cadastro'");
             
            }
        }
    	


        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listClientes = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listClientes[] = $this->visualizar($dados["id_cliente"]);
    		}
    	}
    	return $listClientes;
    }



    //listar clientes para o orçamento
    public function listar_cliente_orcamento() {
        
        $this->db->from("com_clientes");
        $this->db->order_by("nome_fantasia");
         $this->db->where_not_in('id_cliente',PAD_CAD_CLIENTE);
        $this->db->where("deletado",DELETADO);
        $this->db->where("status",ATIVO);
        
      
         
        $query = $this->db->get();
    
        if ($query == FALSE) {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
    
        $listClientes = array();
    
        if ($query != NULL) {
            foreach ($query->result_array() as $dados) {
    
                $listClientes[] = $this->visualizar($dados["id_cliente"]);
            }
        }
        return $listClientes;
    }
    
    
    public function visualizar($id_cliente){
    	$this->db->from("com_clientes");
    	$this->db->where("id_cliente",$id_cliente);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objCliente = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objCliente = $this->Factory->createPojo("com_clientes",$dados);

             $cidadeBusiness = $this->Factory->createBusiness("cidade");
             $objCidade = $cidadeBusiness->visualizar($objCliente->getId_cidade());
             $objCliente->setCidadeObj($objCidade);

             $estadoBusiness = $this->Factory->createBusiness("estado");
             $objEstado = $estadoBusiness->visualizar($objCliente->getId_estado());
             $objCliente->setEstadoObj($objEstado);

                
        }
    
    	return $objCliente;
    
    
    }
    
    
    public function alterar($objCliente){
    	$this->db->where('id_cliente',$objCliente->getId_cliente());
    	$sucess = $this->db->update("com_clientes",$objCliente->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_cliente){
        $this->db->where('id_cliente',$id_cliente);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("com_clientes",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }



    public function verificar_existente($documento){
        $this->db->from("com_clientes");
        
        $this->db->where("cnpj_cpf",$documento);
        

        $query = $this->db->get();
    
        if($query==FALSE){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $objCliente = NULL;
    
        if($query->num_rows()>0){
            $dados = $query->row_array();
            $objCliente = $this->Factory->createPojo("com_clientes",$dados);
                
        }
    
         
        return $objCliente;
    
    
    }

    public function ajax_listar($pos){
        $this->db->from("com_clientes");
        if($pos==NAO){
         $this->db->order_by("nome_fantasia","asc");
        }else{
         $this->db->order_by("id_cliente","desc");   
        }

        $this->db->where("deletado",DELETADO);
        
        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }

        $listCliente = array();

          if($query!=NULL){
              foreach ($query->result_array() as $dados){

         
                $listCliente[] = array(
               'id_cliente'   => $dados['id_cliente'],
               'nome_fantasia'   => $dados['nome_fantasia'],
               );
                  
          }

          }

          return $listCliente;

    }
    


 }
?>
