$.ajaxSetup({
    headers: {
        'isAjax': true,
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function base_url(caminho) {

    if(caminho == undefined)
        caminho = null;

    var url_base =  $('meta[name="base_url"]').attr("content");

    return url_base + caminho + '/';
}

$(document).ready(function() {

    // Envia um formulÃ¡rio ajax, necessÃ¡rio que response seja json ($this->resp())
    $('body').on('submit', 'form.ajax', function(e) {

        e.preventDefault();

        var form        = $(this);
        var url         = form.attr('action');
        var button      = form.find('button[type="submit"]');
        var formData    = new FormData(  $(this)[0] );
        
        mini_loading( button, 'show' );

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false
        }).done(function(data) {
            return ajax_response( data, button );
        }).fail(function(data) {
            data.responseJSON.success = false;
            return ajax_response( data.responseJSON, button );
        });

    });

    // Realiza os tratamentos para o response ajax
    function ajax_response( data, button = false ) {

        mini_loading( button, 'hidden' );

        //Sucesso - Cadastrada
        if(data.success == true) {

            //
            if( data.redirect != undefined && data.redirect )
                window.location.href = data.redirect;

            //
            if ( data.message != undefined && data.message )
                message( 'success', data.message )

            return true;
            
        //Form validation - Error
        } else {

            if( data.message == 'login' )
                return ajax_data_modal(data.redirect);

            if( data.message != undefined )
                message('danger', data.message);

            return false;

        }

    }


    // ABRE UMA MODAL AJAX (GET) COM ONCLICK
    $('[data-modal]').on('click', function(e) {
        
        e.preventDefault();
        let url     = $(this).attr('data-modal');
        ajax_data_modal(url);

    });

    //MASK JS
    // $('.mask-money').mask('000.000.000.000,00', {reverse: true});
    // $('.mask-value').mask('####0,00', {reverse: true});
    // $('.mask-qtd').mask('000000');
    // $('.mask-qtd-01').mask('0');
    // $('.mask-qtd-02').mask('00');
    // $('.mask-qtd-03').mask('000');
    // $('.mask-qtd-04').mask('0000');
    // $('.mask-qtd-05').mask('00000');
    // $('.mask-qtd-06').mask('000000');
    // $('.mask-qtd-07').mask('0000000');
    // $('.mask-qtd-08').mask('00000000');
    // $('.mask-qtd-09').mask('000000000');
    // $('.mask-qtd-10').mask('0000000000');
    // $('.mask-float-01').mask('0000000000.0', {reverse: true});
    // $('.mask-float-02').mask('0000000000.00', {reverse: true});
    // $('.mask-float-03').mask('0000000000.000', {reverse: true});
    // $('.mask-cep').mask('00000-000');
    // $('.mask-card-number').mask('0000 0000 0000 0000');
    // $('.mask-card-date').mask('00/0000');
    // $('.mask-date').mask('00/00/0000');
    // $('.mask-time').mask('00:00');
    // $('.mask-phone').mask('(00) 00000-0000');
    // $('.mask-phone-inter').mask('000000000000000');
    // $(".mask-alphanumeric").mask('Z', {translation: {'Z': {pattern: /[a-zA-Z0-9]/, recursive: true}}});
    // $(".mask-alphanumeric-space").mask('Z', {translation: {'Z': {pattern: /[a-zA-Z0-9 ]/, recursive: true}}});

    //share btns
    $('.btn-share').click(function() {
        var width   = '600';
        var height  = '400';
        var left    = (screen.width/2)-(width/2);
        var top     = (screen.height/2)-(height/2);
        var href    = $(this).data('href');
        window.open(href, '', 'width='+width+', height='+height+', top='+top+', left='+left);
    });

});

// GERA UM CÓDIGO ÚNICO
function uniqueId(under = false) {

    let uniqueId = '';

    if( under )
        uniqueId += '_';

    uniqueId += Math.random().toString(36).substr(2, 9);

    return uniqueId;

}

// ABRE UMA MODAL COM CONTEÚDO EM GET AJAX
function ajax_data_modal(url) {

    $.ajax({
        url: url,
        type: "GET",
        processData: false,
        contentType: false
    }).done(function(data) {

        $('#modalAjax')
            .first()
            .modal('show')
            .find('.modal-body')
            .html( data );

    });

}

// FUNÇÃO PADRÃO DE MENSAGENS
function message(type, message) {

	const element = $("#alertMessage").first();
	element.removeClass('alert-success')
		.removeClass('alert-danger')
		.addClass(`alert-${type}`)
		.slideDown(750)
        .find('p')
		.text(message);

	setTimeout(function(e) {
		element.click();
	}, 4000);

	element.click(function (a) {
        $(this).slideUp(750);
    });

}

// EXIBE LOADING NO BOTÃƒO X E DESABILITA
function mini_loading(element, action, new_i) {

    var element     = $(element);
    var html        = '<i class="fa fa-spinner mini-loader"></i>';

    if(new_i != undefined) {
        new_i       = '<i class="' + new_i + '"></i>';
    } else {
        new_i       = null;
    }

    if(action == 'show') {

        element.attr('disabled', 'disabled');
        element.children('svg').remove();
        element.prepend(html);

    } else {

        element.removeAttr('disabled');
        element.children('svg').remove();
        element.prepend(new_i);

    }

}

/* function para exibir/esconder loading */
function loading(tipo, mensagem) {

    if( mensagem == undefined || !mensagem )
        mensagem = "CARREGANDO";

    $("#loading p").html(mensagem);

    if(tipo == 'show') {
        $('#loading').removeClass('d-none');
    } else {
        $('#loading').addClass('d-none');
    }
}