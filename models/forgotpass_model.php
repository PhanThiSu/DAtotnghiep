<?php 
class forgotpass_model extends vendor_frap_model
{
	public function checkOldEmail($email)
	{
		$sql = "SELECT COUNT(id) as total  FROM `users` WHERE `email` = '".$email."'";
		$result = $this->con->query($sql);
		return $result->fetch_assoc()['total'];
	}

	public function addtocken($tocken,$email)
	{
		$sql = "UPDATE users SET tocken = '$tocken' WHERE email = '$email'";
		return mysqli_query($this->con,$sql);
	}

	public function deletetocken($tocken)
	{
		$sql = "DELETE FROM users WHERE tocken = '$tocken'";
		return mysqli_query($this->con,$sql);
	}

	public function resetPassWord($tocken)
	{
		$sql = "SELECT COUNT(id) as total  FROM `users` WHERE `tocken` = '".$tocken."'";
		$result = $this->con->query($sql);
		return $result->fetch_assoc()['total'];
	}
	public function updatePassword($tocken,$password)
	{
		$sql = "UPDATE users SET password = '$password' WHERE tocken = '".$tocken."'";
		return mysqli_query($this->con,$sql);
	}
}
?>