<?php
/* Classe Pojo (VO): Formas de Pagamentos
 * Autor: Anderson Farias
 * Última atualização: 03/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Fin_formas_pagamentosPojo extends CI_Model {

    private $id_forma;
    private $forma;
    private $cartao; //se é um cartão
    private $status;
    private $cpAntecipado = NAO; 
    private $deletado = false;
    
   
    //status
    private static $ATIVO = "<span class='btn btn-success btn-small buttom_width'>ATIVO</span>";
    private static $BLOQUEADO = "<span class='btn btn-warning btn-small buttom_width'>BLOQUEADO</span>";
    
    
    
 
    
    public function populate($dados){
        if(isset($dados["id_forma"]))
            $this->id_forma = $dados["id_forma"];

        if(isset($dados["forma"]))
            $this->forma = $dados["forma"];
        
         
        if(isset($dados["cartao"]))
            $this->cartao = $dados["cartao"];
      
        if(isset($dados["status"]))
            $this->status = $dados["status"];
        
        if(isset($dados["cpAntecipado"]))
            $this->cpAntecipado = $dados["cpAntecipado"];
                   
      
        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
	}
        
        
        public function getId_forma() {
            return $this->id_forma;
        }

        public function getForma() {
            return $this->forma;
        }

        public function getStatus() {
            return $this->status;
        }

         public function getCpAntecipado() {
            return $this->cpAntecipado;
        }

       

        public function getDeletado() {
            return $this->deletado;
        }

        public function setId_forma($id_forma) {
            $this->id_forma = $id_forma;
        }

        public function setForma($forma) {
            $this->forma = $forma;
        }

        public function setStatus($status) {
            $this->status = $status;
        }

          public function setCpAntecipado($cpAntecipado) {
            $this->cpAntecipado = $cpAntecipado;
        }

       
        
               
        public function getCartao() {
            return $this->cartao;
        }

        public function setCartao($cartao) {
            $this->cartao = $cartao;
        }

        
        
        public function setDeletado($deletado) {
            $this->deletado = $deletado;
        }
        
        
       public function statusIs($status){
        return $this->status == $status;
       }
        
        public function printStatus() {
        switch ($this->status) {
            case ATIVO:
                    echo fin_formas_pagamentosPojo::$ATIVO;
                break;

            case BLOQUEADO:
                    echo fin_formas_pagamentosPojo::$BLOQUEADO;
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

            return $inArray;
        }


 }
?>
