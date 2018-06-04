<?php
/* Classe(DAO): Clientes
* Autor: Anderson Farias
* Última atualização: 03/07/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Fin_filiaisDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objCliente){
        $sucess = $this->db->insert("fin_filiais",$objCliente->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_cliente = $this->db->insert_id();

        return $cod_cliente;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("fin_filiais");
    	$this->db->order_by("nome_fantasia");
       	$this->db->where("deletado",DELETADO);
    	
    	if ($dados["nome_fantasia"] != NULL):
    		$this->db->like("nome_fantasia", $dados["nome_fantasia"]);
    	endif;
        
        if ($dados["cnpj_cpf"] != NULL):
    		$this->db->where("cnpj_cpf", $dados["cnpj_cpf"]);
    	endif;

      
         if ($dados["status"] != NULL):
    		$this->db->where("status", $dados["status"]);
    	endif;
    	 
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listClientes = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listClientes[] = $this->visualizar($dados["id_filial"]);
    		}
    	}
    	return $listClientes;
    }



    //listar clientes para o orçamento
    public function listar() {
        
        $this->db->from("fin_filiais");
        $this->db->order_by("nome_fantasia");
        $this->db->where("deletado",DELETADO);
        $this->db->where("status",ATIVO);
        
      
         
        $query = $this->db->get();
    
        if ($query == FALSE) {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
    
        $listClientes = array();
    
        if ($query != NULL) {
            foreach ($query->result_array() as $dados) {
    
                $listClientes[] = $this->visualizar($dados["id_filial"]);
            }
        }
        return $listClientes;
    }
    
    
    public function visualizar($id_filial){
    	$this->db->from("fin_filiais");
    	$this->db->where("id_filial",$id_filial);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objCliente = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objCliente = $this->Factory->createPojo("fin_filiais",$dados);

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
    	$this->db->where('id_filial',$objCliente->getId_filial());
    	$sucess = $this->db->update("fin_filiais",$objCliente->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_filial){
        $this->db->where('id_filial',$id_filial);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("fin_filiais",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }



    public function verificar_existente($documento){
        $this->db->from("fin_filiais");
        
        $this->db->where("cnpj_cpf",$documento);
        

        $query = $this->db->get();
    
        if($query==FALSE){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $objCliente = NULL;
    
        if($query->num_rows()>0){
            $dados = $query->row_array();
            $objCliente = $this->Factory->createPojo("fin_filiais",$dados);
                
        }
    
         
        return $objCliente;
    
    
    }


      public function ajax_listar($pos){
        $this->db->from("fin_filiais");
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

        $listClientes = array();

          if($query!=NULL){
              foreach ($query->result_array() as $dados){

                // $objBandeira = $this->Factory->createPojo("fin_bandeira_cartao",$dados);
                // $listBandeira[] = $objBandeira;

                $listClientes[] = array(
               'id_filial'   => $dados['id_filial'],
               'nome_fantasia'      => $dados['nome_fantasia'],
               );
                  
          }

          }

          return $listClientes;

    }
    


 }
?>
