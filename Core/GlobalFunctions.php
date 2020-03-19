<?php

//namespace Core;

Class GlobalFunctions {
    /**
    * Verifica chaves de arrays
    *
    * Verifica se a chave existe no array e se ela tem algum valor.
    * Obs.: Essa função está no escopo global, pois, vamos precisar muito da mesma.
    *
    * @param array  $array O array
    * @param string $key   A chave do array
    * @return string|null  O valor da chave do array ou nulo
    **/
    static function chk_array($array, $key) {
        // Verifica se a chave existe no array
        if (isset($array[$key]) && !empty($array[$key])) {
            // Retorna o valor da chave
            return $array[$key];
        }

        // Retorna nulo por padrão
        return null;
    } // chk_array


   function moeda($get_valor){

        $source = array('.', ',');
        $replace = array('', '.');
        $valor = str_replace($source, $replace, $get_valor); //remove os pontos e substitui a virgula pelo ponto
        return $valor; //retorna o valor formatado para gravar no banco
    }
    
    /**
     * @access: public
     * @author: Francisco Aparecido - F.A.G.A <gomes.tisystem@gmail.com>
     * @version: 0.2
     * @param: mixed variables
     * @param: string $table_name [required]
     * @param: array $conditions [required] <code>$conditions['where'=>['colunm'=>value,...]] $conditions['search'=>['colunm'=>value,...]]</code>
     * @return: array Retorna um array com os valores
     */
    static function isSite() {
        if (filter_input(INPUT_SERVER, 'REDIRECT_URL')) {
            $url_vetor = ( array_filter(explode('/', filter_input(INPUT_SERVER, 'REDIRECT_URL')), function($value) {
                return $value !== '';
            }));
        } else {
            $url_vetor = ( array_filter(explode('/', filter_input(INPUT_SERVER, 'REQUEST_URI')), function($value) {
                return $value !== '';
            }) );
        }
        ( count($url_vetor) > 1) ? array_shift($url_vetor) : FALSE;
        $sites = func_get_args();
        foreach ($sites as $site) {
            if (in_array($site, $url_vetor)) {
                return true;
            }
        }
        return false;
    }


     
    
//    public function __construct() {
//        $this->db = new SystemControlDB();
//    }

    /**
     *   @Acesso: public
     *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *   @Função: validaDataHora()
     *   @Descrição: Recebe uma determinada data e um verificador, verifica se a data atende
     *   o verificador passado e retorna true se sim e false se não
     *  
     *   Exemplos:
     *   var_dump(validaDataHora('2014-02-28 12:12:12')); # true
     *   var_dump(validaDataHora('2014-02-30 12:12:12')); # false
     *   var_dump(validaDataHora('2015-06-26', 'Y-m-d')); # true
     *   var_dump(validaDataHora('2015/06/26', 'Y-m-d')); # false
     *   var_dump(validaDataHora('28/02/2014', 'd/m/Y')); # true
     *   var_dump(validaDataHora('30/02/2014', 'd/m/Y')); # false
     *   var_dump(validaDataHora('14:50', 'H:i')); # true
     *   var_dump(validaDataHora('14:77', 'H:i')); # false
     *   var_dump(validaDataHora(14, 'H')); # true
     *   var_dump(validaDataHora('14', 'H')); # true
     * */
    function validaDataHora($date, $format = 'Y-m-d H:i:s') {
        if (!empty($date) && $v_date = date_create_from_format($format, $date)) {
            $v_date = date_format($v_date, $format);
            return ($v_date && $v_date == $date);
        }
        return NULL;
    }   # End ValidaDataHora()

    /**
     *  @Acesso: public
     *  @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *  @Versão: 0.1
     *  @Função: converteData()
     *  @Descrição: Converte uma determinada data para o formato desejado.
     *  @example:
     *  var_dump(converteData('d m Y', 'Y-m-d', '06 02 2025')); 2025-02-06
     *  var_dump(converteData('d-m-Y', 'm/d/Y H:i', '06-02-2014')); 02/06/2014 12:39
     *  var_dump(converteData('Y-m-d', 'l F Y  H:i', '2014-02-06')); Thursday February 2014  12:38
     * */
    function convertDataHora($format, $to_format, $date = NULL, $timezone = NULL) {
       # Verifica se a data informada e verdadeira se sim executa a função se não retorna NULL
       if($this->validaDataHora($date, $format)){
            $timezone = $timezone ? $timezone : new DateTimeZone(date_default_timezone_get());
            $f_date = date_create_from_format($format, $date, $timezone);
            $date_end = date_format($f_date, $to_format);
            return $date_end;
       }
        return NULL;
    }   # End converteData()

    /**
     *  @Acesso: public
     *  @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *  @Versão: 0.1
     *  @Função: avaliar()
     *  @Descrição: Avaliar os dados inseridos pelo usuário e excluir caracteres indesejados.
     * */
    function avaliar($valor_ini) {
        $nopermitido = ["'", '\\', '<', '>', "\""];
        $valor_1 = str_replace($nopermitido, "", $valor_ini);

        $valor = filter_var($valor_1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        return $valor;
    }   # End Avaliar()

    /**
     *  @Acesso: public
     *  @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *  @Versão: 0.1
     *  @Função: encode_decode()
     *  @Descrição: Codifica e decodifica  a string passada dependendo do parametro.
     * */
    function encode_decode($encode = FALSE, $decode = FALSE) {
        if ($encode == TRUE) {

            $rand = rand(100, 900);

            $encode = base64_encode($encode . $rand);
            return $encode;
        } else {
            $decode = base64_decode($decode);
            $_decode = (int) substr($decode, 0, -3);

            return $_decode;
        }
    }

    /**
    *  @Acesso: public
    *  @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
    *  @Versão: 0.1
    *  @Função: encode_decode()
    *  @Descrição: Remove tudo o que não for número.
    * */
    function only_filter_number($valor) {
        return (int) (preg_replace('/[^0-9]/', '', $valor));
    }
    
    /**
    *  @Acesso: public
    *  @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
    *  @Versão: 0.2
    *  @Função: moneyFloat()
    *  @Descrição: Converte o valor da moeda em real para float para armazenar na base de dado.
    * */
    function moneyFloat($str){
        return (float) str_replace(',', '.', str_replace('.','', $str));
    }
    
    /**
    *  @Acesso: public
    *  @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
    *  @Versão: 0.1
    *  @Função: format_padrao()
    *  @Descrição: Verifica se o valor passado corresponde ao campo requerido
    * */
    function format_padrao($string, $tipo = "") {
        $valor = preg_replace("[^0-9]", "", $string);
        if (!$tipo) {
            switch (strlen($valor)) {
                case 11: $tipo = 'fone';
                    break;
                case 8: $tipo = 'cep';
                    break;
                case 11: $tipo = 'cpf';
                    break;
                case 14: $tipo = 'cnpj';
                    break;
            }
        }
        switch ($tipo) {
            case 'fone':
                $valor = '(' . substr($valor, 0, 2) . ') ' . substr($valor, 2, 4) .
                        '-' . substr($valor, 6);
                break;
            case 'cep':
                $valor = substr($valor, 0, 5) . '-' . substr($valor, 5, 3);
                break;
            case 'cpf':
                $valor = substr($valor, 0, 3) . '.' . substr($valor, 3, 3) .
                        '.' . substr($valor, 6, 3) . '-' . substr($valor, 9, 2);
                break;
            case 'cnpj':
                $valor = substr($valor, 0, 2) . '.' . substr($valor, 2, 3) .
                        '.' . substr($valor, 5, 3) . '/' .
                        substr($valor, 8, 4) . '-' . substr($valor, 12, 2);
                break;
            case 'rg':
                $valor = substr($valor, 0, 2) . '.' . substr($valor, 2, 3) .
                        '.' . substr($valor, 5, 3);
                break;
        }
        return $valor;
    }

    /**
    * @access: public
    * @author: Francisco Aparecido - F.A.G.A <gomes.tisystem@gmail.com>
    * @version: 0.2
    * @description: Nome das classes
    * @param: mixed variables
    * @return: object Retorna um object com os valores
    **/
    public static function autoLoad($nomeDaClasse) {
        
        $pastas = ['/Core/', '/interfaces/'];
        
        foreach ($pastas as $pasta) {
            $fileParcial = ABSPATH . $pasta . $nomeDaClasse;
            if (( file_exists($fileParcial . '.class.php') ) OR ( file_exists($fileParcial . '.interf.php')) ) {
                ($pasta === '/Core/') ? require_once($fileParcial . '.class.php') : require_once($fileParcial . '.interf.php');
                
                unset($fileParcial, $pasta, $nomeDaClasse, $pastas, $nomeDaClasse);

                return;
            }
        } #End autoLoad
       
        //require_once (dirname(__DIR__) . '/includes/404.php');

        die('Erro: Classes não encontrada.');
       
        unset($fileParcial, $pasta, $nomeDaClasse, $pastas, $nomeDaClasse);
        exit();
    }
   
} # End Class

 # Registra a função dada como implementação de __autoload()
 spl_autoload_register('GlobalFunctions::autoLoad');