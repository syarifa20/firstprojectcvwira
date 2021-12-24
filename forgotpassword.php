<form method="post" action="" name="reset">
    <h1 class="h3 mb-3 fw-normal">Masukkan email</h1>
    <div class="form-floating">
      <input type="email" class="form-control" id="email" name="email" autocomplete="off"  required>
      <label for="floatingInput">Email</label>
    </div>
</div>
  <br>

    <input type="submit" value="Reset password"  class="w-100 btn btn-primary">

  </form>
  <?php
if(isset($_POST["email"]) && (!empty($_POST["email"]))){
$email = $_POST["email"];
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$email = filter_var($email, FILTER_VALIDATE_EMAIL);
if (!$email) {
  	$error .="<p>Invalid email address please type a valid email address!</p>";
	}else{
	$sel_query = "SELECT * FROM `petugas` WHERE email='".$email."'";
	$results = mysqli_query($con,$sel_query);
	$row = mysqli_num_rows($results);
	if ($row==""){
		$error .= "<p>No user is registered with this email address!</p>";
		}
	}
	if($error!=""){
	echo "<div class='error'>".$error."</div>
	<br /><a href='javascript:history.go(-1)'>Go Back</a>";
		}else{
	$expFormat = mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+1, date("Y"));
	$expDate = date("Y-m-d H:i:s",$expFormat);
	$key = md5(time());
	$addKey = substr(md5(uniqid(rand(),1)),3,10);
	$key = $key . $addKey;
// Insert Temp Table
mysqli_query($con,
"INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`)
VALUES ('".$email."', '".$key."', '".$expDate."');");

$output='<p>Dear user,</p>';
$output.='<p>Klik link dibawah ini untuk mengganti kata sandi.</p>';
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p><a href="http://localhost/wiracek2/reset-password.php?key='.$key.'&email='.$email.'&action=reset" target="_blank">http://localhost/wiracek2/reset-password.php?reset-password.php?key='.$key.'&email='.$email.'&action=reset</a></p>';		
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p>Tolong copy kan atau klik link nya buat masuk ke browser.
link ini akan expired dalam jangka waktu 1 hari,jadi segera reset dalam waktu 24 jam.</p>';
	
$output.='<p>Terima kasih,</p>';
$output.='<p>WIRA ARYA SEJAHTERA</p>';
$body = $output; 
$subject = "Password Recovery - CV WIRA ARYA SEJAHTERA";

$email_to = $email;
$fromserver = "syaripah2004@gmail.com"; 
require("PHPMailer/PHPMailerAutoload.php");
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = "smtp.gmail.com"; // Enter your host here
$mail->SMTPAuth = true;
$mail->Username = "syaripah2004@gmail.com"; // Enter your email here
$mail->Password = "Syarifahnasriyah20"; //Enter your passwrod here
$mail->Port = 587;
$mail->IsHTML(true);
$mail->From = "syaripah2004@gmail.com";
$mail->FromName = "Syaripah Nasriyah";
$mail->Sender = $fromserver; // indicates ReturnPath header
$mail->Subject = $subject;
$mail->Body = $body;
$mail->AddAddress($email_to);
if(!$mail->Send()){
echo "Mailer Error: " . $mail->ErrorInfo;
}else{
echo "<div class='error'>
<p>An email has been sent to you with instructions on how to reset your password.</p>
</div><br /><br /><br />";
	}
}
}


?>