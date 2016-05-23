$(function () {
    $("*").dblclick(function (e) {
        e.preventDefault();
    });
    var navListItems = $('ul.setup-panel li a'),
        allWells = $('.setup-content');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this).closest('li');

        if (!$item.hasClass('disabled')) {
            navListItems.closest('li').removeClass('active');
            $item.addClass('active');
            allWells.hide();
            $target.show();
        }
    });

    $('ul.setup-panel li.active a').trigger('click');

    $('.filterable .btn-filter').click(function () {
        var $panel = $(this).parents('.filterable'),
            $filters = $panel.find('.filters input'),
            $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function (e) {
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9')
            return;
        /* Useful DOM data and selectors */
        var $input = $(this),
            inputContent = $input.val().toLowerCase(),
            $panel = $input.parents('.filterable'),
            column = $panel.find('.filters th').index($input.parents('th')),
            $table = $panel.find('.table'),
            $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function () {
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="' + $table.find('.filters th').length + '">Nenhum resultado encontrado!</td></tr>'));
        }
    });

});

$('.close').on('click', function () {
    $('#conteudoModal').fadeOut().html('Fechando...');
    location.reload();
});

$('#nao').on('click', function () {
    $('#conteudoModal').fadeOut().html('Fechando...');
});

$('#dialog').modal({'show': false});

function chamaModal(titulo, valor, arquivo, tamanho) {
    $('.modal .modal-dialog').css('width', tamanho);

    $('#conteudoModal').hide().fadeIn().html('Carregando...');
    $('#tituloModal').html(titulo);
    $.get(arquivo,
        "valor=" + valor + "&titulo=" + titulo,
        function (data) {
            $('#conteudoModal').html(data);
        }
    );
}

function vBotao(id) {
    var bt = $('#' + id).val();
    if (bt == '') {
        $('#e' + id).addClass('has-error');
        return false;
    } else {
        $('#e' + id).removeClass('has-error').addClass('has-success');
        return true;
    }
}

function inpblur() {
    $("input").blur(function () {
        validaVazio(this.id, this.min);
    });
}

function botao() {
    $('#radioBtn a').on('click', function () {
        var sel = $(this).data('title');
        var tog = $(this).data('toggle');
        $('#' + tog).prop('value', sel);
        $('a[data-toggle="' + tog + '"]').not('[data-title="' + sel + '"]').removeClass('active').addClass('notActive');
        $('a[data-toggle="' + tog + '"][data-title="' + sel + '"]').removeClass('notActive').addClass('active');
    })
}

function validaVazio(campo, mini) {
    var valor = $('#' + campo).val();
    if (valor.length <= mini) {
        $('#v' + campo).removeClass('has-success').addClass('has-error');
        return false;
    } else {
        $('#v' + campo).removeClass('has-error').addClass('has-success');
        return true;
    }
}

function validaSelect(campo) {
    var valor = $('#' + campo).val();
    if (valor == "") {
        $('#v' + campo).removeClass('has-success').addClass('has-error');
        return false;
    } else {
        $('#v' + campo).removeClass('has-error').addClass('has-success');
        return true;
    }
}

function validaEmail() {
    var regex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    var campo = $('#email').val();
    if (campo == "") {
        $('#vemail').removeClass('has-success').addClass('has-error');
        return false;
    }
    if (regex.test(campo)) {
        $('#vemail').removeClass('has-error').addClass('has-success');
        return true;
    } else {
        $('#vemail').removeClass('has-success').addClass('has-error');
        return false;
    }
}

function replaceAll(string, token, newtoken) { // ???
    while (string.indexOf(token) != -1) {
        string = string.replace(token, newtoken);
    }
    return string;
}
function validaCpf() {
    var numeros, digitos, soma, i, resultado, digitos_iguais;
    var cpf = $('input[name=cpf]').val();

    cpf = replaceAll(cpf, '.', ''); // tira os pontos
    cpf = replaceAll(cpf, '-', ''); // tira o traço
    digitos_iguais = 1;
    if (cpf.length == 0) {
        $('#vcpf').removeClass('has-success').addClass('has-error');
        return false;
    }
    if (cpf.length < 11 && cpf.length > 0) {
        $('#vcpf').removeClass('has-success').addClass('has-error');
        return false;
    }
    for (i = 0; i < cpf.length - 1; i++)
        if (cpf.charAt(i) != cpf.charAt(i + 1)) {
            digitos_iguais = 0;
            break;
        }
    if (!digitos_iguais) {
        numeros = cpf.substring(0, 9);
        digitos = cpf.substring(9);
        soma = 0;
        for (i = 10; i > 1; i--) {
            soma += numeros.charAt(10 - i) * i;
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        }
        if (resultado != digitos.charAt(0)) {
            $('#vcpf').removeClass('has-success').addClass('has-error');
            return false;
        }
        numeros = cpf.substring(0, 10);
        soma = 0;
        for (i = 11; i > 1; i--) {
            soma += numeros.charAt(11 - i) * i;
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        }
        if (resultado != digitos.charAt(1)) {
            $('#vcpf').removeClass('has-success').addClass('has-error');
            return false;
        }
        $('#vcpf').removeClass('has-error').addClass('has-success');
        return true;
    } else {

    }
}

function er_replace(pattern, replacement, subject) {
    return subject.replace(pattern, replacement);
}