<?php
/* Classe(DAO): Pedidos
* Autor: Anderson Farias
* Última atualização: 01/10/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Com_pedidos_locDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objPedido){
        $sucess = $this->db->insert("com_pedidos_loc",$objPedido->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_pedido = $this->db->insert_id();

        return $cod_pedido;
    }
    
    
    public function filtro($tipo,$dados) {
     	
    	$this->db->from("com_pedidos_loc");
    	//$this->db->order_by("data_inicio");
       
       
    	$this->db->where("deletado",DELETADO);
        
    	
        $data_de = $dados["data_de"];
        $data_ate = $dados["data_ate"];

          if($dados==null){
          //BUSCAR A DATA DO MÊS
          //$primeiro_dia = date('Y-m-01'); 
          //$ultimo_dia = date("Y-m-t");
          $this->db->limit(150);
          //$this->db->where("DATE(data_inicio) BETWEEN '$primeiro_dia' AND '$ultimo_dia'");
          
         //FINAL DATA DO MÊS
      }


        if($tipo==PEDIDO){
          
            //$status = array(FINALIZADO, ANDAMENTO);
             //$this->db->where_in('status', $status);
            $this->db->where("tipo",$tipo);
            $this->db->order_by("codigo","desc"); //ordenar pela coluna
             
             if($dados['codigo']!=NULL){
             $this->db->where("codigo",$dados['codigo']);
             }
          

          }

          if($tipo==ORCAMENTO){
             $this->db->where("orcamento",SIM);

             if($dados['codigo_orcamento']!=NULL){
                $this->db->where("codigo_orcamento",$dados['codigo_orcamento']);
             }


             $this->db->order_by("data_inicio","desc"); //ordenar pela coluna

              
          }

         


           
         if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                
              $this->db->where("DATE(data_inicio) BETWEEN '$data_de' AND '$data_ate'");
         
         endif;

          if($dados['status']!=NULL){
             $this->db->where("status",$dados['status']);
         }

       if($dados['id_usuario']!=NULL){
             $this->db->where("id_usuario",$dados['id_usuario']);
         }

         if($dados['id_cliente']!=NULL){
             $this->db->where("id_cliente",$dados['id_cliente']);
         }

              
        $query = $this->db->get();
    
    	if ($query == FALSE) {
    		throw new Exception($this->db->_error_message(), $this->db->_error_number());
    	}
    
    	$listPedidos = array();
    
    	if ($query != NULL) {
    		foreach ($query->result_array() as $dados) {
    
    			$listPedidos[] = $this->visualizar($dados["id_pedido"]);
    		}
    	}
    	return $listPedidos;
    }


    public function filtro_entrega($id_pedido) {
        
        $this->db->from("com_pedidos_loc");
        //$this->db->order_by("data_inicio");
       
        $this->db->where("id_pedido",$id_pedido);
        $this->db->where("deletado",DELETADO);
                
                      
        $query = $this->db->get();
    
        if ($query == FALSE) {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
    
        $listPedidos = array();
    
        if ($query != NULL) {
            foreach ($query->result_array() as $dados) {
    
                $listPedidos[] = $this->visualizar($dados["id_pedido"]);
            }
        }
        return $listPedidos;
    }
    
    

    public function ultimas_vendas() {
        
        $this->db->from("com_pedidos_loc");
        //$this->db->order_by("data_inicio");
       
        $this->db->where("tipo",PEDIDO);
        $this->db->where("deletado",DELETADO);
        $this->db->where('faturado', SIM);
        $this->db->order_by('id_pedido',"desc");
        $this->db->limit(5);
        
       $query = $this->db->get();
    
        if ($query == FALSE) {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
    
        $listPedidos = array();
    
        if ($query != NULL) {
            foreach ($query->result_array() as $dados) {
    
                $listPedidos[] = $this->visualizar($dados["id_pedido"]);
            }
        }
        return $listPedidos;
    }
    
    

    
	
    
    public function visualizar($id_pedido){
    	$this->db->from("com_pedidos_loc");
    	$this->db->where("id_pedido",$id_pedido);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objPedido = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objPedido = $this->Factory->createPojo("com_pedidos_loc",$dados);
                
                //Usuário
                $usuarioBusiness = $this->Factory->createBusiness("acesso_usuarios");
                $objUsuario = $usuarioBusiness->visualizar($objPedido->getId_usuario());
                $objPedido->setUsuario($objUsuario);

                               //Cliente
                $clienteBusiness = $this->Factory->createBusiness("com_clientes");
                $objCliente = $clienteBusiness->visualizar($objPedido->getId_cliente());
                $objPedido->setCliente($objCliente);

                $statusBusiness = $this->Factory->createBusiness("fin_status_pedido");
                $objStatus = $statusBusiness->visualizar($objPedido->getStatus());
                $objPedido->setObjStatus($objStatus);

                
                 //Cliente
                $itensBusiness = $this->Factory->createBusiness("com_pedidos_loc_itens");
                $objItem = $itensBusiness->valor_total($objPedido->getId_pedido());
                $objPedido->setTotal_itens($objItem);

                  //Buscar listagem dos itens pedidos
                $pedidos_itensBusiness = $this->Factory->createBusiness("com_pedidos_loc_itens");
                $listPedidosItens = $pedidos_itensBusiness->listar($objPedido->getId_pedido());
                $objPedido->setItens_pedidos($listPedidosItens);

                 //Lançamentos
                $lancBusiness = $this->Factory->createBusiness("fin_lancamentos_receber");
                $objLanc = $lancBusiness->total_venda($objPedido->getId_pedido());
                $objPedido->setTotal_venda($objLanc);




    	}
    
    	return $objPedido;
    
    
    }


    public function visualizar_simples($id_pedido){
        $this->db->from("com_pedidos_loc");
        $this->db->where("id_pedido",$id_pedido);
        $query = $this->db->get();
    
        if($query==FALSE){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $objPedido = NULL;
    
        if($query->num_rows()>0){
            $dados = $query->row_array();
            $objPedido = $this->Factory->createPojo("com_pedidos_loc",$dados);
                
                //Usuário
                $usuarioBusiness = $this->Factory->createBusiness("acesso_usuarios");
                $objUsuario = $usuarioBusiness->visualizar($objPedido->getId_usuario());
                $objPedido->setUsuario($objUsuario);

                               //Cliente
                $clienteBusiness = $this->Factory->createBusiness("com_clientes");
                $objCliente = $clienteBusiness->visualizar($objPedido->getId_cliente());
                $objPedido->setCliente($objCliente);

                $statusBusiness = $this->Factory->createBusiness("fin_status_pedido");
                $objStatus = $statusBusiness->visualizar($objPedido->getStatus());
                $objPedido->setObjStatus($objStatus);

                
}
    
        return $objPedido;
    
    
    }
    
    
    
    public function alterar($objPedido){
    	$this->db->where('id_pedido',$objPedido->getId_pedido());
    	$sucess = $this->db->update("com_pedidos_loc",$objPedido->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_pedido){
        $this->db->where('id_pedido',$id_pedido);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("com_pedidos_loc",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }

    

    //alterar orçamento para pedido
    public function alterar_tipo($id_pedido){
        $this->db->where('id_pedido',$id_pedido);
        $dados["tipo"] = PEDIDO;
        $sucess = $this->db->update("com_pedidos_loc",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


      //alterar orçamento para pedido
    public function alterar_status($id_pedido,$status){
        $this->db->where('id_pedido',$id_pedido);
        $dados["status"] = $status;
        $sucess = $this->db->update("com_pedidos_loc",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


     public function confirmar_orcamento($objPedido){
        $this->db->where('id_pedido',$objPedido->getId_pedido());
       
        $dados["observacao"] = $objPedido->getObservacao();

        $sucess = $this->db->update("com_pedidos_loc",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }

    public function salvar_pedido($dados){
        $this->db->where('id_pedido',$dados['id_pedido']);
       
        //$dados["observacao"] = $objPedido->getObservacao();
        //$dados["desconto"] = $objPedido->getDesconto();
       // $dados["taxa_entrega"] = $objPedido->getTaxa_entrega();
       
        $sucess = $this->db->update("com_pedidos_loc",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


     public function incluir_obs($dados){
        $this->db->where('id_pedido',$dados['id_pedido']);
       
        //$dados["observacao"] = $objPedido->getObservacao();
        //$dados["desconto"] = $objPedido->getDesconto();
       // $dados["taxa_entrega"] = $objPedido->getTaxa_entrega();
       
        $sucess = $this->db->update("com_pedidos_loc",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


    

      public function alterar_cliente($dados){
        $this->db->where('id_pedido',$dados['id_pedido']);
                
        $sucess = $this->db->update("com_pedidos_loc",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }

     //operação para gerar um novo codigo de os
    public function gerar_codigo(){
        $this->db->from("com_pedidos_loc"); //tabela
        $this->db->where("tipo",PEDIDO); //coluna e o código passado como parametro
        //$this->db->where("status",PEDIDO);
        $this->db->where("faturado",SIM);
        $this->db->where("deletado",DELETADO);
        
        $this->db->order_by("codigo","desc"); //ordenar pela coluna
        $this->db->limit(1);
        $query = $this->db->get();
        $objCodigo = NULL;

        if($query->num_rows()>0){
            //pega os dados
            $dados = $query->row_array();
            $objCodigo = $this->Factory->createPojo("com_pedidos_loc",$dados);
       }
       
       else{
         return 1;
       }
        
    
      return $objCodigo->getCodigo()+1;

    }


    public function gerar_codigo_orcamento(){
        $this->db->from("com_pedidos_loc"); //tabela
        //$this->db->where("tipo",PEDIDO); //coluna e o código passado como parametro
       // $this->db->where("tipo",TROCA); //coluna e o código passado como parametro
        //$valor = array(ORCAMENTO);
       
        $this->db->where('tipo',ORCAMENTO);
        $this->db->order_by("codigo_orcamento","desc"); //ordenar pela coluna
        $this->db->limit(1);
        $query = $this->db->get();
        $objCodigo = NULL;

        if($query->num_rows()>0){
            //pega os dados
            $dados = $query->row_array();
            $objCodigo = $this->Factory->createPojo("com_pedidos_loc",$dados);
       }
       
       else{
         return 1;
       }
        
          return $objCodigo->getCodigo_orcamento()+1;

    }



    public function listar_por_cliente($id_cliente,$tipo) {
        
        $this->db->from("com_pedidos_loc");
        $this->db->where("id_cliente",$id_cliente);
        $this->db->where("deletado",DELETADO);

        if($tipo==PEDIDO){
            $this->db->where("faturado",SIM);
        }
        
        if($tipo!=null){
            $this->db->where("tipo",$tipo);
        }

        //$this->db->where("faturado",1);
        //$status = array(FINALIZADO, ANDAMENTO);
        //$this->db->where_in('status', $status);
        $this->db->order_by("codigo","desc"); //ordenar pela coluna
        
       $query = $this->db->get();
    
        if ($query == FALSE) {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
    
        $listPedidos = array();
    
        if ($query != NULL) {
            foreach ($query->result_array() as $dados) {
    
                $listPedidos[] = $this->visualizar($dados["id_pedido"]);
            }
        }
        return $listPedidos;
    }
    

    public function ajax_listar_entrega(){
        //$this->db->from("com_pedidos_loc");
        //$this->db->where("deletado",DELETADO);
        //$data_de = $objDateFormat->date_mysql($data_de);
        //$data_ate = $objDateFormat->date_mysql($data_ate);
        $this->db->select('com_pedidos_loc.id_pedido,com_pedidos_loc.codigo,com_pedidos_loc.data_inicio,com_pedidos_loc.data_final,com_pedidos_loc.tipo,com_clientes.nome_fantasia,com_clientes.celular,com_clientes.email');
        $this->db->from("com_pedidos_loc");
        $this->db->join('com_clientes', 'com_pedidos_loc.id_cliente = com_clientes.id_cliente','left');
        $this->db->where("com_pedidos_loc.deletado",DELETADO);
         $this->db->where("com_pedidos_loc.tipo",PEDIDO);
        
        $data_de = date('Y-m-d');
        $data_ate = date('Y-m-d');        
        
        $this->db->where("Date(com_pedidos_loc.data_final) BETWEEN '$data_de' AND '$data_ate'");

              
        $query = $this->db->get();

        if($query==FALSE){
            throw new Exception($this->db->_error_message(),  $this->db->_error_number());
        }

        $listMsg = array();

          if($query!=NULL){
              
                $objDateFormat = $this->DateFormat;
            
              foreach ($query->result_array() as $dados){

                // $objBandeira = $this->Factory->createPojo("fin_bandeira_cartao",$dados);
                // $listBandeira[] = $objBandeira;

                $listMsg[] = array(
               'id_pedido'   => $dados['id_pedido'],
               'codigo'   => $dados['codigo'],
               'data_inicio'      => $objDateFormat->date_format($dados['data_inicio']),
               'data_final'      => $objDateFormat->date_format($dados['data_final']),
               'tipo'      => $dados['tipo'],
               'cliente'      => $dados['nome_fantasia'],
               'celular'      => $dados['celular'],
               
               

               );
                  
          }

          }

          return $listMsg;

    }






 }

 
?>
