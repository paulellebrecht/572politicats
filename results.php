<?php
    // Pull our initialization file
    require_once "init.php";

    $currID = $_SESSION['currID'];
    $fis_score = $_SESSION['fis_score'];
    $soc_score = $_SESSION['soc_score'];
    
?>

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
		$current_distance = sqrt(($row[3]-$fis_score)*($row[3]-$fis_score) + ($row[4]-$soc_score)*($row[4]-$soc_score));
		
		//Debugging to check whether the calculations are correct
		//echo ("distance to " . $row[1] . " is: " . $current_distance . "<br>");
		//echo ($row[1] . " fiscal score: " . $row[3] . "<br>");
		//echo ($row[1] . " social score: " . $row[4] . "<br>");
		//echo ("Your fiscal score: " . $fis_score . "<br>");
		//echo ("Your social score: " . $soc_score . "<br>");
		
		// If the current distance is less than the least distance, store the name/image of the current cat
		if ($current_distance < $least_distance) {
			$cat_pic = $row[1];
			$cat_name = $row[2];
			$cat_fisc = $row[3]; //cat's fiscal score for plotting on map
			$cat_soc = $row[4]; //cat's social score for plotting on map
			$least_distance = $current_distance;
		}
	}
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

        data.addColumn('number', 'Fiscal Score');
        data.addColumn('number', 'You');
        data.addColumn('number', 'Politicat Match');
        data.addRows([
             [<?php echo $fis_score?>, <?php echo $soc_score?>, null],
             [<?php echo $cat_fisc?>, null, <?php echo $cat_soc?>]
             ]);


        var options = {
          title: 'Political Spectrum Chart',
          titleTextStyle: {color: '#5D5153', fontSize: 19},
          hAxis: {title: 'Liberal <----------------- FISCAL -----------> Conservative', minValue: -1, maxValue: 1, textPosition: 'none'},
          vAxis: {title: 'Liberal <----------------- SOCIAL -----------> Conservative', minValue: -1, maxValue: 1, textPosition: 'none'},
        };

        var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>

 </head>
 <body>

	<!-- facebook like button -->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
  		var js, fjs = d.getElementsByTagName(s)[0];
  		if (d.getElementById(id)) return;
  		js = d.createElement(s); js.id = id;
  		js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

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
			echo ("<p><h3>" . $cat_name . "</h3><img src=" . $cat_pic);
		?>		
		width="500" height="auto"></p> 
	</div>

   <!-- JAVASCRIPT FOR GOOGLE CHART -->
   <div id="chart_div" style="position:static; width: 500px; height: 500px;"></div>
   

   
   


   </div>
 	
	<div id="bottomtext">
 	<h2>Want to see your Politicat on this site? <a href="mailto:mypoliticat@gmail.com?subject=See attached for my Politicat">Send it to us!</a></h2>
	<br>
	<div class="fb-like" data-href="http://politicats.groups.si.umich.edu" data-send="true" data-width="450" data-show-faces="true"></div>
	</div>
   
   <br>
   <br>
   <br>
   <br>
   <br>
   <br>
 
 </body>
</html>