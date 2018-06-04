<?php
/* Classe(DAO): Categoria de produtos
* Autor: Anderson Farias
* Última atualização: 28/06/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Fin_operadoras_cartaoDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objCategoria){
        $sucess = $this->db->insert("fin_operadoras_cartao",$objCategoria->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_categoria = $this->db->insert_id();

        return $cod_categoria;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("fin_operadoras_cartao");
    	$this->db->order_by("empresa");
    	$this->db->where("deletado",DELETADO);
    	
    	if ($dados["empresa"] != NULL):
    		$this->db->like("empresa", $dados["empresa"]);
    	endif;
    	 
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listCategoria = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listCategoria[] = $this->visualizar($dados["id_operadora"]);
    		}
    	}
    	return $listCategoria;
    }
    
    

    //NÃO USADO, LISTAGEM SIMPLES
    public function listar(){
        $this->db->from("fin_operadoras_cartao");
        $this->db->order_by("empresa");
        $this->db->where("deletado",DELETADO);
		
        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }

        $listCategoria = array();

          if($query!=NULL){
              foreach ($query->result_array() as $dados){

                 $objCategoria = $this->Factory->createPojo("fin_operadoras_cartao",$dados);
                 $listCategoria[] = $objCategoria;
				  
	      }
          }

          return $listCategoria;

    }


    public function ajax_listar($pos){
        $this->db->from("fin_operadoras_cartao");
        if($pos==NAO){
         $this->db->order_by("empresa","asc");
        }else{
         $this->db->order_by("id_operadora","desc");   
        }

        $this->db->where("deletado",DELETADO);
          $this->db->where("status",ATIVO);
        
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
               'id_operadora'   => $dados['id_operadora'],
               'empresa'      => $dados['empresa'],
               );
                  
          }

          }

          return $listCategoria;

    }
	


	
    
    public function visualizar($id_operadora){
    	$this->db->from("fin_operadoras_cartao");
    	$this->db->where("id_operadora",$id_operadora);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objCategoria = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objCategoria = $this->Factory->createPojo("fin_operadoras_cartao",$dados);
    	}
    
    	return $objCategoria;
    
    
    }
    
    
    public function alterar($objCategoria){
    	$this->db->where('id_operadora',$objCategoria->getId_operadora());
    	$sucess = $this->db->update("fin_operadoras_cartao",$objCategoria->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_operadora){
        $this->db->where('id_operadora',$id_operadora);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("fin_operadoras_cartao",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


 }
?>
