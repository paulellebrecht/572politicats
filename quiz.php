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
    $sql = "SELECT id, make, model, year, miles, price FROM cars";
    // Retrieve all records
    $result = mysql_query($sql);
    
    // Iterate for each row retrieved from database
    while ( $row = mysql_fetch_row($result) ) 
    {
        // Display one record per HTML row
?>
            <tr>
                <td><?php echo(htmlentities($row[1])); ?></td>                
                <td align="left"><?php echo(htmlentities($row[2])); ?></td> <!-- Column 2 in table = column 3 in SQL -->
                <td align="center"><input type="radio" name=<?php echo(htmlentities($row[1])); ?> value="STdiagree"/></td> <!-- Column 3 in table = column 4 in SQL -->
                <td align="center"><input type="radio" name=<?php echo(htmlentities($row[1])); ?> value="SWdiagree"/></td> <!-- Column 3 in table = column 4 in SQL -->
                <td align="center"><input type="radio" name=<?php echo(htmlentities($row[1])); ?> value="Neutral"/></td> <!-- Column 3 in table = column 4 in SQL -->
                <td align="center"><input type="radio" name=<?php echo(htmlentities($row[1])); ?> value="SWagree"/></td> <!-- Column 3 in table = column 4 in SQL -->
                <td align="center"><input type="radio" name=<?php echo(htmlentities($row[1])); ?> value="STagree"/></td> <!-- Column 3 in table = column 4 in SQL -->
            </tr>
<?php
    }
?>


			
			<tr>
				<td>Governments, like households, shouldn't take on more debt by spending more than they earn</td>
				<td></td>
				<td><input type="radio" name="q1" value="disagree"/></td>
				<td><input type="radio" name="q1" value="agree"/></td>
				<td><input type="radio" name="q1" value="disagree"/></td>
				<td><input type="radio" name="q1" value="agree"/></td>
				<td><input type="radio" name="q1" value="disagree"/></td>
			</tr>
			<tr>
				<td>Taxes are necessary because they pay for public services I appreciate like a police force, firefighters, and paved roads</td>
				<td></td>
				<td><input type="radio" name="q2" value="disagree"/></td>
				<td><input type="radio" name="q2" value="agree"/></td>
			</tr>
		</table>
   </div>
 </body>
</html>
<?php
?>