<?php
/* Classe Pojo (VO): Fornecedores
 * Autor: Anderson Farias
 * Última atualização: 29/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */
class Com_fornecedoresPojo extends CI_Model {

    private $id_fornecedor;
    private $tipo;
    private $nome_fantasia;
    private $razao_social;
    private $cnpj_cpf;
    private $insc_estadual;
    private $insc_municipal;
    private $endereco;
    private $bairro;
    private $cep;
    private $cidade;
    private $estado;
    private $id_estado;
    private $id_cidade;
    private $site;
    private $email;
    private $telefone1;
    private $contato1;
    private $telefone2;
    private $contato2;
    private $celular;
    private $observacao;
    private $data_cadastro;
    private $status;

       //DADOS DE CONTATOS
    private $responsavel;
    private $setor_resp;
    private $telefone_resp;
    private $email_resp;

    private $responsavel2;
    private $setor_resp2;
    private $telefone_resp2;
    private $email_resp2;


    private $responsavel3;
    private $setor_resp3;
    private $telefone_resp3;
    private $email_resp3;
    
    private $deletado = false;

    private $estadoObj;
    private $cidadeObj;
    
   
     //status
    private static $ATIVO = "<span class='btn btn-success btn-small buttom_width'>ATIVO</span>";
    private static $BLOQUEADO = "<span class='btn btn-warning btn-small buttom_width'>BLOQUEADO</span>";
    
    
    
    public function populate($dados){
        if(isset($dados["id_fornecedor"]))
            $this->id_fornecedor = $dados["id_fornecedor"];

        if(isset($dados["tipo"]))
            $this->tipo = $dados["tipo"];
			
        if(isset($dados["nome_fantasia"]))
            $this->nome_fantasia = $dados["nome_fantasia"];

        if(isset($dados["razao_social"]))
            $this->razao_social = $dados["razao_social"];
    
	
        if(isset($dados["cnpj_cpf"]))
            $this->cnpj_cpf = $dados["cnpj_cpf"];
	
        if(isset($dados["insc_estadual"]))
            $this->insc_estadual = $dados["insc_estadual"];
	
        if(isset($dados["insc_municipal"]))
            $this->insc_municipal = $dados["insc_municipal"];
	
        
        if(isset($dados["endereco"]))
            $this->endereco = $dados["endereco"];
        
	if(isset($dados["bairro"]))
            $this->bairro = $dados["bairro"];
	
        if(isset($dados["bairro"]))
            $this->bairro = $dados["bairro"];
	        
        if(isset($dados["cep"]))
            $this->cep = $dados["cep"];
        
        if(isset($dados["cidade"]))
            $this->cidade = $dados["cidade"];
        
	if(isset($dados["estado"]))
            $this->estado = $dados["estado"];
      if(isset($dados["id_cidade"]))
            $this->id_cidade = $dados["id_cidade"];
        
         if(isset($dados["id_estado"]))
            $this->id_estado = $dados["id_estado"];
	
        if(isset($dados["site"]))
            $this->site = $dados["site"];
        
        if(isset($dados["email"]))
            $this->email = $dados["email"];
        
        if(isset($dados["telefone1"]))
            $this->telefone1 = $dados["telefone1"];
        
        if(isset($dados["contato1"]))
            $this->contato1 = $dados["contato1"];
	
	if(isset($dados["telefone2"]))
            $this->telefone2 = $dados["telefone2"];
        
        if(isset($dados["contato2"]))
            $this->contato2 = $dados["contato2"];
        
        if(isset($dados["celular"]))
            $this->celular = $dados["celular"];
               
         if(isset($dados["observacao"]))
            $this->observacao = $dados["observacao"];
	
	
        if(isset($dados["data_cadastro"]))
            $this->data_cadastro = $dados["data_cadastro"];
        
        if(isset($dados["status"]))
            $this->status = $dados["status"];
        
        if(isset($dados["deletado"]))
            $this->deletado = $dados["deletado"];

         if(isset($dados["responsavel"]))
            $this->responsavel = $dados["responsavel"];
        
        if(isset($dados["setor_resp"]))
            $this->setor_resp = $dados["setor_resp"];

        if(isset($dados["telefone_resp"]))
            $this->telefone_resp = $dados["telefone_resp"];

        if(isset($dados["email_resp"]))
            $this->email_resp = $dados["email_resp"];

        if(isset($dados["responsavel2"]))
            $this->responsavel2 = $dados["responsavel2"];
        
        if(isset($dados["setor_resp2"]))
            $this->setor_resp2 = $dados["setor_resp2"];

        if(isset($dados["telefone_resp2"]))
            $this->telefone_resp2 = $dados["telefone_resp2"];

        if(isset($dados["email_resp2"]))
            $this->email_resp2 = $dados["email_resp2"];

        if(isset($dados["responsavel3"]))
            $this->responsavel3 = $dados["responsavel3"];
        
        if(isset($dados["setor_resp3"]))
            $this->setor_resp3 = $dados["setor_resp3"];

        if(isset($dados["telefone_resp3"]))
            $this->telefone_resp3 = $dados["telefone_resp3"];

        if(isset($dados["email_resp3"]))
            $this->email_resp3 = $dados["email_resp3"];

	}
	
	
	
        public function getId_fornecedor() {
            return $this->id_fornecedor;
        }

        public function getTipo() {
            return $this->tipo;
        }

        public function getNome_fantasia() {
            return $this->nome_fantasia;
        }

         public function getRazao_social() {
            return $this->razao_social;
        }


        public function getCnpj_cpf() {
            return $this->cnpj_cpf;
        }

        public function getEndereco() {
            return $this->endereco;
        }

        public function getBairro() {
            return $this->bairro;
        }

        public function getCep() {
            return $this->cep;
        }

        public function getCidade() {
            return $this->cidade;
        }

        public function getEstado() {
            return $this->estado;
        }

        public function getCidadeObj() {
            return $this->cidadeObj;
        }

        public function getEstadoObj() {
            return $this->estadoObj;
        }

        public function getId_cidade() {
            return $this->id_cidade;
        }

        public function getId_estado() {
            return $this->id_estado;
        }

        public function getSite() {
            return $this->site;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getTelefone1() {
            return $this->telefone1;
        }

        public function getContato1() {
            return $this->contato1;
        }

        public function getTelefone2() {
            return $this->telefone2;
        }

        public function getContato2() {
            return $this->contato2;
        }

        public function getData_cadastro() {
            return $this->data_cadastro;
        }

        public function getStatus() {
            return $this->status;
        }

        public function getDeletado() {
            return $this->deletado;
        }

        public function setId_fornecedor($id_fornecedor) {
            $this->id_fornecedor = $id_fornecedor;
        }

        public function setTipo($tipo) {
            $this->tipo = $tipo;
        }

        public function setNome_fantasia($nome_fantasia) {
            $this->nome_fantasia = $nome_fantasia;
        }

         public function setRazao_social($razao_social) {
            $this->razao_social = $razao_social;
        }

        public function setCnpj_cpf($cnpj_cpf) {
            $this->cnpj_cpf = $cnpj_cpf;
        }

        public function setEndereco($endereco) {
            $this->endereco = $endereco;
        }

        public function setBairro($bairro) {
            $this->bairro = $bairro;
        }

        public function setCep($cep) {
            $this->cep = $cep;
        }

        public function setCidade($cidade) {
            $this->cidade = $cidade;
        }

        public function setEstado($estado) {
            $this->estado = $estado;
        }

                public function setCidadeObj($cidadeObj) {
            $this->cidadeObj = $cidadeObj;
        }

        public function setEstadoObj($estadoObj) {
            $this->estadoObj = $estadoObj;
        }

        public function setId_cidade($id_cidade) {
            $this->id_cidade = $id_cidade;
        }

        public function setId_estado($id_estado) {
            $this->id_estado = $id_estado;
        }


        public function setSite($site) {
            $this->site = $site;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function setTelefone1($telefone1) {
            $this->telefone1 = $telefone1;
        }

        public function setContato1($contato1) {
            $this->contato1 = $contato1;
        }

        public function setTelefone2($telefone2) {
            $this->telefone2 = $telefone2;
        }

        public function setContato2($contato2) {
            $this->contato2 = $contato2;
        }

        public function setData_cadastro($data_cadastro) {
            $this->data_cadastro = $data_cadastro;
        }

        public function setStatus($status) {
            $this->status = $status;
        }

        public function setDeletado($deletado) {
            $this->deletado = $deletado;
        }
        
        public function getInsc_estadual() {
            return $this->insc_estadual;
        }

        public function getInsc_municipal() {
            return $this->insc_municipal;
        }

        public function getCelular() {
            return $this->celular;
        }

        public function getObservacao() {
            return $this->observacao;
        }

        public function setInsc_estadual($insc_estadual) {
            $this->insc_estadual = $insc_estadual;
        }

        public function setInsc_municipal($insc_municipal) {
            $this->insc_municipal = $insc_municipal;
        }

        public function setCelular($celular) {
            $this->celular = $celular;
        }

        public function setObservacao($observacao) {
            $this->observacao = $observacao;
        }


    public function getResponsavel(){
        return $this->responsavel;
    }

    public function setResponsavel($responsavel){
        $this->responsavel = $responsavel;
    }

    public function getSetor_resp(){
        return $this->setor_resp;
    }

    public function setSetor_resp($setor_resp){
        $this->setor_resp = $setor_resp;
    }

    public function getTelefone_resp(){
        return $this->telefone_resp;
    }

    public function setTelefone_resp($telefone_resp){
        $this->telefone_resp = $telefone_resp;
    }

    public function getEmail_resp(){
        return $this->email_resp;
    }

    public function setEmail_resp($email_resp){
        $this->email_resp = $email_resp;
    }

    public function getResponsavel2(){
        return $this->responsavel2;
    }

    public function setResponsavel2($responsavel2){
        $this->responsavel2 = $responsavel2;
    }

    public function getSetor_resp2(){
        return $this->setor_resp2;
    }

    public function setSetor_resp2($setor_resp2){
        $this->setor_resp2 = $setor_resp2;
    }

    public function getTelefone_resp2(){
        return $this->telefone_resp2;
    }

    public function setTelefone_resp2($telefone_resp2){
        $this->telefone_resp2 = $telefone_resp2;
    }

    public function getEmail_resp2(){
        return $this->email_resp2;
    }

    public function setEmail_resp2($email_resp2){
        $this->email_resp2 = $email_resp2;
    }

    public function getResponsavel3(){
        return $this->responsavel3;
    }

    public function setResponsavel3($responsavel3){
        $this->responsavel3 = $responsavel3;
    }

    public function getSetor_resp3(){
        return $this->setor_resp3;
    }

    public function setSetor_resp3($setor_resp3){
        $this->setor_resp3 = $setor_resp3;
    }

    public function getTelefone_resp3(){
        return $this->telefone_resp3;
    }

    public function setTelefone_resp3($telefone_resp3){
        $this->telefone_resp3 = $telefone_resp3;
    }

    public function getEmail_resp3(){
        return $this->email_resp3;
    }

    public function setEmail_resp3($email_resp3){
        $this->email_resp3 = $email_resp3;
    }
    

        public function estadoIs($estado){
        return $this->id_estado == $estado;
       }


    public function cidadeIs($cidade){
        return $this->id_cidade == $cidade;
       }

        
               
        
        
       public function statusIs($status){
        return $this->status == $status;
      }
        
        public function printStatus() {
        switch ($this->status) {
            case ATIVO:
                    echo com_fornecedoresPojo::$ATIVO;
                break;

            case BLOQUEADO:
                    echo com_fornecedoresPojo::$BLOQUEADO;
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

          
             unset($inArray["estadoObj"]);
                unset($inArray["cidadeObj"]);
            return $inArray;
        }


 }
?>
