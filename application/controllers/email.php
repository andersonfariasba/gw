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
class Email extends MY_Controller {

   

    public function recuperar(){
        
        $this->load->helper(array('form', 'url'));
          
         $dados = $this->input->post();
         
         $userBusiness = $this->Factory->createBusiness("acesso_usuarios");
         $objUser = $userBusiness->visualizar_por_email($dados['email']);
         $info["objUser"] = $objUser;

          $info['email_erro'] = false;


          if($objUser!=null){
           $info['flag_email'] = true;
           $this->load->view("login", $info);
          }
          else{
              
              $info['email_erro'] = true;
              $info['flag_email'] = null;
            
             $this->load->view("email_rec", $info);

                          
          }

         //print_r($objUser);

        
    }

     public function email_rec(){
         $this->load->helper(array('form', 'url'));
         $info ="";
          $this->load->view("email_rec", $info);


     }

   
}

?>
