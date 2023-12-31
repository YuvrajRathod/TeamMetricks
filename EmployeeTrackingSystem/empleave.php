<?php
	require_once ('process/dbh.php');
	//$sql = "SELECT * from `employee_leave`";
	$sql = "Select employee.id, employee.firstName, employee.lastName, employee_leave.start, employee_leave.end, employee_leave.reason, employee_leave.status, employee_leave.token From employee, employee_leave Where employee.id = employee_leave.id order by employee_leave.token";
	//echo "$sql";
	$result = mysqli_query($conn, $sql);
?>
<html>
	<head>
		<title>Employee Leave | Admin Panel | TeamMetricks</title>
		<link rel="stylesheet" type="text/css" href="styleview.css">
	</head>
	<body>		
		<header>
			<nav>
				<h1>TeamMetricks</h1>
				<ul id="navli">
					<li><a class="homeblack" href="aloginwel.php">HOME</a></li>
                    <li><a class="homeblack" href="addemp.php">ADD EMP</a></li>
                    <li><a class="homeblack" href="viewemp.php">VIEW EMP</a></li>
                    <li><a class="homeblack" href="assign.php">ASSIGN PROJECT</a></li>
                    <li><a class="homeblack" href="assignproject.php">PROJECT STATUS</a></li>
                    <li><a class="homeblack" href="salaryemp.php">SALARY TABLE</a></li> 
                    <li><a class="homered" href="empleave.php">EMP LEAVE</a></li>
                    <li><a class="homeblack" href="alogin.html">LOG OUT</a></li>
				</ul>
			</nav>
		</header>
		<div class="divider"></div>
		<div id="divimg">
			<table>
				<tr>
					<th>Emp. ID</th>
					<th>Token</th>
					<th>Name</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th>Total Days</th>
					<th>Reason</th>
					<th>Status</th>
					<th>Options</th>
				</tr>
				<?php
					while ($employee = mysqli_fetch_assoc($result)) {
					$date1 = new DateTime($employee['start']);
					$date2 = new DateTime($employee['end']);
					$interval = $date1->diff($date2);
					$interval = $date1->diff($date2);
					//echo "difference " . $interval->days . " days ";
						echo "<tr>";
						echo "<td>".$employee['id']."</td>";
						echo "<td>".$employee['token']."</td>";
						echo "<td>".$employee['firstName']." ".$employee['lastName']."</td>";					
						echo "<td>".$employee['start']."</td>";
						echo "<td>".$employee['end']."</td>";
						echo "<td>".$interval->days."</td>";
						echo "<td>".$employee['reason']."</td>";
						echo "<td>".$employee['status']."</td>";
						echo "<td><a href=\"approve.php?id=$employee[id]&token=$employee[token]\"  onClick=\"return confirm('Are you sure you want to Approve the request?')\">Approve</a> | <a href=\"cancel.php?id=$employee[id]&token=$employee[token]\" onClick=\"return confirm('Are you sure you want to Canel the request?')\">Cancel</a></td>";
						echo "</tr>";
					}
				?>
			</table>
		</div>
	</body>
</html>