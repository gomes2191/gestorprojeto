<?php   
    if (!defined('ABSPATH'))    {   exit();    } elseif (isset($_GET['ag'])){
        $id = $modelo->avaliar($_GET['ag']);
        $modelo->delRegister($id);
        unset($id);
    }
    
    // Carrega todos os metódos necessarios
    $modelo->validate_register_form();
    $form_msg = $modelo->form_msg;
?>

    <div class="row">
        <div class="col-md-9 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <div class="btn-group btn-group-justified" role="group" aria-label="First group">
                        <button type="button" title="Adiciona nova consulta no sistema" class="btn btn-sm btn-success btn-responsive" data-toggle='modal' data-target='#addRegister'>
                            <i class="fa fa-calendar-plus-o" aria-hidden="false"></i> Nova Consulta 
                        </button>
                    </div>
                    
                    <div class="btn-group btn-group-justified" role="group" aria-label="First group">
                        <button class="btn btn-sm btn-primary btn-responsive" data-calendar-nav="prev">
                            <i class="fa fa-backward" aria-hidden="true"></i>
                        </button>
                        <button class="btn btn-sm btn-info btn-responsive" data-calendar-nav="today">Hoje</button>
                        <button class="btn btn-sm btn-primary btn-responsive" data-calendar-nav="next">
                            <i class="fa fa-forward" aria-hidden="true"></i>
                        </button>
                    </div>
                    
                    <div class="btn-group btn-group-justified" role="group" aria-label="First group">
                        <button class="btn btn-sm btn-info btn-responsive" data-calendar-view="year">Ano</button>
                        <button class="btn btn-sm btn-warning active btn-responsive" data-calendar-view="month">Mês</button>
                        <button class="btn btn-sm btn-info btn-responsive" data-calendar-view="week">Semana</button>
                        <button class="btn btn-sm btn-warning btn-responsive" data-calendar-view="day">Dia</button>
                    </div>
                    <h5 class="badge badge-info calendarTitle"></h5>
                </div> <!--End botoes-->
                
                <div class="col-md-3 col-sm-8 col-xs-8">
                    <div class="form-group">
                        <select class="form-control form-control-sm" id="sel1">
                            <option selected>Escolha agenda</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                </div>
            </div> <!--End row-->

            <div class="row">
                <div id="calendar" class="col-md-12 col-sm-12 col-xs-12"></div>
            </div>
            
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <span class="badge badge-default">Default</span>
                    <span class="badge badge-primary">Primary</span>
                    <span class="badge badge-success">Success</span>
                    <span class="badge badge-info">Info</span>
                    <span class="badge badge-warning">Warning</span>
                    <span class="badge badge-danger">Danger</span>
                </div>
            </div><!--End row-->
        </div><!-- /End agenda container-->
        
        <!--refresh widget-->
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="card card-info mb-3 text-center">
                <div class="card-header">
                    AGENDAMENTOS DO DIA
                </div>
                <div class="card-block">
                    <div class="paginadorAgenda alert alert-info" role="alert"></div>
                    <ul id="listConsul" class="list-group">

                    </ul>
                </div>
                <div class="card-footer text-muted">
                    <ul class="pagination pagination-sm" id="paginador">

                    </ul>
                </div>
            </div><!--/End widget-->
        </div><!-- /End Container painel-->
    </div><!--/End row-->

    <!--ventana modal para el calendario-->
    <div class="modal fade in" id="events-modal">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" >
                        <i  class="glyphicon glyphicon-info-sign" aria-hidden="true"></i>
                        INFORMAÇÕES SOBRE A CONSULTA
                    </h4>
                </div>
                <div class="modal-body modal-agenda-visao" >

                </div>

                <div class="modal-footer">

                    <div class="btn-group">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar X</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script src="<?= HOME_URI; ?>/_agenda/js/underscore-min.js"></script>
    <script src="<?= HOME_URI; ?>/_agenda/js/calendar.js"></script>
    <script type="text/javascript">

        (function($) {
            window.history.pushState("agenda", "", "agenda");
            "use strict";
            //Criamos a data atual
            var date = new Date();
            var yyyy = date.getFullYear().toString();
            var mm = (date.getMonth() + 1).toString().length == 1 ? "0" + (date.getMonth() + 1).toString() : (date.getMonth() + 1).toString();
            var dd = (date.getDate()).toString().length == 1 ? "0" + (date.getDate()).toString() : (date.getDate()).toString();

            var options = {
                // Definimos que os eventos aparecerão em uma janelo modal
                modal: '#events-modal',
                async: true,
                modal_title: 'Cadastro de consulta',
                // Dentro de um iframe
                modal_type: 'ajax',
                //Obtemos os eventos da base de dados
                events_source: '<?= HOME_URI; ?>/agenda/return-json',
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
                time_split: '10',
                // Definimos uma largura de 100% no calendário
                width: '100%',
                    onAfterEventsLoad: function(events) {
                            if(!events) {
                                    return;
                            }
                            var list = $('#eventlist');
                            list.html('');

                            $.each(events, function(key, val) {
                                    $(document.createElement('li'))
                                            .html('<a href="' + val.url + '">' + val.title + '</a>')
                                            .appendTo(list);
                            });
                    },
                    onAfterViewLoad: function(view) {
                            $('.calendarTitle').text(this.getTitle());
                            $('.btn-group button').removeClass('active');
                            $('button[data-calendar-view="' + view + '"]').addClass('active');
                    },
                    classes: {
                            months: {
                                    general: 'label'
                            }
                    }
            };

            var calendar = $('#calendar').calendar(options);

            $('.btn-group button[data-calendar-nav]').each(function() {
                    var $this = $(this);
                    $this.click(function() {
                            calendar.navigate($this.data('calendar-nav'));
                    });
            });

            $('.btn-group button[data-calendar-view]').each(function() {
                    var $this = $(this);
                    $this.click(function() {
                            calendar.view($this.data('calendar-view'));
                    });
            });

            $('#first_day').change(function(){
                    var value = $(this).val();
                    value = value.length ? parseInt(value) : null;
                    calendar.setOptions({first_day: value});
                    calendar.view();
            });

            $('#language').change(function(){
                    calendar.setLanguage($(this).val());
                    calendar.view();
            });

            $('#events-in-modal').change(function(){
                    var val = $(this).is(':checked') ? $(this).val() : null;
                    calendar.setOptions({modal: val});
            });
            $('#format-12-hours').change(function(){
                    var val = $(this).is(':checked') ? true : false;
                    calendar.setOptions({format12: val});
                    calendar.view();
            });
            $('#show_wbn').change(function(){
                    var val = $(this).is(':checked') ? true : false;
                    calendar.setOptions({display_week_numbers: val});
                    calendar.view();
            });
            $('#show_wb').change(function(){
                    var val = $(this).is(':checked') ? true : false;
                    calendar.setOptions({weekbox: val});
                    calendar.view();
            });
            $('#events-modal .modal-header, #events-modal .modal-footer').click(function(e){
                    //e.preventDefault();
                    //e.stopPropagation();
            });
    }(jQuery));

    </script>

    
    <!-- Modal -->
    <div class="modal fade" id="addRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i  class="fa fa-calendar-plus-o" aria-hidden="true"></i> Inserir consulta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="agenda-form-modal-cad" action="" method="post">
                        <div class="form-group">
                            <label for="from">Começa as:</label>
                            <input id="from" class="form-control dataTime" size="16" type="text" value="" name="from" placeholder="dd/mm/aaaa hh:mm">
                        </div>

                        <div class="form-group">
                            <label for="to">Termina as:</label>
                            <input id="to" class="form-control dataTimeEnd" type="text" value="" name="to" placeholder="dd/mm/aaaa hh:mm">
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
                            <textarea id="desc" name="agenda_desc" required class="form-control" rows="4" placeholder="Descreva aqui informações extras da consultas..."></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">X Fechar</button>
                    <button type="button" id="cad-agenda-modal" class="btn btn-primary">Inserir</button>
                </div>
            </div>
        </div>
    </div>
