$(document).ready(function(){
    $('select[name="Rate[quoteid]"]').change(function(){
        var obj = {quoteid: $(this).val()};
        $.get('http://admin.stocks_mvc.ubuntu/quotes/ajax-quote-details',obj,function(data){
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
});
