<?php
/* Classe(DAO): Categoria de produtos
* Autor: Anderson Farias
* Última atualização: 28/06/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Fin_tabela_taxaDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objCategoria){
        $sucess = $this->db->insert("fin_tabela_taxa",$objCategoria->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_categoria = $this->db->insert_id();

        return $cod_categoria;
    }
    
    
     public function listar($id_tabela_nome) {
        
        $this->db->from("fin_tabela_taxa");
        $this->db->order_by("id_tabela_taxa");
        $this->db->where("id_tabela_nome",$id_tabela_nome);
        $this->db->where("deletado",DELETADO);
        
      
         
        $query = $this->db->get();
    
        if ($query == FALSE) {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
    
        $listCategoria = array();
    
        if ($query != NULL) {
            foreach ($query->result_array() as $dados) {
    
                $listCategoria[] = $this->visualizar($dados["id_tabela_taxa"]);
            }
        }
        return $listCategoria;
    }




    public function filtro($dados) {
     	
    	$this->db->from("fin_tabela_taxa");
    	$this->db->order_by("id_tabela_taxa");
    	$this->db->where("deletado",DELETADO);
    	
    	if ($dados["id_tabela_nome"] != NULL):
    		$this->db->where("id_tabela_nome", $dados["id_tabela_nome"]);
    	endif;
    	 
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listCategoria = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listCategoria[] = $this->visualizar($dados["id_tabela_taxa"]);
    		}
    	}
    	return $listCategoria;
    }
    
    
   

    
    public function visualizar($id_tabela_taxa){
    	$this->db->from("fin_tabela_taxa");
    	$this->db->where("id_tabela_taxa",$id_tabela_taxa);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objCategoria = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objCategoria = $this->Factory->createPojo("fin_tabela_taxa",$dados);
    	}
    
    	return $objCategoria;
    
    
    }
    
    
    public function alterar($objCategoria){
    	$this->db->where('id_tabela_taxa',$objCategoria->getId_tabela_taxa());
    	$sucess = $this->db->update("fin_tabela_taxa",$objCategoria->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_tabela_taxa){
        $this->db->where('id_tabela_taxa',$id_tabela_taxa);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("fin_tabela_taxa",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


         //PESQUISA DE PRODUTOS E SERVIÇOS
     public function visualizar_taxa($id_tabela_nome,$parcela) {




$query = $this->db->query("select n.nome,t.taxa,parcela_inicio,t.parcela_fim from fin_tabela_nome n 
inner join fin_tabela_taxa t on(n.id_tabela_nome = t.id_tabela_nome) where n.id_tabela_nome = ".$id_tabela_nome." and ".$parcela." BETWEEN t.parcela_inicio and t.parcela_fim");
  
    
    $result = $query->result_array();
     
      if($result!=null){
       return $result[0]['taxa'];
      }else{
        return 0;
      }

     }




 }
?>
