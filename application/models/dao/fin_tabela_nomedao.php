<?php
/* Classe(DAO): Categoria de produtos
* Autor: Anderson Farias
* Última atualização: 28/06/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Fin_tabela_nomeDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objCategoria){
        $sucess = $this->db->insert("fin_tabela_nome",$objCategoria->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_categoria = $this->db->insert_id();

        return $cod_categoria;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("fin_tabela_nome");
    	$this->db->order_by("nome");
    	$this->db->where("deletado",DELETADO);
    	
    	if ($dados["nome"] != NULL):
    		$this->db->like("nome", $dados["categoria"]);
    	endif;

    	 
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listCategoria = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listCategoria[] = $this->visualizar($dados["id_tabela_nome"]);
    		}
    	}
    	return $listCategoria;
    }
    
    

   	
    
    public function visualizar($id_tabela_nome){
    	$this->db->from("fin_tabela_nome");
    	$this->db->where("id_tabela_nome",$id_tabela_nome);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objCategoria = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objCategoria = $this->Factory->createPojo("fin_tabela_nome",$dados);
    	}
    
    	return $objCategoria;
    
    
    }
    
    
    public function alterar($objCategoria){
    	$this->db->where('id_tabela_nome',$objCategoria->getId_tabela_nome());
    	$sucess = $this->db->update("fin_tabela_nome",$objCategoria->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_tabela_nome){
        $this->db->where('id_tabela_nome',$id_tabela_nome);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("fin_tabela_nome",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


 }
?>
