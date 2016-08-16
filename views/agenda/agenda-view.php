<?php if (!defined('ABSPATH')) exit; ?>

<div class="row-fluid">
    <?php
        // Carrega todos os métodos do modelo
        $modelo->validate_register_form();
        $modelo->get_register_form(chk_array($parametros, 1));
        $modelo->del_user($parametros);
    ?>
    
    <!-- Agenda bibliotecas js -->
    <script src="<?php echo HOME_URI; ?>/_agenda/js/pt-BR.js"></script>
    <script src="<?php echo HOME_URI; ?>/_agenda/js/moment.js"></script>
    <script src="<?php echo HOME_URI; ?>/_agenda/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?php echo HOME_URI; ?>/_agenda/js/locales/bootstrap-datetimepicker.pt-BR.js"></script>
    <!-- Final agenda js -->

    <div class="col-md-8">
        <div class="row">
            <div class="col-md-12">
                <div style="margin: 0px; padding: 0px;" class="page-header">
                    <h2  style="margin: 0px 0px 5px 0px; padding: 0px;"></h2>
                </div>
                <div class="pull-left form-inline">
                    <br>
                    <button title="click para agendar sua consulta" class="btn btn-success" data-toggle='modal' data-target='#add_evento'>
                        Agendar consulta <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                    </button><span>&nbsp;</span>
                </div>

                <div class="pull-left form-inline">
                    <br>

                    <div class="btn-group">
                        <button class="btn btn-primary" data-calendar-nav="prev">
                            <i class="fa fa-backward" aria-hidden="true"></i>
                        </button>
                        <button class="btn" data-calendar-nav="today">Hoje</button>
                        <button class="btn btn-primary" data-calendar-nav="next">
                            <i class="fa fa-forward" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-warning" data-calendar-view="year">Ano</button>
                        <button class="btn btn-warning active" data-calendar-view="month">Mês</button>
                        <button class="btn btn-warning" data-calendar-view="week">Semana</button>
                        <button class="btn btn-warning" data-calendar-view="day">Dia</button>
                    </div>
                </div>
                <br>

                <div class="form-inline">
                    <span>&nbsp;</span>
                    <!--<label for="sel1">Select list:</label>-->
                    <select class="form-control" id="sel1">
                        <option class="selected" selected>Selecione</option>
                        <option >2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                </div>



            </div>





        </div>
        <span><br></span>
        <div class="row">
            <div class="col-md-12">
                <div id="calendar"></div> <!-- Aqui se mostrara nuestro calendario -->
            </div>
        </div>
    </div>
    <br>            
    <div class="col-md-4">

        <!--refresh widget-->
        <div class="panel-agenda panel panel-default">
            <div class="panel-heading"><a id="refresh1" class="pull-right" href="#"><span class="fa fa-refresh"></span></a>Agendamentos</div>
            <div class="panel-body panel-refresh">
                <div class="refresh-container"><i class="refresh-spinner fa fa-spinner fa-spin fa-5x"></i></div>

                Vázio


            </div>
        </div>
        <!--refresh widget-->

        <!--refresh widget-->
        <div class="panel-agenda panel panel-default">
            <div class="panel-heading"><a id="refresh1" class="pull-right" href="#"><span class="fa fa-refresh"></span></a>Agenda de horários</div>
            <div class="panel-body panel-refresh">
                <div class="refresh-container"><i class="refresh-spinner fa fa-spinner fa-spin fa-5x"></i></div>
                Vázio
            </div>
        </div>
        <!--refresh widget-->
    </div>
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
    (function($){
            //creamos la fecha actual
            var date = new Date();
            var yyyy = date.getFullYear().toString();
            var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
            var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();
                

            //establecemos los valores del calendario
            var options = {

                // definimos que los eventos se mostraran en ventana modal
                    modal: '#events-modal',

                    // dentro de un iframe
                    modal_type:'iframe',

                    //obtenemos los eventos de la base de datos
                    events_source: '<?= HOME_URI; ?>/_agenda/obtener_eventos.php',

                    // mostramos el calendario en el mes
                    view: 'month',

                    // y dia actual
                    day: yyyy+"-"+mm+"-"+dd,


                    // definimos el idioma por defecto
                    language: 'pt-BR',

                    //Template de nuestro calendario
                    tmpl_path: '<?= HOME_URI; ?>/_agenda/tmpls/',
                    tmpl_cache: false,


                    // Hora de inicio
                    time_start: '08:00',

                    // y Hora final de cada dia
                    time_end: '22:00',

                    // intervalo de tiempo entre las hora, en este caso son 30 minutos
                    time_split: '30',

                    // Definimos un ancho del 100% a nuestro calendario
                    width: '100%',

                    onAfterEventsLoad: function(events)
                    {

                            if(!events)
                            {
                                    return;
                            }
                            var list = $('#eventlist');
                            list.html('');

                            $.each(events, function(key, val)
                            {
                                    $(document.createElement('li'))
                                            .html('<a href="' + val.url + '">' + val.title + '</a>')
                                            .appendTo(list);
                            });
                    },
                    onAfterViewLoad: function(view)
                    {
                            $('.page-header h2').text(this.getTitle());
                            $('.btn-group button').removeClass('active');
                            $('button[data-calendar-view="' + view + '"]').addClass('active');
                    },
                    classes: {
                            months: {
                                    general: 'label'
                            }
                    }
            };


            // id del div donde se mostrara el calendario
            var calendar = $('#calendar').calendar(options);

            $('.btn-group button[data-calendar-nav]').each(function()
            {
                    var $this = $(this);
                    $this.click(function()
                    {
                            calendar.navigate($this.data('calendar-nav'));
                    });
            });

            $('.btn-group button[data-calendar-view]').each(function()
            {
                    var $this = $(this);
                    $this.click(function()
                    {
                            calendar.view($this.data('calendar-view'));
                    });
            });

            $('#first_day').change(function()
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
                            <input type='text' class="form-control"  name="from" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="to">Termina as:</label>
                        <div class='input-group date' id='to'>
                            <input type='text' class="form-control" name="to"  />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>

                    </div>

                    <br>

                    <div class="form-group">
                        <label class=" control-label" for="selectbasic">Dentista:</label>
                        <select id="selectbasic" name="sel_dent" class="form-control">
                            <option value="1">Dr. Janaina</option>
                            <option value="2">Dr. Joao</option>
                            <option value="3">Dr. Melisa</option>
                        </select>
                    </div>
                    <br>

                    <label for="tipo">Procedimento:</label>
                    <select class="form-control" name="slect_proced" id="tipo">
                        <option value="event-info">Canal</option>
                        <option value="event-success">Obturação</option>
                        <option value="event-important">Implante</option>
                        <option value="event-warning">Limpeza</option>
                        <option value="event-special">Orçamento</option>
                    </select>


                    <br>


                    <label for="title">Paciente:</label>
                    <input type="text" required autocomplete="off" name="paciente" class="form-control" id="title" placeholder="Nome do paciente...">

                    <br>




                    <label for="body">Descrição da consulta:</label>
                    <textarea id="body" name="descricao" required class="form-control" rows="3" placeholder="Descreva aqui informações extras da consultas..."></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Gravar</button>
                </form>
            </div>
        </div>
    </div>
</div>

        
        
       
               