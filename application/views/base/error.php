<div class="error">

    <span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>    
    <span>Alerta! Procure o Administrador do Sistema!</span>
    <br/>

    <?php
    if ($ex instanceof Exception) {
        if ($ex->getCode() != 0) {
            echo $ex->getCode();
        }
    ?>    
        <h2><?= $ex->getMessage(); ?></h2>
<!--        tirei a impressao do caminho do arquivo-->
        <? $ex->getFile() . " " . $ex->getLine().";" ?>
    <?php
    } else {
        echo $ex;
    }
    ?>            
</div>
