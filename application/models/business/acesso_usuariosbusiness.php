<?php
/* Classe(business): Usuários
 * Autor: Anderson Farias
 * última atualização: 25/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Acesso_usuariosBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objUser = $this->Factory->createPojo("acesso_usuarios",$dados);
            $userDao = $this->Factory->createDao("acesso_usuarios");
            $userDao->connect();
            $cod_user = $userDao->cadastrar($objUser);
		    $userDao->disconnect();
		    return $cod_user;
             } 
        
        catch (Exception $exc) {
	        throw $exc;
        }
    }

    //LISTA
    public function filtro($dados){
    	try {
    		
    	    $userDao = $this->Factory->createDao("acesso_usuarios");
            $userDao->connect();
            $listUser = $userDao->filtro($dados);
            $userDao->disconnect();
            return $listUser;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

          //LISTA
    public function listar_aprovador($perfil){
      try {
        
          $userDao = $this->Factory->createDao("acesso_usuarios");
            $userDao->connect();
            $listUser = $userDao->listar_aprovador($perfil);
            $userDao->disconnect();
            return $listUser;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

          //LISTA
    public function listar_por_perfil($id_perfil){
      try {
        
          $userDao = $this->Factory->createDao("acesso_usuarios");
            $userDao->connect();
            $listUser = $userDao->listar_por_perfil($id_perfil);
            $userDao->disconnect();
            return $listUser;

            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //VISUALIZA
    public function visualizar($id_user){
    	try {
    	    $userDao = $this->Factory->createDao("acesso_usuarios");
            $userDao->connect();
            $objUser = $userDao->visualizar($id_user);
            $userDao->disconnect();
            return $objUser;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }

     public function visualizar_por_email($email){
      try {
          $userDao = $this->Factory->createDao("acesso_usuarios");
            $userDao->connect();
            $objUser = $userDao->visualizar_por_email($email);
            $userDao->disconnect();
            return $objUser;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    $objUser = $this->Factory->createPojo("acesso_usuarios",$dados);
            $userDao = $this->Factory->createDao("acesso_usuarios");
            $userDao->connect();
            $userDao->alterar($objUser);
            $userDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //DELETE
    public function excluir($id_user){
    	try {
    	    $userDao = $this->Factory->createDao("acesso_usuarios");
            $userDao->connect();
            $userDao->excluir($id_user);
            $userDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
     public function validar_login($login,$senha){
            try {
                 $userDao = $this->Factory->createDao("acesso_usuarios");
                 $userDao->connect();
                 $objUser = $userDao->getByLoginSenha($login,$senha);
                 $userDao->disconnect();
                 
                    if($objUser!=null){
                        $dadosSessao = $objUser->toArray();
                        
                         /*foreach($objUser->getPerfil()->getListaPaginas() as $pagina){
                           $cod_pag_mod = $pagina->getCod_pag_mod();
                           $dadosSessao["menu_$cod_pag_mod"] = $cod_pag_mod;
                         }*/
                        //Dados gerais da empresa
                          $filialBusiness = $this->Factory->createBusiness("fin_filiais");
                          $objFilial = $filialBusiness->visualizar(PAD_CAD_FILIAL);
                          $dadosSessao['logo'] = $objFilial->getLogo();
                          $dadosSessao['filial_nome'] = $objFilial->getNome_fantasia();
                          $dadosSessao['filial_documento'] = $objFilial->getCnpj_cpf();
                          $dadosSessao['filial_endereco'] = $objFilial->getEndereco();
                          $dadosSessao['filial_bairro'] = $objFilial->getBairro();
                          $dadosSessao['filial_cep'] = $objFilial->getCep();
                          $dadosSessao['filial_email'] = $objFilial->getEmail();
                          $dadosSessao['filial_telefone'] = $objFilial->getTelefone1();
                          $dadosSessao['filial_celular'] = $objFilial->getCelular();
                          $dadosSessao['mod_locacao'] = $objFilial->getMod_locacao();
                          $dadosSessao['mod_caixa'] = $objFilial->getMod_caixa();
                          $dadosSessao['mod_vendas'] = $objFilial->getMod_vendas();
                          $dadosSessao['mod_compras'] = $objFilial->getMod_compras();
                          $dadosSessao['mod_bar'] = $objFilial->getMod_bar();
                          $estado_param = "";
                          $cidade_param = "";

                          
                            if($objUser->getColaborador()!=null){
                            $dadosSessao['nome_colaborador'] = $objUser->getColaborador()->getNome();
                            
                          }
                          else{
                            $dadosSessao['nome_colaborador'] = "";
                            
                          }

                                                   
                           if($objFilial->getCidadeObj()!=null){
                            $cidade_param = $objFilial->getCidadeObj()->getCt_nome(); 
                           }

                           if($objFilial->getEstadoObj()!=null){
                            $estado_param = $objFilial->getEstadoObj()->getUf_uf(); 
                           }




                          $dadosSessao['filial_cidade'] =  $cidade_param; //$objFilial->getCidade();
                          $dadosSessao['filial_estado'] = $estado_param;//$objFilial->getEstado();







                        unset($dadosSessao['senha']);
                        $dadosSessao['logged_in'] = true;
                        $this->session->set_userdata($dadosSessao);
                        return TRUE;
                    }
                    return FALSE;
                 //return $objUser;
                
            } catch (Exception $exc) {
                throw $exc;
            }
        }


}

?>
