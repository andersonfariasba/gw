<?php
/* Classe Pojo (VO): Usuários
 * Autor: Anderson Farias
 * Última atualização: 25/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Acesso_usuariosPojo extends CI_Model {

    private $id_usuario;
    private $id_perfil;
    private $id_colaborador;
    private $login;
    private $senha;
    private $email;
    private $status;
    private $data_cadastro;
    private $deletado = false;
   
    private $perfil; //obj perfil
    private $colaborador; //obj colaborador
   
   
    //status
    private static $ATIVO = "<span class='btn btn-success btn-small buttom_width'>ATIVO</span>";
    private static $BLOQUEADO = "<span class='btn btn-warning btn-small buttom_width'>BLOQUEADO</span>";
    
     
    
    public function populate($dados){
        if(isset($dados["id_usuario"]))
            $this->id_usuario = $dados["id_usuario"];

        if(isset($dados["id_perfil"]))
            $this->id_perfil = $dados["id_perfil"];

         if(isset($dados["id_colaborador"]))
            $this->id_colaborador = $dados["id_colaborador"];
			
        if(isset($dados["login"]))
            $this->login = $dados["login"];
	
        if(isset($dados["senha"]))
            $this->senha = $dados["senha"];
	
        if(isset($dados["email"]))
            $this->email = $dados["email"];
        
	if(isset($dados["status"]))
            $this->status = $dados["status"];
	
        if(isset($dados["data_cadastro"]))
            $this->data_cadastro = $dados["data_cadastro"];
	        
	if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
	}
	
	
	public function getId_usuario() {
            return $this->id_usuario;
        }

        public function getId_perfil() {
            return $this->id_perfil;
        }

         public function getId_colaborador() {
            return $this->id_colaborador;
        }

        public function getLogin() {
            return $this->login;
        }

        public function getSenha() {
            return $this->senha;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getStatus() {
            return $this->status;
        }

        public function getData_cadastro() {
            return $this->data_cadastro;
        }

        public function getDeletado() {
            return $this->deletado;
        }

        public function getPerfil() {
            return $this->perfil;
        }

          public function getColaborador() {
            return $this->colaborador;
        }

        public function setId_usuario($id_usuario) {
            $this->id_usuario = $id_usuario;
        }

        public function setId_perfil($id_perfil){
            $this->id_perfil = $id_perfil;
        }

        public function setId_colaborador($id_colaborador){
            $this->id_colaborador = $id_colaborador;
        }

        public function setLogin($login) {
            $this->login = $login;
        }

        public function setSenha($senha) {
            $this->senha = $senha;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function setStatus($status) {
            $this->status = $status;
        }

        public function setData_cadastro($data_cadastro) {
            $this->data_cadastro = $data_cadastro;
        }

        public function setDeletado($deletado) {
            $this->deletado = $deletado;
        }

        public function setPerfil($perfil) {
            $this->perfil = $perfil;
        }

          public function setColaborador($colaborador) {
            $this->colaborador = $colaborador;
        }
        
        public function perfilIs($perfil){
           return $this->id_perfil == $perfil;
        }
        
       public function statusIs($status){
        return $this->status == $status;
       }

       public function colaboradorIs($colaborador){
        return $this->id_colaborador == $colaborador;
       }
        
        public function printStatus() {
        switch ($this->status) {
            case ATIVO:
                    echo acesso_usuariosPojo::$ATIVO;
                break;

            case BLOQUEADO:
                    echo acesso_usuariosPojo::$BLOQUEADO;
                break;
            
            default:
         
            break;
        }
    }
    
        
        
        public function toArray(){
            $inArray = array();
            foreach(get_object_vars($this) as $attribute => $value){
                if(is_float($this->$attribute)){
                    $inArray[$attribute] = number_format($this->$attribute,4,".","");
                }
                else
                {
                    $inArray[$attribute] = $this->$attribute;
                }
            }

            unset($inArray["perfil"]);
            unset($inArray["colaborador"]);
            return $inArray;
        }


 }
?>
