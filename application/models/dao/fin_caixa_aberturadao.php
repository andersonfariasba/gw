<?php
/* Classe(DAO): Categoria de produtos
* Autor: Anderson Farias
* Última atualização: 28/06/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Fin_caixa_aberturaDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objCaixa){
        $sucess = $this->db->insert("fin_caixa_abertura",$objCaixa->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $id_abertura = $this->db->insert_id();

        return $id_abertura;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("fin_caixa_abertura");
    	$this->db->order_by("data","desc");
    	$this->db->where("deletado",DELETADO);
    	
    	
        $data_de = $dados["data_de"];
        $data_ate = $dados["data_ate"];

        if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                
              $this->db->where("DATE(data) BETWEEN '$data_de' AND '$data_ate'");
         
         endif;


        if ($dados["usuario"] != NULL):
    		$this->db->like("usuario", $dados["usuario"]);
    	endif;
    	 
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listCategoria = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listCategoria[] = $this->visualizar($dados["id_abertura"]);
    		}
    	}
    	return $listCategoria;
    }
    
     

    

	
    
    public function visualizar($id_abertura){
    	$this->db->from("fin_caixa_abertura");
    	$this->db->where("id_abertura",$id_abertura);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objCategoria = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objCategoria = $this->Factory->createPojo("fin_caixa_abertura",$dados);
    	}
    
    	return $objCategoria;
    
    
    }
    
    
    public function alterar($objCategoria){
    	$this->db->where('id_abertura',$objCategoria->getId_abertura());
    	$sucess = $this->db->update("fin_caixa_abertura",$objCategoria->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_abertura){
        $this->db->where('id_abertura',$id_abertura);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("fin_caixa_abertura",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


 }
?>
