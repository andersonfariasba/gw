<?php

class AgendaDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function insert($objDentista){
        $sucess = $this->db->insert("agenda",$objDentista->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_dent = $this->db->insert_id();

        return $cod_dent;
    }

    
     

     public function filtro($dados) {
      
      $this->db->from("agenda");
      $this->db->order_by("start");
           
      
      /*if ($dados[""] != NULL):
        $this->db->like("nome", $dados["nome"]);
      endif;
      */

            
        $query = $this->db->get();
    
      if ($query == FALSE) {
        throw new Exception($this->db->_error_message(), $this->db->_error_number());
      }
    
      $listCargo = array();
    
      if ($query != NULL) {
        foreach ($query->result_array() as $dados) {
    
          $listCargo[] = $this->getById($dados["id"]);
        }
      }
      return $listCargo;
    }
    
    
    
    
	
	

    public function excluir($id){
        $this->db->where('id',$id);
       
        $sucess = $this->db->delete("agenda");
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


    public function getById($id){
        $this->db->from("agenda");
        $this->db->where("id",$id);

        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }
        $objDentista = NULL;

        if($query->num_rows()>0){
            $dados = $query->row_array();
            $objDentista = $this->Factory->createPojo("agenda",$dados);
        }

        return $objDentista;

        
    }


    public function update($dados){
        $this->db->where('id',$dados['id']);
        $sucess = $this->db->update("agenda",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),  $this->db->_error_number());
         }

    }

    public function ajax_listar($usuario){
       
       
      $param = "";

       if ($usuario != NULL):
              $param .= " where usuario = '".$usuario."' ";
        endif;

       $query = $this->db->query("select * from agenda ".$param." order by id");
                   
          
        
        $listFat = array();

       
              foreach ($query->result_array() as $dados){

                // $objBandeira = $this->Factory->createPojo("fin_bandeira_cartao",$dados);
                // $listBandeira[] = $objBandeira;
                
               $objDateFormat = $this->DateFormat; 

                $listFat[] = array(
               'id'   => $dados['id'],
               'title'   =>     $dados['usuario']." / ".$dados['observacao']." /".date('H:i', strtotime($dados['end'])),
               'usuario'      => $dados['usuario'],
               'start'      => $dados['start'],
               'end'      => $dados['end'],
               'status' => $dados['status'],
               
               );
                  
          }
          
   //'data_entrega'      => $objDateFormat->date_format($dados['data_entrega']),
          return $listFat;

    }





    

    


    

    
}
?>
