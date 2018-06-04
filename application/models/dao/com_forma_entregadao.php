<?php
/* Classe(DAO): Categoria de produtos
* Autor: Anderson Farias
* Última atualização: 28/06/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Com_forma_entregaDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objCategoria){
        $sucess = $this->db->insert("com_forma_entrega",$objCategoria->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_categoria = $this->db->insert_id();

        return $cod_categoria;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("com_forma_entrega");
    	$this->db->order_by("forma");
    	$this->db->where("deletado",DELETADO);
        if($dados==null){
            $this->db->where("situacao",ATIVO);
    	}
    	if ($dados["forma"] != NULL):
    		$this->db->like("forma", $dados["forma"]);
    	endif;

        if ($dados["situacao"] != NULL):
            $this->db->where("situacao", $dados["situacao"]);
        endif;
    	 
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listCategoria = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listCategoria[] = $this->visualizar($dados["id_forma"]);
    		}
    	}
    	return $listCategoria;
    }
    
    

    
    public function ajax_listar($pos){
        $this->db->from("com_forma_entrega");
        if($pos==NAO){
         $this->db->order_by("forma","asc");
        }else{
         $this->db->order_by("id_forma","desc");   
        }

        $this->db->where("deletado",DELETADO);
        
        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }

        $listCategoria = array();

          if($query!=NULL){
              foreach ($query->result_array() as $dados){

                // $objBandeira = $this->Factory->createPojo("fin_bandeira_cartao",$dados);
                // $listBandeira[] = $objBandeira;

                $listCategoria[] = array(
               'id_forma'   => $dados['id_forma'],
               'forma'      => $dados['forma'],
               );
                  
          }

          }

          return $listCategoria;

    }
	


	
    
    public function visualizar($id_forma){
    	$this->db->from("com_forma_entrega");
    	$this->db->where("id_forma",$id_forma);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objCategoria = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objCategoria = $this->Factory->createPojo("com_forma_entrega",$dados);
    	}
    
    	return $objCategoria;
    
    
    }
    
    
    public function alterar($dados){
    	$this->db->where('id_forma',$dados['id_forma']);
    	$sucess = $this->db->update("com_forma_entrega",$dados);
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_forma){
        $this->db->where('id_forma',$id_forma);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("com_forma_entrega",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


 }
?>
