<?php
/* Classe(controller): Contas pagar
 * Autor: Anderson Farias
 * Última atualização: 04/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Boletos extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->library('boleto');
  }
	
    
      //GERAR BOLETO
    
    public function gerar_boleto(){
          
          $this->load->helper(array('form','url'));
          //$this->load->library('boleto');
                  
       $dados = array(
      // Informações necessárias para todos os bancos
      'dias_de_prazo_para_pagamento' => 5,
      'taxa_boleto'                  => 1,
      'pedido'                       => array(
        'nome'           => 'Serviços de Desenvolvimento Web',
        'quantidade'     => '1',
        'valor_unitario' => '49.90',
        'numero'         => 10000000025,
        'aceite'         => 'N',
        'especie'        => 'R$',
        'especie_doc'    => 'DM',
      ),
      'sacado'                       => array(
        'nome'     => 'João da Silva',
        'endereco' => 'Av. Meninas Bonitas, 777',
        'cidade'   => 'Salvador',
        'uf'       => 'BA',
        'cep'      => '93816-630',
      ),
      // Informações necessárias que são específicas do Banco do Brasil
      'variacao_carteira'            => '019',
      'contrato'                     => 999999,
      'convenio'                     => 7777777,
    );

    // Gera o boleto
    $this->boleto->bb($dados);

  }
    


    }

      
      

?>
