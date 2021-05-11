<?php 

		
	session_start();

	if (!isset($_SESSION['admin_email'])) {
		echo "<script> window.open('login.php', '_self');</script>";
	}else {
		
	


	require 'func/config.php';
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Porters'</title>
	 <meta name="viewport" content="width=device-width,initial-scale=1"/>

	

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/material.min.css">
	
	<link rel="stylesheet" type="text/css" href="css/admin_style.css">
	<style type="text/css">
		.fom{
			margin-top: 30px;
		}
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
		
	</style>
 </head>
 <body>
 	<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">E-DISTRIBUTION APP</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
     
      <ul class="nav navbar-nav navbar-right">

      

        <li><a href="#">&nbsp;</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['admin_email']; ?><span class="caret"></span></a>
          <ul class="dropdown-menu">

            <li><a href="index.php">Home</a></li>
            <li><a href="verify.php">Distribute Items</a></li>
            <li><a href="filter.php">Search</a></li>
             <li><a href="porters.php">Porters' Lodge</a></li>
             
           
            <li role="separator" class="divider"></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>

    

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<?php
global $link;
if (isset($_POST['sub'])) {
	$room_search=mysqli_escape_string($link, trim($_POST['room_number']));
	if (empty($room_search)) {
		header("Refresh: 0; url=porters.php");
		echo '<script type=""> alert("PLEASE ENTER ROOM NUMBER");</script>';
	}
	else{
		
		$query= "SELECT * FROM add_student WHERE room='$room_search';";
		$result=mysqli_query($link,$query);
		$true = mysqli_num_rows($result);
		if ($true >= 1) {
			while ($row = mysqli_fetch_assoc($result)) {
				$fname=$row['f_name'];
				$lname=$row['l_name'];
				$level=$row['level'];
				$prog=$row['program'];
				$pic=$row['student_photo'];
				$guardian=$row['g_phone'];
				echo '
				<div class="container ">
	<div class="row">
		
		<div class="col-md-3" id="log">
			<form style="font-style:italic; font-size:15px;">
			<div class="well" >
				
						<div align="center">
							<img src="images/Profile/'.$pic.'" width="150px;" height="200px;">
						</div><br><hr>
						<div>
						<tr>
						<td >NAME: '.$fname.'&nbsp;'.$lname.'</td>
						</tr><hr>
						<tr>
						<td>LEVEL: '.$level.'</td>
						</tr><hr>
						<tr>
						<td>PROGRAM: '.$prog.'</td>
						</tr><hr>
						<tr>
						<td>GUARDIAN CONTACT: '.$guardian.'</td>
						</tr>
						</div>
		              
            		</div>
            	</form>

		</div
			

				';
				
		}
	}
	else{
		header("Refresh: 0; url=porters.php");
		echo '<script type=""> alert("ROOM ENTERED DOES NOT EXIST");</script>';
	}
  }
}
?>













<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/material.min.js"></script>
 
 </body>
 </html>
 <?php } ?>
