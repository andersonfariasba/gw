<?php
/* Classe(DAO): Pedidos
* Autor: Anderson Farias
* Última atualização: 01/10/2015
* Contato: andersonjfarias@yahoo.com.br
*/

class Com_pedidosDao extends CI_Model {
    

    public function connect(){
        $this->load->database();
    }

    public function disconnect(){
        $this->db->close();
    }


    public function cadastrar($objPedido){
        $sucess = $this->db->insert("com_pedidos",$objPedido->toArray());
        if(!$sucess){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $cod_pedido = $this->db->insert_id();

        return $cod_pedido;
    }
    
    
    //VENDAS
    public function filtro($tipo,$dados) {
     	
    	$this->db->from("com_pedidos");
    	//$this->db->order_by("data_inicio");
       
       
    	$this->db->where("deletado",DELETADO);
        $this->db->where("locacao",NAO);
        
    	
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


    //VENDAS
    public function filtro_loc($tipo,$dados) {
        
        $this->db->from("com_pedidos");
        //$this->db->order_by("data_inicio");
       
       
        $this->db->where("deletado",DELETADO);
        $this->db->where("locacao",SIM);
        
        
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


     //VENDAS PARA BAR/RESTAURANTE
    public function filtro_bar($tipo,$dados) {
        
        $this->db->from("com_pedidos");
        //$this->db->order_by("data_inicio");
       
       
        $this->db->where("deletado",DELETADO);
        $this->db->where("locacao",NAO);
        
        
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

        if($dados['id_mesa']!=NULL){
             $this->db->where("id_mesa",$dados['id_mesa']);
         }

         if($dados['id_garcon']!=NULL){
             $this->db->where("id_garcon",$dados['id_garcon']);
         }

              
        $query = $this->db->get();
    
        if ($query == FALSE) {
            throw new Exception($this->db->_error_message(), $this->db->_error_number());
        }
    
        $listPedidos = array();
    
        if ($query != NULL) {
            foreach ($query->result_array() as $dados) {
    
                $listPedidos[] = $this->visualizar_bar($dados["id_pedido"]);
            }
        }
        return $listPedidos;
    }




    public function filtro_entrega__($id_pedido) {
        
        $this->db->from("com_pedidos");
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
        
        $this->db->from("com_pedidos");
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
    	$this->db->from("com_pedidos");
    	$this->db->where("id_pedido",$id_pedido);
      	$query = $this->db->get();
    
    	if($query==FALSE){
    		throw new Exception($this->db->_error_message(),$this->db->_error_number());
    	}

    	$objPedido = NULL;
    
    	if($query->num_rows()>0){
    		$dados = $query->row_array();
    		$objPedido = $this->Factory->createPojo("com_pedidos",$dados);
                
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
                $itensBusiness = $this->Factory->createBusiness("com_pedidos_itens");
                $objItem = $itensBusiness->valor_total($objPedido->getId_pedido());
                $objPedido->setTotal_itens($objItem);

                  //Buscar listagem dos itens pedidos
                $pedidos_itensBusiness = $this->Factory->createBusiness("com_pedidos_itens");
                $listPedidosItens = $pedidos_itensBusiness->listar($objPedido->getId_pedido());
                $objPedido->setItens_pedidos($listPedidosItens);

                 //Lançamentos
                $lancBusiness = $this->Factory->createBusiness("fin_lancamentos_receber");
                $objLanc = $lancBusiness->total_venda($objPedido->getId_pedido());
                $objPedido->setTotal_venda($objLanc);




    	}
    
    	return $objPedido;
    
    
    }


    //PARA BAR E RESTAURANTE
    public function visualizar_bar($id_pedido){
        $this->db->from("com_pedidos");
        $this->db->where("id_pedido",$id_pedido);
        $query = $this->db->get();
    
        if($query==FALSE){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $objPedido = NULL;
    
        if($query->num_rows()>0){
            $dados = $query->row_array();
            $objPedido = $this->Factory->createPojo("com_pedidos",$dados);
                
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

                 //Garcon
                $garconBusiness = $this->Factory->createBusiness("rh_colaboradores");
                $objGarcon = $garconBusiness->visualizar($objPedido->getId_garcon());
                $objPedido->setGarcon($objGarcon);

                   //Mesa
                $mesaBusiness = $this->Factory->createBusiness("com_mesas");
                $objMesa = $mesaBusiness->visualizar($objPedido->getId_mesa());
                $objPedido->setMesa($objMesa);

                
                 //Cliente
                $itensBusiness = $this->Factory->createBusiness("com_pedidos_itens");
                $objItem = $itensBusiness->valor_total($objPedido->getId_pedido());
                $objPedido->setTotal_itens($objItem);

                  //Buscar listagem dos itens pedidos
                $pedidos_itensBusiness = $this->Factory->createBusiness("com_pedidos_itens");
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
        $this->db->from("com_pedidos");
        $this->db->where("id_pedido",$id_pedido);
        $query = $this->db->get();
    
        if($query==FALSE){
            throw new Exception($this->db->_error_message(),$this->db->_error_number());
        }

        $objPedido = NULL;
    
        if($query->num_rows()>0){
            $dados = $query->row_array();
            $objPedido = $this->Factory->createPojo("com_pedidos",$dados);
                
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
    	$sucess = $this->db->update("com_pedidos",$objPedido->toArray());
    	
    	if(!$sucess){
    		throw new Exception($this->db->_error_message(),  $this->db->_error_number());
    	}
    
    }
    
    
    public function excluir($id_pedido){
        $this->db->where('id_pedido',$id_pedido);
        $dados["deletado"] = DELETADO_SIM;
        $sucess = $this->db->update("com_pedidos",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }

    

    //alterar orçamento para pedido
    public function alterar_tipo($id_pedido){
        $this->db->where('id_pedido',$id_pedido);
        $dados["tipo"] = PEDIDO;
        $sucess = $this->db->update("com_pedidos",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


      //alterar orçamento para pedido
    public function alterar_status($id_pedido,$status){
        $this->db->where('id_pedido',$id_pedido);
        $dados["status"] = $status;
        $sucess = $this->db->update("com_pedidos",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


     public function confirmar_orcamento($objPedido){
        $this->db->where('id_pedido',$objPedido->getId_pedido());
       
        $dados["observacao"] = $objPedido->getObservacao();

        $sucess = $this->db->update("com_pedidos",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }

    public function salvar_pedido($dados){
        $this->db->where('id_pedido',$dados['id_pedido']);
       
        //$dados["observacao"] = $objPedido->getObservacao();
        //$dados["desconto"] = $objPedido->getDesconto();
       // $dados["taxa_entrega"] = $objPedido->getTaxa_entrega();
       
        $sucess = $this->db->update("com_pedidos",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


     public function incluir_obs($dados){
        $this->db->where('id_pedido',$dados['id_pedido']);
       
        //$dados["observacao"] = $objPedido->getObservacao();
        //$dados["desconto"] = $objPedido->getDesconto();
       // $dados["taxa_entrega"] = $objPedido->getTaxa_entrega();
       
        $sucess = $this->db->update("com_pedidos",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }


    

      public function alterar_cliente($dados){
        $this->db->where('id_pedido',$dados['id_pedido']);
                
        $sucess = $this->db->update("com_pedidos",$dados);
         if(!$sucess){
             throw new Exception($this->db->_error_message(),$this->db->_error_number());
         }
    }

     //operação para gerar um novo codigo de os
    public function gerar_codigo(){
        $this->db->from("com_pedidos"); //tabela
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
            $objCodigo = $this->Factory->createPojo("com_pedidos",$dados);
       }
       
       else{
         return 1;
       }
        
    
      return $objCodigo->getCodigo()+1;

    }


    public function gerar_codigo_orcamento(){
        $this->db->from("com_pedidos"); //tabela
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
            $objCodigo = $this->Factory->createPojo("com_pedidos",$dados);
       }
       
       else{
         return 1;
       }
        
          return $objCodigo->getCodigo_orcamento()+1;

    }



    public function listar_por_cliente($id_cliente,$tipo) {
        
        $this->db->from("com_pedidos");
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
        //$this->db->from("com_pedidos");
        //$this->db->where("deletado",DELETADO);
        //$data_de = $objDateFormat->date_mysql($data_de);
        //$data_ate = $objDateFormat->date_mysql($data_ate);
        $this->db->select('com_pedidos.id_pedido,com_pedidos.codigo,com_pedidos.data_inicio,com_pedidos.data_final,com_pedidos.tipo,com_clientes.nome_fantasia,com_clientes.celular,com_clientes.email');
        $this->db->from("com_pedidos");
        $this->db->join('com_clientes', 'com_pedidos.id_cliente = com_clientes.id_cliente','left');
        $this->db->where("com_pedidos.deletado",DELETADO);
         $this->db->where("com_pedidos.tipo",PEDIDO);
        
        $data_de = date('Y-m-d');
        $data_ate = date('Y-m-d');        
        
        $this->db->where("Date(com_pedidos.data_final) BETWEEN '$data_de' AND '$data_ate'");

              
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



    //ENTREGA LOCAÇÃO

    //Movimentação de Produtos
public function filtro_entrega($dados) {

      
       // $id_projeto = $dados['id_projeto'];
                  
       
        $param = "";
           
              
        $data_de = $dados['data_de'];
        $data_ate = $dados['data_ate'];

       
                  
         if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                 
                
                 $param .= " and DATE(i.data_prev_entrega) BETWEEN '$data_de' AND '$data_ate'"; 
         
         endif;

         if($dados['codigo']!=NULL){ 
          
              $param .= " and p.codigo = '".$dados['codigo']."' ";
                     
          }

           if($dados['id_cliente']!=NULL){ 
          
              $param .= " and p.id_cliente = '".$dados['id_cliente']."' ";
                     
          }

           if($dados['id_status']!=NULL){ 
          
              $param .= " and i.id_status = '".$dados['id_status']."' ";
                     
          }



        $query = $this->db->query("select p.id_pedido,i.id_item,p.codigo as 'codigo_locacao',e.descricao as 'produto',i.qtd,i.data_prev_entrega,i.data_entrega_final,c.nome_fantasia as 'cliente',i.id_status,s.status,s.cor from com_pedidos_itens i
       left join com_pedidos p
       on(i.id_pedido = p.id_pedido)
       left join est_produtos e
       on(i.id_produto = e.id_produto)
       left join com_clientes c
       on(p.id_cliente = c.id_cliente)
       left join com_status_itens s
       on(s.id_status = i.id_status)
       where p.deletado = 0 and i.deletado = 0 and p.locacao = 1 and p.faturado = 1 ".$param."
       order by data_prev_entrega desc");
       
       $result = $query->result_array();
       
       return $result;
        
     }


    //FINAL DA CONSULTA



    //Movimentação de Produtos
public function filtro_entrega_hoje($dados) {

      
       // $id_projeto = $dados['id_projeto'];
                  
       
        $param = "";
           
              
        $data_de = $dados['data_de'];
        $data_ate = $dados['data_ate'];

       
                  
         if ($data_de != NULL && $data_ate != NULL):
                 $objDateFormat = $this->DateFormat;
                 $data_de = $objDateFormat->date_mysql($data_de);
                 $data_ate = $objDateFormat->date_mysql($data_ate);
                 
                
                 $param .= " and DATE(i.data_prev_entrega) BETWEEN '$data_de' AND '$data_ate'"; 
         
         endif;

       

        $query = $this->db->query("select p.id_pedido,i.id_item,p.codigo as 'codigo_locacao',e.descricao as 'produto',i.qtd,i.data_prev_entrega,i.data_entrega_final,c.nome_fantasia as 'cliente',i.id_status,s.status,s.cor from com_pedidos_itens i
       left join com_pedidos p
       on(i.id_pedido = p.id_pedido)
       left join est_produtos e
       on(i.id_produto = e.id_produto)
       left join com_clientes c
       on(p.id_cliente = c.id_cliente)
       left join com_status_itens s
       on(s.id_status = i.id_status)
       where p.deletado = 0 and i.deletado = 0 and p.locacao = 1 and p.faturado = 1 ".$param."
       order by data_prev_entrega desc");
       
       $result = $query->result_array();
       
       return $result;
        
     }


    //FINAL DA CONSULTA






 }

 
?>
