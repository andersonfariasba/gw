<?php
/* Classe Pojo (VO): Bandeira de Cartões
 * Autor: Anderson Farias
 * Última atualização: 15/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Fin_bandeira_cartaoPojo extends CI_Model {

    private $id_bandeira;
    private $id_forma;
    private $id_operadora;
    private $bandeira;
    private $taxa;
    private $max_parcela;
    private $antecipacao_pagamento;
    private $status;
    private $deletado = false;
    
    private $forma;
    private $operadora;
    

    //status
    private static $ATIVO = "<span class='btn btn-success btn-small buttom_width'>ATIVO</span>";
    private static $BLOQUEADO = "<span class='btn btn-warning btn-small buttom_width'>BLOQUEADO</span>";
    
    
        
    public function populate($dados){
        if(isset($dados["id_bandeira"]))
            $this->id_bandeira = $dados["id_bandeira"];

        if(isset($dados["id_forma"]))
            $this->id_forma = $dados["id_forma"];

        if(isset($dados["id_operadora"]))
            $this->id_operadora = $dados["id_operadora"];
        
        if(isset($dados["bandeira"]))
            $this->bandeira = $dados["bandeira"];
                
       if(isset($dados["taxa"]))
            $this->taxa = $dados["taxa"];
        
        if(isset($dados["max_parcela"]))
            $this->max_parcela = $dados["max_parcela"];
        
        if(isset($dados["status"]))
            $this->status = $dados["status"];

        if(isset($dados["antecipacao_pagamento"]))
            $this->antecipacao_pagamento = $dados["antecipacao_pagamento"];
        
        
        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
	}
        
        
        
        public function getId_bandeira() {
            return $this->id_bandeira;
        }

        public function getId_forma() {
            return $this->id_forma;
        }


        public function getId_operadora() {
            return $this->id_operadora;
        }

        public function getBandeira() {
            return $this->bandeira;
        }

        public function getTaxa() {
            return $this->taxa;
        }

        public function getMax_parcela() {
            return $this->max_parcela;
        }

        public function getAntecipacao_pagamento() {
            return $this->antecipacao_pagamento;
        }


        public function getDeletado() {
            return $this->deletado;
        }

        public function setAntecipacao_pagamento($antecipacao_pagamento) {
            $this->antecipacao_pagamento = $antecipacao_pagamento;
        }

        public function setId_bandeira($id_bandeira) {
            $this->id_bandeira = $id_bandeira;
        }

        public function setId_forma($id_forma) {
            $this->id_forma = $id_forma;
        }

        public function setId_operadora($id_operadora) {
            $this->id_operadora = $id_operadora;
        }

        public function setBandeira($bandeira) {
            $this->bandeira = $bandeira;
        }

        public function setTaxa($taxa) {
            $this->taxa = $taxa;
        }

        public function setMax_parcela($max_parcela) {
            $this->max_parcela = $max_parcela;
        }

        public function setDeletado($deletado) {
            $this->deletado = $deletado;
        }
        
        public function getStatus() {
            return $this->status;
        }

        public function setStatus($status) {
            $this->status = $status;
        }
        
        public function getForma() {
            return $this->forma;
        }

        public function setForma($forma) {
            $this->forma = $forma;
        }


        public function getOperadora() {
            return $this->operadora;
        }

        public function setOperadora($operadora) {
            $this->operadora = $operadora;
        }
        
       public function statusIs($status){
        return $this->status == $status;
       }
       
       public function formaIs($forma){
           return $this->id_forma == $forma;
       }

       public function OperadoraIs($operadora){
           return $this->id_operadora == $operadora;
       }


        
        public function printStatus() {
        switch ($this->status) {
            case ATIVO:
                    echo fin_bandeira_cartaoPojo::$ATIVO;
                break;

            case BLOQUEADO:
                    echo fin_bandeira_cartaoPojo::$BLOQUEADO;
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
            unset($inArray["forma"]);
             unset($inArray["operadora"]);  
            return $inArray;
        }


 }
?>
