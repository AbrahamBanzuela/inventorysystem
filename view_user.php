<?php
include "connect.php";


$query = "select * from users order by names";

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$cH = "<table class='table table-striped table-bordered table-hover table-responsive' style='font-size:12px' cellspacing='0'>
			<tr>
				<th style='background-color: lightblue; text-align: center'>Name</th>
				<th style='background-color: lightblue; text-align: center'>Username</th>
                <th style='background-color: lightblue; text-align: center'>Passsword</th>
                <th style='background-color: lightblue; text-align: center'>User Type</th>
			</tr>
";

while ( $row = mysqli_fetch_assoc($result) ) {

	$cH .= "<tr style='cursor:pointer;' class='current_record' record_id='".$row["login_id"]."'>
				<td style='text-align: center'>".$row["names"]."</td>
				<td style='text-align: center'>".$row["username"]."</td>
                <td style='text-align: center'>".$row["password"]."</td>
				<td style='text-align: center'>".$row["user_type"]."</td>
			</tr>";
	
}

$cH .= "</table>";

echo $cH;

?>