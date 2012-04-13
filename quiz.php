<?php 
// Use initialization file
require_once "init.php";

    // If the user hits the submit button then....
    if ( isset($_POST['Submit']) &&
		 isset($_POST['q1']) &&
		 isset($_POST['q2']) &&
		 isset($_POST['q3']) &&
		 isset($_POST['q4']) &&
		 isset($_POST['q5']) &&
		 isset($_POST['q6']) &&
		 isset($_POST['q7']) &&
		 isset($_POST['q8']) &&
		 isset($_POST['q9']) &&
		 isset($_POST['q10'])) 
    {

		//These are the users responses to the quiz                
        $q1 = $_POST['q1'];
        $q2 = $_POST['q2'];
		$q3 = $_POST['q3'];
        $q4 = $_POST['q4'];
        $q5 = $_POST['q5'];
        $q6 = $_POST['q6'];
        $q7 = $_POST['q7'];
		$q8 = $_POST['q8'];
        $q9 = $_POST['q9'];
        $q10 = $_POST['q10'];
        //NEED TO CONVERT TEXT INTO FLOAT VALUES <-------------------------- DO THIS!!!
        
		//These are the users responses for how important each question is to them                
        $w1 = $_POST['weight_1'];
        $w2 = $_POST['weight_2'];
		$w3 = $_POST['weight_3'];
        $w4 = $_POST['weight_4'];
        $w5 = $_POST['weight_5'];
        $w6 = $_POST['weight_6'];
        $w7 = $_POST['weight_7'];
		$w8 = $_POST['weight_8'];
        $w9 = $_POST['weight_9'];
        $w10 = $_POST['weight_10'];
        
		//What we're using to build the user's fiscal score
		//Count counts the number of questions answered (for normalization)
		$fis_score = 0;
		$soc_score = 0;
		$fis_count = 0;
		$soc_count = 0;		

		//Find out what the orientation of each question is 
	    $sql = "SELECT orientation_fiscal, orientation_social FROM questions";
	    //$sql = "SELECT * FROM questions";
	    // Retrieve all records
    	$orientation = mysql_query($sql);
    	$_SESSION['orient'] = $orientation[0][0];
 		
        $q_array = array($q1, $q2, $q3, $q4, $q5, $q6, $q7, $q8, $q9, $q10);
		$w_array = array($w1, $w2, $w3, $w4, $w5, $w6, $w7, $w8, $w9, $w10);
		
		//Looping to calculate the fiscal score
    	for ($i=0; $i<sizeof($q_array); $i++) {
    		
    		//orientation array is multi dimensional, so need to brake it out:
    		$row = mysql_fetch_row($orientation);
    		//for fiscal orientation, we'll always want the first column of the array
    		
    		$fis_score = $fis_score + ($q_array[$i] * $w_array[$i] * $row[0]);
    		$soc_score = $soc_score + ($q_array[$i] * $w_array[$i] * $row[1]);
    		$fis_count = $fis_count + abs($row[0]) * $w_array[$i];
    		$soc_count = $soc_count + abs($row[1]) * $w_array[$i];
    		//echo "<br>Echo in code: fis_score" .$fis_score . " fis_count" . $fis_count . "\n"; //<--------------------------- Echos to print to screen
			//echo "Echo in code: soc_score" .$soc_score . " soc_count" . $soc_count . "\n";
    	}
		
		$fis_score = $fis_score/$fis_count;
        $soc_score = $soc_score/$soc_count;
		
		// Create Dummy user to store Anonymous quizzes
        // BEGIN and COMMIT are to prevent another user from jumping in (b/c we're so popular)
        $sql = "BEGIN;";
        mysql_query($sql);
        $sql = "INSERT INTO users (name, score_fis, score_soc)
                    VALUES ('Anonymous', $fis_score, $soc_score)";
        mysql_query($sql);
        
        $currID = mysql_insert_id();
        
        $sql = "COMMIT;";
        mysql_query($sql);    				 

        // <-----------------------------------------------------------------  DOUBLE CHECK HERE IF ADD MORE QUESTIONS   
        // Everything is ok so insert new record
        $sql = "INSERT INTO answers (users_id, q1_value, q1_weight, q2_value, q2_weight, q3_value, q3_weight, q4_value, q4_weight, q5_value, q5_weight
                                               q6_value, q6_weight, q7_value, q7_weight, q8_value, q8_weight, q9_value, q9_weight, q10_value, q10_weight)
                VALUES ($currID, $q1, $q2, $q3, $q4, $q5, $q6, $q7, $q8, $q9, $q10, $w1, $w2, $w3, $w4, $w5, $w6, $w7, $w8, $w9, $w10)";
        mysql_query($sql);
            
        // Set message to display in index page
        $_SESSION['sesMessage'] = 'Record Added';
        $_SESSION['currID'] = $currID;
        $_SESSION['fis_score'] = $fis_score;
        $_SESSION['soc_score'] = $soc_score;
        
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


<script type="text/javascript">
	//To validate that the user answered all the questions
	//alert ("hi"); //Was for debugging
	
	//Need to check that field[0].checked is false for ALL of the buttons, then the question wasn't questioned
	
	
	//Gets passed a group of 5 radio buttons for our five options, check whether  
	//each one is checked
	function isEmpty(field) {

		//test variable, if all of the radio buttons are empty, then = true;
		testEmpty = true;

		//Go through each available radio button within a grouping of buttons
		for (i = 0; i < field.length; i ++)
		{
			if(field[i].checked == true)
			{
				testEmpty = false;	
			}
		}
		return testEmpty;		
	}

	
	function validateFormOnSubmit(theForm) {

		//Start off assuming that there are no empty questions
		emptyQuestion = false;

		//Because I'm not sure how to iterate though all my quesitons, I'm testing each one
		//I realize this is not ideal design for this function
		
		if(isEmpty(theForm.q1))
		{
			emptyQuestion = true;
		}

		if(isEmpty(theForm.q2))
		{
			emptyQuestion = true;
		}
		if(isEmpty(theForm.q3))
		{
			emptyQuestion = true;
		}
		if(isEmpty(theForm.q4))
		{
			emptyQuestion = true;
		}
		if(isEmpty(theForm.q5))
		{
			emptyQuestion = true;
		}
		if(isEmpty(theForm.q6))
		{
			emptyQuestion = true;
		}
		if(isEmpty(theForm.q7))
		{
			emptyQuestion = true;
		}
		if(isEmpty(theForm.q8))
		{
			emptyQuestion = true;
		}
		if(isEmpty(theForm.q9))
		{
			emptyQuestion = true;
		}
		if(isEmpty(theForm.q10))
		{
			emptyQuestion = true;
		}

		//If there are any empty questions, the form does not submit
		//Since it does not submit the users answers are still on the page
		//Can't continue without answering all the questions				
	  	if (emptyQuestion == true) {
	    	alert("You must answer all of the questions to complete the quiz");

			emptyQuestion = false;
	    	return false;
	  	}

	  	emptyQuestion = false;
	  	return true;
			
	}
     
</script>
		
		<h1>HELLO YOU ARE TOTALLY TAKING A QUIZ</h1>
		<form method="post" name="theForm" onSubmit="return validateFormOnSubmit(this)">
		<table id= "quiz_table" border="1">
			<tr>
                <th>Question</th>
                <th>Strongly Disagree</th>
                <th>Somewhat Disagree</th>
                <th>Neither Agree or Disagree</th>
                <th>Somewhat Agree</th>
                <th>Strongly Agree</th>
                <th>Question Importance</th>
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
            	<!-- Building our table with the radio buttons and dropdown for weights -->
                <td><?php echo($row[1]); ?></td>   
                             
                <td align="center"><input type="radio" name="q<?php echo($row[0]); ?>" value="-1"/></td> 
                <td align="center"><input type="radio" name="q<?php echo($row[0]); ?>" value="-0.5"/></td> 
                <td align="center"><input type="radio" name="q<?php echo($row[0]); ?>" value="0"/></td> 
                <td align="center"><input type="radio" name="q<?php echo($row[0]); ?>" value="0.5"/></td> 
                <td align="center"><input type="radio" name="q<?php echo($row[0]); ?>" value="1"/></td> 
                <td>
                	<select name="weight_<?php echo($row[0]); ?>">
  						<option value="1">Critical</option>
 						<option selected="selected" value="0.3">Important</option>
  						<option value="0.1">Meh?</option>
					</select>
				</td>
            </tr>
<?php   
    }
?>
		</table>
		<p>
		<div align="center">
		<input type="submit" name="Submit" value="FIND OUT WHICH CAT YOU ARE LIKE!"/>
   <br>
   <br>
   <br>
   <br>
   <br>

		</div>
		</form>
   </div>
 </body>
</html>
