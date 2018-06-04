<?php
/* Classe(DAO): Fornecedores
* Autor: Anderson Farias
* Última atualização: 29/06/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Com_transportadorasDao extends CI_Model {
    
    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objTrans){
        $sucess = $this->db->insert("com_transportadoras",$objTrans->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_transportadora = $this->db->insert_id();

        return $cod_transportadora;
    }
    
    
    public function filtro($dados){
     	
    	$this->db->from("com_transportadoras");
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
                
    	 
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listTransportadora = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listTransportadora[] = $this->visualizar($dados["id_transportadora"]);
    		}
    	}
    	return $listTransportadora;
    }


    public function ajax_listar($pos){
        $this->db->from("com_transportadoras");
        if($pos==NAO){
         $this->db->order_by("nome_fantasia","asc");
        }else{
         $this->db->order_by("id_transportadora","desc");   
        }

        $this->db->where("deletado",DELETADO);
        
        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }

        $listTransportadora = array();

          if($query!=NULL){
              foreach ($query->result_array() as $dados){

         
                $listTransportadora[] = array(
               'id_transportadora'   => $dados['id_transportadora'],
               'nome_fantasia'   => $dados['nome_fantasia'],
               );
                  
          }

          }

          return $listTransportadora;

    }
    
    
    public function visualizar($id_transportadora){
    	$this->db->from("com_transportadoras");
    	$this->db->where("id_transportadora",$id_transportadora);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objTransportadora = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objTransportadora = $this->Factory->createPojo("com_transportadoras",$dados);
                
        }
    
    	return $objTransportadora;
    }
    
    
    public function alterar($objTransportadora){
    	$this->db->where('id_transportadora',$objTransportadora->getId_transportadora());
    	$sucess = $this->db->update("com_transportadoras",$objTransportadora->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    }
    
    
    public function excluir($id_transportadora){
        $this->db->where('id_transportadora',$id_transportadora);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("com_transportadoras",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }



    public function verificar_existente($documento){
        $this->db->from("com_transportadoras");
        
        $this->db->where("cnpj_cpf",$documento);
        

        $query = $this->db->get();
    
        if($query==FALSE){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $objTransportadora = NULL;
    
        if($query->num_rows()>0){
            $dados = $query->row_array();
            $objTransportadora = $this->Factory->createPojo("com_transportadoras",$dados);
                
        }
    
         
        return $objTransportadora;
    }
}

?>
