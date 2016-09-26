<?php

/**
 *  @Autor: F.A.G.A <gomes.tisystem@gmail.com>
 *  @Class: MainModel - Modelo base
 *  @Descrição: Essa classe servirá para manter os métodos que poderão ser utilizados em todos os modelos, ou seja, ela o ajuda a manter a reutilização de código sempre ativa.
 * 
 *  @Pacote: OdontoControl
 *  @Versão: 0.1
 **/
class MainModel {

    /**
     *  @Acesso: public
     *  @Autor: F.A.G.A <gomes.tisystem@gmail.com>
     *  @Descrição: Armazena os dados passado no formulário via post.
     **/
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
     **/
    public $form_confirma;

    /**
     *  @Acesso: public
     *  @Autor: F.A.G.A <gomes.tisystem@gmail.com>
     *  @Descrição: O objeto da nossa conexão PDO.
     **/
    public $db;

    /**
     *  @Acesso: public
     *  @Autor: F.A.G.A <gomes.tisystem@gmail.com>
     *  @Descrição: O controller que gerou esse modelo
     **/
    public $controller;

    /**
     *  @Acesso: public
     *  @Autor: F.A.G.A <gomes.tisystem@gmail.com>
     *  @Descrição: Parâmetros da URL
     **/
    public $parametros;

    /**
     *  @Acesso: public
     *  @Autor: F.A.G.A <gomes.tisystem@gmail.com>
     *  @Descrição: Dados do usuário
     **/
    public $userdata;

    /**
     * Inverte datas 
     *
     * Obtém a data e inverte seu valor.
     * De: d-m-Y H:i:s para Y-m-d H:i:s ou vice-versa.
     *
     * @since 0.1
     * @access public
     * @param string $data A data
     */
//	public function inverte_data( $data = null ) {
//	
//		// Configura uma variável para receber a nova data
//		$nova_data = null;
//		
//		// Se a data for enviada
//		if ( $data ) {
//		
//			// Explode a data por -, /, : ou espaço
//			$data = preg_split('/\-|\/|\s|:/', $data);
//			
//			// Remove os espaços do começo e do fim dos valores
//			$data = array_map( 'trim', $data );
//			
//			// Cria a data invertida
//			$nova_data .= chk_array( $data, 2 ) . '-';
//			$nova_data .= chk_array( $data, 1 ) . '-';
//			$nova_data .= chk_array( $data, 0 );
//			
//			// Configura a hora
//			if ( chk_array( $data, 3 ) ) {
//				$nova_data .= ' ' . chk_array( $data, 3 );
//			}
//			
//			// Configura os minutos
//			if ( chk_array( $data, 4 ) ) {
//				$nova_data .= ':' . chk_array( $data, 4 );
//			}
//			
//			// Configura os segundos
//			if ( chk_array( $data, 5 ) ) {
//				$nova_data .= ':' . chk_array( $data, 5 );
//			}
//		}
//		
//		// Retorna a nova data
//		return $nova_data;
//	
//	} // inverte_data
    
    /**
     *   @Acesso: public
     *   @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *   @Função: validaDataHora()
     *   @Descrição: Recebe uma determinada data e um verificador, verifica se a data atende o verificador passado e retorna true se sim e false se não
     *  
     *   Exemplos:
     *   var_dump(validaData('2014-02-28 12:12:12')); # true
     *   var_dump(validaData('2014-02-30 12:12:12')); # false
     *   var_dump(validaData('2015-06-26', 'Y-m-d')); # true
     *   var_dump(validaData('2015/06/26', 'Y-m-d')); # false
     *   var_dump(validaData('28/02/2014', 'd/m/Y')); # true
     *   var_dump(validaData('30/02/2014', 'd/m/Y')); # false
     *   var_dump(validaData('14:50', 'H:i')); # true
     *   var_dump(validaData('14:77', 'H:i')); # false
     *   var_dump(validaData(14, 'H')); # true
     *   var_dump(validaData('14', 'H')); # true
     * */
    public function validaDataHora($date, $format = 'Y-m-d H:i:s') {
        if (!empty($date) && $v_date = date_create_from_format($format, $date)) {
            $v_date = date_format($v_date, $format);
            return ($v_date && $v_date == $date);
        }
        return false;
    } # End ValidaDataHora()

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
    public function converteData($format, $to_format, $date, $timezone = null) {
        if (!empty($date)) {
            $timezone = $timezone ? $timezone : new DateTimeZone(date_default_timezone_get());
            $f_date = date_create_from_format($format, $date, $timezone);
            return date_format($f_date, $to_format);
        }
        return false;
    } # End converteData()

    /**
     *  @Acesso: public
     *  @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *  @Versão: 0.1
     *  @Função: avaliar()
     *  @Descrição: Avaliar os dados inseridos pelo usuário e excluir caracteres indesejados.
     **/
    public function avaliar($valor_ini) {
        $nopermitido = ["'", '\\', '<', '>', "\""];
        $valor_1 = str_replace($nopermitido, "", $valor_ini);

        $valor = filter_var($valor_1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        return $valor;
    } # End Avaliar()

} # End MainModel