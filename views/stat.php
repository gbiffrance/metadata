<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
	// Load the Visualization API and the piechart package.
  google.load('visualization', '1.0', {'packages':['corechart']});
  google.load('visualization', '1', {'packages':['geomap']});

  // Set a callback to run when the Google Visualization API is loaded.
  google.setOnLoadCallback(drawChart);
  google.setOnLoadCallback(drawVisualization);

	function drawVisualization()
	{
    // Pour institutions par régions
    var data1 = new google.visualization.DataTable();
    data1.addColumn('string', "Region");
    data1.addColumn('number', "institution");
    data1.addRows([
    <?php
    	$i = 1;
    	foreach($instregion as $item)
    	{
    		if($item['count'] =='')
    		{
    			$item['count'] = 0;
    		}
    		if($item['NameRegion'] == 'Guyane')
    		{
    			$string = "[\"French Guiana\", ".$item['count']."]";
    		}
    		elseif($item['NameRegion'] == 'La Réunion')
    		{
    			$string = "[\"Reunion\", ".$item['count']."]";
    		}
    		elseif($item['NameRegion'] == 'Nouvelle-Calédonie')
    		{
    			$string = "[\"New Caledonia\", ".$item['count']."]";
    		}
    		elseif($item['NameRegion'] == 'Polynésie française')
    		{
    			$string = "[\"French Polynesia\", ".$item['count']."]";
    		}
    		else
    		{
    			$string = "[\"".$item['NameRegion']."\", ".$item['count']."]";
    		}
    		if($i < sizeof($instregion))
    		{
    			$string .= ",";
    		}
    		$string .= "\n";
    		echo $string;
    		$i++;
    	}
    ?>
    ]);

    var options1 = {};  
			options1['region'] = 'FR';            
			options1['dataMode'] = 'regions';
			options1['width'] = '700px';
			options1['height'] = '700px';

		// Outre mer
		// Guadeloupe
		var options12 = {};  
			options12['region'] = 'GP';           
			options12['dataMode'] = 'regions';
			options12['width'] = '200px';
			options12['height'] = '100px';
			options12['showLegend'] = false;
			
		// Guyane
		var options13 = {};  
			options13['region'] = 'GF';          
			options13['dataMode'] = 'regions';
			options13['width'] = '200px';
			options13['height'] = '100px';
			options13['showLegend'] = false;
			
		// Réunion
		var options14 = {};  
			options14['region'] = 'RE';           
			options14['dataMode'] = 'regions';
			options14['width'] = '200px';
			options14['height'] = '100px';
			options14['showLegend'] = false;
			
		// Nouvelle calédonie
		var options15 = {};  
			options15['region'] = 'NC';          
			options15['dataMode'] = 'regions';
			options15['width'] = '200px';
			options15['height'] = '100px';
			options15['showLegend'] = false;
			
		// Polynésie française
		var options16 = {};  
			options16['region'] = 'PF';            
			options16['dataMode'] = 'regions';
			options16['width'] = '200px';
			options16['height'] = '100px';
			options16['showLegend'] = false;
			
		// Martinique
		var options17 = {};  
			options17['region'] = 'MQ';            
			options17['dataMode'] = 'regions';
			options17['width'] = '200px';
			options17['height'] = '100px';
			options17['showLegend'] = false;
		
		// Mayotte
	  var options18 = {};  
			options18['region'] = 'YT';          
			options18['dataMode'] = 'regions';
			options18['width'] = '200px';
			options18['height'] = '100px';
			options18['showLegend'] = false;
			
	  var chart1 = new google.visualization.GeoMap(document.getElementById('chart_div1'));
    chart1.draw(data1, options1);
    var chart12 = new google.visualization.GeoMap(document.getElementById('chart_div12'));
    chart12.draw(data1, options12);
    var chart13 = new google.visualization.GeoMap(document.getElementById('chart_div13'));
    chart13.draw(data1, options13);
    var chart14 = new google.visualization.GeoMap(document.getElementById('chart_div14'));
    chart14.draw(data1, options14);
    var chart15 = new google.visualization.GeoMap(document.getElementById('chart_div15'));
    chart15.draw(data1, options15);
    var chart16 = new google.visualization.GeoMap(document.getElementById('chart_div16'));
    chart16.draw(data1, options16);
    var chart17 = new google.visualization.GeoMap(document.getElementById('chart_div17'));
    chart17.draw(data1, options17);
    var chart18 = new google.visualization.GeoMap(document.getElementById('chart_div18'));
    chart18.draw(data1, options18);
	  
	}

  // Callback that creates and populates a data table, instantiates the chart, passes in the data and draws it.
  function drawChart() 
  {
    // Create the data table 
    // Pour institutions par type
    var data2 = new google.visualization.DataTable();
    data2.addColumn('string', "Type");
    data2.addColumn('number', "nombre d'institution");
    data2.addRows([
    <?php
    	$i = 1;
    	foreach($insttype as $item)
    	{
    		$string = "[\"".$item['NameTypeInst']."\", ".$item['count']."]";
    		if($i < sizeof($insttype))
    		{
    			$string .= ",";
    		}
    		$string .= "\n";
    		echo $string;
    		$i++;
    	}
    ?>
    ]);  
    // Pour dataset par inst
    var data3 = new google.visualization.DataTable();
    data3.addColumn('string', "Nombre de dataset associes");
    data3.addColumn('number', "nombre d'institutions");
    data3.addRows([
    <?php
    	$i = 1;
    	foreach($instdata as $item)
    	{
    		$string = "[\"".$item['nbdata']." jeux de données\", ".$item['nbinst']."]";
    		if($i < sizeof($instdata))
    		{
    			$string .= ",";
    		}
    		$string .= "\n";
    		echo $string;
    		$i++;
    	}
    ?>
    ]);
    // Pour dataset par type
    var data4 = new google.visualization.DataTable();
    data4.addColumn('string', "Type");
    data4.addColumn('number', "nombre de jeu de données");
    data4.addRows([
    <?php
    	$i = 1;
    	foreach($datatype as $item)
    	{
    		$string = "[\"".$item['NameTypeData']."\", ".$item['count']."]";
    		if($i < sizeof($datatype))
    		{
    			$string .= ",";
    		}
    		$string .= "\n";
    		echo $string;
    		$i++;
    	}
    ?>
    ]);
    // Pour dataset par nature
    var data5 = new google.visualization.DataTable();
    data5.addColumn('string', "Nature");
    data5.addColumn('number', "nombre de jeu de données");
    data5.addRows([
    <?php
    	$i = 1;
    	foreach($datanature as $item)
    	{
    		$string = "[\"".$item['NameNature']."\", ".$item['count']."]";
    		if($i < sizeof($datanature))
    		{
    			$string .= ",";
    		}
    		$string .= "\n";
    		echo $string;
    		$i++;
    	}
    ?>
    ]);
    // Pour dataset connecté au gbif
    var data6 = new google.visualization.DataTable();
    data6.addColumn('string', "Connecté au gbif");
    data6.addColumn('number', "nombre de jeu de données");
    data6.addRows([
    <?php
    		echo "['OUI', ".$nbgbif."],\n";
    		$nongbif = $nbdataset - $nbgbif;
    		echo "['NON', ".$nongbif."]";
    ?>
    ]);
    
    // Set chart options
    // Pour institutions par type
    var options2 = {'title':"Nombre d'institution par type",
                   'width':600,
                   'height':300};
		// Pour dataset par inst
		var options3 = {'title':"Nombre de dataset par institutions",
                   'width':800,
                   'height':400};
    // Pour dataset par type
    var options4 = {'title':"Nombre de dataset par type",
                   'width':800,
                   'height':200};
		// Pour dataset par nature
		var options5 = {'title':"Nombre de dataset par nature",
                   'width':800,
                   'height':300};
    // Pour dataset connecté au gbif
    var options6 = {'title':"Nombre de dataset connectés au GBIF",
                   'width':800,
                   'height':200};
                   
    // Instantiate and draw our chart, passing in some options.
    // Pour institutions par type
    var chart2 = new google.visualization.PieChart(document.getElementById('chart_div2'));
    chart2.draw(data2, options2);
    // Pour dataset par inst
    var chart3 = new google.visualization.PieChart(document.getElementById('chart_div3'));
    chart3.draw(data3, options3);
     // Pour dataset par type
     var chart4 = new google.visualization.PieChart(document.getElementById('chart_div4'));
    chart4.draw(data4, options4);
    // Pour dataset par nature
    var chart5 = new google.visualization.PieChart(document.getElementById('chart_div5'));
    chart5.draw(data5, options5);
    // Pour dataset connecté au gbif
    var chart6 = new google.visualization.PieChart(document.getElementById('chart_div6'));
    chart6.draw(data6, options6);
  }
</script>

<div id=body >
	<!--Div that will hold charts-->
	<div id="cartes">
		<h2>Nombre d'institutions par régions</h2>
		<div id="outremer">
			<h3>Outre mer</h3>
			<h4>Guadeloupe</h4>
			<div id="chart_div12"></div>
			<h4>Guyane</h4>
			<div id="chart_div13"></div>
			<h4>Martinique</h4>
			<div id="chart_div17"></div>
			<h4>Mayotte</h4>
			<div id="chart_div18"></div>
			<h4>Nouvelle-Cal&eacute;donie</h4>
			<div id="chart_div15"></div>
			<h4>Polyn&eacute;sie française</h4>
			<div id="chart_div16"></div>
			<h4>R&eacute;union</h4>
			<div id="chart_div14"></div>
		</div>
		<div id="metropole">
			<h3>Metropole</h3>
			<div id="chart_div1"></div>
		</div>
	</div>
	<br/>
	<div id="camemberts">
		<h2>Nombre d'institutions par type</h2>
		<div id="chart_div2"></div>
		<h2>Nombre de jeux de donn&eacute;es par institutions</h2>
		<div id="chart_div3"></div>
		<h2>Nombre de jeux de donn&eacute;es par type</h2>
		<div id="chart_div4"></div>
		<h2>Nombre de jeux de donn&eacute;es par nature</h2>
		<div id="chart_div5"></div>
		<h2>Nombre de jeux de donn&eacute;es connect&eacute;s au GBIF</h2>
		<div id="chart_div6"></div>
	</div>
</div>
