 <?php
 global $link;
  session_start();

  if (!isset($_SESSION['admin_email'])) {
    echo "<script> window.open('login.php', '_self');</script>";
  }
    else {
    require 'func/func.php';
    verify();
    ?>

<!DOCTYPE html>
<html>
<head>
	<title>Verify Student</title>
	 <meta name="viewport" content="width=device-width,initial-scale=1"/>

	

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/material.min.css">
	
	<link rel="stylesheet" type="text/css" href="css/admin_style.css">
	<style type="text/css">
	.bg{
		background-image: url('images/bg.png');
	}
	#log{
		margin-top: 50px;
		}
	body{
		background-image: url('images/ad_back.jpg');
	}
	.imgg{
		width: 200px;
		height: 200px;
		margin-left: 50px;
	}

	</style>

	
</head>
<body class="bg">





<div class="container ">
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4" id="log">
			<div class="well" >
				
				<div class="lead text-center text-info"> Verify Student </div><hr>
						<div class="">
							<img src="images/five.png" class="img img-responsive  imgg ">
						</div><br><hr>
		              <form class=""  action="" method="post">
		             	
		                <input type="text" id="index-number" name="index" class="form-control" placeholder="Index Number" >
		               
		               	<br>
		               
		                <button class="lead btn btn-block btn-info" type="submit" name="verify-me">Verify Me</button>
		              </form>
		              	<br>
		               		    
		                

            		</div>
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
<?php } ?>