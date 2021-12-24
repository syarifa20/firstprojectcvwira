<?php 

include ("database/mydb.php");

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Sign in</title>

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
    
<main class="form-signin">
<?php 
if (isset($_GET['halaman']))
{
  if($_GET['halaman']=="login")
  {
    include 'login.php';
  }
  elseif($_GET['halaman']=="login")
  {
    include 'login.php';
  }
  elseif($_GET['halaman']=="logout")
  {
    include 'logout.php';
  }
  elseif($_GET['halaman']=="forgotpassword")
  {
    include 'forgotpassword.php';
  }
  elseif($_GET['halaman']=="reset-password")
  {
    include 'reset-password.php';
  }
  

  
}
else
{
  include 'login.php';
}
?>


</main>

    
  </body>
</html>

