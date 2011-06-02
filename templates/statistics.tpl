{$formstart}

{literal}
<script type="text/javascript">
  $jQ = jQuery.noConflict();
				var chart;

$jQ(document).ready(function() {
	
	// Matches for individual Touch-devices
	
   chart = new Highcharts.Chart({
     
					 chart: {
         renderTo: 'container',
         defaultSeriesType: 'bar',
									margin: [50, 50, 80, 150]
      },
      title: {
         text: 'Mobile Statistics'
      },
      subtitle: {
         text: '{/literal}{$uamatchestext|escape:'quotes'}{literal}'
      },
      xAxis: {
         //categories: ['Africa', 'America', 'Asia', 'Europe', 'Oceania'],
		         categories: [{/literal}{', '|implode:$ua_names}{literal}],
									
         title: {
            text: null
         }
      },
      yAxis: {
         min: 0,
         title: {
            text: '{/literal}{$uamatchestext|escape:'quotes'}{literal} (hits)',
            align: 'high'
         }
      },
      tooltip: {
         formatter: function() {
            return ''+
                this.series.name +': '+ this.y +' hits';
         }
      },
      plotOptions: {
         bar: {
            dataLabels: {
               enabled: true
            }
         }
      },
      legend: {
         layout: 'vertical',
         align: 'right',
         verticalAlign: 'top',
         x: -100,
         y: 20,
         borderWidth: 1,
         //backgroundColor: '#FFFFFF'
      },
      credits: {
         enabled: false
      }
       ,
       series: [{
                name: "User Agent",
                data: [{/literal}{', '|implode:$ua_total}{literal}]
             }]
                
      
   });
   


// Matches / no matches with touch devices
chart = new Highcharts.Chart({
					chart: {
						renderTo: 'container2',
						margin: [30, 200, 30, 170]
					},
					title: {
						text: '{/literal}{$matchestext|escape:'quotes'}{literal} / {/literal}{$nonmatchestext|escape:'quotes'}{literal}'
					},
					plotArea: {
						shadow: null,
						borderWidth: null,
						backgroundColor: null
					},
					tooltip: {
						formatter: function() {
							return '<b>'+ this.point.name +'<\/b>: '+ this.y +' %';
						}
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
								enabled: true,
								formatter: function() {
									if (this.y > 5) return this.point.y +' %';
								},
								color: 'black',
								style: {
									font: '13px Trebuchet MS, Verdana, sans-serif'
								}
							}
						}
					},
					legend: {
						layout: 'vertical',
						style: {
							left: 'auto',
							bottom: 'auto',
							right: '50px',
							top: '100px'
						}
					},
					credits: {
         enabled: false
      }
						,
				    series: [{
						type: 'pie',
						name: 'Mobile devices',
						data: [
							['{/literal}{$matchestext|escape:'quotes'}{literal}',   {/literal}{$pcmatches|replace:'%':''}{literal}],
							['{/literal}{$nonmatchestext|escape:'quotes'}{literal}', {/literal}{$pcnonmatches|replace:'%':''}{literal}]
						]
					}]
				});   
}); //end ready
				
		</script>


{/literal}
            
<div id="container2" style="max-width: 800px; min-height:300px; margin: 10px auto"></div>                  
<div id="container" style="max-width: 800px; min-height: 300px; margin: 10px auto"></div>

<br />
<div style="max-width: 800px; margin:10px auto">
  <div class="pageoverflow">
    <p class="pagetext">{$matchestext}</p>
    <p class="pageinput">{$matches}</p>
  </div>
  
  <div class="pageoverflow">
    <p class="pagetext">{$nonmatchestext}</p>
    <p class="pageinput">{$nonmatches}</p>
  </div>
  
  <div class="pageoverflow">
    <p class="pagetext">{$uamatchestext}</p>
    <p class="pageinput">{$uamatches}</p>
  </div>
</div>
<div class="pageoverflow">
	<p class="pagetext">&nbsp;</p>
	<p class="pageinput">{$submit}</p>
</div>

{$formend}
