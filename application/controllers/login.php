<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author wcs
 */
class login extends MY_Controller {

    public function index(){
        
        $this->load->helper(array('form', 'url'));
        $this->loadLibrary("form_validation");

        //se nao estiver logado
        if (!$this->session->userdata("logged_in")) {
            $this->form_validation->set_rules('login', 'Login', 'required|alpha_dash');
            $this->form_validation->set_rules('senha', 'Senha', 'required|alpha_numeric|callback_validar_login');

            if ($this->form_validation->run() == FALSE) {
                //$content = $this->load->view("login", "", TRUE);
                //$this->loadPage($content);
                $info['flag_email'] = false;
                $info['email_erro'] = false;
                $this->load->view("login", $info);
                return;
                
            }
        }
                
        //redirect("home");
        //redirect("pedidos/filtro/".PEDIDO."/1");
       
        $dados['id_usuario'] =$this->session->userdata('id_usuario');
        $dados['data'] = date('Y-m-d H:i');
        $dados['responsavel'] = $this->session->userdata('login');
        $dados['operacao'] = "Usuario realizou login"; 
        $acesso = $this->Factory->createBusiness("acesso_historico");
        $confirmar = $acesso->cadastrar($dados);

        
        if($this->session->userdata('id_perfil')==PERFIL_MASTER || $this->session->userdata('id_perfil')==PERFIL_CONTADOR ){
          redirect("dashboard/entrada/");
        }

        else if($this->session->userdata('id_perfil')==PERFIL_VENDAS || $this->session->userdata('id_perfil')==PERFIL_AUXILIAR){
          redirect("clientes/filtro/");
        }

         else if($this->session->userdata('id_perfil')==PERFIL_FINANCEIRO){
          redirect("contas_pagar/filtro/");
        }

        else{
            redirect("clientes/filtro");
        }
    

    }

    public function index__(){
        
        $this->load->helper(array('form', 'url'));
        
        $this->load->view("login", "");

        
    }

    public function recuperar(){
        
        $this->load->helper(array('form', 'url'));
        
        echo "teste";
        //$this->load->view("login", "");

        
    }

    //OBS: a excecao nao esta sendo capturada por motivo desconhecido
    public function validar_login($senha) {
        try {
            $login = $this->input->post("login");

            $usuarioBus = $this->Factory->createBusiness("acesso_usuarios");

            if ($usuarioBus->validar_login($login, $senha)) {
                return TRUE;
            } else {
                $this->form_validation->set_message('validar_login', 'Login ou senha incorretos.');
                return FALSE;
            }
        } catch (Excpeption $ex) {
            $this->loadError($ex);
        }
    }

    public function sair() {
        $this->load->helper('url');
        $this->session->sess_destroy();
        redirect("login", "refresh");
    }

      public function verificar_usuario(){

        $this->load->helper(array('form','url'));

        //$dadosForm = $this->input->post();

        $login = 'admin'; //$dadosForm['login'];
        $senha = 'admin';//$dadosForm['senha'];

        $usuarioBus = $this->Factory->createBusiness("acesso_usuarios");
        $confirmar = $usuarioBus->validar_login($login, $senha);
   

   if($confirmar!=null){
    
    echo "ok"; // log in
    
   }
   else{
    
    echo "email or password does not exist."; // wrong details 
   }



        
    }


}

?>
