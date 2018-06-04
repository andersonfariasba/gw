<?php
/* Classe(DAO): Contas
* Autor: Anderson Farias
* Última atualização: 12/07/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class fin_contas_pagarDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objConta){
        $sucess = $this->db->insert("fin_contas_pagar",$objConta->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_conta = $this->db->insert_id();

        return $cod_conta;
    }
    
    
    public function filtro($dados) {
     	
    	$this->db->from("fin_contas_pagar");
    	$this->db->order_by("data");
    	$this->db->where("deletado",DELETADO);
    	
        $data_de = $dados["data_de"];
        $data_ate = $dados["data_ate"];
           
         if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                
              $this->db->where("DATE(data) BETWEEN '$data_de' AND '$data_ate'");
         endif;
        
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listContas = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listContas[] = $this->visualizar($dados["id_conta"]);
    		}
    	}
    	return $listContas;
    }


public function visualizar($id_conta){
    	$this->db->from("fin_contas_pagar");
    	$this->db->where("id_conta",$id_conta);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objConta = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objConta = $this->Factory->createPojo("fin_contas_pagar",$dados);
                
                //Forncedor
                $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
                $objFornecedor = $fornecedorBusiness->visualizar($objConta->getId_fornecedor());
                $objConta->setFornecedor($objFornecedor);
                
                //Centro de Custos
                $custoBusiness = $this->Factory->createBusiness("fin_centro_custos");
                $objCusto = $custoBusiness->visualizar($objConta->getId_custo());
                $objConta->setCusto($objCusto);

                $planoBusiness = $this->Factory->createBusiness("fin_plano_contas");
                $objPlano = $planoBusiness->visualizar($objConta->getId_plano());
                $objConta->setPlano($objPlano);

               
    	}
    
    	return $objConta;
    
    
    }


      
    
    public function alterar($objConta){
    	$this->db->where('id_conta',$objConta->getId_conta());
    	$sucess = $this->db->update("fin_contas_pagar",$objConta->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_conta){
        $this->db->where('id_conta',$id_conta);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("fin_contas_pagar",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }

     public function editar_tela_lanc($dados){

        $this->db->where('id_conta',$dados['id_conta']);
        $sucess = $this->db->update("fin_contas_pagar",$dados);
        
        if(!$sucess){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }
    
    }

      //MOTRAR O TOTAL DA CONTA REFERENTE A UMA DATA
     public function filtro_compra_total($dados) {
        

        $this->db->select_sum('valor_total');
        $this->db->select('data');
        $this->db->select('count(id_conta) as qtd');
        $this->db->where("deletado",DELETADO);
        $this->db->group_by("data");
          $this->db->order_by("data","desc"); 
       

        $data_de = $dados["data_de"];
        $data_ate = $dados["data_ate"];
           
         if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                
              $this->db->where("DATE(data) BETWEEN '$data_de' AND '$data_ate'");
         endif;
        
        $query = $this->db->get('fin_contas_pagar');
        $result = $query->result_array();

        return $result;
        
     }

       //MOTRAR O TOTAL DA CONTA REFERENTE A UMA DATA
     public function resumo_conta_pagar($dados) {

        $data_de = $dados["data_de"];
        $data_ate = $dados["data_ate"];
      
        $param = "";
           
         if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                
             // $this->db->where("DATE(l.data_vencimento) BETWEEN '$data_de' AND '$data_ate'");
                $param .= "and DATE(data_vencimento) BETWEEN '$data_de' AND '$data_ate'"; 
         
         endif;


       
       $query = $this->db->query("select sum(valor_titulo) as valor from fin_lancamentos_pagar where deletado = 0 ".$param." order by data_vencimento desc");
       

       $result = $query->result_array();

       

        return $result;
        
     }



    
    


 }
?>
