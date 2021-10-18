<?php

class Activity extends MainModel
{
    public $db;

    public $global;

    private $formData = [];

    public function __construct($db = null)
    {
        $this->db = $db;
        $this->clientGetMethod = filter_input(INPUT_GET, 'action_type', FILTER_SANITIZE_STRING);
        $this->clientPostMethod = filter_input(INPUT_POST, 'action_type', FILTER_SANITIZE_STRING);
        $this->getPostValues = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->serverRequestMethod = filter_var(getenv('REQUEST_METHOD'), FILTER_SANITIZE_STRING);
    }

    public function actionType()
    {
        if ($this->serverRequestMethod === 'POST') {
            // Faz o loop dos dados do formulário inserindo os no vetor $form_data.
            foreach ($this->getPostValues as $key => $value) {
                # Configura os dados do post para a propriedade $form_data
                $this->formData[$key] = $value;
            } //--> End foreach

            // Verifica se existe o ID e decodifica se o mesmo existir.
            !empty($this->formData['id']) ? $this->formData['id']  = (int) GFunc::encodeDecode(0, $this->formData['id']) : false;

            if ($this->clientPostMethod == 'add') {
                $this->insertReg();
            } elseif ($this->clientPostMethod == 'update') {
                $this->updateReg($this->formData['id']);
            } elseif ($this->clientPostMethod == 'delete') {
                $this->delReg($this->formData['id']);
            } else {
                return;
            }
        } else {
            return;
        }
    }

    /**
     * Faz a inserção do registro no BD.
     * Obs.: se houver erro na inserção o valor "1" será retornado.
     *
     * @param int $lastId - valor do tipo inteiro.
     *
     * @return bool Retorna um valor boleano (true ou false).
     */
    public function insertReg()
    {
        $lastId = (int) $this->db->insert('Activities', [
            'id_project' => GFunc::chkArray($this->formData, 'id_project'),
            'name'       => GFunc::chkArray($this->formData, 'name'),
            'start_date' => GFunc::convertDataHora('d/m/Y', 'Y-m-d', $this->formData['start_date']),
            'end_date'   => GFunc::convertDataHora('d/m/Y', 'Y-m-d', $this->formData['end_date']),
            'finished'   => $this->formData['finished'],
        ]);

        // Verifica se a consulta está OK se sim envia o Feedback para o usuário.
        if ($lastId > 0) {
            // Deleta a variável.
            unset($lastId);

            # Feedback sucesso!
            die(true);
        } else {

            // Deleta a variável.
            unset($lastId);

            # Feedback erro!
            die(false);
        }
    }

    public function updateReg($id = 0)
    {
        $r = $this->db->update('Activities', 0, 'id', $id, [
            'id_project' => GFunc::chkArray($this->formData, 'id_project'),
            'name'       => GFunc::chkArray($this->formData, 'name'),
            'start_date' => GFunc::convertDataHora('d/m/Y', 'Y-m-d', $this->formData['start_date']),
            'end_date'   => GFunc::convertDataHora('d/m/Y', 'Y-m-d', $this->formData['end_date']),
            'finished'   => $this->formData['finished'],
        ]);

        // Verifica se a consulta está OK, se sim envia o Feedback para o usuário.
        if ($r > 0) {
            // Deleta a variável.
            unset($r);

            # Feedback sucesso!
            die(true);
        } else {
            // Deleta a variável.
            unset($r);

            # Feedback erro!
            die(false);
        }
    }

    public function delReg($id_encode)
    {
        # Recebe o ID do registro converte de string para inteiro.
        $id = GFunc::encodeDecode(false, $id_encode);

        # Executa a consulta na base de dados
        $r = $this->db->query("SELECT count(*) FROM `Activities` WHERE `id` = $id ");

        if ($r->fetchColumn() < 1) {

            # Destroy variáveis não mais utilizadas
            unset($id, $r, $id_encode);

            // Feedback erro
            die(false);
        } else {
            $this->db->delete('Activities', 'id', $id);
            unset($r, $id, $id_encode);
            die(true); // Feedback sucesso!
        }
    }


    public function listar($table = 'Activities', $column = '*', $condition = null)
    {
        return $this->db->select($table, $column, $condition);
    }
}