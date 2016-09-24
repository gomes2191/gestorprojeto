<?php
/**
 * MainModel - Modelo geral
 *
 * Essa classe servirá para manter os métodos que poderão ser utilizados em todos os modelos, ou seja, 
 * ela o ajuda a manter a reutilização de código sempre ativa.
 *
 * 
 * @package OdontoControl
 * @since 0.1
 */
class MainModel
{
	/**
	 * $form_data
	 *
	 * Os dados de formulários de envio.
	 *
	 * @access public
	 */	
	public $form_data;

	/**
	 * $form_msg
	 *
	 * As mensagens de feedback para formulários.
	 *
	 * @access public
	 */	
	public $form_msg;

	/**
	 * $form_confirma
	 *
	 * Mensagem de confirmação para apagar dados de formulários
	 *
	 * @access public
	 */
	public $form_confirma;

	/**
	 * $db
	 *
	 * O objeto da nossa conexão PDO
	 *
	 * @access public
	 */
	public $db;

	/**
	 * $controller
	 *
	 * O controller que gerou esse modelo
	 *
	 * @access public
	 */
	public $controller;

	/**
	 * $parametros
	 *
	 * Parâmetros da URL
	 *
	 * @access public
	 */
	public $parametros;

	/**
	 * $userdata
	 *
	 * Dados do usuário
	 *
	 * @access public
	 */
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
    *  
    **/    
    public function validaDataHora($date, $format = 'Y-m-d H:i:s') {
        if (!empty($date) && $v_date = date_create_from_format($format, $date)) {
            $v_date = date_format($v_date, $format);
            return ($v_date && $v_date == $date);
        }
        return false;
    } // End ValidaDataHora()
    
    /**
     *  @Acesso: public
     *  @Autor: Gomes - F.A.G.A <gomes.tisystem@gmail.com>
     *  @Função: converteData()
     *  @Descrição: Converte uma determinada data para o formato desejado.
     * 
     *  Exemplos:
     *  var_dump(converteData('d m Y', 'Y-m-d', '06 02 2025')); 2025-02-06
     *  var_dump(converteData('d-m-Y', 'm/d/Y H:i', '06-02-2014')); 02/06/2014 12:39
     *  var_dump(converteData('Y-m-d', 'l F Y  H:i', '2014-02-06')); Thursday February 2014  12:38
     * 
     **/
     public function converteData($format, $to_format, $date, $timezone = null) {
        if (!empty($date)) {
            $timezone = $timezone ? $timezone : new DateTimeZone(date_default_timezone_get());
            $f_date = date_create_from_format($format, $date, $timezone);
            return date_format($f_date, $to_format);
        }
        return false;
    } # End converteData()

    // Avaliar os dados inseridos pelo usuário e excluir caracteres indesejados.
    public function avaliar( $valor_ini ) {
        $nopermitido = array("'", '\\', '<', '>', "\"");
        $valor_1 = str_replace($nopermitido, "", $valor_ini);

        $valor = filter_var($valor_1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        return $valor;
    }

} // MainModel