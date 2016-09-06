<?php
    if (!defined('ABSPATH')){
        exit;
    }
    
    // Carrega todos os métodos do modelo
    $modelo->validate_register_form();
    $modelo->get_register_form(chk_array($parametros, 1));
    $modelo->del_user($parametros);

    //$modelo->get_agenda_consulta(); 
?>

<div class="row-fluid">
    <!-- Agenda bibliotecas js -->
    <script src="<?php echo HOME_URI; ?>/_agenda/js/pt-BR.js"></script>
    <script src="<?php echo HOME_URI; ?>/_agenda/js/moment.js"></script>
    <script src="<?php echo HOME_URI; ?>/_agenda/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?php echo HOME_URI; ?>/_agenda/js/locales/bootstrap-datetimepicker.pt-BR.js"></script>
    <!-- Final agenda js -->

    <div class="col-md-1 col-sm-1"></div>
    <div class="col-md-7 col-sm-7">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <!--refresh widget-->
                <div>
                    <div class="agenda-date">
                        <h5></h5>
                    </div>
                    <div style="background-color: rgb(245, 245, 245); padding: 4px; border-radius: 3px;" >
                        <div class="btn-group">
                            <button title="click para agendar sua consulta" class="btn btn-sm btn-default" data-toggle='modal' data-target='#add_evento'>
                                AGENDAR CONSULTA <i class="fa fa-calendar-plus-o" aria-hidden="false"></i>
                            </button>
                            <button class="btn btn-sm btn-primary" data-calendar-nav="prev">
                                <i class="fa fa-backward" aria-hidden="true"></i>
                            </button>
                            <button class="btn btn-sm btn-default" data-calendar-nav="today">Hoje</button>
                            <button class="btn btn-sm btn-primary" data-calendar-nav="next">
                                <i class="fa fa-forward" aria-hidden="true"></i>
                            </button>
                            <button class="btn btn-sm btn-warning" data-calendar-view="year">Ano</button>
                            <button class="btn btn-sm btn-warning active" data-calendar-view="month">Mês</button>
                            <button class="btn btn-sm btn-warning" data-calendar-view="week">Semana</button>
                            <button class="btn btn-sm btn-warning" data-calendar-view="day">Dia</button>
                            <select class="btn-sm btn-default" id="sel1">
                                <option selected>Selecione</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div id="calendar"></div> <!-- Aqui será exibido nosso calendario -->
                    </div>
                </div>
                <br>
                <div class="progress">
                    <div class="progress-bar progress-bar-success" style="width: 10%">
                        <span class="sr-only">35% Complete (success)</span>
                        Tratamento
                    </div>
                    <div class="progress-bar progress-bar-warning progress-bar-striped" style="width: 10%">
                        <span class="sr-only">20% Complete (warning)</span>
                    </div>
                    <div class="progress-bar progress-bar-danger" style="width: 10%">
                        <span class="sr-only">10% Complete (danger)</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--refresh widget-->
    <div class="col-md-3 col-sm-3">
        <!--refresh widget-->
        <div class="panel-agenda panel panel-default">
            <div class="panel-heading"><a id="refresh1" class="pull-right" href="#"><span class="fa fa-refresh"></span></a>Agendamentos</div>
            <div class="panel-body panel-refresh">
                <div class="refresh-container"><i class="refresh-spinner fa fa-spinner fa-spin fa-5x"></i></div>

                <div class="refresh-data"> 

                </div>
            </div>
        </div>
        <!--refresh widget-->

        <!--refresh widget-->
        <div class="panel-agenda panel panel-default">
            <div class="panel-heading"><a id="refresh1" class="pull-right" href="#"><span class="fa fa-refresh"></span></a>Agenda de horários</div>
            <div class="panel-body panel-refresh">
                <div class="refresh-container"><i class="refresh-spinner fa fa-spinner fa-spin fa-5x"></i></div>
            </div>
        </div>
        <!--refresh widget-->
    </div>
    <div class="col-md-1 col-sm-1"></div>
</div>
<!--ventana modal para el calendario-->
<div class="modal fade in" id="events-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="height: 400px">
                <p>One fine body &hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script src="<?php echo HOME_URI; ?>/_agenda/js/underscore-min.js"></script>
<script src="<?php echo HOME_URI; ?>/_agenda/js/calendar.js"></script>
<script type="text/javascript">
    (function ($) {
        //Criamos a data atual
        var date = new Date();
        var yyyy = date.getFullYear().toString();
        var mm = (date.getMonth() + 1).toString().length == 1 ? "0" + (date.getMonth() + 1).toString() : (date.getMonth() + 1).toString();
        var dd = (date.getDate()).toString().length == 1 ? "0" + (date.getDate()).toString() : (date.getDate()).toString();


        //Estabelecemos os valores do calendario
        var options = {
            // Definimos que os eventos aparecerão em uma janelo modal
            modal: '#events-modal',
            modal_title: 'Cadastro de consulta',
            // Dentro de um iframe
            modal_type: 'ajax',
            //Obtemos os eventos da base de dados
            events_source: '<?= HOME_URI; ?>/_agenda/get_consulta.php',
            // Mostramos o calendário no mês
            view: 'month',
            // No dia atual
            day: 'now',
            // Definimos o idioma padrão
            language: 'pt-BR',
            //Template de nosso calendario
            tmpl_path: '<?= HOME_URI; ?>/_agenda/tmpls/',
            tmpl_cache: false,
            // Hora de inicio
            time_start: '08:00',
            // Hora final de cada dia
            time_end: '17:00',
            // Intervalo de tempo entre as horas, neste são 30 minutos
            time_split: '5',
            // Definimos uma largura de 100% no calendário
            width: '100%',
            onAfterEventsLoad: function (events)
            {

                if (!events)
                {
                    return;
                }
                var list = $('#eventlist');
                list.html('');

                $.each(events, function (key, val)
                {
                    $(document.createElement('li'))
                            .html('<a href="' + val.url + '">' + val.title + '</a>')
                            .appendTo(list);
                });
            },
            onAfterViewLoad: function (view)
            {
                $('.agenda-date h5').text(this.getTitle());
                $('.btn-group button').removeClass('active');
                $('button[data-calendar-view="' + view + '"]').addClass('active');
            },
            classes: {
                months: {
                    general: 'label'
                }
            }
        };


        // Id da div onde mostrara o calendario
        var calendar = $('#calendar').calendar(options);

        $('.btn-group button[data-calendar-nav]').each(function ()
        {
            var $this = $(this);
            $this.click(function ()
            {
                calendar.navigate($this.data('calendar-nav'));
            });
        });

        $('.btn-group button[data-calendar-view]').each(function ()
        {
            var $this = $(this);
            $this.click(function ()
            {
                calendar.view($this.data('calendar-view'));
            });
        });

        $('#first_day').change(function ()
        {
            var value = $(this).val();
            value = value.length ? parseInt(value) : null;
            calendar.setOptions({first_day: value});
            calendar.view();
        });
    }(jQuery));
</script>

<div class="modal fade" id="add_evento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">
                    <i  class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                    AGENDAMENTO DE CONSULTAS
                </h4>
            </div>
            <div class="modal-body">
                <form action="" method="post">



                    <div class="form-group">
                        <label for="from">Começa as:</label>
                        <div class='input-group date' id='from'>
                            <input type='text' class="form-control from"  name="from" placeholder="00/00/0000 00:00" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="to">Termina as:</label>
                        <div class='input-group date' id='to'>
                            <input type='text' class="form-control to" name="to" placeholder="00/00/0000 00:00" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
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
                        <input type="text" required autocomplete="off" name="agenda_pac" class="form-control" id="paciente" placeholder="Nome do paciente...">
                    </div>
                    <div class="form-group">
                        <label for="desc">Descrição da consulta:</label>
                        <textarea id="desc" name="agenda_desc" required class="form-control" rows="3" placeholder="Descreva aqui informações extras da consultas..."></textarea>
                    </div>

                    <div class="modal-footer">

                        <div class="btn-group">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <i class="fa fa-times"></i>Cancelar
                            </button>
                        </div>
                        <div class="btn-group">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i> Gravar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
