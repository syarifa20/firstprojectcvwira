<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Reset Password</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin"


<?php
include ('database/mydb.php');
if (isset($_GET["key"]) && isset($_GET["email"])
&& isset($_GET["action"]) && ($_GET["action"]=="reset")
&& !isset($_POST["action"])){
$key = $_GET["key"];
$email = $_GET["email"];
$curDate = date("Y-m-d H:i:s");
$query = mysqli_query($con,"
SELECT * FROM `password_reset_temp` WHERE `key`='".$key."' and `email`='".$email."';");
$row = mysqli_num_rows($query);
if ($row==""){
$error .= '<h2>Invalid Link</h2>
<p>The link is invalid/expired. Either you did not copy the correct link from the email, 
or you have already used the key in which case it is deactivated.</p>
<p><a href="localhost/wiracek2/index.php?halaman=reset-password">Click here</a> to reset password.</p>';
	}else{
	$row = mysqli_fetch_assoc($query);
	$expDate = $row['expDate'];
	if ($expDate >= $curDate){
?>
 <br />
 <h1 class="h3 mb-3 fw-normal">Reset passsword</h1>
	<form method="post" action="" name="update">
	<input type="hidden" name="action" value="update" />
	
    <div class="form-floating">
      <input type="password" class="form-control" id="pass1" name="pass1" autocomplete="off" maxlength="15" required>
      <label for="floatingPassword">Password</label>
     </div>
     <div class="form-floating">
      <input type="password" class="form-control" id="pass2" name="pass2" autocomplete="off" maxlength="15" required>
      <label for="floatingPassword">Masukkan ulang</label>
     </div>
	<input type="hidden" name="email" value="<?php echo $email;?>"/>
	<input type="submit" id="reset" value="Reset Password" class="w-100 btn btn-primary" />
	</form>
<?php
}else{
$error .= "<h2>Link Expired</h2>
<p>The link is expired. You are trying to use the expired link which as valid only 24 hours (1 days after request).<br /><br /></p>";
				}
		}
if($error!=""){
	echo "<div class='error'>".$error."</div><br />";
	}			
} // isset email key validate end


if(isset($_POST["email"]) && isset($_POST["action"]) && ($_POST["action"]=="update")){
$error="";
$pass1 = mysqli_real_escape_string($con,$_POST["pass1"]);
$pass2 = mysqli_real_escape_string($con,$_POST["pass2"]);
$email = $_POST["email"];
$curDate = date("Y-m-d H:i:s");
if ($pass1!=$pass2){
		$error .= "<p>Password do not match, both password should be same.<br /><br /></p>";
		}
	if($error!=""){
		echo "<div class='error'>".$error."</div><br />";
        
		}else{

$pass1 = md5($pass1);
mysqli_query($con,
"UPDATE `petugas` SET `password`='".$pass1."', `trn_date`='".$curDate."' WHERE `email`='".$email."';");	

mysqli_query($con,"DELETE FROM `password_reset_temp` WHERE `email`='".$email."';");		
	
echo '<div class="error"><p>Congratulations! Your password has been updated successfully.</p>
<p><a href="index.php?halaman=login">Click here</a> to Login.</p></div><br />';
		}		
    }
?>

</main>

    
  </body>
</html>