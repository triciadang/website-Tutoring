<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<!-- all-tutors.php - 3/22/2011 - Steve Hadfield -->
<!-- Shows how to retrieve data with SQL using PHP -->

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
  <head>
    <title>Tutors</title>
    <link type="text/css" rel="stylesheet" href="csl.css">
		
<!-- Set up style for form error feedback areas -->
    <style type="text/css">
      .formError { color: red; font-weight: bold }
    </style>
  </head>

<body>
	<table border="0" width="100%">
		<tbody>
			<tr>
				<td colspan="4"><div id="tutor_site_title"><br /><center>USAFA Tutoring</center><br /></div></td>
			</tr>
			<tr>
				<td width="25%"><center><div id="tutor_navigation"><a href="index.html">Intro</a></div></center></td>
				<td width="25%"><center><div id="tutor_navigation"><a href="find-tutor.html">Find A Tutor</a></div></center></td>
				<td width="25%"><center><div id="tutor_navigation"><a href="tutor-sign-up.html">Be A Tutor</a></div></center></td>
				<td width="25%"><center><div id="tutor_navigation"><a href="all-tutors.php">All Tutors</a></div></center></td>
			</tr>
			<tr>
				<td colspan="4">
				
				
				
           <div id="tutor_page_title">
             <br /><p><center>List of All Tutors</center><p>
           </div>
           <center>
           <table border="1" cellpadding="4">
             <tr><th>First Name</th><th>Last Name</th><th>Class Year</th><th>Squadron</th><th>Building</th>
			 <th>Room Number</th><th>Major</th><th>Email Address</th><th>Phone Number</th></tr>

<!-- Note the use of <?php ?> to embed PHP commands 
     and connect to the database and retrieve the info -->

             <?php 

             // open connection to the database on LOCALHOST with 
             // userid of 'root', password '', and database 'tutor'

             @ $db = new mysqli('LOCALHOST', 'root', '', 'tutor');

             // Check if there were error and if so, report and exit

             if (mysqli_connect_errno()) 
             { 
               echo 'ERROR: Could not connect to database.  Error is '.mysqli_connect_error();
               exit;
             }

             // run the SQL query to retrieve the service partner info

             $results = $db->query('SELECT * FROM cadet INNER JOIN squadron USING(Squadron_Number)');

             // determine how many rows were returned

             $num_results = $results->num_rows;
			 
			 // check for empty values
			 $noFirstName = 0;
			 $noLastName = 0;
			 $noMajor = 0;
			 $noSquadron = 0;
			 
			 if(strcasecmp($_POST['firstName'],'')!=0)
			 {
				 $noFirstName = 1;
			 }
			 if(strcasecmp($_POST['lastName'],'')!=0)
			 {
				 $noLastName = 1;
			 }
			 if(strcasecmp($_POST['major'],'')!=0)
			 {
				 $noMajor = 1;
			 }
			 if(strcasecmp($_POST['squadron'],'')!=0)
			 {
				 $noSquadron = 1;
			 }

             // loop through each row building the table rows and data columns

             for ($i=0; $i < $num_results; $i++) 
             {
               $r= $results->fetch_assoc();
			   if((($noFirstName == 0) OR (strcasecmp($r['First_Name'],$_POST['firstName']) == 0)) AND 
			   (($noLastName == 0) OR (strcasecmp($r['Last_Name'],$_POST['lastName']) == 0)) AND 
			   (($noMajor == 0) OR (strcasecmp($r['Major'],$_POST['major']) == 0)) AND
			   (($noSquadron == 0) OR (strcasecmp($r['Squadron_Number'],$_POST['squadron']) == 0)) AND
			   (($noFirstName+$noLastName+$noMajor+$noSquadron)>0))
			   {
				   print '<tr><td>'.$r['First_Name'].'</td><td>'.$r['Last_Name'].'</td>
				   <td>'.$r['Class_Year'].'</td><td>'.$r['Squadron_Number'].'</td>
				   <td>'.$r['Building'].'</td><td>'.$r['Room_Number'].'</td>
				   <td>'.$r['Major'].'</td><td>'.$r['Email_Address'].'</td>
				   <td>'.$r['Phone_Number'].'</td></tr>';
				   print '<tr><th>Courses:</th><td colspan="8">'.$r['Courses'].'</td></tr>';
			   }
             }

             // deallocate memory for the results and close the database connection
			 
			 $results->free();
             $db->close();

           ?>
		   
		   <br />

<!-- Note the use of <?php ?> to embed PHP commands
     and $_POST['<parameter_name>'] to get POST parameters -->

     <br />
	 
           </table>
           </center>
           <br />
         </td>
       </tr>
     </tbody>
   </table>
 </center> 
 </body>
</html> 