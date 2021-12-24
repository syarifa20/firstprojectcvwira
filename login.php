<form method="post">
    <h1 class="h3 mb-3 fw-normal">Please Login</h1>

    <div class="form-floating">
      <input type="text" class="form-control" id="username" name="username" autocomplete="off" required>
      <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="password" name="password" autocomplete="off" required>
      <label for="floatingPassword">Password</label>
     </div>
	 
    <div class="checkbox mb-3">
    </div>
    <input type="submit" name="login" value="Login" id="login" class="w-100 btn btn-lg btn-primary">
  </form>
  <a href="index.php?halaman=forgotpassword">lupa kata sandi?</a>
  <?php 
	if(isset($_POST['login'])){
		$cek = "";
		$username = mysqli_real_escape_string($con,$_POST['username']);
		$password = mysqli_real_escape_string($con,md5($_POST['password']));
	
		$sql = mysqli_query($con,"SELECT * FROM petugas WHERE username='$username' AND password='$password' ");
		$cek = mysqli_num_rows($sql);
		$data = mysqli_fetch_assoc($sql);


		if ($data['level'] == "admin") {
			session_start();
			$_SESSION['username'] = $username;
			$_SESSION['data'] = $data;
			header('location:adminpage/');
		} 
		elseif ($data['level'] == "petugas") {
			session_start();
			$_SESSION['username'] = $username;
			$_SESSION['data'] = $data;
			header('location:petugas/');
		}
		elseif ($data['level'] == "remaching") {
			session_start();
			$_SESSION['username'] = $username;
			$_SESSION['data'] = $data;
			header('location:remaching/');
		}
		else{
			echo "<script>alert('Gagal Login')</script>";
			// echo "<script>location='index.php?halaman=login';</script>";
		}

	}
 ?>