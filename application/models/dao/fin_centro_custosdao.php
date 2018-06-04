<?php
/* Classe(DAO): Centro de custos
* Autor: Anderson Farias
* Última atualização: 03/07/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Fin_centro_custosDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objCusto){
        $sucess = $this->db->insert("fin_centro_custos",$objCusto->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_custo = $this->db->insert_id();

        return $cod_custo;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("fin_centro_custos");
    	$this->db->order_by("custo");
    	$this->db->where("deletado",DELETADO);
    	
    	if ($dados["custo"] != NULL):
    		$this->db->like("custo", $dados["custo"]);
    	endif;
    	 
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listCusto = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listCusto[] = $this->visualizar($dados["id_custo"]);
    		}
    	}
    	return $listCusto;
    }
    
    

    //NÃO USADO, LISTAGEM SIMPLES
    public function listar(){
        $this->db->from("fin_centro_custos");
        $this->db->order_by("custo");
        $this->db->where("deletado",DELETADO);
		
        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }

        $listCusto = array();

          if($query!=NULL){
              foreach ($query->result_array() as $dados){

                 $objCusto = $this->Factory->createPojo("fin_centro_custos",$dados);
                 $listCusto[] = $objCusto;
				  
	      }
          }

          return $listCusto;

    }
	
	
    
    public function visualizar($id_custo){
    	$this->db->from("fin_centro_custos");
    	$this->db->where("id_custo",$id_custo);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objCusto = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objCusto = $this->Factory->createPojo("fin_centro_custos",$dados);
    	}
    
    	return $objCusto;
    
    
    }
    
    
    public function alterar($objCusto){
    	$this->db->where('id_custo',$objCusto->getId_custo());
    	$sucess = $this->db->update("fin_centro_custos",$objCusto->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_custo){
        $this->db->where('id_custo',$id_custo);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("fin_centro_custos",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


 }
?>
