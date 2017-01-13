/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */




function Financeiro() {

    var nome;
    var idade;
    var curso;
    var str;
    var n;
    var c;
    var d;
    var t;



    this.setNome = function (vNome) {
        this.nome = vNome;
    };

    this.setIdade = function (vIdade) {
        this.idade = vIdade;
    };

    this.setCurso = function (vCurso) {
        this.curso = vCurso;
    };

    this.setClearNum = function (vStr) {
        this.str = vStr;
    };

    this.setMoneyCash = function (vN, vC, vD, vT) {
        this.n = vN;
        this.c = vC;
        this.d = vD;
        this.t = vT;  
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

    this.getClearNum = function () {
        return this.str;
    };


    this.mostraDados = function () {
        alert("Nome do aluno: " + this.nome + "\nIdade: " + this.idade + "\nCurso: " + this.curso);
    };

    this.formatMoney = function () {
        this.c = isNaN(this.c = Math.abs(this.c)) ? 2 : this.c, this.d = this.d == undefined ? "," : this.d, this.t = this.t == undefined ? "." : this.t, s = this.n < 0 ? "-" : "", i = parseInt(this.n = Math.abs(+this.n || 0).toFixed(this.c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
        return s + (j ? i.substr(0, j) + this.t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + this.t) + (this.c ? this.d + Math.abs(this.n - i).toFixed(this.c).slice(2) : "");
    };


}


var objFinanca = new Financeiro();
 
objFinanca.setNome("Henrique");
objFinanca.setIdade("25");
objFinanca.setCurso("Introdução à programação orientada a objetos em Javascript");


objFinanca.mostraDados();

objFinanca.setMoneyCash(10000, 2, '.', ',');

alert(objFinanca.formatMoney());





    