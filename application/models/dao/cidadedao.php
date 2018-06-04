<?php
/* Classe(DAO): Categoria de produtos
* Autor: Anderson Farias
* Última atualização: 28/06/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class CidadeDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }



    public function ajax_listar($uf){
        $this->db->from("cidade");
        $this->db->where("ct_uf",$uf);
        $this->db->order_by("ct_nome","asc");

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
               'ct_id'   => $dados['ct_id'],
               'ct_nome'      => $dados['ct_nome'],
               );
                  
          }

          }

          return $listCategoria;

    }




     public function filtro($ct_uf) {
      
      $this->db->from("cidade");
      $this->db->order_by("ct_nome");
     
     if($ct_uf!=null){ 
        $this->db->where("ct_uf",$uf);
      }

      $query = $this->db->get();
    
      if ($query == FALSE) {
        throw new Exception($this->db->_error_message(), $this->db->_error_number());
      }
    
      $listCategoria = array();
    
      if ($query != NULL) {
        foreach ($query->result_array() as $dados) {
    
          $listCategoria[] = $this->visualizar($dados["ct_id"]);
        }
      }
      return $listCategoria;
    }


      public function visualizar($ct_id){
      $this->db->from("cidade");
      $this->db->where("ct_id",$ct_id);
        $query = $this->db->get();
    
      if($query==FALSE){
        throw new Exception($this->db->_error_message(),$this->db->_error_number());
      }

      $objCategoria = NULL;
    
      if($query->num_rows()>0){
        $dados = $query->row_array();
        $objCategoria = $this->Factory->createPojo("cidade",$dados);
      }
    
      return $objCategoria;
    
    
    }


     public function ajax_visualizar($ct_id){
        $this->db->from("cidade");
        $this->db->where("ct_id",$ct_id);
        $this->db->order_by("ct_nome","asc");

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
               'ct_id'   => $dados['ct_id'],
               'ct_nome'      => $dados['ct_nome'],
               );
                  
          }

          }

          return $listCategoria;

    }
    
    
	


	
    
    

 }
?>
