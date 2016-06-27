$(document).ready(function(){
    $('select[name="Rate[quoteid]"]').change(function(){
        var obj = {quoteid: $(this).val()};
        $.get('/admin/quotes/ajax-quote-details',obj,function(data){
            var result = data;
            if(result){
                var step = 1;
                $('input[name="rate-company"]').val(result.companyname);
                $('input[name="rate-country"]').val(result.countryname);
                switch(result.step){
                    case '1': step = 1; break;
                    case '10': step = 10; break;
                    case '100': step = 100; break;
                    case '1000': step = 1000; break;
                    case '10000': step = 10000; break;
                    case '01': step = 0.1; break;
                    case '001': step = 0.01; break;
                    case '0001': step = 0.001; break;
                    case '00001': step = 0.0001; break;
                    case '000001': step = 0.00001; break;
                    case '0000001': step = 0.000001; break;
                }
                $('input[name="Rate[openrate]"]').attr("step",step);
                $('input[name="Rate[closerate]"]').attr("step",step);
                $('input[name="Rate[minimum]"]').attr("step",step);
                $('input[name="Rate[maximum]"]').attr("step",step);
            }
        });
    });

    $('.actionModal').click(function (event) {
        event.preventDefault();
        var url = $(this).attr("href");
        var obj = {};
        ajaxRenderOnSuccess(url,obj);
    });

    $(document).on('click','ul.pagination li a',function (event){
        event.preventDefault();
        var url = $(this).attr("href");
        var obj = {};
        ajaxRenderOnSuccess(url,obj);
    });

    $('#add-quote-index').click(function (event) {
        event.preventDefault();
        var url = '/admin/indeces/add-quotes-to-index';
        var exchid = $('select[name="Index[exchangeid]"]').val();
        var obj = {exchid: exchid};
        ajaxRenderOnSuccess(url,obj);
    });
    $(document).on('click','#grid-add-quote-to-index > table > tbody > tr',function(){
        var id = $(this).attr('data-key');
        var tr = $('<tr>').addClass('quote-row');
        var exists = $('input[value='+id+']').length;
        if(!exists){
            $('#form-index-create > table > tbody').append(tr);
            $('<td>').addClass('hidden').append($('<input name="IndexQuotes[]" type=hidden>').val(id)).appendTo(tr);
            $('<td>').html($(this).children('td').eq(1).html()).appendTo(tr);
            $('<td>').html($(this).children('td').eq(2).html()).appendTo(tr);
            $('<td>').html($(this).children('td').eq(3).html()).appendTo(tr);
            $('<td>').append($('<a href="#">').append($('<span>').addClass('glyphicon glyphicon-remove'))).appendTo(tr);
        }
    });
    $(document).on('click','#form-index-create > table > tbody > tr > td > a',function(){
        $(this).parents('tr').remove();
    });

    $('button#add-quote-index').attr('disabled',$('select[name="Index[exchangeid]"]').val() == '');

    //$('#btn-load-csv').click(function(event){
    //    event.preventDefault();
    //    var url = '/admin/rates/load';
    //});

    $('select[name="Index[exchangeid]"]').change(function(){
        $('button#add-quote-index').attr('disabled',$(this).val() == '');
    });

});

function ajaxRenderOnSuccess(url,obj){
    var modalContainer = $('#modal');
    $.get(url,obj,function (data) {
        $('#modal-body').html(data);
        modalContainer.modal({show: true});
    });
}

