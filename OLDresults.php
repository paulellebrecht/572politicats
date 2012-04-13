<?php
    // Pull our initialization file
    require_once "init.php";

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
          title: 'Political Spectrum Chart',
          titleTextStyle: {color: '#5D5153', fontSize: 19},
          hAxis: {title: 'Liberal <---------- FISCAL -------------> Conservative', minValue: -1, maxValue: 1},
          vAxis: {title: 'Liberal <---------- SOCIAL -------------> Conservative', minValue: -1, maxValue: 1},
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
   <!-- Save for debugging Your fiscal score is: <?php echo $fis_score;?>. Your social score is: <?php echo $fis_score;?>.  -->
	<h2>You are a match for: </h2><br>   

	<div id="picture">
<?php 
	// Compare the current user to each of the politicats 
    $sql = "SELECT * FROM politicat";
    $result = mysql_query($sql);
	$least_distance = 2;
	// Iterate over each politicat
	
	//var_dump($result);
	//die();
	while ( $row = mysql_fetch_row($result) ) {
		// calculate the distance between the current user and the current politicat
		$current_distance = sqrt(($row[3]-$fis_score)*($row[3]-$fis_score) + ($row[2]-$soc_score)*($row[4]-$soc_score));
		
		// If the current distance is less than the least distance, store the name/image of the current cat
		if ($current_distance < $least_distance) {
			$cat_pic = $row[1];
			$cat_name = $row[2];
			$least_distance = $current_distance;
		}
	}

	echo ("<p><h3>" . $cat_name . "</h3><img src=" . $cat_pic);
?>		
		width="500" height="auto"></p> 
	</div>

   <!-- JAVASCRIPT FOR GOOGLE CHART -->
   <div id="chart_div" style="position:static; width: 500px; height: 500px;"></div>
   </div>
 </body>
</html>