<?php
# Class Minha Exception
class ErrosException extends Exception
{
    var $mailAdmin = 'sans.pds@gmail.com';

    function __construct($message = null, $code = 0)
    {
        parent::__construct($message, $code);
        date_default_timezone_set('Brazil/East');
        $hoje = date('Y-m-d H:i:s');
        $msg_error =
            "\n ====== $hoje ======" .
            "\n Erro no arquivo : " . $this->getFile() .
            "\n Linha:      " . $this->getLine() .
            "\n Mensagem:   " . $this->getMessage() .
            "\n Codigo:     " . $this->getCode() .
            "\n Trace(str): " . $this->getTraceAsString() . "\n";

        switch ($code) {
                # aviso de um erro mais grave
            case E_USER_ERROR: # requer muita atencao
            case E_ERROR:
            case E_USER_WARNING:
            case E_WARNING:
                return error_log($msg_error, 3,  Config::ABS_PATH . 'log_de_erros.txt');
                //return error_log($msg_error, 1, $this-&gt;mailAdmin, 'Possivel grave erro no sistema.');
                break;
                # um erro que pode ser guardado em log apenas
            case E_USER_NOTICE:
            case E_NOTICE:
                return error_log($msg_error, 3, Config::ABS_PATH . 'log_de_erros.txt');
                break;
            default:
                return false;
                break;
        }
    }

    public function getAdminMail()
    {
        return $this->mailAdmin;
    }
}
