<?php
/* Classe(DAO): Categoria de produtos
* Autor: Anderson Farias
* Última atualização: 28/06/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Est_categoriasDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objCategoria){
        $sucess = $this->db->insert("est_categorias",$objCategoria->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_categoria = $this->db->insert_id();

        return $cod_categoria;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("est_categorias");
    	$this->db->order_by("categoria");
    	$this->db->where("deletado",DELETADO);
    	
    	if ($dados["categoria"] != NULL):
    		$this->db->like("categoria", $dados["categoria"]);
    	endif;
    	 
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listCategoria = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listCategoria[] = $this->visualizar($dados["id_categoria"]);
    		}
    	}
    	return $listCategoria;
    }
    
    

    //NÃO USADO, LISTAGEM SIMPLES
    public function listar(){
        $this->db->from("est_categorias");
        $this->db->order_by("categoria");
        $this->db->where("deletado",DELETADO);
		
        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }

        $listCategoria = array();

          if($query!=NULL){
              foreach ($query->result_array() as $dados){

                 $objCategoria = $this->Factory->createPojo("est_categorias",$dados);
                 $listCategoria[] = $objCategoria;
				  
	      }
          }

          return $listCategoria;

    }


    public function ajax_listar($pos){
        $this->db->from("est_categorias");
        if($pos==NAO){
         $this->db->order_by("categoria","asc");
        }else{
         $this->db->order_by("id_categoria","desc");   
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
               'id_categoria'   => $dados['id_categoria'],
               'categoria'      => $dados['categoria'],
               );
                  
          }

          }

          return $listCategoria;

    }
	


	
    
    public function visualizar($id_categoria){
    	$this->db->from("est_categorias");
    	$this->db->where("id_categoria",$id_categoria);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objCategoria = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objCategoria = $this->Factory->createPojo("est_categorias",$dados);
    	}
    
    	return $objCategoria;
    
    
    }
    
    
    public function alterar($objCategoria){
    	$this->db->where('id_categoria',$objCategoria->getId_categoria());
    	$sucess = $this->db->update("est_categorias",$objCategoria->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_categoria){
        $this->db->where('id_categoria',$id_categoria);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("est_categorias",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


 }
?>
