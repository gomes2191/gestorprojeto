<?php

//require_once('Config.php');

/**
 * Classe responsavel pelo gerenciamento manual
 * de erro do sistema.
 * Caso um erro desconhecido seja encontrado,
 * a classe retorna o controle de erros para
 * o ambiente PHP
 **/
class Erros
{
    private $_adminMail = 'gomes.tisystem@gmail.com';
    protected $log_notices = 'log_notices.log';
    protected $log_warnings = 'log_warnings.log';
    protected $log_errors = 'log_errors.log';
    private  $code = 0;
    protected $mensagem = '';
    protected $arquivo = '';
    protected $linha = 0;
    protected $arr_contexto = array();
    protected $dataHora;

    // ------------------------------------------------------
    function __construct(
        $pcode,
        $pmensagem,
        $parquivo,
        $plinha,
        $pcontexto
    ) {
        $this->code = $pcode;
        $this->mensagem = $pmensagem;
        $this->arquivo = $parquivo;
        $this->linha = $plinha;
        $this->arr_contexto = $pcontexto;
        $this->dataHora = date('d/m/Y H:m:s');
    }

    // ------------------------------------------------------
    /**
     * Metodo responsavel por controlar os erros que
     * acontecem no sistema. Necessita ser Static para
     * ser possivel a chamada externa pelo PHP
     *
     * @param int $errno - level de erro
     * @param string $errstr - mensagem de erro
     * @param string $errfile - nome do arquivo com erro
     * @param int $errline - numero da linha
     * @param array $errcontext - contexto em que erro ocorreu
     * @return bool
     **/
    public static function controlar(
        $errno,     // numero do erro
        $errstr,    // mensagem
        $errfile,   // arquivo em que ocorreu o erro
        $errline,   // linha do erro
        $errcontext // contexto
    ) {

        // criando uma instancia propria deste objeto...
        $self = new self(
            $errno,
            $errstr,
            $errfile,
            $errline,
            $errcontext
        );

        // decidindo qual metodo chamar para o erro...
        switch ($errno) {

            case E_USER_NOTICE:
            case E_NOTICE:
                $self->controlar_notices();
                break;

            case E_USER_WARNING:
            case E_WARNING:
                $self->controlar_warning();
                break;

                // esse pode ser um erro fatal
            case E_USER_ERROR:
            case E_ERROR:
                $self->controlar_erro();
                break;

                // um erro desconhecido...
            default:
                // retornar false, faz com que o PHP
                // se encarregue de controlar esse erro.
                return false;
        }
    }

    // ------------------------------------------------------
    /**
     * Funcao responsavel pelo controle de
     * E_ERROR e E_USER_ERROR
     * que caracterizam os problemas mais
     * graves em PHP que necessitam de cuidado
     * especial.
     *
     * @return
     **/
    protected function controlar_erro()
    {
        // guardando a saida em buffer...
        ob_start();
        // joga no buffer funcoes chamadas,
        // e arquivos solicitados pelo script
        debug_print_backtrace();
        // retorna o buffer como uma string e
        // desliga a funcao ob_start()
        $backtrace = ob_get_flush();
        // gerando mensagem de erro com EOT, para que o
        // arquivo de log fique alinhado a esquerda sem
        // espacos
        $conteudo = <<<EOT
            -------- Relatório do Erro --------
            Data/Hora: $this->dataHora
            Código: $this->code;
            Mensagem: $this->mensagem
            Arquivo: $this->arquivo
            Linha: $this->linha

        EOT;

        //Backtrace: $backtrace

        $headers = "From: someone@something.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=utf8\r\n";

        // enviando mensagem por email ao admin
        //error_log($conteudo, 1, $this->_adminMail, $headers);

        error_log($conteudo . "\n", 3, Config::ABS_PATH . '/logs/' . $this->log_errors);

        //return error_log($conteudo . "\n", 3, Config::ABS_PATH . '/logs/' . $this->log_errors);

        // exit(1) indica um erro de script
        //exit(1);
    }

    // ------------------------------------------------------
    protected function controlar_warning()
    {
        $conteudo = <<<EOT
            -------- Relatório do Erro --------
            Data/Hora: $this->dataHora
            Código: $this->code;
            Mensagem: $this->mensagem
            Arquivo: $this->arquivo
            Linha: $this->linha

        EOT;

        // enviando mensagem de erro ao admin do sistema
        //return error_log($conteudo, 1, $this->_adminMail, 'E_Warning no Sistema');
        error_log($conteudo . "\n", 3, Config::ABS_PATH . '/logs/' . $this->log_warnings);
    }

    // ------------------------------------------------------
    protected function controlar_notices()
    {

        $conteudo = <<<EOT
            -------- Relatório do Erro --------
            Data/Hora: $this->dataHora
            Código: $this->code
            Mensagem: $this->mensagem
            Arquivo: $this->arquivo
            Linha: $this->linha

        EOT;

        error_log($conteudo . "\n", 3, Config::ABS_PATH . '/logs/' . $this->log_notices);
    }
} // fim da classe:  ControleDeErros


// por fim, solicitamos educadamente ao PHP
// que nos de o controle sobre a gerencia de erros
// do sistema. Passando como parametro, o nome da
// classe e o nome do metodo que trata os erros.
set_error_handler(array('Erros', 'controlar'));
