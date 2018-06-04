<?php
/* Classe(DAO): Perfil de usu�rios
* Autor: Anderson Farias
* Última atualização: 26/06/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Rh_cargosDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objCargo){
        $sucess = $this->db->insert("rh_cargos",$objCargo->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_cargo = $this->db->insert_id();

        return $cod_cargo;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("rh_cargos");
    	$this->db->order_by("cargo");
    	$this->db->where("deletado",DELETADO);
    	
    	if ($dados["cargo"] != NULL):
    		$this->db->where("cargo", $dados["cargo"]);
    	endif;
    	 
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listCargo = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listCargo[] = $this->visualizar($dados["id_cargo"]);
    		}
    	}
    	return $listCargo;
    }
    
    

    //NÃO USADO, LISTAGEM SIMPLES
    public function listar(){
        $this->db->from("rh_cargos");
        $this->db->order_by("cargo");
        $this->db->where("deletado",DELETADO);
		
        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }

        $listCargo = array();

          if($query!=NULL){
              foreach ($query->result_array() as $dados){

                 $objCargo = $this->Factory->createPojo("rh_cargos",$dados);
                 $listCargo[] = $objCargo;
				  
	      }
          }

          return $listCargo;

    }
	
	
    
    public function visualizar($id_cargo){
    	$this->db->from("rh_cargos");
    	$this->db->where("id_cargo",$id_cargo);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objCargo = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objCargo = $this->Factory->createPojo("rh_cargos",$dados);
    	}
    
    	return $objCargo;
    
    
    }
    
    
    public function alterar($objCargo){
    	$this->db->where('id_cargo',$objCargo->getId_cargo());
    	$sucess = $this->db->update("rh_cargos",$objCargo->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_cargo){
        $this->db->where('id_cargo',$id_cargo);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("rh_cargos",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


 }
?>
