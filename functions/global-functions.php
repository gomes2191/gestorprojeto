<?php

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
    function chk_array($array, $key) {
        // Verifica se a chave existe no array
        if (isset($array[$key]) && !empty($array[$key])) {
            // Retorna o valor da chave
            return $array[$key];
        }

        // Retorna nulo por padrão
        return null;
    } // chk_array


   function moeda($get_valor) {

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
    function isSite() {
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

    /**
    * @access: public
    * @author: Francisco Aparecido - F.A.G.A <gomes.tisystem@gmail.com>
    * @version: 0.2
    * @param: mixed variables
    * @return: object Retorna um object com os valores
    **/
    function autoLoad($nomeDaClasse) {
        
        $pastas = ['/classes/', '/interfaces/'];
        
        foreach ($pastas as $pasta) {
            $fileParcial = ABSPATH . $pasta . $nomeDaClasse;
            if (( file_exists($fileParcial . '.class.php') ) OR ( file_exists($fileParcial . '.interf.php'))) {
                ($pasta === '/classes/') ? require_once($fileParcial . '.class.php') : require_once($fileParcial . '.interf.php');
                unset($fileParcial, $pasta, $nomeDaClasse, $pastas, $nomeDaClasse);
                return;
            }
        }
        require_once (ABSPATH . '/includes/404.php');
        unset($fileParcial, $pasta, $nomeDaClasse, $pastas, $nomeDaClasse);
        exit();
    }
    
    # Registra a função dada como implementação de __autoload()
    spl_autoload_register('autoLoad');



