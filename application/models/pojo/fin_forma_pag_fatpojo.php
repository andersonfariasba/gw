<?php
/* Classe Pojo (VO): Formas de Pagamentos
 * Autor: Anderson Farias
 * Última atualização: 03/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Fin_forma_pag_fatPojo extends CI_Model {

    private $id_forma_fat;
    private $id_pedido;
    private $id_forma; //ambos, contas a pagar e contas a receber
    private $id_bandeira; //se é um cartão
    private $id_usuario;
    private $valor;
    private $parcela;
    private $data;
    private $parcelado;
    private $antecipado;
    private $status;
       
    //status
    private static $ATIVO = "<span class='btn btn-success btn-small buttom_width'>ATIVO</span>";
    private static $BLOQUEADO = "<span class='btn btn-warning btn-small buttom_width'>BLOQUEADO</span>";
    
    public function populate($dados){
        
        if(isset($dados["id_forma_fat"]))
            $this->id_forma_fat = $dados["id_forma_fat"];

        if(isset($dados["id_pedido"]))
            $this->id_pedido = $dados["id_pedido"];
        
        
        if(isset($dados["id_forma"]))
            $this->id_forma = $dados["id_forma"];
      
        if(isset($dados["id_bandeira"]))
            $this->id_bandeira = $dados["id_bandeira"];
      
        if(isset($dados["id_usuario"]))
            $this->id_usuario = $dados["id_usuario"];
       
        if(isset($dados["valor"]))
            $this->valor = $dados["valor"];

        if(isset($dados["parcela"]))
            $this->parcela = $dados["parcela"];
      
       if(isset($dados["data"]))
            $this->data = $dados["data"];

       if(isset($dados["antecipado"]))
            $this->antecipado = $dados["antecipado"];

        if(isset($dados["parcelado"]))
            $this->parcelado = $dados["parcelado"];
      
            
       
        if(isset($dados["status"]))
            $this->status = $dados["status"];
                
    
	}
        
        
        public function getId_forma_fat(){
        return $this->id_forma_fat;
    }

    public function setId_forma_fat($id_forma_fat){
        $this->id_forma_fat = $id_forma_fat;
    }

    public function getId_pedido(){
        return $this->id_pedido;
    }

    public function setId_pedido($id_pedido){
        $this->id_pedido = $id_pedido;
    }

    public function getId_forma(){
        return $this->id_forma;
    }

    public function setId_forma($id_forma){
        $this->id_forma = $id_forma;
    }

    public function getId_bandeira(){
        return $this->id_bandeira;
    }

    public function setId_bandeira($id_bandeira){
        $this->id_bandeira = $id_bandeira;
    }

    public function getId_usuario(){
        return $this->id_usuario;
    }

    public function setId_usuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }

    public function getValor(){
        return $this->valor;
    }

    public function setValor($valor){
        $this->valor = $valor;
    }

    public function getParcela(){
        return $this->parcela;
    }

    public function setParcela($parcela){
        $this->parcela = $parcela;
    }

    public function getParcelado(){
        return $this->parcelado;
    }

    public function setParcelado($parcelado){
        $this->parcelado = $parcelado;
    }

    public function getAntecipado(){
        return $this->antecipado;
    }

    public function setAntecipado($antecipado){
        $this->antecipado = $antecipado;
    }

    public function getData(){
        return $this->data;
    }

    public function setData($data){
        $this->data = $data;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }
        
        
       public function statusIs($status){
        return $this->status == $status;
       }
        
    public function printStatus() {
        switch ($this->status) {
            case ATIVO:
                    echo fin_forma_pag_fatPojo::$ATIVO;
                break;

            case BLOQUEADO:
                    echo fin_forma_pag_fatPojo::$BLOQUEADO;
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
