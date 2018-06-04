<!--ALTERAR A FOLHA DE STILO CSS-->
<div class="header">
    <div class="container">
        <? if (isset($voltar)): ?>
            <div class="span-10">
                <a href="<?= $voltar ?>">Voltar</a>
            </div>
        <? endif; ?>
        <div class="right">
            <a href="#" onClick="javascript: window.close('this');">Fechar</a>
        </div>
    </div>
</div>
