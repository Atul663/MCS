<?php
include('config.php');

if (isset($_POST["login"])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	$sql = "SELECT role FROM userRole where email = ?";
	$stmt1 = $mysqli->prepare($sql);
	$stmt1->bind_param('s', $email);
	$stmt1->execute();
	$res = $stmt1->get_result();
	$roleAssoc = $res->fetch_assoc();

	if ($roleAssoc) {
		$role = $roleAssoc['role'];
		// This line is just for testing purposes
		if ($role != null) {
			$query = "SELECT * FROM $role WHERE email = ?";  // Modify this query
			$stmt = $mysqli->prepare($query);
			$stmt->bind_param('s', $email);
			$stmt->execute();
			$result = $stmt->get_result();
			$rs = $result->fetch_assoc();

			if ($rs) {
				if ($role == "citizen") {
					header('Location: userDash.php');
                	exit();
				} elseif ($role == "admin") {
					header('Location: adminDash.php');
                	exit();
				}
				else{
					echo $role;
				}
				exit(); // Important to stop further script execution
			}
		} else{
			echo "hello";
		}
	}else{
		echo "<script>alert('user does not exists.');</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<div class="ts-main-content">
	<?php include('includes/sidebar.php'); ?>
	<form action="" class="mt" method="post">
		<label for="" class="text-uppercase text-sm">Email</label>
		<input type="text" placeholder="Email" name="email" class="form-control mb">
		<label for="" class="text-uppercase text-sm">Password</label>
		<input type="password" placeholder="Password" name="password" class="form-control mb">
		<input type="submit" name="login" class="btn btn-primary btn-block" value="Login">
	</form>
</div>

</html>