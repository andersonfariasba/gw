<?php
/* Classe(DAO): Categoria de produtos
* Autor: Anderson Farias
* Última atualização: 28/06/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Comp_solicitacaoDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objCategoria){
        $sucess = $this->db->insert("comp_solicitacao",$objCategoria->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_categoria = $this->db->insert_id();

        return $cod_categoria;
    }
    
    
    //FILTRO DE SOLICITAÇÃO
    public function filtro($dados) {
     	
    	$this->db->from("comp_solicitacao");
    	//$this->db->order_by("data_criacao","desc");
        $this->db->order_by("id_solicitacao","desc");
    	$this->db->where("deletado",DELETADO);
        

        if ($dados["id_solicitacao"] != NULL):
    		$this->db->where("id_solicitacao", $dados["id_solicitacao"]);
    	endif;


        if ($dados["id_status"] != NULL):
            $this->db->where("id_status", $dados["id_status"]);
        endif;

        
        if ($dados["id_solicitante"] != NULL):
            $this->db->where("id_solicitante", $dados["id_solicitante"]);
        endif;

         if ($dados["id_aprovador"] != NULL):
            $this->db->where("id_aprovador", $dados["id_aprovador"]);
        endif;

        $data_de = $dados["data_de"];
        $data_ate = $dados["data_ate"];

        if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                
              $this->db->where("DATE(data_criacao) BETWEEN '$data_de' AND '$data_ate'");
         
         endif;

        $data_de = $dados["data_de_priori"];
        $data_ate = $dados["data_ate_priori"];

        if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                
              $this->db->where("DATE(data_necessidade) BETWEEN '$data_de' AND '$data_ate'");
         
         endif;


    	 
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listCategoria = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listCategoria[] = $this->visualizar($dados["id_solicitacao"]);
    		}
    	}
    	return $listCategoria;
    }


    //FILTRO DE COTAÇÃO
    public function filtro_cotacao($dados) {
        
        $this->db->from("comp_solicitacao");
        $this->db->order_by("data_criacao","desc");
         $this->db->order_by("id_solicitacao","desc");
        $this->db->where("deletado",DELETADO);
        //$this->db->where("id_status",ST_APROVADO);
        $status = array(ST_APROVADO,ST_APROVADO_PARCIAL);
        $this->db->where_in('id_status',$status);

         //$this->db->where("id_status",ST_APROVADO_PARCIAL);
        

        if ($dados["id_solicitacao"] != NULL):
            $this->db->where("id_solicitacao", $dados["id_solicitacao"]);
        endif;


        if ($dados["id_status"] != NULL):
            $this->db->where("id_status", $dados["id_status"]);
        endif;

        
        if ($dados["id_solicitante"] != NULL):
            $this->db->where("id_solicitante", $dados["id_solicitante"]);
        endif;

         if ($dados["id_aprovador"] != NULL):
            $this->db->where("id_aprovador", $dados["id_aprovador"]);
        endif;

        $data_de = $dados["data_de"];
        $data_ate = $dados["data_ate"];

        if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                
              $this->db->where("DATE(data_criacao) BETWEEN '$data_de' AND '$data_ate'");
         
         endif;

        $data_de = $dados["data_de_priori"];
        $data_ate = $dados["data_ate_priori"];

        if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                
              $this->db->where("DATE(data_necessidade) BETWEEN '$data_de' AND '$data_ate'");
         
         endif;


         
        $query = $this->db->get();
    
        if ($query == FALSE) {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
    
        $listCategoria = array();
    
        if ($query != NULL) {
            foreach ($query->result_array() as $dados) {
    
                $listCategoria[] = $this->visualizar($dados["id_solicitacao"]);
            }
        }
        return $listCategoria;
    }


    //FILTRO DE PEDIDO DE COMPRA
    public function filtro_pc($dados) {
        
        $this->db->from("comp_solicitacao");
        $this->db->order_by("data_criacao","desc");
           $this->db->order_by("id_solicitacao","desc");
        $this->db->where("deletado",DELETADO);
        $this->db->where('codigo_pc is NOT NULL', NULL, FALSE);
        

        if ($dados["id_solicitacao"] != NULL):
            $this->db->where("id_solicitacao", $dados["id_solicitacao"]);
        endif;


      

          if ($dados["id_status_diretoria"] != NULL):
            $this->db->where("id_status_diretoria", $dados["id_status_diretoria"]);
        endif;

        
      
        $data_de = $dados["data_de"];
        $data_ate = $dados["data_ate"];

        if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                
              $this->db->where("DATE(data_criacao) BETWEEN '$data_de' AND '$data_ate'");
         
         endif;

      

         
        $query = $this->db->get();
    
        if ($query == FALSE) {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
    
        $listCategoria = array();
    
        if ($query != NULL) {
            foreach ($query->result_array() as $dados) {
    
                $listCategoria[] = $this->visualizar($dados["id_solicitacao"]);
            }
        }
        return $listCategoria;
    }


      //LISTAR ITENS DO PEDIDO DE COMPRA(UTILIZADA)
     public function listar_itens_pc($id_solicitacao) {

      
      
       
       $query = $this->db->query("SELECT i.id_item,e.id_produto,e.descricao,co.valor,i.qtd,co.data_entrega,f.nome_fantasia,f.id_fornecedor,i.id_solicitacao, co.valor * i.qtd as sub_total,co.id_cotacao,co.lancada,co.flag_parcial,co.status from comp_cotacoes co
        left join comp_itens i on(co.id_item = i.id_item) 
        left join est_produtos e on(i.id_produto=e.id_produto) 
        left join com_fornecedores f on(co.id_fornecedor=f.id_fornecedor) 
        where i.id_solicitacao = ".$id_solicitacao." and co.status = 1 and co.deletado=0 and co.flag_parcial is not null");
       
       $result = $query->result_array();

      

       
        return $result;
        
     }





     //LISTAR ITENS DO PEDIDO DE COMPRA(UTILIZADA)
     public function __listar_itens_pc($id_solicitacao) {

      
      
       
       $query = $this->db->query("SELECT i.id_item,e.id_produto,e.descricao,o.nome_obra,c.codigo as custo,c.id_custo,o.id_obra,co.valor,i.qtd,co.data_entrega,f.nome_fantasia,f.id_fornecedor,i.id_solicitacao, co.valor * i.qtd as sub_total,co.id_cotacao,co.lancada from comp_cotacoes co
        left join comp_itens i on(co.id_item = i.id_item) left join est_produtos e on(i.id_produto=e.id_produto) left join proj_obra o on(i.id_obra=o.id_obra) left join fin_centro_custos c on(i.id_custo=c.id_custo) left join com_fornecedores f on(co.id_fornecedor=f.id_fornecedor) where i.id_solicitacao = ".$id_solicitacao." and co.status = 1 and co.deletado=0");
       
       $result = $query->result_array();

      

       
        return $result;
        
     }




       //LISTAR ITENS AGRUPADAS POR FORNECEDOR
     public function listar_itens_pc_group($id_solicitacao) {

                   
       $query = $this->db->query("SELECT e.id_produto,e.descricao,co.valor,co.qtd,co.data_entrega,f.nome_fantasia,f.id_fornecedor,i.id_solicitacao, co.valor * co.qtd as sub_total from comp_cotacoes co
        left join comp_itens i on(co.id_item = i.id_item) 
        left join est_produtos e on(i.id_produto=e.id_produto) 
left join com_fornecedores f on(co.id_fornecedor=f.id_fornecedor) 
where i.id_solicitacao = ".$id_solicitacao." and co.status = 1 and co.deletado=0 and co.flag_parcial=0 group by f.id_fornecedor");
       
       $result = $query->result_array();

      

       
        return $result;
        
     }

 
    
    

    
    public function ajax_listar($pos){
        $this->db->from("comp_solicitacao");
        if($pos==NAO){
         $this->db->order_by("data_necessidade","asc");
        }else{
         $this->db->order_by("id_solicitacao","desc");   
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
               'id_solicitacao'   => $dados['id_solicitacao'],
               'id_status'      => $dados['id_status'],
               );
                  
          }

          }

          return $listCategoria;

    }
	


	
    
    public function visualizar($id_solicitacao){
    	$this->db->from("comp_solicitacao");
    	$this->db->where("id_solicitacao",$id_solicitacao);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objCategoria = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objCategoria = $this->Factory->createPojo("comp_solicitacao",$dados);

             //Solicitente
             $colaboradorBusiness = $this->Factory->createBusiness("rh_colaboradores");
             $objColaborador = $colaboradorBusiness->visualizar($objCategoria->getId_solicitante());
             $objCategoria->setColaborador($objColaborador);

                //Solicitente
             $aprovadorBusiness = $this->Factory->createBusiness("rh_colaboradores");
             $objAprovador = $aprovadorBusiness->visualizar($objCategoria->getId_aprovador());
             $objCategoria->setAprovador($objAprovador);

             $statusBusiness = $this->Factory->createBusiness("conf_status");
             $objStatus = $statusBusiness->visualizar($objCategoria->getId_status());
             $objCategoria->setObjStatus($objStatus);

             $statusBusiness = $this->Factory->createBusiness("conf_status");
             $objStatusCotacao = $statusBusiness->visualizar($objCategoria->getId_status_cotacao());
             $objCategoria->setObjStatusCotacao($objStatusCotacao);

             $statusBusiness = $this->Factory->createBusiness("conf_status");
             $objStatusControladoria = $statusBusiness->visualizar($objCategoria->getId_status_controladoria());
             $objCategoria->setObjStatusControladoria($objStatusControladoria);

             $statusBusiness = $this->Factory->createBusiness("conf_status");
             $objStatusDiretoria = $statusBusiness->visualizar($objCategoria->getId_status_diretoria());
             $objCategoria->setObjStatusDiretoria($objStatusDiretoria);


             $aprovadorBusiness = $this->Factory->createBusiness("rh_colaboradores");
             $objAprovador_cotacao = $aprovadorBusiness->visualizar($objCategoria->getId_aprovador_cotacao());
             $objCategoria->setAprovador_cotacao($objAprovador_cotacao);

             $aprovadorBusiness = $this->Factory->createBusiness("rh_colaboradores");
             $objAprovadorControladoria = $aprovadorBusiness->visualizar($objCategoria->getId_aprovador_controladoria());
             $objCategoria->setAprovadorControladoria($objAprovadorControladoria);

             $aprovadorBusiness = $this->Factory->createBusiness("rh_colaboradores");
             $objAprovadorDiretoria = $aprovadorBusiness->visualizar($objCategoria->getId_aprovador_diretoria());
             $objCategoria->setAprovadorDiretoria($objAprovadorDiretoria);

    	}
    
    	return $objCategoria;
    
    
    }
    
    
    public function alterar($dados){
    	$this->db->where('id_solicitacao',$dados['id_solicitacao']);
    	$sucess = $this->db->update("comp_solicitacao",$dados);
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_solicitacao){
        $this->db->where('id_solicitacao',$id_solicitacao);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("comp_solicitacao",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }



    //CONSULTAS RELATORIOS 

    //SOLICITAÇÃO
     public function relatorio_solicitacao($dados) {

      
        $id_solicitacao = $dados['id_solicitacao'];
        $id_status = $dados['id_status'];
        $id_solicitante = $dados['id_solicitante'];
        $id_custo = $dados['id_custo'];
        $data_de = $dados['data_de'];
        $data_ate = $dados['data_ate'];

       
        $param = "";
           
         if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                 
                
                 $param .= "and DATE(s.data_criacao) BETWEEN '$data_de' AND '$data_ate'"; 
         
         endif;
         

     

         if ($dados["id_solicitante"] != NULL):
              $param .= " and s.id_solicitante = ".$id_solicitante." ";
        endif; 


       if ($dados["id_solicitacao"] != NULL):
              $param .= " and s.id_solicitacao = $id_solicitacao";
        endif;

        if ($dados["id_status"] != NULL):
              $param .= " and s.id_status = $id_status";
        endif; 

      

        if ($dados["id_custo"] != NULL):
              $param .= " and c.id_custo = $id_custo ";
        endif; 



       
         

       
       $query = $this->db->query("select s.id_solicitacao as codigo,r.nome as solicitante, s.data_criacao as data,s.data_necessidade,c.custo,p.projeto as site,st.status,s.id_solicitante 
    from comp_solicitacao s
    inner join rh_colaboradores r
    on(s.id_solicitante=r.id_colaborador)
    inner join comp_itens i
    on(i.id_solicitacao = s.id_solicitacao)
    inner join fin_centro_custos c
    on(i.id_custo=c.id_custo)
    inner join proj_projetos p
    on(p.id_projeto=c.id_projeto)
    inner join conf_status st
    on(s.id_status=st.id_status)
    where s.deletado = 0 ".$param. "
    group by i.id_custo order by s.id_solicitacao desc, s.data_criacao desc");
       
       $result = $query->result_array();

      

       
        return $result;
        
     }

    //FINAL DA CONSULTA

    


 }
?>
