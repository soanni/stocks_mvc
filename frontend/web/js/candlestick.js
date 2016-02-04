$(document).ready(function () {
    var qid = $('div.chart-view').attr('id');
    var width = $('div.row').width();
    var obj = {quoteid: qid,
        startdate : '20150101',
        enddate: '20150530'};
    $.ajax({
        url: '/charts/get-rates-json',
        data: obj,
        type: 'GET'
    }).done(function(d){
        var result = [];
        for (i = 0; i < d.length; i++){
            var time = new Date(String(d[i].ratedate).slice(0,4)
                ,parseInt(String(d[i].ratedate).slice(5,7))-1
                ,String(d[i].ratedate).slice(8,10)).getTime();
            result.push(
                [time
                    , round(d[i].openrate)
                    , round(d[i].maximum)
                    , round(d[i].minimum)
                    , round(d[i].closerate)] );
        }
        $('<div></div>')
            .highcharts('StockChart', {
                chart : {
                    type: 'candlestick',
                    width:width,
                },
                rangeSelector : {
                    allButtonsEnabled: true,
                    selected: 2
                },
                series: [{
                    data: result
                }]
            })
            .appendTo('div#chart');
    });
});
