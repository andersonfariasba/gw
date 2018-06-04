<?php
/* Classe(DAO): Departamentos Colaboradores
* Autor: Anderson Farias
* Última atualização: 03/01/2016
* Contato: andersonjfarias@yahoo.com.br
*/

class Rh_departamentosDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objDep){
        $sucess = $this->db->insert("rh_departamentos",$objDep->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_dep = $this->db->insert_id();

        return $cod_dep;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("rh_departamentos");
    	$this->db->order_by("departamento");
    	$this->db->where("deletado",DELETADO);
    	
    	if ($dados["departamento"] != NULL):
    		$this->db->like("departamento", $dados["departamento"]);
    	endif;
    	 
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listDep = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listDep[] = $this->visualizar($dados["id_departamento"]);
    		}
    	}
    	return $listDep;
    }
    
    

    //NÃO USADO, LISTAGEM SIMPLES
    public function listar(){
        $this->db->from("rh_departamentos");
        $this->db->order_by("departamento");
        $this->db->where("deletado",DELETADO);
		
        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }

        $listDep = array();

          if($query!=NULL){
              foreach ($query->result_array() as $dados){

                 $objDep = $this->Factory->createPojo("rh_departamentos",$dados);
                 $listDep[] = $objDep;
				  
	      }
          }

          return $listDep;

    }
	
	
    
    public function visualizar($id_departamento){
    	$this->db->from("rh_departamentos");
    	$this->db->where("id_departamento",$id_departamento);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objDep = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objDep = $this->Factory->createPojo("rh_departamentos",$dados);
    	}
    
    	return $objDep;
    
    
    }
    
    
    public function alterar($objDep){
    	$this->db->where('id_departamento',$objDep->getId_departamento());
    	$sucess = $this->db->update("rh_departamentos",$objDep->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_departamento){
        $this->db->where('id_departamento',$id_departamento);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("rh_departamentos",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


 }
?>
