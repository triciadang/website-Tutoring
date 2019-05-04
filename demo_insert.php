<html>

<!-- Demo.php - 3/21/2011 - Steve Hadfield -->
<!-- Shows how to insert data into a database using PHP -->

 <head>
   <title>USAFA Tutoring Insert</title>
   <style> 
     body {font-family: Arial; color: black; } 
     h1 {background-color: #E6E6FA; color: #000000; }
   </style>
 </head>

 <body>
   <center>
     <h1>USAFA Tutoring Insert</h1>
     <br />
     <br />

<!-- Note the use of <?php ?> to embed PHP commands 
     and $_POST['<parameter_name>'] to get POST parameters -->

     <?php 

     // open connection to the database on LOCALHOST with 
     // userid of 'root', password '', and database 'csl'

     @ $db = new mysqli('LOCALHOST', 'root', '', 'tutor');

     // Check if there were error and if so, report and exit

     if (mysqli_connect_errno()) 
     { 
       echo 'ERROR: Could not connect to database, error is '.mysqli_connect_error();
       exit;
     }

     // convert the carAccess boolean to 'Y' or 'N'

     if (isset($_POST['carAccess'])) 
       { $carAccess='Y'; }
     else 
       { $carAccess='N'; }

     // sanitize the input from the form to eliminate possible SQL Injection

	$firstName = stripslashes($_POST['firstName']);
    $firstName = $db->real_escape_string($firstName);

	$lastName = stripslashes($_POST['lastName']);
	$lastName = $db->real_escape_string($lastName );

	$major = stripslashes($_POST['major']);
	$major = $db->real_escape_string($major);

	$squadron = stripslashes($_POST['squadron']);
	$squadron = $db->real_escape_string($squadron);

     // set up a prepared statement to insert the tutor info

     $query = "INSERT INTO tutorlist (tutorFName, tutorLName, tutorMajor, tutorSquadron) 
	           VALUES ( ?, ?, ?, ?)";  // question marks are parameter locations

     $stmt = $db->prepare($query);  // creates the Prepared Statement

	 // binds the parameters of Prepared Statement to corresponding variables
	 // first argument, "sssiss", gives the parameter data types of 3 strings, an int, 2 strings
     $stmt->bind_param("ssss", $firstName, $lastName, $major, $squadron);

     $stmt->execute();  // runs the Prepared Statement query

     echo $stmt->affected_rows.' records inserted.<br/><br/>';  // report results

     $stmt->close();  // deallocate the Prepared Statement
     $db->close();    // close the database connection
   ?>

     <table border="1" cellpadding="3">
       <tr><th>Parameter</th><th>Value</th></tr>
       <tr><td>First Name</td><td><?php echo $_POST['firstName']; ?></td></tr>
       <tr><td>Last Name</td><td><?php echo $_POST['lastName']; ?></td></tr>
       <tr><td>Major</td><td><?php echo $_POST['major']; ?></td></tr>
       <tr><td>Squadron</td><td><?php echo $_POST['squadron']; ?></td></tr>
       <tr><td>Building</td><td><?php echo $_POST['building']; ?></td></tr>
	   <tr><td>Phone Number</td><td><?php echo $_POST['phoneNumber']; ?></td></tr>
	   <tr><td>Email Address</td><td><?php echo $_POST['emailAddress']; ?></td></tr>
	   <tr><td>Class Year</td><td><?php echo $_POST['classYear']; ?>
	   
	 </td></tr>
     </table>
     <br />

<!-- Below demonstrates how to get system information from PHP -->

     Web page <b><?php echo $_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI'] ?></b><br />
     accessed on <b><?php echo date("Y-m-d H:i") ?></b> 
        from IP address <b><?php echo $_SERVER['REMOTE_ADDR'] ?></b> via
        <b><?php echo $_SERVER['REQUEST_METHOD'] ?></b><br/>
     <br />

<!-- Give a link back to the main page -->

     <a href="Index.html">Click Here</a> to return to the tutoring web site.

   </center> 
 </body>
</html> 