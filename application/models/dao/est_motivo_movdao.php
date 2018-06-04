<?php
/* Classe(DAO): Categoria de produtos
* Autor: Anderson Farias
* Última atualização: 28/06/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Est_motivo_movDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objCategoria){
        $sucess = $this->db->insert("est_motivo_mov",$objCategoria->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_categoria = $this->db->insert_id();

        return $cod_categoria;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("est_motivo_mov");
    	$this->db->order_by("descricao");
    	$this->db->where("deletado",DELETADO);
    	
    	if ($dados["descricao"] != NULL):
    		$this->db->like("descricao", $dados["descricao"]);
    	endif;

      /*  if ($dados["tipo"] != NULL):
            $this->db->where("tipo", $dados["tipo"]);
        endif;*/
    	 
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listCategoria = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listCategoria[] = $this->visualizar($dados["id_motivo"]);
    		}
    	}
    	return $listCategoria;
    }
    
    

    //NÃO USADO, LISTAGEM SIMPLES
    public function listar(){
        $this->db->from("est_motivo_mov");
        $this->db->order_by("descricao");
        $this->db->where("deletado",DELETADO);
		
        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }

        $listCategoria = array();

          if($query!=NULL){
              foreach ($query->result_array() as $dados){

                 $objCategoria = $this->Factory->createPojo("est_motivo_mov",$dados);
                 $listCategoria[] = $objCategoria;
				  
	      }
          }

          return $listCategoria;

    }


    public function ajax_listar($pos,$tipo){
        $this->db->from("est_motivo_mov");
        if($pos==NAO){
         $this->db->order_by("descricao","desc");
        }else{
         $this->db->order_by("id_motivo","asc");   
        }

        $this->db->where("deletado",DELETADO);

        if($tipo!=null){
            $this->db->where("tipo",$tipo);
        }
        
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
               'id_motivo'   => $dados['id_motivo'],
               'descricao'      => $dados['descricao'],
               );
                  
          }

          }

          return $listCategoria;

    }
	


	
    
    public function visualizar($id_motivo){
    	$this->db->from("est_motivo_mov");
    	$this->db->where("id_motivo",$id_motivo);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objCategoria = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objCategoria = $this->Factory->createPojo("est_motivo_mov",$dados);
    	}
    
    	return $objCategoria;
    
    
    }
    
    
    public function alterar($objCategoria){
    	$this->db->where('id_motivo',$objCategoria->getId_motivo());
    	$sucess = $this->db->update("est_motivo_mov",$objCategoria->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_motivo){
        $this->db->where('id_motivo',$id_motivo);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("est_motivo_mov",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


 }
?>
