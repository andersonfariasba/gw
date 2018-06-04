<?php
/* Classe(DAO): Categoria de produtos
* Autor: Anderson Farias
* Última atualização: 28/06/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Fin_status_pedidoDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objCategoria){
        $sucess = $this->db->insert("fin_status_pedido",$objCategoria->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_categoria = $this->db->insert_id();

        return $cod_categoria;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("fin_status_pedido");
    	$this->db->order_by("status");
    	$this->db->where("deletado",DELETADO);
        if($dados==null){
            $this->db->where("situacao",ATIVO);
    	}
    	if ($dados["status"] != NULL):
    		$this->db->like("status", $dados["status"]);
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
    
    			$listCategoria[] = $this->visualizar($dados["id_status"]);
    		}
    	}
    	return $listCategoria;
    }
    
    

    
    public function ajax_listar($pos){
        $this->db->from("fin_status_pedido");
        if($pos==NAO){
         $this->db->order_by("status","asc");
        }else{
         $this->db->order_by("id_status","desc");   
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
               'id_status'   => $dados['id_status'],
               'status'      => $dados['status'],
               );
                  
          }

          }

          return $listCategoria;

    }
	


	
    
    public function visualizar($id_status){
    	$this->db->from("fin_status_pedido");
    	$this->db->where("id_status",$id_status);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objCategoria = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objCategoria = $this->Factory->createPojo("fin_status_pedido",$dados);
    	}
    
    	return $objCategoria;
    
    
    }
    
    
    public function alterar($objCategoria){
    	$this->db->where('id_status',$objCategoria->getId_status());
    	$sucess = $this->db->update("fin_status_pedido",$objCategoria->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_status){
        $this->db->where('id_status',$id_status);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("fin_status_pedido",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


 }
?>
