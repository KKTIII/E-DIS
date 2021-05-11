<?php
 require 'func/func.php'; 
 admin_login();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	 <meta name="viewport" content="width=device-width,initial-scale=1"/>

	

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/material.min.css">
	
	<link rel="stylesheet" type="text/css" href="css/admin_style.css">
	<style type="text/css">
	#log{
		margin-top: 40px;
		}
	.bg{
		background-image: url('images/bg.png');
	}
	.imgg{
		width: 170px;
		height: 170px;
		margin-left: 70px;
	}

	</style>

	
</head>
<body class="bg">





<div class="container ">
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4" id="log">
			<form action="" method="post">
			<div class="well" >
				
				<div class="lead text-center text-info"> Administrator Only</div><hr>
						<div class="">
							<img src="images/five.png" class="img img-responsive  imgg ">
						</div><br><hr>
		              
		             
		                <label for="inputEmail" class="sr-only">Administrator Username</label>
		                <input type="text" id="inputEmail" name="admin_user" class="form-control" placeholder="Username" required autofocus>
		                <br>
		                <label for="inputPassword" class="sr-only">Password</label>
		                <input type="password" id="inputPassword" name="admin_pass" class="form-control" placeholder="Password" required>
		               
		               	<br><br>
		               
		               <button class="lead btn btn-block btn-info" type="submit" name="admin_login">Login</button>
		             
		              	<br>
		               		    
		                 

            		</div>
            	</form>

            		<br>

		</div>
		<div class="col-md-4"></div>
	</div>
</div>




		<script type="text/javascript" src="js/popper.min.js"></script>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/material.min.js"></script>
</body>
</html>