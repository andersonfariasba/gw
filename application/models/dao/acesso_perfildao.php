<?php
/* Classe(DAO): Perfil de usuários
* Autor: Anderson Farias
* Última atualização: 23/06/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Acesso_perfilDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objPerfil){
        $sucess = $this->db->insert("acesso_perfil",$objPerfil->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_perfil = $this->db->insert_id();

        return $cod_perfil;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("acesso_perfil");
    	$this->db->order_by("perfil");
    	$this->db->where("deletado",DELETADO);
    	
    	if ($dados["perfil"] != NULL):
    		$this->db->where("perfil", $dados["perfil"]);
    	endif;
    	 
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listPerfil = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listPerfil[] = $this->visualizar($dados["id_perfil"]);
    		}
    	}
    	return $listPerfil;
    }
    
    

    //NÃO USADO, LISTAGEM SIMPLES
    public function listar(){
        $this->db->from("acesso_perfil");
        $this->db->order_by("perfil");
        $this->db->where("deletado",DELETADO);
		
        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }

        $listPerfil = array();

          if($query!=NULL){
              foreach ($query->result_array() as $dados){

                 $objPerfil = $this->Factory->createPojo("acesso_perfil",$dados);
                  $listPerfil[] = $objPerfil;
				  
	      }
          }

          return $listPerfil;

    }
	
	
    
    public function visualizar($id_perfil){
    	$this->db->from("acesso_perfil");
    	$this->db->where("id_perfil",$id_perfil);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objPerfil = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objPerfil = $this->Factory->createPojo("acesso_perfil",$dados);
    	}
    
    	return $objPerfil;
    
    
    }
    
    
    public function alterar($objPerfil){
    	$this->db->where('id_perfil',$objPerfil->getId_perfil());
    	$sucess = $this->db->update("acesso_perfil",$objPerfil->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_perfil){
        $this->db->where('id_perfil',$id_perfil);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("acesso_perfil",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


 }
?>
