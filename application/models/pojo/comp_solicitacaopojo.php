<?php
/* Classe Pojo (VO): Categorias
 * Autor: Anderson Farias
 * Última atualização: 28/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Comp_solicitacaoPojo extends CI_Model {

    private $id_solicitacao;
    private $id_status;
    private $id_status_cotacao;
    private $id_solicitante;
    private $id_aprovador;
    private $id_aprovador_cotacao;
    private $data_criacao;
    private $data_necessidade;
    private $data_aprovacao;
    private $data_aprovacao_cotacao;
    private $tipo_entrada;
    private $observacao;
    private $observacao_cotacao;
    private $observacao_diretoria;
    private $observacao_controladoria;
    
    private $deletado = false;

    //novos campos
    private $codigo_pc;

    private $id_status_controladoria;
    private $id_aprovador_controladoria;
    private $data_aprovacao_controladoria;

    private $id_status_diretoria;
    private $id_aprovador_diretoria;
    private $data_aprovacao_diretoria;




    private $colaborador; //obj colaborador
    private $aprovador;
    private $aprovador_cotacao;
    private $aprovadorControladoria;
    private $aprovadorDiretoria;
    private $objStatus; //status;
    private $objStatusCotacao; //status;
    
    private $objStatusControladoria; //Status Controladoria
    private $objStatusDiretoria; //Status Controladoria


       
    public function populate($dados){
   
        if(isset($dados["id_solicitacao"]))
            $this->id_solicitacao = $dados["id_solicitacao"];

        if(isset($dados["id_status"]))
            $this->id_status = $dados["id_status"];

         if(isset($dados["id_status_cotacao"]))
            $this->id_status_cotacao = $dados["id_status_cotacao"];


        if(isset($dados["id_solicitante"]))
            $this->id_solicitante = $dados["id_solicitante"];
        
        if(isset($dados["id_aprovador"]))
            $this->id_aprovador = $dados["id_aprovador"];

        if(isset($dados["id_aprovador_cotacao"]))
            $this->id_aprovador_cotacao = $dados["id_aprovador_cotacao"];
	   

       if(isset($dados["data_criacao"]))
            $this->data_criacao = $dados["data_criacao"];
       

       if(isset($dados["data_necessidade"]))
            $this->data_necessidade = $dados["data_necessidade"];

        
        if(isset($dados["data_aprovacao"]))
            $this->data_aprovacao = $dados["data_aprovacao"];

        if(isset($dados["data_aprovacao_cotacao"]))
            $this->data_aprovacao_cotacao = $dados["data_aprovacao_cotacao"];
       

       if(isset($dados["tipo_entrada"]))
            $this->tipo_entrada = $dados["tipo_entrada"];
                   

       if(isset($dados["observacao"]))
            $this->observacao = $dados["observacao"];

         if(isset($dados["observacao_cotacao"]))
            $this->observacao_cotacao = $dados["observacao_cotacao"];

         if(isset($dados["observacao_controladoria"]))
            $this->observacao_controladoria = $dados["observacao_controladoria"];

         if(isset($dados["observacao_diretoria"]))
            $this->observacao_diretoria = $dados["observacao_diretoria"];

        
        if(isset($dados["codigo_pc"]))
            $this->codigo_pc = $dados["codigo_pc"];

         if(isset($dados["id_status_controladoria"]))
            $this->id_status_controladoria = $dados["id_status_controladoria"];

         if(isset($dados["id_aprovador_controladoria"]))
            $this->id_aprovador_controladoria = $dados["id_aprovador_controladoria"];

         if(isset($dados["data_aprovacao_controladoria"]))
            $this->data_aprovacao_controladoria = $dados["data_aprovacao_controladoria"];

        
         if(isset($dados["id_status_diretoria"]))
            $this->id_status_diretoria = $dados["id_status_diretoria"];

         if(isset($dados["id_aprovador_diretoria"]))
            $this->id_aprovador_diretoria = $dados["id_aprovador_diretoria"];

         if(isset($dados["data_aprovacao_diretoria"]))
            $this->data_aprovacao_diretoria = $dados["data_aprovacao_diretoria"];

       

       if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
       
    }
        
    
    public function getId_solicitacao(){
        return $this->id_solicitacao;
    }

    public function setId_solicitacao($id_solicitacao){
        $this->id_solicitacao = $id_solicitacao;
    }

    public function getId_status(){
        return $this->id_status;
    }

    public function setId_status($id_status){
        $this->id_status = $id_status;
    }

    public function getId_solicitante(){
        return $this->id_solicitante;
    }

    public function setId_solicitante($id_solicitante){
        $this->id_solicitante = $id_solicitante;
    }

    public function getId_aprovador(){
        return $this->id_aprovador;
    }

    public function setId_aprovador($id_aprovador){
        $this->id_aprovador = $id_aprovador;
    }

    public function getData_criacao(){
        return $this->data_criacao;
    }

    public function setData_criacao($data_criacao){
        $this->data_criacao = $data_criacao;
    }

    public function getData_necessidade(){
        return $this->data_necessidade;
    }

    public function setData_necessidade($data_necessidade){
        $this->data_necessidade = $data_necessidade;
    }

    public function getData_aprovacao(){
        return $this->data_aprovacao;
    }

    public function setData_aprovacao($data_necessidade){
        $this->data_necessidade = $data_necessidade;
    }

    public function getTipo_entrada(){
        return $this->tipo_entrada;
    }

    public function setTipo_entrada($tipo_entrada){
        $this->tipo_entrada = $tipo_entrada;
    }

   
    public function getObservacao(){
        return $this->observacao;
    }

    public function setObservacao($observacao){
        $this->observacao = $observacao;
    }

    public function getDeletado(){
        return $this->deletado;
    }

    public function setDeletado($deletado){
        $this->deletado = $deletado;
    }

    public function getColaborador() {
            return $this->colaborador;
    }

    public function setColaborador($colaborador) {
            $this->colaborador = $colaborador;
    }

    public function getAprovador() {
            return $this->aprovador;
    }

    public function setAprovador($aprovador) {
            $this->aprovador = $aprovador;
    }

    public function getId_aprovador_cotacao(){
        return $this->id_aprovador_cotacao;
    }

    public function setId_aprovador_cotacao($id_aprovador_cotacao){
        $this->id_aprovador_cotacao = $id_aprovador_cotacao;
    }

    public function getData_aprovacao_cotacao(){
        return $this->data_aprovacao_cotacao;
    }

    public function setData_aprovacao_cotacao($data_aprovacao_cotacao){
        $this->data_aprovacao_cotacao = $data_aprovacao_cotacao;
    }

    public function getAprovador_cotacao(){
        return $this->aprovador_cotacao;
    }

    public function setAprovador_cotacao($aprovador_cotacao){
        $this->aprovador_cotacao = $aprovador_cotacao;
    }

    public function getAprovadorControladoria(){
        return $this->aprovadorControladoria;
    }

    public function setAprovadorControladoria($aprovadorControladoria){
        $this->aprovadorControladoria = $aprovadorControladoria;
    }

    public function getAprovadorDiretoria(){
        return $this->aprovadorDiretoria;
    }

    public function setAprovadorDiretoria($aprovadorDiretoria){
        $this->aprovadorDiretoria = $aprovadorDiretoria;
    }

    public function getObjStatus(){
        return $this->objStatus;
    }

    public function setObjStatus($objStatus){
        $this->objStatus = $objStatus;
    }

    public function getId_status_cotacao(){
        return $this->id_status_cotacao;
    }

    public function setId_status_cotacao($id_status_cotacao){
        $this->id_status_cotacao = $id_status_cotacao;
    }

        public function getId_status_controladoria(){
        return $this->id_status_controladoria;
    }

    public function setId_status_controladoria($id_status_controladoria){
        $this->id_status_controladoria = $id_status_controladoria;
    }

    public function getId_aprovador_controladoria(){
        return $this->id_aprovador_controladoria;
    }

    public function setId_aprovador_controladoria($id_aprovador_controladoria){
        $this->id_aprovador_controladoria = $id_aprovador_controladoria;
    }

    public function getData_aprovacao_controladoria(){
        return $this->data_aprovacao_controladoria;
    }

    public function setData_aprovacao_controladoria($data_aprovacao_controladoria){
        $this->data_aprovacao_controladoria = $data_aprovacao_controladoria;
    }

    public function getId_status_diretoria(){
        return $this->id_status_diretoria;
    }

    public function setId_status_diretoria($id_status_diretoria){
        $this->id_status_diretoria = $id_status_diretoria;
    }

    public function getId_aprovador_diretoria(){
        return $this->id_aprovador_diretoria;
    }

    public function setId_aprovador_diretoria($id_aprovador_diretoria){
        $this->id_aprovador_diretoria = $id_aprovador_diretoria;
    }

    public function getData_aprovacao_diretoria(){
        return $this->data_aprovacao_diretoria;
    }

    public function setData_aprovacao_diretoria($data_aprovacao_diretoria){
        $this->data_aprovacao_diretoria = $data_aprovacao_diretoria;
    }

    public function getObservacao_cotacao(){
        return $this->observacao_cotacao;
    }

    public function setObservacao_cotacao($observacao_cotacao){
        $this->observacao_cotacao = $observacao_cotacao;
    }

    public function getObservacao_diretoria(){
        return $this->observacao_diretoria;
    }

    public function setObservacao_diretoria($observacao_diretoria){
        $this->observacao_diretoria = $observacao_diretoria;
    }

    public function getObservacao_controladoria(){
        return $this->observacao_controladoria;
    }

    public function setObservacao_controladoria($observacao_controladoria){
        $this->observacao_controladoria = $observacao_controladoria;
    }

    public function getObjStatusCotacao(){
        return $this->objStatusCotacao;
    }

    public function setObjStatusCotacao($objStatusCotacao){
        $this->objStatusCotacao = $objStatusCotacao;
    }

    public function getObjStatusControladoria(){
        return $this->objStatusControladoria;
    }

    public function setObjStatusControladoria($objStatusControladoria){
        $this->objStatusControladoria = $objStatusControladoria;
    }

    public function getObjStatusDiretoria(){
        return $this->objStatusDiretoria;
    }

    public function setObjStatusDiretoria($objStatusDiretoria){
        $this->objStatusDiretoria = $objStatusDiretoria;
    }

     public function statusIs($objStatus){
           return $this->id_status == $objStatus;
    }

    public function statusCotacaoIs($objStatusCotacao){
           return $this->id_status_cotacao == $objStatusCotacao;
    }

    public function statusControladoriaIs($objStatusControladoria){
           return $this->id_status_controladoria == $objStatusControladoria;
    }

     public function statusDiretoriaIs($objStatusDiretoria){
           return $this->id_status_diretoria == $objStatusDiretoria;
    }


    public function aprovadorIs($aprovador){
           return $this->id_aprovador == $aprovador;
    }

    public function aprovadorCotacaoIs($aprovador_cotacao){
           return $this->id_aprovador_cotacao == $aprovador_cotacao;
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

                unset($inArray["aprovador"]);
                unset($inArray["aprovador_cotacao"]);
                unset($inArray["aprovadorControladoria"]);
                unset($inArray["aprovadorDiretoria"]);
                unset($inArray["colaborador"]);
                unset($inArray['objStatus']);
                unset($inArray['objStatusCotacao']);
                unset($inArray['objStatusControladoria']);
                unset($inArray['objStatusDiretoria']);

            return $inArray;
        }


 }
?>
