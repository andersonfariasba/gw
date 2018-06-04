<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Controller
 *
 * @author wcs
 */
class MY_Controller extends CI_Controller {

    public function __construct() {
        date_default_timezone_set('Brazil/East');
        setlocale(LC_ALL, "pt_BR", "ptb");

        parent::__construct();
        $this->loggedCheck();
    }

   private function loggedCheck() {
        $this->load->library('session');

        //se nao estiver logado
        if (!$this->session->userdata("logged_in")) {
            //se nao for a tela de login a ser exibida            
            if (!$this->isLoginView()) {
                //redireciona para a tela de login
                redirect("login");
            }
        }
    }

    private function isLoginView() {
        $this->load->helper("url");
        $uri_string = uri_string();
        return (($uri_string == "") || ($uri_string == "login") || ($uri_string == "email/recuperar"));
    }
    
    
       /*
     * Metodo chamado em todos os metodos dos controllers que devem ter controle de acesso pelo perfil
     * @param Integer $permissao
     */

    protected function accessTo($permissao) {
        $perfilPermBusiness = $this->Factory->createBusiness("Adm_perfil_permissao");
        $listaPermissoes = $perfilPermBusiness->listarByPerfil($this->session->userdata("cod_perfil"));

        foreach ($listaPermissoes as $objPerfilPerm) {
            if ($objPerfilPerm->getCod_perm() == $permissao) {
                return TRUE;
            }
        }
        $this->load->helper("url");
        redirect("home/restrito");
        
        /*
         * Foi tirado o controle pela sessao, Estava dando problema de memoria
         */
//        if (!($this->session->userdata("perm_" . $permissao) == $permissao)) {
//            $this->load->helper("url");
//            redirect("home/restrito");
//        }
    }

    protected function loadPage($content = NULL) {

        $this->load->helper("url");

        $info = array(
            //"header" => $this->load->view("base/header", "", TRUE),
            "menu" => $this->load->view("base/menu", "", TRUE),
            "content" => $content,
            "footer" => $this->load->view("base/footer", "", TRUE)
        );

        //se for a tela de login a ser exibida, nao mostra menu
        if ($this->isLoginView()) {
            $info["menu"] = "";
        }
        
               
        

        $this->load->view("base/container", $info);
    }

    protected function loadMenu($console = NULL) {

        $this->load->helper("url");

        $info = array(
            "menuP" => $this->load->view("menu/menuP", "", TRUE),
            "console" => $console,
            "footer" => $this->load->view("base/footer", "", TRUE)
        );

        $this->load->view("menu/container", $info);
    }

    protected function loadError($ex) {
        $dados["ex"] = $ex;
        $content = $this->load->view("base/error", $dados, TRUE);
        $this->loadPage($content);
    }

    protected function loadLibrary($library) {
        $this->load->library($library);

        switch ($library) {
            case "form_validation":
                $this->form_validation->set_error_delimiters('<div class="alert">', '</div>');
                break;

            default:
                break;
        }
    }

}

?>
