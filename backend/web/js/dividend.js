$(document).ready(function() {
    $('body').on('change', 'select[name="Dividend[country]"]', function () {
        var url = '/admin/countries/get-exchanges-by-country';
        var countryid = $(this).val();
        var obj = {
            countryid: countryid
        };
        $.get(url, obj, function (data) {
            fillSelectWithOptions($('select[name="Dividend[exchid]"]'),data,'exchid','exchname',true);
        });
    });


    $('body').on('change','select[name="Dividend[exchid]"]',function (){
        // filling exchanges list
        var url = '/admin/exchanges/get-companies-by-exchange';
        var exchid = $(this).val();
        var obj = {
            exchid: exchid
        };
        $.get(url, obj, function (data) {
            fillSelectWithOptions($('select[name="Dividend[companyid]"]'),data,'companyid','companyname',true);
        });

        // filling quotes list
        var url = '/admin/exchanges/get-quotes-by-exchange';
        var exchid = $(this).val();
        var obj = {
            exchid: exchid
        };
        $.get(url, obj, function (data) {
            fillSelectWithOptions($('select[name="Dividend[quoteid]"]'),data,'qid','fullname',false);
        });
    });

    $('body').on('change','select[name="Dividend[companyid]"]', function(){
        // filling quotes list
        var url = '/admin/companies/get-quotes-by-company';
        var companyid = $(this).val();
        var obj = {
            companyid: companyid
        };
        $.get(url, obj, function (data) {
            fillSelectWithOptions($('select[name="Dividend[quoteid]"]'),data,'qid','fullname',false);
        });
    });
});

function fillSelectWithOptions(element,data,value,text,fireChange) {
    element.find('option').remove();
    for(i = 0; i < data.length; i++){
        var val = data[i][value];
        var txt = data[i][text];
        element.append($('<option/>').val(val).text(txt));
        // fire the event
        if(fireChange){
            element.change();
        }
    }
}
