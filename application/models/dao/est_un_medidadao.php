<?php
/* Classe(DAO): Unidade de medida de produtos
* Autor: Anderson Farias
* Última atualização: 27/06/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Est_un_medidaDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objUnidade){
        $sucess = $this->db->insert("est_un_medida",$objUnidade->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_unidade = $this->db->insert_id();

        return $cod_unidade;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("est_un_medida");
    	$this->db->order_by("unidade");
    	$this->db->where("deletado",DELETADO);
    	
    	if ($dados["unidade"] != NULL):
    		$this->db->like("unidade", $dados["unidade"]);
    	endif;
        
        if ($dados["sigla"] != NULL):
    		$this->db->like("sigla", $dados["sigla"]);
    	endif;
    	 
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listUnidade = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listUnidade[] = $this->visualizar($dados["id_unidade"]);
    		}
    	}
    	return $listUnidade;
    }
    
    

    //NÃO USADO, LISTAGEM SIMPLES
    public function listar(){
        $this->db->from("est_un_medida");
        $this->db->order_by("unidade");
        $this->db->where("deletado",DELETADO);
		
        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }

        $listUnidade = array();

          if($query!=NULL){
              foreach ($query->result_array() as $dados){

                 $objUnidade = $this->Factory->createPojo("est_un_medida",$dados);
                  $listUnidade[] = $objUnidade;
				  
	      }
          }

          return $listUnidade;

    }

      public function ajax_listar($pos){
        $this->db->from("est_un_medida");
        if($pos==NAO){
         $this->db->order_by("unidade","asc");
        }else{
         $this->db->order_by("id_unidade","desc");   
        }

        $this->db->where("deletado",DELETADO);
        
        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }

        $listUnidade = array();

          if($query!=NULL){
              foreach ($query->result_array() as $dados){

         
                $listUnidade[] = array(
               'id_unidade'   => $dados['id_unidade'],
               'unidade'      => $dados['unidade'],
               );
                  
          }

          }

          return $listUnidade;

    }
	
	
    
    public function visualizar($id_unidade){
    	$this->db->from("est_un_medida");
    	$this->db->where("id_unidade",$id_unidade);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objUnidade = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objUnidade = $this->Factory->createPojo("est_un_medida",$dados);
    	}
    
    	return $objUnidade;
    
    
    }
    
    
    public function alterar($objUnidade){
    	$this->db->where('id_unidade',$objUnidade->getId_unidade());
    	$sucess = $this->db->update("est_un_medida",$objUnidade->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_unidade){
        $this->db->where('id_unidade',$id_unidade);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("est_un_medida",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


 }
?>
