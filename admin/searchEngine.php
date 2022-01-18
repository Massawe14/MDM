<?php 
  include('authentication.php');
  include('config/dbconn.php');

  if (isset($_POST['input'])) {
  	
  	$input = $_POST['input'];

  	$query = "SELECT * 
  	          FROM users 
  	           INNER JOIN devices USING (username)
  	          WHERE username LIKE '{$input}%' OR first_name LIKE '{$input}%' OR last_name LIKE '{$input}%' OR email LIKE '{$input}%' OR device_id LIKE '{$input}%' OR name LIKE '{$input}%'";

  	$result = mysqli_query($conn, $query);

  	if (mysqli_num_rows($result) > 0) {?>
  		
  		<table class="table table-bordered table-striped mt-4">
  			<thead>
  				<tr>
  					<th>SN</th>
  					<th>Firstname</th>
  					<th>Lastname</th>
  					<th>Username</th>
  					<th>Email</th>
  					<th>Device ID</th>
  					<th>Device Name</th>
  				</tr>
  			</thead>
  			<tbody>
  				<?php  
  				  while ($row = mysqli_fetch_assoc($result)) {

  				  	$sn = $row['sn'];
  				  	$firstname = $row['first_name'];
  				  	$lastname = $row['last_name'];
  				  	$username = $row['username'];
  				  	$email = $row['email'];
  				  	$device_id = $row['device_id'];
  				  	$name = $row['name'];

  				  	?>

  				  	  <tr>
  				  	  	<td><?php echo $sn; ?></td>
  				  	  	<td><?php echo $firstname; ?></td>
  				  	  	<td><?php echo $lastname; ?></td>
  				  	  	<td><?php echo $username; ?></td>
  				  	  	<td><?php echo $email; ?></td>
  				  	  	<td><?php echo $device_id; ?></td>
  				  	  	<td><?php echo $name; ?></td>
  				  	  </tr>

  				  	<?php
  				  }
  				?>
  			</tbody>
  		</table>

  		<?php

  	}else{
  		echo "<h6 class='text-danger text-center mt-3'>No data found</h6>";
  	}
  }
?>