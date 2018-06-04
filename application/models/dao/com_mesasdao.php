<?php
/* Classe(DAO): Perfil de usu�rios
* Autor: Anderson Farias
* Última atualização: 26/06/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Com_mesasDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objMesa){
        $sucess = $this->db->insert("com_mesas",$objMesa->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_mesa = $this->db->insert_id();

        return $cod_mesa;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("com_mesas");
    	$this->db->order_by("nome");
    	$this->db->where("deletado",DELETADO);
    	
    	if ($dados["nome"] != NULL):
    		$this->db->where("nome", $dados["nome"]);
    	endif;
    	 
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listMesa = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listMesa[] = $this->visualizar($dados["id_mesa"]);
    		}
    	}
    	return $listMesa;
    }
    
    

  	
    
    public function visualizar($id_mesa){
    	$this->db->from("com_mesas");
    	$this->db->where("id_mesa",$id_mesa);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objMesa = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objMesa = $this->Factory->createPojo("com_mesas",$dados);
    	}
    
    	return $objMesa;
    
    
    }
    
    
    public function alterar($dados){
    	$this->db->where('id_mesa',$dados['id_mesa']);
    	$sucess = $this->db->update("com_mesas",$dados);
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_mesa){
        $this->db->where('id_mesa',$id_mesa);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("com_mesas",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


    
    public function controle_mesas($dados){

        $query = $this->db->query("select m.id_mesa,m.nome,m.capacidade,p.qtd_pessoas_mesa from com_mesas m
        left join com_pedidos p
        on(m.id_mesa = p.id_mesa)
        where m.deletado = 0
        order by m.nome");

        $result = $query->result_array();
        
        return $result;    
    

    }




 }
?>
