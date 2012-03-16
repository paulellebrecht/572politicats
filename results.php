<?php
    // Pull our initialization file
    require_once "init.php";
?>
<?php
    $pctmatch = abs($userscore*100);
    
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
 </head>
 <body>
   <div id="header">
      <a href="index.php" accesskey="1"><img src="politicats_catface_transparent.png" alt="PC_Logo"  /></a>
      <ul>
        <li><a href="about_pc.html">About Politicats</a></li>
      </ul>
   </div>

   <div id="bodycontent">

		<h2>You're a <?php echo $pctmatch;?>% Match to: </h2>
		
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