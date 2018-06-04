<?php
/* Classe(DAO): Fornecedores
* Autor: Anderson Farias
* Última atualização: 29/06/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Com_fornecedoresDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objForn){
        $sucess = $this->db->insert("com_fornecedores",$objForn->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_fornecedor = $this->db->insert_id();

        return $cod_fornecedor;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("com_fornecedores");
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

        if ($dados["tipo"] != NULL):
            $this->db->where("tipo", $dados["tipo"]);
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
    
    	$listFornecedor = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listFornecedor[] = $this->visualizar($dados["id_fornecedor"]);
    		}
    	}
    	return $listFornecedor;
    }


     public function ajax_listar($pos){
        $this->db->from("com_fornecedores");
        if($pos==NAO){
         $this->db->order_by("nome_fantasia","asc");
        }else{
         $this->db->order_by("id_fornecedor","desc");   
        }

        $this->db->where("deletado",DELETADO);
        
        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }

        $listFornecedor = array();

          if($query!=NULL){
              foreach ($query->result_array() as $dados){

         
                $listFornecedor[] = array(
               'id_fornecedor'   => $dados['id_fornecedor'],
               'nome_fantasia'   => $dados['nome_fantasia'],
               );
                  
          }

          }

          return $listFornecedor;

    }
    
    
    public function visualizar($id_fornecedor){
    	$this->db->from("com_fornecedores");
    	$this->db->where("id_fornecedor",$id_fornecedor);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objFornecedor = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objFornecedor = $this->Factory->createPojo("com_fornecedores",$dados);
                
        }
    
    	return $objFornecedor;
    
    
    }
    
    
    public function alterar($objFornecedor){
    	$this->db->where('id_fornecedor',$objFornecedor->getId_fornecedor());
    	$sucess = $this->db->update("com_fornecedores",$objFornecedor->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_fornecedor){
        $this->db->where('id_fornecedor',$id_fornecedor);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("com_fornecedores",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }



     public function verificar_existente($documento){
        $this->db->from("com_fornecedores");
        
        $this->db->where("cnpj_cpf",$documento);
        

        $query = $this->db->get();
    
        if($query==FALSE){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $objFornecedor = NULL;
    
        if($query->num_rows()>0){
            $dados = $query->row_array();
            $objFornecedor = $this->Factory->createPojo("com_fornecedores",$dados);
                
        }
    
         
        return $objFornecedor;
    
    
    }
    


 }
?>
