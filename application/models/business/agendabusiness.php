<?php
class AgendaBusiness extends CI_Model {

    public function cadastrar($dados){
        try {
            $objDentista = $this->Factory->createPojo("agenda",$dados);

            $dentistaDao = $this->Factory->createDao("agenda");
            $dentistaDao->connect();
            $cod_dentista = $dentistaDao->insert($objDentista);
			
				
			
            $dentistaDao->disconnect();

            return $cod_dentista;



        } catch (Exception $exc) {
            throw $exc;
        }


        }


          public function filtro($dados=null){
      try {
        
            $dentistaDao = $this->Factory->createDao("agenda");
            $dentistaDao->connect();
            $listDentista = $dentistaDao->filtro($dados);
            $dentistaDao->disconnect();
            return $listDentista;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

            
        

      				
	   
				
         
        public function visualizar($id){
            try {
                 $dentistaDao = $this->Factory->createDao("agenda");
                 $dentistaDao->connect();
                 $objDentista = $dentistaDao->getById($id);
                 $dentistaDao->disconnect();
                 return $objDentista;
                
            } catch (Exception $exc) {
                throw $exc;
            }
        }
        
        
        public function editar($dados){
            try {
                //$objDentista = $this->Factory->createPojo("agenda",$dados);
                $dentistaDao = $this->Factory->createDao("agenda");

                $dentistaDao->connect();
                $dentistaDao->update($dados);
                $dentistaDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
        }


        public function excluir($id){
            try {
                  $dentistaDao = $this->Factory->createDao("agenda");
                  $dentistaDao->connect();
                  $dentistaDao->excluir($id);
                  $dentistaDao->disconnect();

            } catch (Exception $exc) {
                throw $exc;
            }
        }


        public function ajax_listar($usuario){
         try {
            
            $fatDao = $this->Factory->createDao("agenda");
            $fatDao->connect();
            $listFat = $fatDao->ajax_listar($usuario);
            $fatDao->disconnect();
            return $listFat;

            } catch (Exception $exc) {
                throw $exc;
            }
        }





}
?>
