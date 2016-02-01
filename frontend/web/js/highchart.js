 $(document).ready(function () {
     $('a.chart-anchor').click(function(event){
         event.preventDefault();
         $('tr.appended').remove();
         var parentRow = $(this).parent().parent();
         var qid = parentRow.attr('id');
         var obj = {quoteid: qid,
                    startdate : '20150501',
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
             $('<tr></tr>').attr('class','appended').append($('<td></td>').attr('colspan',4).append($('<div></div>').attr('id','chart'))).insertAfter(parentRow);
             $('<div></div>')
                 .highcharts('StockChart', {
                     chart : {
                         type: 'line',
                     },
                     //rangeSelector : {
                     //    allButtonsEnabled: true,
                     //    selected: 2
                     //},
                     //title : {
                     //    text : qid
                     //},
                     series: [{
                         data: result
                     }]
                 })
                 .appendTo('div#chart');
         });
     });
 });

 function round(d) {
     return Math.round(100 * d) / 100;
 }
