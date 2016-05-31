$(document).ready(function () {
    $(document).on('click','button.btn-default',function (event){
        $('button.btn-default').removeClass('active');
        $(this).addClass('active');
        var url = '/site/get-leaders-and-loosers';
        var btn_id = $(this).attr('id');
        var period = '';
        switch(btn_id){
            case 'button-day': period = 'day'; break;
            case 'button-month': period = 'month'; break;
            case 'button-year': period = 'year'; break;
            case 'button-all': period = 'all'; break;
            default: period = 'day';
        }
        var obj = {period: period};
        $.ajax({
            url: url,
            data: obj,
            type: 'GET'
        }).done(function(d){
            $('table#table-leaders > tbody > tr').remove();
            d[0].forEach(function(item){
                var row = $('<tr></tr>');
                var a = $('<a></a>');
                var td = $('<td></td>');
                a.attr('href','/charts/view?id='.concat(item.qid));
                a.html(item.shortname);
                td.append(a);
                row.append(td);
                row.append($('<td></td>').html(item.diff.concat('%')));
                $('table#table-leaders > tbody').append(row);
            });
        $('table#table-loosers > tbody > tr').remove();
        d[1].forEach(function(item){
            var row = $('<tr></tr>');
            var a = $('<a></a>');
            var td = $('<td></td>');
            a.attr('href','/charts/view?id='.concat(item.qid));
            a.html(item.shortname);
            td.append(a);
            row.append(td);
            row.append($('<td></td>').html(item.diff.concat('%')));
            $('table#table-loosers > tbody').append(row);
        });
        });
    });
});