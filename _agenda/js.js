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
            modal_type: 'modal',
            //Obtemos os eventos da base de dados
            events_source: '<?= HOME_URI; ?>/_agenda/return_json.php',
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
