<?php
    // Pull our initialization file
    require_once "init.php";
?>
<?php
    $currID = $_SESSION['currID'];
    $fis_score = $_SESSION['fis_score'];
    $soc_score = $_SESSION['soc_score'];
    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
   <title> POLITICATS!
   </title>
   <link href="slick_green.css" rel="stylesheet"
         type="text/css" />

	<!-- JAVASCRIPT FOR GOOGLE CHART -->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);

      <!-- THIS IS WHERE THEY ARE ADDING DATA TO THE DATATABLE -->
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('number', 'Fiscal');
        data.addColumn('number', 'Social');
        data.addRows([
          [<?php echo $fis_score?>, <?php echo $soc_score?>],
        ]);

        var options = {
          title: 'Political Spectrum Plot',
          hAxis: {title: 'Fiscal', minValue: -1, maxValue: 1},
          vAxis: {title: 'Social', minValue: -1, maxValue: 1},
          legend: 'none'
        };

        var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>


 </head>
 <body>
   <div id="header">
      <a href="index.php" accesskey="1"><img src="politicats_catface_transparent.png" alt="PC_Logo"  /></a>
      <ul>
        <li><a href="about_pc.html">About Politicats</a></li>
      </ul>
   </div>

   <div id="bodycontent">
   
   <!-- JAVASCRIPT FOR GOOGLE CHART -->
   <div id="chart_div" style="width: 500px; height: 500px;"></div>

		<h2>Your fiscal score is: <?php echo $fis_score;?>. You are a match for: </h2>
		
<?php 

	echo ("currID: " . $currID . " fis_score: " . $fis_score . " soc_score: " . $soc_score); 
	

	if($fis_score < 0)
		echo '<p><h3>Chairman Meow</h3><img src="ChairmanMeow2.png"></p>';
	elseif($fis_score > 0)
		echo '<p><h3>Feline Palin</h3><img src="Palin_cat.png"></p>';
	else 
		echo '<p><h3>You are undecided!</h3></p>';	
?>		
		

   </div>
 </body>
</html>