<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php 
    // Gain access to DB
    require_once "db.php";
    // Initialize session for page
    session_start();

    // Need to check whether the user came to this page because of clicking the
    // link from the index page or because of the form submission in this page.
    if ( isset($_POST['Submit'])) 
    {
        // Came to this page because of the form submission.

    	////////////////////////////////////START WORKING HERE ////////////////////////////////////////
        // Safeguard entered values 
        $make = trim(mysql_real_escape_string($_POST['txtMake']));
        $model = trim(mysql_real_escape_string($_POST['txtModel']));
        $year = trim(mysql_real_escape_string($_POST['txtYear']));
        $miles = trim(mysql_real_escape_string($_POST['txtMiles']));
        $price = trim(mysql_real_escape_string($_POST['txtPrice']));
        
        // Various checks of entered values
        if ( empty($make) )
            // Value for make is an empty string
            // Set error message to display in index page
            $_SESSION['sesError'] = "Add Error: Make cannot be an empty string";
        elseif ( empty($model) )
            // Value for model is an empty string
            // Set error message to display in index page
            $_SESSION['sesError'] = "Add Error: Model cannot be an empty string";
        elseif ( empty($year) )
            // Value for year is an empty string
            // Set error message to display in index page
            $_SESSION['sesError'] = "Add Error: Year cannot be empty";
        elseif ( is_numeric($year) === False )
            // Value for year is not numeric
            // Set error message to display in index page
            $_SESSION['sesError'] = "Add Error: Year must be an interger";
        elseif ( empty($miles) )
            // Value for miles is an empty string
            // Set error message to display in index page
            $_SESSION['sesError'] = "Add Error: Miles cannot be empty";
        elseif ( is_numeric($miles) === False ) 
            // Value for miles is not numeric
            // Set error message to display in index page
            $_SESSION['sesError'] = "Add Error: Miles must be an interger";
        elseif ( empty($price) )
            // Value for price is an empty string
            // Set error message to display in index page
            $_SESSION['sesError'] = "Add Error: Price cannot be empty";
        elseif ( is_numeric($price) === False ) 
            // Value for price is not numeric
            // Set error message to display in index page
            $_SESSION['sesError'] = "Add Error: Prices must be an interger";
        else 
        {
            // Everything is ok so insert new record
            $sql = "INSERT INTO cars (make, model, year, miles, price)
                    VALUES ('$make', '$model', $year, $miles, $price)";
            mysql_query($sql);
            
            // Set message to display in index page
            $_SESSION['sesMessage'] = 'Record Added';
        }
        // Redirect to index page
        header( 'Location: results.php' );        
        // Suspend further execution of this page and wait for redirect
        return;
    }
?>
    
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
        <li><a href="conferences.html">Conferences</a></li>
      </ul>
   </div>

   <div id="bodycontent">
		
		<h1>HELLO YOU ARE TOTALLY TAKING A QUIZ</h1>
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
    // Create sql command
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
                <td align="center"><input type="radio" name=<?php echo($row[0]); ?> value="STdiagree"/></td> <!-- Column 3 in table = column 4 in SQL -->
                <td align="center"><input type="radio" name=<?php echo($row[0]); ?> value="SWdiagree"/></td> <!-- Column 3 in table = column 4 in SQL -->
                <td align="center"><input type="radio" name=<?php echo($row[0]); ?> value="Neutral"/></td> <!-- Column 3 in table = column 4 in SQL -->
                <td align="center"><input type="radio" name=<?php echo($row[0]); ?> value="SWagree"/></td> <!-- Column 3 in table = column 4 in SQL -->
                <td align="center"><input type="radio" name=<?php echo($row[0]); ?> value="STagree"/></td> <!-- Column 3 in table = column 4 in SQL -->
            </tr>
<?php
    }
?>
		</table>

		<form method="post">
		<input type="submit" name="Submit" value="FIND OUT WHICH CAT YOU ARE LIKE!"/>
		</form>


   </div>
 </body>
</html>
<?php
?>