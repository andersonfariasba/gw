<?php
/* Classe(DAO): Categoria de produtos
* Autor: Anderson Farias
* Última atualização: 28/06/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class EstadoDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }



    public function ajax_listar($pos){
        $this->db->from("estado");
        if($pos==NAO){
         $this->db->order_by("uf_nome","asc");
        }else{
         $this->db->order_by("uf_id","desc");   
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
               'uf_id'   => $dados['uf_id'],
               'uf_nome'      => $dados['uf_nome'],
               );
                  
          }

          }

          return $listCategoria;

    }
	




public function filtro() {
      
      $this->db->from("estado");
      $this->db->order_by("uf_nome");
     
     

      $query = $this->db->get();
    
      if ($query == FALSE) {
        throw new Exception($this->db->_error_message(), $this->db->_error_number());
      }
    
      $listCategoria = array();
    
      if ($query != NULL) {
        foreach ($query->result_array() as $dados) {
    
          $listCategoria[] = $this->visualizar($dados["uf_id"]);
        }
      }
      return $listCategoria;
    }


      public function visualizar($uf_id){
      $this->db->from("estado");
      $this->db->where("uf_id",$uf_id);
        $query = $this->db->get();
    
      if($query==FALSE){
        throw new Exception($this->db->_error_message(),$this->db->_error_number());
      }

      $objCategoria = NULL;
    
      if($query->num_rows()>0){
        $dados = $query->row_array();
        $objCategoria = $this->Factory->createPojo("estado",$dados);
      }
    
      return $objCategoria;
    
    
    }
    
    
  

	
    
    

 }
?>
