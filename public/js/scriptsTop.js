// Agenda paginador de eventos
$(function () {
    var paginador;
    var totalPaginas;
    var itemsPorPagina = 3;
    var numerosPorPagina = 3;

    function creaPaginador(totalItems)
    {
        paginador = $(".pagination-events");

        totalPaginas = Math.ceil(totalItems / itemsPorPagina);

        $('<li><a href="#" class="first_link"><</a></li>').appendTo(paginador);
        $('<li><a href="#" class="prev_link">«</a></li>').appendTo(paginador);

        var pag = 0;
        while (totalPaginas > pag)
        {
            $('<li><a href="#" class="page_link">' + (pag + 1) + '</a></li>').appendTo(paginador);
            pag++;
        }


        if (numerosPorPagina > 1)
        {
            $(".page_link").hide();
            $(".page_link").slice(0, numerosPorPagina).show();
        }

        $('<li><a href="#" class="next_link">»</a></li>').appendTo(paginador);
        $('<li><a href="#" class="last_link">></a></li>').appendTo(paginador);

        paginador.find(".page_link:first").addClass("active");
        paginador.find(".page_link:first").parents("li").addClass("active");

        paginador.find(".prev_link").hide();

        paginador.find("li .page_link").click(function ()
        {
            var irpagina = $(this).html().valueOf() - 1;
            cargaPagina(irpagina);
            return false;
        });

        paginador.find("li .first_link").click(function ()
        {
            var irpagina = 0;
            cargaPagina(irpagina);
            return false;
        });

        paginador.find("li .prev_link").click(function ()
        {
            var irpagina = parseInt(paginador.data("pag")) - 1;
            cargaPagina(irpagina);
            return false;
        });

        paginador.find("li .next_link").click(function ()
        {
            var irpagina = parseInt(paginador.data("pag")) + 1;
            cargaPagina(irpagina);
            return false;
        });

        paginador.find("li .last_link").click(function ()
        {
            var irpagina = totalPaginas - 1;
            cargaPagina(irpagina);
            return false;
        });

        cargaPagina(0);

    }

    function cargaPagina(pagina)
    {
        var desde = pagina * itemsPorPagina;

        $.ajax({
            data: {"param1": "dame", "limit": itemsPorPagina, "offset": desde},
            type: "GET",
            dataType: "json",
            url: 'agenda/json-pagination'
        }).done(function (data, textStatus, jqXHR) {

            var lista = data.lista;

            $("#listConsul").html("");

            $.each(lista, function (ind, elem) {

                $(
                        "<li class='list-group-item list-group-item-info'>" + '<i class="glyphicon glyphicon-certificate"></i>' + '<b> Nome: </b>' + elem.agenda_pac + ' <b>Procedimento: </b>' + elem.agenda_proc + ' <b>Horario: </b>' + elem.agenda_start_normal + "</li>"

                        ).appendTo($("#listConsul"));

            });


        }).fail(function (jqXHR, textStatus, textError) {
            alert(textError);


        });

        if (pagina > 0)
        {

            paginador.find(".prev_link").show();



        } else
        {
            paginador.find(".prev_link").hide();
        }
        if (pagina < (totalPaginas - numerosPorPagina))
        {
            paginador.find(".next_link").show();
        } else
        {
            paginador.find(".next_link").hide();

        }

        paginador.data("pag", pagina);

        if (numerosPorPagina > 1)
        {

            $(".page_link").hide();
            if (pagina < (totalPaginas - numerosPorPagina))
            {
                $(".page_link").slice(pagina, numerosPorPagina + pagina).show();

            } else {
                if (totalPaginas > numerosPorPagina)
                    $(".page_link").slice(totalPaginas - numerosPorPagina).show();
                else
                    $(".page_link").slice(0).show();
            }

        }

        paginador.children().removeClass("active");
        paginador.children().eq(pagina + 2).addClass("active");

    }

    $(function () {
        $.ajax({
            data: {"param1": "quantos"},
            type: "GET",
            dataType: "json",
            url: 'agenda/json-pagination'
        }).done(function (data, textStatus, jqXHR) {
            var total = data.total;

            creaPaginador(total);

            if (total == '0') {
                $('.paginadorAgenda').html('<i class="glyphicon glyphicon-info-sign"></i> Olá, ainda não a agendamentos');
                $('.panel-footer').hide();

            } else {

                $('.paginadorAgenda').hide();
            }

        }).fail(function (jqXHR, textStatus, textError) {
            alert("Error al realizar la peticion quantos".textError);

        });

    });
});


// Monetario paginas com financeiros
    $(function (){
        var test = 'R$ 1.700,90';


        function getMoney( str )
        {
                return parseInt( str.replace(/[\D]+/g,'') );
        }
        function formatReal( int )
        {
                var tmp = int+'';
                tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
                if( tmp.length > 6 )
                        tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

                return tmp;
        }


        //var int = getMoney( test );
        //alert( int );


        //console.log( formatReal( 1000 ) );
        //console.log( formatReal( 19990020 ) );
        //console.log( formatReal( 12006 ) );
        //console.log( formatReal( 111090 ) );
        //console.log( formatReal( 1111 ) );
        //console.log( formatReal( 120090 ) );
        //console.log( formatReal( int ) );

    });

//Limpa os dados do modal boostrap apos fechalo
$(function () {
    // when the modal is closed
    $('body').on('hidden.bs.modal', function () {
        // remove the bs.modal data attribute from it
        $(this).removeData('bs.modal');
        // and empty the modal-content element
        $('#modal-container .modal-content').empty();
    });
});

$(document).ready(function () {
    $(".btn-select").each(function (e) {
        var value = $(this).find("ul li.selected").html();
        if (value != undefined) {
            $(this).find(".btn-select-input").val(value);
            $(this).find(".btn-select-value").html(value);
        }
    });
});

//custom select
$(document).ready(function () {
    $(".btn-select").each(function (e) {
        var value = $(this).find("ul li.selected").html();
        if (value != undefined) {
            $(this).find(".btn-select-input").val(value);
            $(this).find(".btn-select-value").html(value);
        }
    });
});

$(document).on('click', '.btn-select', function (e) {
    e.preventDefault();
    var ul = $(this).find("ul");
    if ($(this).hasClass("active")) {
        if (ul.find("li").is(e.target)) {
            var target = $(e.target);
            target.addClass("selected").siblings().removeClass("selected");
            var value = target.html();
            $(this).find(".btn-select-input").val(value);
            $(this).find(".btn-select-value").html(value);
        }
        ul.hide();
        $(this).removeClass("active");
    }
    else {
        $('.btn-select').not(this).each(function () {
            $(this).removeClass("active").find("ul").hide();
        });
        ul.slideDown(300);
        $(this).addClass("active");
    }
});

$(document).on('click', function (e) {
    var target = $(e.target).closest(".btn-select");
    if (!target.length) {
        $(".btn-select").removeClass("active").find("ul").hide();
    }
});
//End