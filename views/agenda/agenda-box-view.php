<?php
    if (!defined('ABSPATH')) {
        exit;
        
    }
    
    // Verifica se existe o parametro necessario 'ag'
    if(isset($_GET['ag'])){
        
            // Verifica se existe caractres especiais no id
            $id = $modelo->avaliar($_GET['ag']);
            
            // Metodo que armazena o evento especifico um vetor
            $row = $modelo->get_listar($id);

            // Paciente 
            $agenda_pac = $row['agenda_pac'];

            // Descrição
            $agenda_proc = $row['agenda_proc'];

            // Descrição
            $agenda_desc = $row['agenda_desc'];

            // Fecha inicio
            $inicio = $row['agenda_start_normal'];

            // Fecha Termino
            $final = $row['agenda_end_normal'];

            
    }else{
        header('Location:'.HOME_URI);
    }
    
    // Chama o método que pega os valores da base de dados e trás para edição no formulário
    $modelo->get_register_form($id);
  
?>




<div>
    <p>
        <b>Paciente:</b>
        <br> 
        <?= $agenda_pac; ?>
    </p>
    <p>
        <b>Procedimento:</b>
        <br> 
        <?= $agenda_proc; ?>
    </p>
    <p>
        <b>Descrição:</b>
        <br> 
        <?= $agenda_desc; ?>
    </p>
    <hr>
    <b>Início:</b> <mark><?= $inicio; ?></mark> <b>Término:</b> <mark><?= $final; ?></mark>
</div>

<br>
    <div class="btn-group">
        
        <a href="<?= HOME_URI ?>/agenda?ag=<?= $id; ?>" class="btn btn-sm btn-danger" title="Deletar" >
            <span class="glyphicon glyphicon-trash"> REMOVER</span>
        </a>
            

    </div>

    <div class="btn-group">
        <button id="Editar" class="btn btn-sm btn-success" data-toggle="modal" data-dismiss="modal" data-target="#edConsulta" title="Editar">
            <span class="glyphicon glyphicon-pencil"> EDITAR</span>
        </button>
    </div>


<!-- Start Modal de edição de consulta-->

<div class="modal fade" id="edConsulta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">
                    <i  class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                    EDIÇÃO DE CONSULTAS
                </h4>
            </div>
            <div class="modal-body">
                <form id="agenda-form-modal-cad" action="" method="post">
                   
                    <div class="form-group">
                        
                        <label for="from">Começa as:</label>
                        <div class="input-group date form_date col-md-5" id='from'>
                            <input type="hidden" name="agenda_id" value="<?= htmlentities(chk_array($modelo->form_data, 'agenda_id'));?>" >
                            <input class="form-control from" size="16" type="text" value="<?= htmlentities(chk_array($modelo->form_data, 'agenda_start_normal'));?>" name="from" placeholder="dd/mm/aaaa hh:mm">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                        
                    </div>

                    <div class="form-group">
                        <label for="to">Termina as:</label>
                        <div class="input-group date form_date col-md-5" id='to' >
                            <input class="form-control to" size="16" type="text" value="<?= htmlentities(chk_array($modelo->form_data, 'agenda_start_normal')); ?>" name="to" placeholder="dd/mm/aaaa hh:mm">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="tipo">Marcadores: </label>
                        <select id="tipo" name="agenda_class" class="form-control">
                            <option value="event-info">Media</option>
                            <option value="event-success">Normal</option>
                            <option value="event-important">Urgente</option>
                            <option value="event-warning">Advertencia</option>
                            <option value="event-special">Especial</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tipo">Procedimento:</label>
                        <select class="form-control" name="agenda_proc" id="tipo">
                            <option value="Canal">Canal</option>
                            <option value="Obturação">Obturação</option>
                            <option value="Implante">Implante</option>
                            <option value="Limpeza">Limpeza</option>
                            <option value="Orçamento">Orçamento</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="paciente">Paciente:</label>
                        <input type="text" required autocomplete="off" name="agenda_pac" class="form-control" id="paciente" placeholder="Nome do paciente..." value="<?= htmlentities(chk_array($modelo->form_data, 'agenda_pac')); ?>">
                    </div>
                    <div class="form-group">
                        <label for="desc">Descrição da consulta:</label>
                        <textarea id="desc" name="agenda_desc" required class="form-control" rows="3" placeholder="Descreva aqui informações extras da consultas..."><?= htmlentities(chk_array($modelo->form_data, 'agenda_desc')); ?></textarea>
                    </div>

                    <div class="modal-footer">

                        <div class="btn-group">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <i class="fa fa-times"></i> Cancelar
                            </button>
                        </div>
                        <div class="btn-group">
                            <button id="cad-agenda-modal" type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i> Gravar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--End Modal modal de edição de consultas-->


