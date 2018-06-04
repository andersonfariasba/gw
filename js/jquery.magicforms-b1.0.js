function replace_all(string,encontrar,substituir){
    while(string.indexOf(encontrar)>=0)
        string = string.replace(encontrar,substituir);
    return string;
}

function isInt(x) {
    if (x.indexOf('.') != -1)
        return false;
    if (isNaN(x))
        return false;
    return true;
}

function isFloat(x) {
    if (isNaN(x))
        return false;
    return true;
}

function isAnoBissexto(ano) {
    if (ano % 400 == 0) return true;
    if (ano % 100 == 0) return false;
    if (ano % 4 == 0) return true;
    return false;
}

function errorMsg(msg) {
    return '<span class="error">' + msg + '</span>';
}

function checkValorMax(ele, valor) {
    var max = $(ele).attr("valorMax");
    if (max != null && max != undefined) {
        if (valor > max) {
            $(ele).after(errorMsg('Valor m&aacute;ximo: ' + max));
            return false;
        }
    }

    return true;
}

function checkValorMin(ele, valor) {
    var min = $(ele).attr("valorMin");
    if (min != null && min != undefined) {
        if (valor < min) {
            $(ele).after(errorMsg('Valor m&iacute;nimo: ' + min));
            return false;
        }
    }

    return true;
}

function requeridoIsValid(ele) {
    if ($(ele).val() == null || $(ele).val() == '') {
        var customMsg = $(ele).attr("msgRequerida");
        if (customMsg != null && customMsg != undefined)
            $(ele).after(errorMsg(customMsg));
        else
            $(ele).after(errorMsg('Campo obrigat&oacute;rio'));

        return false;
    }

    return true;
}

function inteiroIsValid(ele) {
    if (!isInt($(ele).val())) {
        $(ele).after(errorMsg('N&uacute;mero inv&aacute;lido'));
        return false;
    }

    var i = parseInt($(ele).val());
    if (!checkValorMin(ele, i)) return false;
    if (!checkValorMax(ele, i)) return false;

    return true;
}

function realIsValid(ele) {
    var x = $(ele).val().replace(',', '.');
    if (!isFloat(x)) {
        $(ele).after(errorMsg('Valor inv&aacute;lido'));
        return false;
    }

    var f = parseFloat(x);
    if (!checkValorMin(ele, f)) return false;
    if (!checkValorMax(ele, f)) return false;

    return true;
}

function dataIsValid(ele, isDataNascimento) {
    var strData = $(ele).val();
    var pos1 = strData.indexOf('/');
    var pos2 = strData.indexOf('/', pos1 + 1);
    var strDia = strData.substring(0, pos1);
    var strMes = strData.substring(pos1 + 1, pos2);
    var strAno = strData.substring(pos2 + 1);

    var dia = parseInt(strDia);
    var mes = parseInt(strMes);
    var ano = parseInt(strAno);

    var isValido = true;

    if (dia > 28) {
        switch (mes) {
            case 4:
            case 6:
            case 9:
            case 11:
                if (dia > 30)
                    isValido = false;
                break;
            case 2:
                if ((dia > 29) || (dia == 29 && !isAnoBissexto(ano)))
                    isValido = false;
                break;
            case 1:
            case 3:
            case 5:
            case 7:
            case 8:
            case 10:
            case 12:
                if (dia > 31)
                    isValido = false;
                break;
            default:
                isValido = false;
        }
    } else if (mes < 1 || mes > 12)
        isValido = false;

    // verifica se eh para validar data de nascimento:
    if (isDataNascimento) {
        var hoje = new Date();
        if (hoje.getFullYear() < ano) {
            isValido = false;
        } else if (hoje.getYear() == ano) {
            if (hoje.getMonth + 1 < mes) {
                isValido = false;
            } else if (hoje.getMonth() + 1 == mes) {
                if (hoje.getDate() < dia) {
                    isValido = false;
                }
            }
        }
    }

    if (!isValido) {
        $(ele).after(errorMsg('Data inv&aacute;lida'));
        return false;
    }

    return true;
}

function cpfIsValid(ele) {
    var value = $(ele).val();
    value = value.replace('.','');
    value = value.replace('.','');
    cpf = value.replace('-','');
    if (cpf.length < 11) return false;
    var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
    var a = [];
    var b = new Number;
    var c = 11;
    for (i=0; i<11; i++){
        a[i] = cpf.charAt(i);
        if (i < 9)
            b += (a[i] * --c);
    }
    if ((x = b % 11) < 2) {
        a[9] = 0
    } else {
        a[9] = 11-x
    }
    b = 0;
    c = 11;
    for (y=0; y<10; y++) {
        b += (a[y] * c--);
    }
    if ((x = b % 11) < 2) {
        a[10] = 0;
    } else {
        a[10] = 11-x;
    }
    if ((cpf.charAt(9) != a[9])
        || (cpf.charAt(10) != a[10])
        || cpf.match(expReg)) {
        $(ele).after(errorMsg('CPF inv&aacute;lido'));
        return false;
    }

    return true;
}

function cnpjIsValid(ele) {
    var CNPJ = $(ele).val();
    CNPJ = CNPJ.replace('.', '');
    CNPJ = CNPJ.replace('.', '');
    CNPJ = CNPJ.replace('/', '');
    CNPJ = CNPJ.replace('-', '');

    var a = [];
    var b = new Number;
    var c = [6,5,4,3,2,9,8,7,6,5,4,3,2];

    for (var i = 0; i < 12; i++){
        a[i] = CNPJ.charAt(i);
        b += a[i] * c[i+1];
    }
    if ((x = b % 11) < 2) {
        a[12] = 0
    } else {
        a[12] = 11-x
    }

    b = 0;
    for (var y = 0; y < 13; y++) {
        b += (a[y] * c[y]);
    }
    if ((x = b % 11) < 2) {
        a[13] = 0;
    } else {
        a[13] = 11-x;
    }

    if ((CNPJ.charAt(12) != a[12]) || (CNPJ.charAt(13) != a[13])) {
        $(ele).after(errorMsg('CNPJ inv&aacute;lido'));
        return false;
    }

    return true;
}

function horarioIsValid(ele) {
    var array = $(ele).val().split(":");
    var hora = parseInt(array[0]);
    var min = parseInt(array[1]);

    if (min > 59 || min < 0 || hora < 0 || hora > 23) {
        $(ele).after(errorMsg('Hor&aacute;rio inv&aacute;lido'));
        return false;
    }

    return true;
}



function validate() {
    var formIsValido = true;

    $(this).each(function() {
        $(".error").replaceWith(''); // retirar as msgs de erro previas
        $(".erroValidacao").removeClass("erroValidacao"); // retirar erros previos
        
        var campos = [];
        var texts = [];

        $("input:text:visible").each(function() {
            if($(this).attr("valueDefault") != "undefined"){ //se tiver o atributo valueDefault
                if($(this).val() == $(this).attr("valueDefault")){
                    $(this).val('');
                }
            }
            texts.push($(this));
            campos.push($(this));
        });

        $("input:password, select, textarea").each(function(){
            if ($(this).is(":visible"))
                campos.push($(this));
        });

        // radios e checkboxes requeridos:
        $("input[type=radio][requerido], input[type=checkbox][requerido]").each(function() {
            if ($(this).is(":visible")) {
                if ($(":checked[name=" + $(this).attr("name") + "]").length == 0) {
                    formIsValido = false;
                    $("input[name=" + $(this).attr("name") + "]").addClass("erroValidacao");

                    var msgRequerida = $(this).attr("msgRequerida");
                    if (msgRequerida != null && msgRequerida != undefined)
                        $("input[name=" + $(this).attr("name") + "]:first").before(errorMsg(msgRequerida));
                    else
                        $("input[name=" + $(this).attr("name") + "]:first").before(errorMsg("Sele&ccedil;&atilde;o obrigat&oacute;ria"));
                }
            }
        });

        // campos obrigatorios:
        for (var i in campos) {
            if (campos[i].attr("requerido") != null) {
                if (!requeridoIsValid(campos[i])) {
                    formIsValido = false;
                    campos[i].addClass("erroValidacao");
                }
            }
        }

        // minLength :
        $("textarea[minLength], input[type=text][minLength], input[type=password][minLength]").each(function() {
            if ($(this).is(":visible")) {
                var min = $(this).attr("minLength");
                if ($(this).val() != "" && $(this).val().length < min) {
                    $(this).addClass("erroValidacao");
                    $(this).after(errorMsg("M&iacute;nimo de " + min + " caracteres"));
                    formIsValido = false;
                }
            }
        });

        // checkboxes com quantidade minima de checked, "minChecked":
        $("input[type=checkbox][minChecked]").each(function () {
            var min = $(this).attr("minChecked");
            if ($("[name=" + $(this).attr("name") + "]:checked").length < min) {
                formIsValido = false;
                $("[name=" + $(this).attr("name") + "]:first").before(
                    errorMsg("Selecione pelo menos " + min + " op&ccedil;&otilde;es") );
            }
        });
        
        // checkboxes com quantidade exata de checked, "strictChecked":
        $("input[type=checkbox][strictChecked]").each(function () {
            var qtd = $(this).attr("strictChecked");
            if ($("[name=" + $(this).attr("name") + "]:checked").length != qtd) {
                formIsValido = false;
                $("[name=" + $(this).attr("name") + "]:first").before(
                    errorMsg("Selecione " + qtd + " op&ccedil;&otilde;es") );
                $("[name=" + $(this).attr("name") + "]:first").focus();
            }
        });

        // validar campos text:
        for (i in texts) {
            var tipo = texts[i].attr("tipo");
            var valor = texts[i].val();
            if ((tipo != null || tipo != undefined) // campo possui atributo 'tipo'
                && (!(valor == null || valor == ""))) { // campo nao vazio

                isValido = true;
                if (tipo == "inteiro") {
                    isValido = inteiroIsValid(texts[i]);
                } else if (tipo == "real") {
                    isValido = realIsValid(texts[i]);
                } else if (tipo == "data") {
                    isValido = dataIsValid(texts[i], false);
                } else if (tipo == "dataNascimento") {
                    isValido = dataIsValid(texts[i], false);
                } else if (tipo == "cpf") {
                    isValido = cpfIsValid(texts[i]);
                } else if (tipo == "cnpj") {
                    isValido = cnpjIsValid(texts[i]);
                } else if (tipo == "horario") {
                    isValido = horarioIsValid(texts[i]);
                }

                if (!isValido) {
                    formIsValido = false;
                    texts[i].addClass("erroValidacao");
                }
            }
        }
        $(".erroValidacao:first").focus();
    });

    if(!formIsValido){
        $("input[type=text][valueDefault]").each(function() {
            if($(this).val() == ""){
                $(this).val($(this).attr("valueDefault"));
            }
        })
    }

    if(formIsValido){
        //Para moneyReal. 1.000,00 => 1000.00
        $("input[tipo=moneyReal]").each(function(){
            var value = $(this).val();
            if((value != null) && (value != undefined) && (value != "")){
                if(value.indexOf(",")>=0){
                    value = replace_all(value,".", ""); //replace_all utilizada para alterar todas as ocorrencias de um caracter
                    value = value.replace(",", ".");
                    $(this).val(parseFloat(value));
                }
            }
        })

        //Para moneyDolar. 1,000.00 => 1000.00
        $("input[tipo=moneyDolar]").each(function(){
            var value = $(this).val();
            if((value != null) && (value != undefined) && (value != "")){
                value = value.replace(",", "");
                $(this).val(parseFloat(value));
            }
        })

        //Para moneyEuro. 1 000,00 => 1000.00
        $("input[tipo=moneyEuro]").each(function(){
            var value = $(this).val();
            if((value != null) && (value != undefined) && (value != "")){
                value = value.replace(" ", "");
                value = value.replace(",", ".");
                $(this).val(parseFloat(value));
            }
        })
    }
    return formIsValido;
}

function insertEstados($selectEstados){
    $selectEstados.append("<option value=''>Selecione</option><option value='AC'>AC</option><option value='AL'>AL</option><option value='AM'>AM</option><option value='AP'>AP</option><option value='BA'>BA</option><option value='CE'>CE</option><option value='DF'>DF</option><option value='ES'>ES</option><option value='GO'>GO</option><option value='MA'>MA</option><option value='MG'>MG</option><option value='MS'>MS</option><option value='MT'>MT</option><option value='PA'>PA</option><option value='PB'>PB</option><option value='PE'>PE</option><option value='PI'>PI</option><option value='PR'>PR</option><option value='RJ'>RJ</option><option value='RN'>RN</option><option value='RO'>RO</option><option value='RR'>RR</option><option value='RS'>RS</option><option value='SC'>SC</option><option value='SE'>SE</option><option value='SP'>SP</option><option value='TO'>TO</option>");
}

function insertMascaras(){
    // add mascaras:
    $("input:text[tipo]").each(
        function() {
            var tipo = $(this).attr("tipo");
            if (tipo != undefined) {
                if (tipo == "cnpj") {
                    $(this).mask("99.999.999/9999-99");
                } else if (tipo == "cpf") {
                    $(this).mask("999.999.999-99");
                } else if (tipo == "data" || tipo == "dataNascimento") {
                    $(this).mask("99/99/9999");
                } else if (tipo == "telefone") {
                    $(this).mask("9999-9999");
                } else if (tipo == "dddTelefone") {
                    $(this).mask("(99) 9999-9999");
                } else if (tipo == "horario") {
                    $(this).mask("99:99");
                } else if (tipo == "cep") {
                    $(this).mask("99999-999");
                //o plugin tem bug para campos readonly, então apenas seto a mascara se ele não for readonly
                }else if((tipo == "moneyDolar") && (!$(this).attr("readonly"))){
                    $(this).maskMoney({
                        showSymbol:true
                    }); //US$ 0.00
                }else if((tipo == "moneyReal") && (!$(this).attr("readonly"))){
                    //R$ 00,00
                    var options = {};
                    options["symbol"] = "";
                    options["decimal"] = ",";
                    options["thousands"] = ".";
                    options["showSymbol"] = true;
                    options["allowZero"] = true, // Permite que o digito 0 seja o primeiro caractere
                    options["precision"] = 2; //A precisão do decimal (,00) ;                    
                    $(this).maskMoney(options);
                    
                }else if((tipo == "moneyEuro") && (!$(this).attr("readonly"))){
                    //Euro 0,00
                    $(this).maskMoney({
                        symbol:"Euro",
                        showSymbol:true,
                        decimal:",",
                        thousands:" "
                    });
                }
            }
        }
        );
}

function insertEfeitos(){
    // add efeitos "showOnly" para os radios:
    $("input[type=radio][showOnly]").each(function() {
        var ids = $(this).attr("showOnly").split(",");

        $(this).change(function() {
            showOnlyByIds(ids);
        });
    });

    // add efeitos "show" para os radios:
    $("input[type=radio][show]").each(function() {
        var ids = $(this).attr("show").split(",");

        $(this).change(function() {
            showByIds(ids);
        });
    });

    // add efeitos "hideOnly" para os radios:
    $("input[type=radio][hideOnly]").each(function() {
        var ids = $(this).attr("hideOnly").split(",");

        $(this).change(function() {
            hideOnlyByIds(ids);
        });
    });

    // add efeitos "hide" para os radios:
    $("input[type=radio][hide]").each(function() {
        var ids = $(this).attr("hide").split(",");

        $(this).change(function() {
            hideByIds(ids);
        });
    });
    //add efeitos "toggleDisplay" para checkboxes:
    $("input[type=checkbox][toggleDisplay]").each(function() {
        var ids = $(this).attr("toggleDisplay").split(",");

        $(this).change(function() {
            if ($(this).is(":checked"))
                showByIds(ids);
            else
                hideByIds(ids);
        });
    });

    // add estados no select
    $("select[tipo=estados]").each(function() {
        insertEstados($(this));
    });

    // add efeitos "hide/show/showOnly/hideOnly" para os selects
    $("select[hideShowOptions]").each(function() {
        $(this).change(function() {
            // tentar executar os eventos do option selecionado e retorna se executou algum:
            var executed = exeEvents($("[name="+ $(this).attr("name") +"] :selected"));

            if (!executed)
                exeEvents($(this)); // executa os eventos default do select
        });
    });

    // esconder elementos c/ "hidden" e desabilita os campos filhos
    $("[hidden]").each(function() {
        $(this).hide();
        $(this).attr("disabled", "disabled");
        $(this).find("input, select, textarea").attr("disabled", "disabled"); // disable all
    });

    // esconder filhos dos elementos c/ "hiddenChildren" e desabilita os campos filhos
    $("[hiddenChildren]").each(function() {
        $(this).children().hide();
        $(this).find("input, select, textarea").attr("disabled", "disabled"); // disable all
    });

    // charCounter
    $("textarea[charCounter]").each(function() {
        var max = $(this).attr("maxLength");
        var name = $(this).attr("name");

        $(this).after('<br/><span class="charCounter" name="' + name + '">' + max + ' caracteres restantes</span>');
        $(this).keyup(updateContador);
        $(this).keydown(updateContador);
        $(this).keypress(updateContador);
    });

    //add efeitos "valueDefault" para text:
    $("input[type=text][valueDefault]").each(function() {
        var valueDefault = $(this).attr("valueDefault");
        var isLoad = true;

        $(this).focus(function(){
            isLoad = false;
            var value = $(this).val();
            if(valueDefault == value){
                $(this).val('');
            }
        })

        $(this).blur(function(){
            isLoad = false;
            var value = $(this).val();
            if(value == ''){
                $(this).val(valueDefault);
            }
        })

        if(isLoad) $(this).val(valueDefault);
    });
}

// preparacao do form:
$(document).ready(function() {    

    insertMascaras();

    insertEfeitos();
        
});

function exeEvents(ele) {
    var strAttr;
    var executed = false;

    if ((strAttr = $(ele).attr("showOnly")) != undefined) {
        showOnlyByIds(strAttr.split(","));
        executed = true;
    }
    if ((strAttr = $(ele).attr("hideOnly")) != undefined) {
        hideOnlyByIds(strAttr.split(","));
        executed = true;
    }
    if ((strAttr = $(ele).attr("show")) != undefined) {
        showByIds(strAttr.split(","));
        executed = true;
    }
    if ((strAttr = $(ele).attr("hide")) != undefined) {
        hideByIds(strAttr.split(","));
        executed = true;
    }

    return executed;
}

function showOnlyByIds(ids) {
    hideShowByIds(ids, true, true);
}

function hideOnlyByIds(ids) {
    hideShowByIds(ids, false, true);
}

function showByIds(ids) {
    hideShowByIds(ids, true, false);
}

function hideByIds(ids) {
    hideShowByIds(ids, false, false);
}

function hideShowByIds(ids, show, only) {
    var trimmedParentId = jQuery.trim(ids[0]);
    if (only) {
        $("#"+trimmedParentId).parent().children().hide(); // hide all
        $("#"+trimmedParentId).parent().find("input, select, textarea").attr("disabled", "disabled"); // disable all
    }

    for (var i in ids) {
        var trimmedId = jQuery.trim(ids[i]);
        if (show) {
            $("#"+trimmedId).show();
            $("#"+trimmedId).filter("input, select, textarea").removeAttr("disabled");
            $("#"+trimmedId).find("input, select, textarea").removeAttr("disabled");
            $("#"+trimmedId).find("input, select, textarea").each(function(){
                var type = $(this).attr("type");
                var tag = this.tagName.toLowerCase();
                if ((type == 'checkbox' || type == 'radio') && (this.checked)) $(this).change();
                else if ((tag == 'select') && (this.selected)) $(this).change();
            })
        } else {
            $("#"+trimmedId).hide();
            $("#"+trimmedId).filter("input, select, textarea").attr("disabled", "disabled");
            $("#"+trimmedId).find("input, select, textarea").attr("disabled", "disabled");            
        }
    }

    if (only){
        $("#"+trimmedParentId).parent().show();
    }

    if(show) $("#"+trimmedParentId).removeAttr("disabled"); //Weslley quem add
}

function updateContador(event) {
    var max = parseInt($(this).attr("maxLength"));

    $(".charCounter[name=" + $(this).attr("name") + "]").html(
        (max - $(this).val().length) + ' caracteres restantes</span>' );

    return charsLimite($(this), max, event);
}

function charsLimite(ele, max, event) {
    if ( $(ele).val().length >= max && (event.which >= 48
        || event.which == 32 /*space*/ || event.which == 16 /*shift*/
        || event.which == 13 /*enter*/) )
        return false;
    return true;
}