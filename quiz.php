<?php 
// Gain access to DB
require_once "db.php";
// Initialize session for page
session_start();

    // If the user hits the submit button then....
    if ( isset($_POST['Submit']) ) 
    {

        // Set the values of the question responses as session values
        // NOTE: For our beta release we will add error checking to see
        //       whether the user infact answered all the questions 
        $_SESSION['q1'] = $_POST['1'];
        $_SESSION['q2'] = $_POST['2'];
		$_SESSION['q3'] = $_POST['3'];
        $_SESSION['q4'] = $_POST['4'];
        $_SESSION['q5'] = $_POST['5'];
                
        // Redirect to results page
        header( 'Location: results.php' );        
        // Suspend further execution of this page and wait for redirect
        return;
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
 </head>
 <body>
   <div id="header">
      <a href="index.php" accesskey="1"><img src="politicats_catface_transparent.png" alt="PC_Logo"  /></a>
      <ul>
        <li><a href="about_pc.html">About Politicats</a></li>
      </ul>
   </div>

   <div id="bodycontent">
		
		<h1>HELLO YOU ARE TOTALLY TAKING A QUIZ</h1>
		<form method="post">
		<table>
			<tr>
                <th>Question</th>
                <th></th>
                <th>Strongly Disagree</th>
                <th>Somewhat Disagree</th>
                <th>Neither Agree or Disagree</th>
                <th>Somewhat Agree</th>
                <th>Strongly Agree</th>
            </tr>
<?php
    // Create sql command: Want to pull our questions' text from our database
    $sql = "SELECT id, text FROM questions";
    // Retrieve all records
    $result = mysql_query($sql);
    
    // Iterate for each row retrieved from database
    while ( $row = mysql_fetch_row($result) ) 
    {
        // Display one record per HTML row
?>
            <tr>
                <td><?php echo($row[1]); ?></td>                
                <td align="left"><?php echo($row[2]); ?></td> <!-- Column 2 in table = column 3 in SQL -->
                <td align="center"><input type="radio" name=<?php echo($row[0]); ?> value="-1"/></td> 
                <td align="center"><input type="radio" name=<?php echo($row[0]); ?> value="-0.5"/></td> 
                <td align="center"><input type="radio" name=<?php echo($row[0]); ?> value="0"/></td> 
                <td align="center"><input type="radio" name=<?php echo($row[0]); ?> value="0.5"/></td> 
                <td align="center"><input type="radio" name=<?php echo($row[0]); ?> value="1"/></td> 
            </tr>
<?php
    }
?>
		</table>
		<input type="submit" name="Submit" value="FIND OUT WHICH CAT YOU ARE LIKE!"/>
		</form>
   </div>
 </body>
</html>
