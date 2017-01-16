/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */




function Financeiro() {

    var nome;
    var idade;
    var curso;
    var n, c, d, t, finalNum;
    //var numClear;
    var numUS;



    this.setNome = function (vNome) {
        this.nome = vNome;
    };

    this.setIdade = function (vIdade) {
        this.idade = vIdade;
    };

    this.setCurso = function (vCurso) {
        this.curso = vCurso;
    };
    
    // usando   formatMoney(100000, 2, '.', ',') //retorna 1.000,00
    this.setMoneyCash = function (vN, vC, vD, vT) {
        this.n = vN;
        this.c = vC;
        this.d = vD;
        this.t = vT;  
    };
    
    this.setClear = function (vNumClear){
        this.numClear = vNumClear;
    };
    
    this.setUS = function (vNumUS) {
        this.numUS = vNumUS;
    }

    this.getNome = function () {
        return this.nome;
    };

    this.getIdade = function () {
        return this.idade;
    };

    this.getCurso = function () {
        return this.curso;
    };
    
    this.getMoneyCash = function () {
        return this.finalNum;
    };

    this.getClear = function () {
        return this.numClear;
    };
    
    this.getUS = function () {
        return this.numUS;
    };


    this.mostraDados = function () {
        alert("Nome do aluno: " + this.nome + "\nIdade: " + this.idade + "\nCurso: " + this.curso);
    };

    this.formatMoneyCash = function () {
        this.c = isNaN(this.c = Math.abs(this.c)) ? 2 : this.c, this.d = this.d == undefined ? "," : this.d, this.t = this.t == undefined ? "." : this.t, s = this.n < 0 ? "-" : "", i = parseInt(this.n = Math.abs(+this.n || 0).toFixed(this.c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
        return this.finalNum  = (s + (j ? i.substr(0, j) + this.t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + this.t) + (this.c ? this.d + Math.abs(this.n - i).toFixed(this.c).slice(2) : ""));
    };
    
    this.clearNumber = function (){
        numsStr = this.numClear.replace(/[^0-9]/g,'');
        return this.numClear = parseInt(numsStr);
    };
    
    this.mostrarUS = function () {
        
        if( (this.numUS.indexOf(",") >= 0 ) && ( this.numUS.indexOf(".") >= 0 ) ){
            //console.log('string encontrada');
            return this.numUS = this.numUS.replace(',', '.');
           
            
        }{
            return this.numUS = this.numUS.replace(',', '.');
        }
        
    };
}

    // Exemplo de uso

    var objFinanca = new Financeiro();

    objFinanca.setMoneyCash('12', 2, ',', '.');

    objFinanca.formatMoneyCash();

    console.log(objFinanca.getMoneyCash());
    





    