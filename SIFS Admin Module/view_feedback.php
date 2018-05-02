<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

    <title>Safety Feedback</title>
</head>
<style>
    .login-panel {
        margin-top: 150px;
    }
     .table {
        margin-top: 40px;
    }
	
	 .title {
        margin-top: 40px;
    }
	
	 .subtitle {
        margin-top: 20px;
    }

	.incenter {
		  display: block;
  margin-right: auto;
  margin-left: auto;
  line-height: 2em;
  width:20em;
	}
	
</style>

<body>
<?php $currentPage="Safety Feedback List"; ?>
<?php 
include('header.php'); ?>
<div class="table-scrol">
       <h1 align="center" class="title"><span class="alert alert-success">User Submitted Feedbacks</span></h1>
 <h3 align="center" class="subtitle">Search Feedback Details</h3> 
	    <p align="center">Search using Feedback Title</p> 
	<input class="incenter" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Feedback Titles..">
    <table id="myTable" class="table  table-responsive-md table-hover  table-striped" >
        <thead class="mdb-color lighten-4">

        <tr>

            <th onclick="sortTable(0)">#</th>
            <th onclick="sortTable(1)"><i class="fa fa-user fa-lg pr-2" aria-hidden="true"></i> First Name</th>
            <th onclick="sortTable(2)"><i class="fa fa-user fa-lg pr-2" aria-hidden="true"></i> Last Name</th>
            <th onclick="sortTable(3)"><i class="fa fa-leaf fa-lg pr-2" aria-hidden="true"></i> Gender</th>
            <th onclick="sortTable(4)"><i class="fa fa-leaf fa-lg pr-2" aria-hidden="true"></i> Feedback Title</th>
            <th onclick="sortTable(5)"><i class="fa fa-pencil fa-lg pr-2" aria-hidden="true"></i> Feedback Reason</th>
            <th onclick="sortTable(6)"><i class="fa fa-calendar-o fa-lg pr-2" aria-hidden="true"></i> Date</th>
            <th onclick="sortTable(7)"><i class="fa fa-clock-o  fa-lg pr-2" aria-hidden="true"></i> Time</th>
            <th onclick="sortTable(8)"><i class="fa fa-star-half-o fa-lg pr-2" aria-hidden="true"></i> Rating</th>
            <th><i class="fa fa-map-o fa-lg pr-2" aria-hidden="true"></i> Latitude</th>
            <th><i class="fa fa-map-o fa-lg pr-2" aria-hidden="true"></i> Longitude</th>
            <th>Actions</th>
        </tr>
        </thead>

        <?php
        include("database/db_conection.php");
        $view_users_query="select * from feedback where isActive=1";//select query for viewing users.
        $run=mysqli_query($dbcon,$view_users_query);//here run the sql query.

        while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.
        {
            $f_id=$row[0];
            $f_fname=$row[2];
            $f_lname=$row[3];
            $f_gender=$row[11];
            $f_title=$row[5];
            $f_reason=$row[4];
            $f_date=$row[9];
            $f_time=$row[10];
            $f_rate=$row[6];
            $f_lat=$row[7];
            $f_lon=$row[8];
          
     
        ?>

        <tr>
<!--here showing results in the table -->
            <td><?php echo $f_id;  ?></td>
            <td><?php echo $f_fname;  ?></td>
            <td><?php echo $f_lname;  ?></td>
            <td><?php echo $f_gender;  ?></td>
            <td><?php echo $f_title;  ?></td>
            <td><?php echo $f_reason;  ?></td>
            <td><?php echo $f_date;  ?></td>
            <td><?php echo $f_time;  ?></td>
            <td><?php echo $f_rate;  ?></td>
            <td><?php echo $f_lat;  ?></td>
            <td><?php echo $f_lon;  ?></td>
        
            <td><a href="delete_feedback.php?del=<?php echo $f_id ?>"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">DELETE</button></a></td> 
        </tr>

        <?php } ?>

    </table>
   
</div>


</body>
<script>
function myFunction() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}

function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc"; 
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++; 
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}

</script>
</html>
