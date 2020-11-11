/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function Financeiro() {
    var nome;
    var idade;
    var curso;
    var numUS;
    var idOne, idTwo, nValor, nPorce, calcTotal;
    var url, id, jsonData, objData, objAction;

    this.setNome = function (nome) {
        this.nome = nome;
    };



    this.setIdade = function (idade) {
        this.idade = idade;
    };

    this.setCurso = function (curso) {
        this.curso = curso;
    };

    this.setClear = function (numClear) {
        this.numClear = numClear;
    };

    // Recebe um numero que contem virgula e substitui po ponto
    this.setUS = function (numUS) {
        this.numUS = numUS;
    };

    this.setNumberCalc = function (idOne, idTwo) {
        this.idOne = idOne;
        this.idTwo = idTwo;
        this.nValor;
        this.nPorce;
        this.calcTotal;
    };

    this.setMoneyCashClear = function (valor, validos, tammax) {
        var result = "";
        var aux;
        for (var i = 0; i < valor.length; i++) {
            aux = validos.indexOf(valor.substring(i, i + 1));
            if (aux >= 0) {
                if (result.length < tammax - 1) {
                    result += aux;
                }
            }
        }
        return result;
    };

    this.setAjaxData = function (objData) {
        this.objData = objData;
    };

    this.setAjaxFilter = function (objData) {
        this.objData = objData;
    };

    this.setAjaxActionUser = function (objAction) {
        this.objAction = objAction;
    };


    this.getNome = function () {
        return this.nome;
    };

    this.getIdade = function () {
        return this.idade;
    };

    this.getCurso = function () {
        return this.curso;
    };

    this.getClear = function () {
        return this.numClear;
    };

    this.getUS = function () {
        return this.numUS;
    };

    this.getNumberCalc = function () {
        if (this.calcTotal) {
            return this.calcTotal;
        } else {
            return this.calcTotal = '0,00';
        }
    };

    this.getAjaxData = function () {
        return this.objData;
    };

    this.getAjaxFilter = function () {
        return this.objData;
    };

    this.getAjaxActionUser = function () {
        return this.objAction;
    };

    this.mostraDados = function () {
        alert("Nome do aluno: " + this.nome + "\nIdade: " + this.idade + "\nCurso: " + this.curso);
    };

    this.clearNumber = function () {
        numsStr = this.numClear.replace(/[^0-9]/g, '');
        return this.numClear = parseInt(numsStr);
    };

    this.mostrarUS = function () {
        if ((this.numUS.indexOf('.') >= 0) && (this.numUS.indexOf(',') >= 0)) {
            this.numUS = this.numUS.replace('.', '');
            this.numUS = this.numUS.replace('.', '');
            this.numUS = this.numUS.replace('.', '');
            this.numUS = this.numUS.replace(',', '.');
            return this.numUS = parseFloat(this.numUS);
        } else {
            this.numUS = this.numUS.replace(',', '.');
            return this.numUS = parseFloat(this.numUS);
        }

    };

    this.somarNumberCalc = function () {
        this.nValor = document.getElementById(this.idOne).value;

        if ((this.nValor.indexOf('.') >= 0) && (this.nValor.indexOf(',') >= 0)) {
            this.nValor = this.nValor.replace('.', '');
            this.nValor = this.nValor.replace('.', '');
            this.nValor = this.nValor.replace('.', '');
            this.nValor = this.nValor.replace(',', '.');
            this.nValor = parseFloat(this.nValor);
        } else {
            this.nValor = this.nValor.replace(',', '.');
            this.nValor = parseFloat(this.nValor);
        }

        this.nPorce = parseFloat(document.getElementById(this.idTwo).value);

        if (!this.nPorce) {
            this.calcTotal = this.nValor;
        } else {
            this.calcTotal = parseFloat((this.nValor - (this.nValor * this.nPorce / 100)));
        }

    };
    /*
     * @author: Francisco Aparecido
     * @version: 1.0
     * @description: Converte um numero para um formato pre determinado
     * @example: onkeydown="this.moneyCash(this,28,event,2,'.',',');"
     * onkeydown="this.moneyCash(this,28,event,3,',','.')"
     * onkeydown="this.moneyCash(this,28,event,4,'.',',')"
     * onkeydown="this.moneyCash(this,28,event,5,'.',',')"
     * onkeydown="this.moneyCash(this,28,event,6,'.',',')"
     * onkeydown="this.moneyCash(this,28,event,7,'.',',')"
     * onkeydown="this.moneyCash(this,28,event,8,'.',',')"
     * onkeydown="this.moneyCash(this,28,event,12,'.',',')"
     *
     */
    this.moneyCash = function (campo, tammax, teclapres, decimal, ptmilhar, ptdecimal) {
        var tecla = teclapres.keyCode;
        vr = this.setMoneyCashClear(campo.value, "0123456789", tammax);
        tam = vr.length;
        dec = decimal;
        if (tam < tammax && tecla != 8) {
            tam = vr.length + 1;
        }
        if (tecla == 8) {
            tam = tam - 1;
        }
        if (tecla == 8 || tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105) {
            if (tam <= dec) {
                campo.value = vr;
            } else if ((tam > dec) && (tam <= dec + 3)) {
                //alert(tam);
                campo.value = vr.substr(0, tam - dec) + ptdecimal + vr.substr(tam - dec, tam);
            } else if ((tam >= dec + 4) && (tam <= dec + 6)) {
                campo.value = vr.substr(0, tam - 3 - dec) + ptmilhar + vr.substr(tam - 3 - dec, 3) + ptdecimal + vr.substr(tam - dec, 12);
            } else if ((tam >= dec + 7) && (tam <= dec + 9)) {
                campo.value = vr.substr(0, tam - 6 - dec) + ptmilhar + vr.substr(tam - 6 - dec, 3) + ptmilhar + vr.substr(tam - 3 - dec, 3) + ptdecimal + vr.substr(tam - dec, 12);
            } else if ((tam >= dec + 10) && (tam <= dec + 12)) {
                campo.value = vr.substr(0, tam - 9 - dec) + ptmilhar + vr.substr(tam - 9 - dec, 3) + ptmilhar + vr.substr(tam - 6 - dec, 3) + ptmilhar + vr.substr(tam - 3 - dec, 3) + ptdecimal + vr.substr(tam - dec, 12);
            } else if ((tam >= dec + 13) && (tam <= dec + 15)) {
                campo.value = vr.substr(0, tam - 12 - dec) + ptmilhar + vr.substr(tam - 12 - dec, 3) + ptmilhar + vr.substr(tam - 9 - dec, 3) + ptmilhar + vr.substr(tam - 6 - dec, 3) + ptmilhar + vr.substr(tam - 3 - dec, 3) + ptdecimal + vr.substr(tam - dec, 12);
            } else if ((tam >= dec + 16) && (tam <= dec + 18)) {
                campo.value = vr.substr(0, tam - 15 - dec) + ptmilhar + vr.substr(tam - 15 - dec, 3) + ptmilhar + vr.substr(tam - 12 - dec, 3) + ptmilhar + vr.substr(tam - 9 - dec, 3) + ptmilhar + vr.substr(tam - 6 - dec, 3) + ptmilhar + vr.substr(tam - 3 - dec, 3) + ptdecimal + vr.substr(tam - dec, 12);
            } else if ((tam >= dec + 19) && (tam <= dec + 21)) {
                campo.value = vr.substr(0, tam - 18 - dec) + ptmilhar + vr.substr(tam - 18 - dec, 3) + ptmilhar + vr.substr(tam - 15 - dec, 3) + ptmilhar + vr.substr(tam - 12 - dec, 3) + ptmilhar + vr.substr(tam - 9 - dec, 3) + ptmilhar + vr.substr(tam - 6 - dec, 3) + ptmilhar + vr.substr(tam - 3 - dec, 3) + ptdecimal + vr.substr(tam - dec, 12);
            } else if ((tam >= dec + 22) && (tam <= dec + 24)) {
                campo.value = vr.substr(0, tam - 21 - dec) + ptmilhar + vr.substr(tam - 21 - dec, 3) + ptmilhar + vr.substr(tam - 18 - dec, 3) + ptmilhar + vr.substr(tam - 15 - dec, 3) + ptmilhar + vr.substr(tam - 12 - dec, 3) + ptmilhar + vr.substr(tam - 9 - dec, 3) + ptmilhar + vr.substr(tam - 6 - dec, 3) + ptmilhar + vr.substr(tam - 3 - dec, 3) + ptdecimal + vr.substr(tam - dec, 12);
            } else {
                campo.value = vr.substr(0, tam - 24 - dec) + ptmilhar + vr.substr(tam - 24 - dec, 3) + ptmilhar + vr.substr(tam - 21 - dec, 3) + ptmilhar + vr.substr(tam - 18 - dec, 3) + ptmilhar + vr.substr(tam - 15 - dec, 3) + ptmilhar + vr.substr(tam - 12 - dec, 3) + ptmilhar + vr.substr(tam - 9 - dec, 3) + ptmilhar + vr.substr(tam - 6 - dec, 3) + ptmilhar + vr.substr(tam - 3 - dec, 3) + ptdecimal + vr.substr(tam - dec, 12);
            }
        }
    };

    this.ajaxData = function () {
        if ((this.objData.url.match(/filters/) && this.objData.url.match(this.objData.url_id))) {
            if (this.objData.get_decode == null) {
                $.ajax({
                    type: 'POST',
                    dataType: 'html',
                    url: this.objData.url,
                    //data: 'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&qtdLine='+qtdLine,
                    async: true,
                    beforeSend: function () {
                        $('#loading').show();
                    },
                    success: function (data) {
                        $('#tableData').html(data);
                        $('#loading').fadeOut();
                        if (document.getElementById("tableList")) {
                            $('#filtros').show();
                        } else {
                            $('#filtros').hide();
                        }
                    }
                });
            } else {
                $.ajax({
                    type: 'POST',
                    dataType: 'html',
                    url: this.objData.url,
                    data: { get_decode: this.objData.get_decode },
                    async: true,
                    beforeSend: function () {
                        $('#loading').show();
                    },
                    success: function (data) {
                        $('#tableData').html(data);
                        $('#loading').fadeOut();
                        if (document.getElementById("tableList")) {
                            $('#filtros').show();
                        } else {
                            $('#filtros').hide();
                        }
                    }
                });
            }
        } else {
            return false;
        }
    };

    this.ajaxFilter = function (page_num) {
        page_num = page_num ? page_num : 0;
        var keywords = $('#keywords').val();
        var qtdLine = $('#qtdLine').val();
        var sortBy = $('#sortBy').val();

        //var keywords = $('#keywords').val();
        //var sortBy = $('#sortBy').val();
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: this.objData.url,
            data: 'page=' + page_num + '&keywords=' + keywords + '&sortBy=' + sortBy + '&qtdLine=' + qtdLine + '&get_decode=' + this.objData.get_decode,
            async: true,
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (data) {
                $('#tableData').html(data);
                $('#loading').fadeOut();
            }
        });
    };

    this.ajaxActionUser = function () {
        if ((this.objAction.type === 'loadEdit' || this.objAction.type === 'loadInfo') && this.objAction.url.match(/ajax-process/) && this.objAction.url.match(this.objAction.url_id)) {
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: this.objAction.url,
                data: 'action_type=' + this.objAction.type + '&id=' + this.objAction.id,
                async: true,
                success: function (data) {
                    if (typeExec === 'loadEdit') {
                        $.each(data, function (key, value) {
                            $('#' + key).val(value);
                        });
                    } else if (typeExec === 'loadInfo') {
                        $.each(data, function (key, value) {
                            $('.' + key).text((value) ? value : ' campo ainda não preenchido');
                        });
                    }
                }
            });
        } else if ((this.objAction.type === 'add' || this.objAction.type === 'update' || this.objAction.type === 'delete') && this.objAction.url.match(/ajax-process/) && this.objAction.url.match(this.objAction.url_id)) {
            $.ajax({
                type: 'POST',
                url: this.objAction.url,
                data: this.objAction.userData,
                success: function (msg) {
                    objFinanca.ajaxData();
                    if (msg === 0) {
                        $.toaster({
                            title: {
                                text: 'Sucesso!',
                                icon: 'fas fa-check-circle',
                                //info: 'just now',
                                close: true
                            },
                            content: feedback,
                            delay: 4000,
                            position: 'top right'
                        });


                        /*toastr.success(feedback, 'Sucesso!', {
                            "closeButton": true,
                            timeOut: 5000,
                            "progressBar": true
                        });*/


                        $('.form-register')[0].reset();
                    } else {
                        /*toastr.warning('Ocorreu algum problema, tente novamente', 'Erro!', {
                            timeOut: 5000
                        });*/
                        $.toaster({
                            title: {
                                text: 'Erro!',
                                icon: 'far fa-exclamation-triangle',
                                //info: 'just now',
                                close: true
                            },
                            content: 'Ocorreu algum problema, tente novamente',
                            delay: 4000,
                            position: 'top right'
                        });
                    }
                }
            });
        }
    };
}

function Metodos() {

    //    objSet = {
    //        form: $("#addForm"),
    //        not_empty: ['laboratory_name','laboratory_id']
    //    };
    //    objMetodos.setForm( objSet );
    //    objMetodos.serializeForm();
    //    objMetodos.getForm();
    //Propriedades da classe
    var objForm, objData;

    //Passando parâmetros
    this.setForm = function (objForm) {
        this.objForm = objForm;
        this.objData = {};
    };

    //Pega valores
    this.getForm = function () {
        return this.objData;
    };

    //Executa a função
    this.serializeForm = function () {
        var formArray = this.objForm.form.serializeArray();

        for (var i = 0, n = formArray.length; i < n; ++i)
            this.objData[formArray[i].name] = formArray[i].value;
    };


    //Rotina que verifica se a campos vazios
    var arrayData;

    this.setVerify = function (arrayData) {
        this.arrayData = arrayData;
    };

    this.getVerify = function () {
        return this.arrayData;
    };

    this.emptyVerify = function () {
        for (i = 0; i < this.arrayData.length; ++i) {
            cond = document.getElementById(this.arrayData[i]).value;
            if (cond == false || cond.length == false) {
                document.getElementById(this.arrayData[i]).classList.add('is-invalid');
            } else {
                document.getElementById(this.arrayData[i]).classList.remove('is-invalid');
            }

        }
    };

}








//    // Exemplo de uso
//
//    var objFinanca = new Financeiro();
//
//
//    // ------------------
//
//    objFinanca.setAjax('btn-dell');
//
//    objFinanca.getAjax();
//
//    objFinanca.mostraAjax();

//teste = objFinanca.getUS();

//alert( teste * 3);

//objFinanca.setCalculo('numero_um', 'numero_dois');

//objFinanca.calcNumber();

//teste = objFinanca.getUS();




////em float
//formatNumber(1234.53);
////em string real
//formatNumber('1.234,53');
////em string real sem ponto
//formatNumber('1234,53');
////em string americano
//formatNumber('1,234.53');
//
////retornará 1234.53
//function formatNumber(value) {
//    value = convertToFloatNumber(value);
//    return value.formatMoney(2, '.', '');
//}
////retornará 1.234,53
//function formatNumber(value) {
//    value = convertToFloatNumber(value);
//    return value.formatMoney(2, ',', '.');
//}
////retornará 1,234.53
//function formatNumber(value) {
//    value = convertToFloatNumber(value);
//    return value.formatMoney(2, '.', ',');
//}
//
// //transforma a entrada em número float
// var convertToFloatNumber = function(value) {
//     value = value.toString();
//      if (value.indexOf('.') !== -1 && value.indexOf(',') !== -1) {
//          if (value.indexOf('.') <  value.indexOf(',')) {
//             //inglês
//             return parseFloat(value.replace(/,/gi,''));
//          } else {
//            //português
//             return parseFloat(value.replace(/./gi,'').replace(/,/gi,'.'));
//          }
//      } else {
//         return parseFloat(value);
//      }
//   }
//
////prototype para formatar a saída
//Number.prototype.formatMoney = function (c, d, t) {
//    var n = this,
//        c = isNaN(c = Math.abs(c)) ? 2 : c,
//        d = d == undefined ? "." : d,
//        t = t == undefined ? "," : t,
//        s = n < 0 ? "-" : "",
//        i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
//        j = (j = i.length) > 3 ? j % 3 : 0;
//    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
//};


class EventAction {
    static setVal(id1, id2) {

        document.querySelector(id1).addEventListener('click', function () {
            document.querySelectorAll(id2).forEach(function (group) {
                'use strict';
                var s = group.style;
                s.opacity = 1;
                (function fadeOut() { // name the function
                    /**
                    * Verifica se opacity é menor que 0.1,
                    * caso não seja subtrai 0.1 até chegar a 0.0. **/
                    if (((s.opacity -= .1) < 0.1))
                        s.display = "none";
                    else
                        //setTimeout(fadeOut, 30); // use the name of the function
                        requestAnimationFrame(fadeOut);
                })();
            });

            document.querySelectorAll(".form-hidden, #group-btn-hidden, .row-button-hidden, .notice-hidden").forEach(function (group) {
                'use strict';
                var s = group.style;
                s.opacity = 0;
                s.display = 'flex' || '';

                (function fadeIn() { // name the function
                    var val = parseFloat(s.opacity);
                    /**
                    * Verifica se opacity é menor que 0.1,
                    * caso não seja subtrai 0.1 até chegar a 0.0. **/
                    if ( !((val += 0.1) > 1) )
                        s.opacity = val;
                        requestAnimationFrame(fadeIn); // use the name of the function
                })();
            });

            document.querySelectorAll('#btn-save, .form-register').forEach(function (group) {
                //console.log(group.getAttributeNode("class").value);
                if(group.getAttributeNode("class").value === 'form-register'){

                    group.setAttribute("id", "addForm");



                } else if(group.getAttributeNode("id").value === 'btn-save'){

                    group.setAttribute("onclick", "typeAction(objData={type:'add'})");
                    group.innerHTML = "<i class='fas fa-save fa-lg'></i> <span>SALVAR</span>";

                }

            });

        });
    }
}