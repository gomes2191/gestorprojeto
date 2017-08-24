$(function (){
    
    //Montando a URL
    newURL = window.location.protocol + '//' + window.location.host + '/' + 'soc/';

    //window.history.pushState("agenda", "", "agenda");
    "use strict";
    //Criamos a data atual
    var date = new Date();
    var yyyy = date.getFullYear().toString();
    var mm = (date.getMonth() + 1).toString().length === 1 ? "0" + (date.getMonth() + 1).toString() : (date.getMonth() + 1).toString();
    var dd = (date.getDate()).toString().length === 1 ? "0" + (date.getDate()).toString() : (date.getDate()).toString();

    var options = {
        // Definimos que os eventos aparecerão em uma janelo modal
        modal: '#event-modal',
        async: true,
        modal_title: 'Cadastro de consulta',
        // Dentro de um iframe
        modal_type: 'ajax',
        //Obtemos os eventos da base de dados
        events_source: newURL + 'agenda/return-json',
        // Mostramos o calendário no mês
        view: 'month',
        // No dia atual
        day: 'now',
        // Definimos o idioma padrão
        language: 'pt-BR',
        //Template de nosso calendario
        tmpl_path: newURL + '_agenda/tmpls/',
        tmpl_cache: false,
        // Hora de inicio
        time_start: '08:00',
        // Hora final de cada dia
        time_end: '17:00',
        // Intervalo de tempo entre as horas, neste são 30 minutos
        time_split: '10',
        // Definimos uma largura de 100% no calendário
        width: '100%',
        onAfterEventsLoad: function (events) {
            if (!events) { return; }
            
            var list = $('#eventlist');
           
            list.html('');
            
            $.each(events, function (key, val) {
                $(document.createElement('li')).html('<a href="' + val.url + '">' + val.title + '</a>').appendTo(list);
            });
        },
        onAfterModalShown: function(event) {
            // Inside this function 'this' is the calendar instance
            console.log(event);
            $('.patient').text(event.title);
            $('.desc').text(event.desc);
            $('.start_normal').text(event.start_normal);
            $('.end_normal').text(event.end_normal);
            
        },
        onAfterViewLoad: function (view) {
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
    
    $('.btn-group button[data-calendar-nav]').each(function () {
        var $this = $(this);
        $this.click(function () {
            calendar.navigate($this.data('calendar-nav'));
        });
    });

    $('.btn-group button[data-calendar-view]').each(function () {
        var $this = $(this);
        $this.click(function () {
            calendar.view($this.data('calendar-view'));
        });
    });

    $('#first_day').change(function () {
        var value = $(this).val();
        value = value.length ? parseInt(value) : null;
        calendar.setOptions({first_day: value});
        calendar.view();
    });

    $('#language').change(function () {
        calendar.setLanguage($(this).val());
        calendar.view();
    });

    $('#events-in-modal').change(function () {
        var val = $(this).is(':checked') ? $(this).val() : null;
        calendar.setOptions({modal: val});
    });
    $('#format-12-hours').change(function () {
        var val = $(this).is(':checked') ? true : false;
        calendar.setOptions({format12: val});
        calendar.view();
    });
    $('#show_wbn').change(function () {
        var val = $(this).is(':checked') ? true : false;
        calendar.setOptions({display_week_numbers: val});
        calendar.view();
    });
    $('#show_wb').change(function () {
        var val = $(this).is(':checked') ? true : false;
        calendar.setOptions({weekbox: val});
        calendar.view();
    });

    $('#events-modal .modal-header, #events-modal .modal-footer').click(function (e) {
        e.preventDefault();
        //e.stopPropagation();
    });
    
});

    


