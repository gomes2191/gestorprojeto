<?php

/**
 *  @Autor: F.A.G.A <gomes.tisystem@gmail.com>
 *  @Class: MainModel - Modelo base
 *  @Descrição: Essa classe servirá para manter os métodos que poderão ser utilizados em todos os modelos, ou seja, ela o ajuda a manter a reutilização de código sempre ativa.
 * 
 *  @Pacote: OdontoControl
 *  @Versão: 0.1
 * */
class MainModel {

    /**
     *  @Acesso: public
     *  @Autor: F.A.G.A <gomes.tisystem@gmail.com>
     *  @Descrição: Armazena os dados passado no formulário via post.
     * */
    public $form_data;

    /**
     *  @Acesso: public
     *  @Autor: F.A.G.A <gomes.tisystem@gmail.com>
     *  @Descrição: Responsavel por armazenar as mensagen de feedback ao usuário.
     */
    public $form_msg;

    /**
     *  @Acesso: public
     *  @Autor: F.A.G.A <gomes.tisystem@gmail.com>
     *  @Descrição: Armazena a mensagem de confirmação ao apagar algum registro
     * */
    public $form_confirma;

    /**
     *  @Acesso: public
     *  @Autor: F.A.G.A <gomes.tisystem@gmail.com>
     *  @Descrição: O objeto da nossa conexão PDO.
     * */
    public $db;

    /**
     *  @Acesso: public
     *  @Autor: F.A.G.A <gomes.tisystem@gmail.com>
     *  @Descrição: O controller que gerou esse modelo
     * */
    public $controller;

    /**
     *  @Acesso: public
     *  @Autor: F.A.G.A <gomes.tisystem@gmail.com>
     *  @Descrição: Parâmetros da URL
     * */
    public $parametros;

    /**
     *  @Acesso: public
     *  @Autor: F.A.G.A <gomes.tisystem@gmail.com>
     *  @Descrição: Dados do usuário
     * */
    public $userdata;

    /**
     *   @Acesso: public
     *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *   @Função: validaDataHora()
     *   @Descrição: Recebe uma determinada data e um verificador, verifica se a data atende o verificador passado e retorna true se sim e false se não
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
    public function validaDataHora($date, $format = 'Y-m-d H:i:s') {
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
     * 
     *  Exemplos:
     *  var_dump(converteData('d m Y', 'Y-m-d', '06 02 2025')); 2025-02-06
     *  var_dump(converteData('d-m-Y', 'm/d/Y H:i', '06-02-2014')); 02/06/2014 12:39
     *  var_dump(converteData('Y-m-d', 'l F Y  H:i', '2014-02-06')); Thursday February 2014  12:38
     * */
    public function converteData($format, $to_format, $date = NULL, $timezone = NULL) {
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
    public function avaliar($valor_ini) {
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
    public function encode_decode($encode = FALSE, $decode = FALSE) {

        if ($encode == TRUE) {

            $rand = rand(100, 900);

            $encode = base64_encode($encode . $rand);
            return $encode;
        } else {
            $decode = base64_decode($decode);
            $_decode = substr($decode, 0, -3);

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
    public function only_filter_number($valor) {
        $valor_final = preg_replace('/[^0-9]/', '', $valor);
        return $valor_final;
    }
    
    /**
     *  @Acesso: public
     *  @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *  @Versão: 0.1
     *  @Função: format_padrao()
     *  @Descrição: Verifica se o valor passado corresponde ao campo requerido
     * */
    public function format_padrao($string, $tipo = "") {
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
     *   @Acesso: public
     *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *   @Versão: 0.1
     *   @Função: get_table_data() 
     *   @Descrição: Recebe os valores passado na função, $campo, $tabela e $id, efetua a consulta e retorna o resultado. 
     * */
    public function get_table_data( $tipo, $campo, $table, $id_campo, $get_id, $id, $sqlUpdate, $sqlSelect  ) {
        
        if ($tipo == 1){
             
            # Simplesmente seleciona os dados na base de dados
            $query = $this->db->query(" SELECT  $campo FROM $table  ORDER BY $id ");
             
            # Destroy todas as variaveis nao mais utilizadas
            unset($tipo, $campo, $table, $id_campo, $get_id, $id);
           
            # Retorna os valores da consulta
            return $query->fetchAll(PDO::FETCH_ASSOC);
            
        }elseif ($tipo == 2){
            
            # Simplesmente seleciona os dados na base de dados
            $query = $this->db->query(" SELECT  $campo FROM $table WHERE $id_campo = $get_id ORDER BY $id ");
            
            # Destroy todas as variaveis nao mais utilizadas
            unset($tipo, $campo, $table, $id_campo, $get_id, $id);
            
            # Retorna os valores da consulta
            return $query;
            
        }elseif ($tipo == 3){
            # Faz o update na tabela
            $query = $this->db->query($sqlUpdate);
             
            # Destroy todas as variaveis nao mais utilizadas
            //unset($tipo, $campo, $table, $id_campo, $get_id, $id);
           
            # Retorna os valores da consulta
            return $query;
        }elseif($tipo == 4) {
            # Simplesmente seleciona os dados na base de dados
            $queryGet = $this->db->query($sqlSelect);
           
//            while ( $results = $queryGet->fetchAll(PDO::FETCH_ASSOC)) {
//                $results_array[] = $results;
//            }
            
            return $queryGet->fetchAll(PDO::FETCH_BOTH);
        }
         
    }   # End get_table_data()
    
    /**
     *  @Acesso: public
     *  @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *  @Versão: 0.1
     *  @Função: search()
     *  @Descrição: .
     * */
    public function search($search_string, $time, $query_count, $query) {
        # Timestamp entry of search for later display
        $time_entry     = $this->get_table_data(3, NULL, NULL, NULL, NULL, NULL, $time, NULL);

        # Count how many times a query occurs
        $query_count    = $this->get_table_data(3, NULL, NULL, NULL, NULL, NULL, $query_count, NULL);

        # Do the search
        $result_array   = $this->get_table_data(4, NULL, NULL, NULL, NULL, NULL, NULL, $query); 
            
        # Check for results
        if (isset($result_array)) {
            
            // Output HTML formats
            $html  = '<tr>';
            $html .=    '<td class="small">nameString</td>';
            $html .=    '<td class="small">compString</td>';
            $html .=    '<td class="small">zipString</td>';
            $html .=    '<td class="small">cityString</td>';
            $html .= '</tr>';
            
            foreach ($result_array as $result) {
                # var_dump($result);die;
                # Output strings and highlight the matches
                $d_name = preg_replace("/" . $search_string . "/i", "<b>" . $search_string . "</b>", $result['pay_cat']);
                $d_comp = $result['pay_id'];
                $d_zip = $result['pay_venc'];
                $d_city = $result['pay_date_pay'];
                # Replace the items into above HTML
                $o = str_replace('nameString', $d_name, $html);
                $o = str_replace('compString', $d_comp, $o);
                $o = str_replace('zipString', $d_zip, $o);
                $o = str_replace('cityString', $d_city, $o);
                # Output it
                echo($o);
            }
        } else {
            # Replace for no results
            $o = str_replace('nameString', '<span class="label label-danger">Não existe</span>', $html);
            $o = str_replace('compString', '', $o);
            $o = str_replace('zipString', '', $o);
            $o = str_replace('cityString', '', $o);
            # Output
            echo($o);
        }
        
    }
    
    

}   # End MainModel