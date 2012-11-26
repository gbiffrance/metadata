		var $ = jQuery.noConflict();
	Highcharts.theme = {
		   colors: ["#DDDF0D", "#7798BF", "#55BF3B", "#DF5353", "#aaeeee", "#ff0066", "#eeaaee", 
		      "#55BF3B", "#DF5353", "#7798BF", "#aaeeee"],
		   chart: {
		      backgroundColor: {
		         linearGradient: [0, 0, 0, 400],
		         stops: [
		            [0, 'rgb(96, 96, 96)'],
		            [1, 'rgb(16, 16, 16)']
		         ]
		      },
		      borderWidth: 0,
		      borderRadius: 15,
		      plotBackgroundColor: null,
		      plotShadow: false,
		      plotBorderWidth: 0
		   },
		   title: {
		      style: { 
		         color: '#FFF',
		         font: '16px Lucida Grande, Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif'
		      }
		   },
		   subtitle: {
		      style: { 
		         color: '#DDD',
		         font: '12px Lucida Grande, Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif'
		      }
		   },
		   xAxis: {
		      gridLineWidth: 0,
		      lineColor: '#999',
		      tickColor: '#999',
		      labels: {
		         style: {
		            color: '#999',
		            fontWeight: 'bold'
		         }
		      },
		      title: {
		         style: {
		            color: '#AAA',
		            font: 'bold 12px Lucida Grande, Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif'
		         }            
		      }
		   },
		   yAxis: {
		      alternateGridColor: null,
		      minorTickInterval: null,
		      gridLineColor: 'rgba(255, 255, 255, .1)',
		      lineWidth: 0,
		      tickWidth: 0,
		      labels: {
		         style: {
		            color: '#999',
		            fontWeight: 'bold'
		         }
		      },
		      title: {
		         style: {
		            color: '#AAA',
		            font: 'bold 12px Lucida Grande, Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif'
		         }            
		      }
		   },
		   legend: {
		      itemStyle: {
		         color: '#CCC'
		      },
		      itemHoverStyle: {
		         color: '#FFF'
		      },
		      itemHiddenStyle: {
		         color: '#333'
		      }
		   },
		   labels: {
		      style: {
		         color: '#CCC'
		      }
		   },
		   tooltip: {
		      backgroundColor: {
		         linearGradient: [0, 0, 0, 50],
		         stops: [
		            [0, 'rgba(96, 96, 96, .8)'],
		            [1, 'rgba(16, 16, 16, .8)']
		         ]
		      },
		      borderWidth: 0,
		      style: {
		         color: '#FFF'
		      }
		   },
		   
		   
		   plotOptions: {
		      line: {
		         dataLabels: {
		            color: '#CCC'
		         },
		         marker: {
		            lineColor: '#333'
		         }
		      },
		      spline: {
		         marker: {
		            lineColor: '#333'
		         }
		      },
		      scatter: {
		         marker: {
		            lineColor: '#333'
		         }
		      },
		      candlestick: {
		         lineColor: 'white'
		      }
		   },
		   
		   toolbar: {
		      itemStyle: {
		         color: '#CCC'
		      }
		   },
		   
		   navigation: {
		      buttonOptions: {
		         backgroundColor: {
		            linearGradient: [0, 0, 0, 20],
		            stops: [
		               [0.4, '#606060'],
		               [0.6, '#333333']
		            ]
		         },
		         borderColor: '#000000',
		         symbolStroke: '#C0C0C0',
		         hoverSymbolStroke: '#FFFFFF'
		      }
		   },
		   
		   exporting: {
		      buttons: {
		         exportButton: {
		            symbolFill: '#55BE3B'
		         },
		         printButton: {
		            symbolFill: '#7797BE'
		         }
		      }
		   },
		   
		   // scroll charts
		   rangeSelector: {
		      buttonTheme: {
		         fill: {
		            linearGradient: [0, 0, 0, 20],
		            stops: [
		               [0.4, '#888'],
		               [0.6, '#555']
		            ]
		         },
		         stroke: '#000000',
		         style: {
		            color: '#CCC',
		            fontWeight: 'bold'
		         },
		         states: {
		            hover: {
		               fill: {
		                  linearGradient: [0, 0, 0, 20],
		                  stops: [
		                     [0.4, '#BBB'],
		                     [0.6, '#888']
		                  ]
		               },
		               stroke: '#000000',
		               style: {
		                  color: 'white'
		               }
		            },
		            select: {
		               fill: {
		                  linearGradient: [0, 0, 0, 20],
		                  stops: [
		                     [0.1, '#000'],
		                     [0.3, '#333']
		                  ]
		               },
		               stroke: '#000000',
		               style: {
		                  color: 'yellow'
		               }
		            }
		         }               
		      },
		      inputStyle: {
		         backgroundColor: '#333',
		         color: 'silver'
		      },
		      labelStyle: {
		         color: 'silver'
		      }
		   },
		   
		   navigator: {
		      handles: {
		         backgroundColor: '#666',
		         borderColor: '#AAA'
		      },
		      outlineColor: '#CCC',
		      maskFill: 'rgba(16, 16, 16, 0.5)',
		      series: {
		         color: '#7798BF',
		         lineColor: '#A6C7ED'
		      }
		   },
		   
		   scrollbar: {
		      barBackgroundColor: {
		            linearGradient: [0, 0, 0, 20],
		            stops: [
		               [0.4, '#888'],
		               [0.6, '#555']
		            ]
		         },
		      barBorderColor: '#CCC',
		      buttonArrowColor: '#CCC',
		      buttonBackgroundColor: {
		            linearGradient: [0, 0, 0, 20],
		            stops: [
		               [0.4, '#888'],
		               [0.6, '#555']
		            ]
		         },
		      buttonBorderColor: '#CCC',
		      rifleColor: '#FFF',
		      trackBackgroundColor: {
		         linearGradient: [0, 0, 0, 10],
		         stops: [
		            [0, '#000'],
		            [1, '#333']
		         ]
		      },
		      trackBorderColor: '#666'
		   },
		   
		   // special colors for some of the demo examples
		   legendBackgroundColor: 'rgba(48, 48, 48, 0.8)',
		   legendBackgroundColorSolid: 'rgb(70, 70, 70)',
		   dataLabelsColor: '#444',
		   textColor: '#E0E0E0',
		   maskColor: 'rgba(255,255,255,0.3)'
		};
		
		// Apply the theme
		var highchartsOptions = Highcharts.setOptions(Highcharts.theme);
		

			var chart,render_chart,series_type,d1,d2,d3,d4;
			$(document).ready(function() {
			
			render_chart=function(d,series_type)
			{

				chart = new Highcharts.Chart({
					chart: {
						renderTo: 'container2',
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false
					},
					title: {
						text: d.title
					},
					tooltip: {
						formatter: function() {
							return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
						}
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
								enabled: true,
								color: Highcharts.theme.textColor || '#000000',
								connectorColor: Highcharts.theme.textColor || '#000000'
							},
							showInLegend: true
						}
					},
				    series: [
				    {
				    type: 'pie',
				    name: 'Browser share',
				    data: d.data
				    }
				    ]
				});
			} // end function render_chart
			
			var data1=[
				['Parc zoologique',   68],
				['Autre',       112],							
				['Aquarium / marinarium',    45],
				['Organisme de recherche',     13],
				['Conservatoire',   3],
				['Jardin botanique',   8],	
				['Société savante',   2],	
				['Université/école',   547],
				['Association',   36],								
																								
			]
			
			d1={'title':"Collections par type d'institution",data:data1}


			var data2=[
				['Preservee',   65],
				['Vivant',       72],							
				['Digitalise',    3]																														
			]
		
			d2={'title':'Collections par classe',data:data2}			
		
			
			var data3=[
				['',   10],
				['t',       24],							
				['f',    1109]																														
			]

			
			d3={'title':'Collections par connection au GBIF',data:data3}		
		var data4=[
			['Fermee',   2],
			['Inconnu',       14],							
			['Active',    94],
			['Passive',       5]																													
		]	

		
			d4={'title':'Collections par statut de développement',data:data4}
	//		render_chart(d1)
		var $ = jQuery.noConflict();			
			$('select').change(function()
			{
			var my_data=window[$(this).find('option:selected').attr('id')]
			var my_id=$(this).find('option:selected').attr('id')
			if (my_id!='columns')
			{
/*
series_type=
{
	type: 'pie',
	name: 'Browser share',
	data: my_data.data
}
*/
	render_chart(my_data)
			}
			else
			{
		chart = new Highcharts.Chart({
						chart: {
							renderTo: 'container2',
							defaultSeriesType: 'column',
							margin: [ 50, 50, 100, 80],
							events: {
											            click: function(e) {
											            //    alert ('A series was added');
										//	 console.info(e)
							
											            }
											        }
						},
						   
						
						title: {
							text: 'Nombre de collections par ville (seulement les plus importantes)'
						},
						xAxis: {
							categories: [
				"Aix-en-Provence",
				"Perpignan",
				"Montpellier",
				"Avignon",
				"Clermont-Ferrand",
				"Villers-lès-Nancy","Mende","Brioude","Strasbourg","Biarritz"
				,"Auxerre"
				,"Toulouse","Paris","Bagnères-de-Bigorre","Marseille","Lyon","Carcassonne","Nantes","Nice","Angers","Le Mans","Toulon"
										],
							labels: {
									rotation: -45,
									align: 'right',
									style: {
										 font: 'normal 11px Verdana, sans-serif'
									}
								}
							},
							yAxis: {
								min: 0,
								title: {
									text: 'Nombre de collections'
								}
								},
								
							legend: {
								enabled: false
							},
							tooltip: {
								formatter: function() {
									return '<b>'+ this.x +'</b><br/>'+
										 'Nombre de collections: '+ Highcharts.numberFormat(this.y, 1);
										 
								}
							},
							plotOptions: {
							cursor: 'pointer',
						/*	series:
							
							{
							events: {
								                click: function(event) {
								                       // Log to console
								                    console.log(event.point);
		//						                    alert(this.name +' clicked\n'+
		//						                          'Alt: '+ event.altKey +'\n'+
		//						                          'Control: '+ event.ctrlKey +'\n'+
		//						                          'Shift: '+ event.shiftKey +'\n');
								                        
								                }
								           }
							}	           
							   
							*/	
							},
							
							series: [{
							name: 'Numero de Collections',
							data: [23,7,409,2,40,3,15,19,1,1,49,34,11,33,5,13,32,7,22,9,7],
							dataLabels: {
									enabled: true,
									rotation: 0,
									color: '#FFFFFF',
									align: 'center',
									x: -3,
									y: -5,
									formatter: function() {
										return this.y;
									},
									style: {
										font: 'normal 13px Verdana, sans-serif'
									}
								}			
							}]
						});
			
			}
			
				
			})
render_chart(d1,series_type)	
			});
				
