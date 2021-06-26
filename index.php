<?php 
	session_start();
	include 'config/connection.php';
	@$user = $_POST['user'];
	@$pass = $_POST['pass'];
	@$hak = $_POST['hak'];
	@$req = "dashboard.php";

	if (isset($_POST['login'])) {
		if (empty($user) || empty($pass)) {
			echo "<script>alert('Data tidak boleh kosong');</script>";
		}else{
			@$sql = mysqli_query($con, "SELECT * FROM user WHERE username = '$user' AND password = '$pass' AND akses = '$hak'");
			@$cek = mysqli_num_rows($sql);
			@$data = mysqli_fetch_array($sql);
			if ($cek == 1) {
				if ($data['akses'] == 'manager') {
					$_SESSION['hak_akses'] = $hak;
					$_SESSION['username'] = $user;
          $_SESSION['id']=$data['id'];
					echo "<script>alert('Selamat datang manager');document.location.href='$req'</script>";
				}elseif ($data['akses'] == 'admin') {
					$_SESSION['hak_akses'] = $hak;
					$_SESSION['username'] = $user;
          $_SESSION['id']=$data['id'];
					echo "<script>alert('Selamat datang Admin');document.location.href='$req'</script>";
				}elseif ($data['akses'] == 'kasir') {
					$_SESSION['hak_akses'] = $hak;
					$_SESSION['username'] = $user;
          $_SESSION['id']=$data['id'];
					echo "<script>alert('Selamat datang Kasir');document.location.href='$req'</script>";
				}
			}else{
				echo "<script>alert('Gagal Login');</script>";	
			}
		}
	}
 ?>
<html>
	<head>
		<title>Form Login</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	</head>
	<body>
		<form method="post" >
					<div class="position-absolute top-50 start-50 translate-middle w-25 text-secondary border border-5  rounded p-4 shadow  border-start-0 border-end-0">

										<label class="form-label h6 mb-2">Username</label>
										<input type="text" name="user" class="form-control" placeholder="masukan username" required="">
									
										<label class="form-label h6 mb-2">Password</label>
										<input class="form-control" rows="3" id="inputPassword3" type="password" name="pass" placeholder="masukan password">
								
                    <label class="form-label h6 mb-2">Hak Akses</label>
                    
                      <select class="form-control" name="hak">
                        <option selected>Pilih akses</option>
                        <option value="admin">Admin</option>
                        <option value="kasir">Kasir</option>
                        <option value="manager">Manager</option>
                      </select>
                     
                                    
									<div>
										<button class="btn btn-primary text-light mt-3" type="submit" name="login">Login</button>
									</div>
					</div>
		</form>
	</body>
</html>