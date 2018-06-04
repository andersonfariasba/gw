<?php
/* Classe(DAO): Perfil de usuários
* Autor: Anderson Farias
* Última atualização: 23/06/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Acesso_historicoDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objHistorico){
        $sucess = $this->db->insert("acesso_historico",$objHistorico->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $id_acesso = $this->db->insert_id();

        return $id_acesso;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("acesso_historico");
    	$this->db->order_by("data", "desc");
        $this->db->order_by("id_acesso", "desc");
        	
    	
        if ($dados["id_usuario"] != NULL):
    		$this->db->where("id_usuario", $dados["id_usuario"]);
    	endif;

         $data_de = $dados["data_de"];
         $data_ate = $dados["data_ate"];
           
         
         if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                
              $this->db->where("DATE(data) BETWEEN '$data_de' AND '$data_ate'");
         endif;
         





    	 
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listHistorico = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listHistorico[] = $this->visualizar($dados["id_acesso"]);
    		}
    	}
    	return $listHistorico;
    }
    

	
    
    public function visualizar($id_acesso){
    	$this->db->from("acesso_historico");
    	$this->db->where("id_acesso",$id_acesso);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objHistorico = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objHistorico = $this->Factory->createPojo("acesso_historico",$dados);
    	}
    
    	return $objHistorico;
    
    
    }
    
    
    public function alterar($objHistorico){
    	$this->db->where('id_acesso',$objHistorico->getId_acesso());
    	$sucess = $this->db->update("acesso_historico",$objHistorico->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_acesso){
        $this->db->where('id_acesso',$id_acesso);
       //$dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->delete("acesso_perfil");
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


 }
?>
