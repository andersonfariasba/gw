<?php
/* Classe(controller): Cargos colaboradores
 * Autor: Anderson Farias
 * Última atualização: 23/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Relatorio_painel extends MY_Controller {
	
    //VALIDA��O
    private function Rules(){
        $this->form_validation->set_rules('cargo','Cargo','required');
        $this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
    }


    //RELATORIOS


       

       public function menu(){
            $this->load->helper(array('form','url'));

             
              //Plano de contas
            $planosBusiness = $this->Factory->createBusiness("fin_plano_contas_cat");
            $listPlanosCat = $planosBusiness->listar_por_tipo(CONTAS_PAGAR);
            $info["listPlanosCat"] = $listPlanosCat;



             //Listagem de Clientes
            $clientesBusiness = $this->Factory->createBusiness("com_clientes");
            $listCliente = $clientesBusiness->listar_cliente_orcamento();
            $info['listCliente'] = $listCliente;

            $userBusiness = $this->Factory->createBusiness("acesso_usuarios");
            $listUser = $userBusiness->filtro(null);
            $info['listUser'] = $listUser;

             //Categoria
            $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
            $listCategoria = $categoriaBusiness->filtro(null);
            $info["listCategoria"] = $listCategoria;

            //Centro de custos
            $custoBusiness = $this->Factory->createBusiness("fin_centro_custos");
            $listCustos = $custoBusiness->filtro();
            $info["listCusto"] = $listCustos;
           

               //FORMA DE PAGAMENTO
            $formasBusiness = $this->Factory->createBusiness("fin_formas_pagamentos");
            $listFormas = $formasBusiness->filtro();
            $info['listForma'] = $listFormas;

              //FORMA DE PAGAMENTO
            $formasBusiness = $this->Factory->createBusiness("fin_formas_recebimentos");
            $listFormas = $formasBusiness->filtro();
            $info['listFormaRec'] = $listFormas;
                     
           
            
            //Fornecedor
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;

             //Conta Banco
            $conta_bancoBusiness = $this->Factory->createBusiness("fin_contas_banco");
            $listContasBanco = $conta_bancoBusiness->filtro();
            $info["listContaBanco"] = $listContasBanco;

             $statusBusiness = $this->Factory->createBusiness("fin_status_pedido");
            $listStatus = $statusBusiness->filtro(null);
            $info['listStatus'] = $listStatus;

            $statusEntregaBusiness = $this->Factory->createBusiness("com_status_itens");
            $listStatusEntrega = $statusEntregaBusiness->filtro(null);
            $info['listStatusEntrega'] = $listStatusEntrega;


            $content = $this->load->view("relatorio_painel/menu",$info,TRUE);
            $this->loadPage($content);

       }

        
       
    
  
   
      
      
}
?>
