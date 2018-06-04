<?php
/* Classe Pojo (VO): Colaboradores
 * Autor: Anderson Farias
 * Última atualização: 26/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Rh_colaboradoresPojo extends CI_Model {

    private $id_colaborador;
    private $id_cargo;
    private $id_departamento;
    private $nome;
    private $data_nascimento;
    private $endereco;
    private $bairro;
    private $cep;
    private $cidade;
    private $uf;
    private $telefone;
    private $celular1;
    private $celular2;
    private $emergencia;
    private $email;
    private $rg;
    private $uf_exp;
    private $data_exp;
    private $cpf;
    private $reservista;
    private $pis;
    private $data_cadastro_pis;
    private $titulo;
    private $zona;
    private $secao;
    private $habilitacao;
    private $categoria_hab;
    private $validade_hab;
    private $banco;
    private $agencia;
    private $conta;
    private $observacao;
    private $comissao_venda;

    private $status;
    private $deletado = false;
    
    private $cargo; //obj cargo
    private $departamento;
   
    //status
    private static $ATIVO = "<span class='btn btn-success btn-small buttom_width'>ATIVO</span>";
    private static $BLOQUEADO = "<span class='btn btn-warning btn-small buttom_width'>BLOQUEADO</span>";
    
    
    
    
    public function populate($dados){
        if(isset($dados["id_colaborador"]))
            $this->id_colaborador = $dados["id_colaborador"];

        if(isset($dados["id_cargo"]))
            $this->id_cargo = $dados["id_cargo"];

         if(isset($dados["id_departamento"]))
            $this->id_departamento = $dados["id_departamento"];

        if(isset($dados["nome"]))
            $this->nome = $dados["nome"];

        if(isset($dados["data_nascimento"]))
            $this->data_nascimento = $dados["data_nascimento"];

        if(isset($dados["endereco"]))
            $this->endereco = $dados["endereco"];

        if(isset($dados["bairro"]))
            $this->bairro = $dados["bairro"];

        if(isset($dados["cep"]))
            $this->cep = $dados["cep"];

        if(isset($dados["cidade"]))
            $this->cidade = $dados["cidade"];

        if(isset($dados["uf"]))
            $this->uf = $dados["uf"];

        if(isset($dados["telefone"]))
            $this->telefone = $dados["telefone"];

        if(isset($dados["celular1"]))
            $this->celular1 = $dados["celular1"];

        if(isset($dados["celular2"]))
            $this->celular2 = $dados["celular2"];

        if(isset($dados["emergencia"]))
            $this->emergencia = $dados["emergencia"];

        if(isset($dados["email"]))
            $this->email = $dados["email"];

        if(isset($dados["rg"]))
            $this->rg = $dados["rg"];

        if(isset($dados["uf_exp"]))
            $this->uf_exp = $dados["uf_exp"];

        if(isset($dados["data_exp"]))
            $this->data_exp = $dados["data_exp"];

        if(isset($dados["cpf"]))
            $this->cpf = $dados["cpf"];

        if(isset($dados["reservista"]))
            $this->reservista = $dados["reservista"];

        if(isset($dados["pis"]))
            $this->pis = $dados["pis"];

        if(isset($dados["data_cadastro_pis"]))
            $this->data_cadastro_pis = $dados["data_cadastro_pis"];

        if(isset($dados["titulo"]))
            $this->titulo = $dados["titulo"];

        if(isset($dados["zona"]))
            $this->zona = $dados["zona"];

        if(isset($dados["secao"]))
            $this->secao = $dados["secao"];

        if(isset($dados["habilitacao"]))
            $this->habilitacao = $dados["habilitacao"];

        if(isset($dados["categoria_hab"]))
            $this->categoria_hab = $dados["categoria_hab"];

        if(isset($dados["validade_hab"]))
            $this->validade_hab = $dados["validade_hab"];

        if(isset($dados["banco"]))
            $this->banco = $dados["banco"];

        if(isset($dados["agencia"]))
            $this->agencia = $dados["agencia"];

        if(isset($dados["conta"]))
            $this->conta = $dados["conta"];

        if(isset($dados["observacao"]))
            $this->observacao = $dados["observacao"];

        if(isset($dados["status"]))
            $this->status = $dados["status"];

         if(isset($dados["comissao_venda"]))
            $this->comissao_venda = $dados["comissao_venda"];

        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];
	}
	
	
	
       public function getId_colaborador(){
        return $this->id_colaborador;
    }

    public function setId_colaborador($id_colaborador){
        $this->id_colaborador = $id_colaborador;
    }

    public function getId_cargo(){
        return $this->id_cargo;
    }

    public function getId_departamento(){
        return $this->id_departamento;
    }

    public function setId_departamento($id_departamento){
        $this->id_departamento = $id_departamento;
    }

    public function setId_cargo($id_cargo){
        $this->id_cargo = $id_cargo;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getData_nascimento(){
        return $this->data_nascimento;
    }

    public function setData_nascimento($data_nascimento){
        $this->data_nascimento = $data_nascimento;
    }

    public function getEndereco(){
        return $this->endereco;
    }

    public function setEndereco($endereco){
        $this->endereco = $endereco;
    }

    public function getBairro(){
        return $this->bairro;
    }

    public function setBairro($bairro){
        $this->bairro = $bairro;
    }

    public function getCep(){
        return $this->cep;
    }

    public function setCep($cep){
        $this->cep = $cep;
    }

    public function getCidade(){
        return $this->cidade;
    }

    public function setCidade($cidade){
        $this->cidade = $cidade;
    }



    public function getUf(){
        return $this->uf;
    }

    public function setUf($uf){
        $this->uf = $uf;
    }

    public function getTelefone(){
        return $this->telefone;
    }

    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }

    public function getCelular1(){
        return $this->celular1;
    }

    public function setCelular1($celular1){
        $this->celular1 = $celular1;
    }

    public function getCelular2(){
        return $this->celular2;
    }

    public function setCelular2($celular2){
        $this->celular2 = $celular2;
    }

    public function getEmergencia(){
        return $this->emergencia;
    }

    public function setEmergencia($emergencia){
        $this->emergencia = $emergencia;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getRg(){
        return $this->rg;
    }

    public function setRg($rg){
        $this->rg = $rg;
    }

    public function getUf_exp(){
        return $this->uf_exp;
    }

    public function setUf_exp($uf_exp){
        $this->uf_exp = $uf_exp;
    }

    public function getData_exp(){
        return $this->data_exp;
    }

    public function setData_exp($data_exp){
        $this->data_exp = $data_exp;
    }

    public function getCpf(){
        return $this->cpf;
    }

    public function setCpf($cpf){
        $this->cpf = $cpf;
    }

    public function getReservista(){
        return $this->reservista;
    }

    public function setReservista($reservista){
        $this->reservista = $reservista;
    }

    public function getPis(){
        return $this->pis;
    }

    public function setPis($pis){
        $this->pis = $pis;
    }

    public function getData_cadastro_pis(){
        return $this->data_cadastro_pis;
    }

    public function setData_cadastro_pis($data_cadastro_pis){
        $this->data_cadastro_pis = $data_cadastro_pis;
    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }

    public function getZona(){
        return $this->zona;
    }

    public function setZona($zona){
        $this->zona = $zona;
    }

    public function getSecao(){
        return $this->secao;
    }

    public function setSecao($secao){
        $this->secao = $secao;
    }

    public function getHabilitacao(){
        return $this->habilitacao;
    }

    public function setHabilitacao($habilitacao){
        $this->habilitacao = $habilitacao;
    }

    public function getCategoria_hab(){
        return $this->categoria_hab;
    }

    public function setCategoria_hab($categoria_hab){
        $this->categoria_hab = $categoria_hab;
    }

    public function getValidade_hab(){
        return $this->validade_hab;
    }

    public function setValidade_hab($validade_hab){
        $this->validade_hab = $validade_hab;
    }

    public function getBanco(){
        return $this->banco;
    }

    public function setBanco($banco){
        $this->banco = $banco;
    }

    public function getAgencia(){
        return $this->agencia;
    }

    public function setAgencia($agencia){
        $this->agencia = $agencia;
    }

    public function getConta(){
        return $this->conta;
    }

    public function setConta($conta){
        $this->conta = $conta;
    }

    public function getObservacao(){
        return $this->observacao;
    }

    public function setObservacao($observacao){
        $this->observacao = $observacao;
    }


     public function getComissao_venda(){
        return $this->comissao_venda;
    }

    public function setComissao_venda($comissao_venda){
        $this->comissao_venda = $comissao_venda;
    }


    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function getDeletado(){
        return $this->deletado;
    }

    public function setDeletado($deletado){
        $this->deletado = $deletado;
    }

    public function getCargo(){
        return $this->cargo;
    }

    public function setCargo($cargo){
        $this->cargo = $cargo;
    }


    public function getDepartamento(){
        return $this->departamento;
    }

    public function setDepartamento($departamento){
        $this->departamento = $departamento;
    }
                
        
    public function cargoIs($cargo){
       return $this->id_cargo == $cargo;
    }

    public function departamentoIs($departamento){
       return $this->id_departamento == $departamento;
    }
    
   public function statusIs($status){
    return $this->status == $status;
   }
    
    public function printStatus() {
    switch ($this->status) {
        case ATIVO:
                echo rh_colaboradoresPojo::$ATIVO;
            break;

        case BLOQUEADO:
                echo rh_colaboradoresPojo::$BLOQUEADO;
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

            unset($inArray["cargo"]);
            unset($inArray["departamento"]);
            return $inArray;
        }


 }
?>
