<?php
session_start();
include_once 'connection.php';

if (isset($_SESSION['rollNo'])) {
    header('location: home.php');
}

if (isset($_POST['login'])) {
    $username = htmlentities($_POST['username']);
    $password = htmlentities($_POST['password']);

    $_SESSION['rollNo'] = $username;

    if ($username == 'admin' && $password == 'admin') {
        header('location: home.php');
    } else {
        echo "<script>alert('Invalid username or password');window.location.href='index.php'</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Attendance Lan - Admin</title>

        <!--Bootsrap 4 CDN-->
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <!--Fontawesome CDN-->
    	<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    	<!--Custom styles-->
    	<link rel="stylesheet" type="text/css" href="./css/index.css?q=<?= time() ?>">
    </head>
    <body>
        <div class="container">
        	<div class="d-flex justify-content-center h-100">
        		<div class="card">
        			<div class="card-header">
        				<h3>Admin Sign In</h3>
        				<!-- <div class="d-flex justify-content-end social_icon">
        					<span><i class="fab fa-facebook-square"></i></span>
        					<span><i class="fab fa-google-plus-square"></i></span>
        					<span><i class="fab fa-twitter-square"></i></span>
        				</div> -->
        			</div>
        			<div class="card-body">
        				<form action="index.php" method="POST">
        					<div class="input-group form-group">
        						<div class="input-group-prepend">
        							<span class="input-group-text"><i class="fas fa-user"></i></span>
        						</div>
        						<input name="username" type="text" class="form-control" placeholder="username">

        					</div>
        					<div class="input-group form-group">
        						<div class="input-group-prepend">
        							<span class="input-group-text"><i class="fas fa-key"></i></span>
        						</div>
        						<input name="password" type="password" class="form-control" placeholder="password">
        					</div>
        					<div class="row align-items-center remember">
        						<input type="checkbox">Remember Me
        					</div>
        					<div class="form-group">
        						<input type="submit" name="login" value="Login" class="btn float-right login_btn">
        					</div>
        				</form>
        			</div>
        			<div class="card-footer">
        				<div class="d-flex justify-content-center links">
        					Don't have an account?<a href="#">Sign Up</a>
        				</div>
        				<div class="d-flex justify-content-center">
        					<a href="#">Forgot your password?</a>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
    </body>
</html>
