<?php
    // Gain access to DB
    require_once "db.php";
    // Initialize session for page
    session_start();
?>
<?php
    
	//What we're using to build the user's fiscal score
	//Count counts the number of questions answered (for normalization)
	$score = 0;
	$count = 0;

    // Create sql command: Want to pull our questions' orientation (lefty or righty)
    $sql = "SELECT orientation_fiscal FROM questions";
    // Retrieve all records
    $result = mysql_query($sql);
	
	//If the user answered question 1 then calcuate the score with this information
	//count increments
	if ( isset($_SESSION['q1'] ) ) 
    {
    	$count = $count + 1;
    	$row = mysql_fetch_row($result);  
        $score = $score + ($_SESSION['q1'] * $row[0]);
    }

	//If the user answered question 2 then calcuate the score with this information
	//count increments
	if ( isset($_SESSION['q2'] ) ) 
    {
    	$count = $count + 1;
    	$row = mysql_fetch_row($result);     	
        $score = $score + ($_SESSION['q2'] * $row[0]);
   	}
    
	//If the user answered question 3 then calcuate the score with this information
	//count increments
	if ( isset($_SESSION['q3'] ) ) 
    {
    	$count = $count + 1;
    	$row = mysql_fetch_row($result);     	
        $score = $score + ($_SESSION['q3'] * $row[0]);
    	
    }

	//If the user answered question 3 then calcuate the score with this information
	//count increments
	if ( isset($_SESSION['q4'] ) ) 
    {
    	$count = $count + 1;
    	$row = mysql_fetch_row($result);     	
        $score = $score + ($_SESSION['q4'] * $row[0]);
    	
    }

	//If the user answered question 3 then calcuate the score with this information
	//count increments
	if ( isset($_SESSION['q5'] ) ) 
    {
    	$count = $count + 1;
    	$row = mysql_fetch_row($result);     	
        $score = $score + ($_SESSION['q5'] * $row[0]);    	
    }    
	
    $userscore = $score/$count;
    $pctmatch = abs($userscore*100);
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
	if($userscore < 0)
		echo '<p><h3>Chairman Meow</h3><img src="ChairmanMeow2.png"></p>';
	elseif($userscore > 0)
		echo '<p><h3>Feline Palin</h3><img src="Palin_cat.png"></p>';
	else 
		echo '<p><h3>You are undecided!</h3></p>';	
?>		
		

   </div>
 </body>
</html>