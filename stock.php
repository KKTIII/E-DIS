<?php 

		
	session_start();

	if (!isset($_SESSION['admin_email'])) {
		echo "<script> window.open('login.php', '_self');</script>";
	}else {
	require 'func/func.php';
	
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Stock</title>
 	 <meta name="viewport" content="width=device-width,initial-scale=1"/>

	

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/material.min.css">
	
	<link rel="stylesheet" type="text/css" href="css/admin_style.css">
	<style type="text/css">
		.fom{
			margin-top: 30px;
		}
    .tb3{
    border-spacing: 20px;
    border-collapse: collapse;
    border:8px solid #ddd;
    width: 95%;
    padding:15px;
    font-size: 20px;
    font-style: italic;
    text-align: center;
    margin-top: 150px;
    

  }
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
             <li><a href="taken.php">Items Distributed</a></li>
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
$fin="SELECT * FROM stock";
$xec=mysqli_query($link,$fin);

echo '
<table border="1" class="tb3">
          <tr>
            <th style="text-align:center">ITEM</th>
            <th style="text-align:center">TOTAL AMOUNT</th>
            <th style="text-align:center">AMOUNT DISTRIBUTED</th>
            <th style="text-align:center">AMOUNT LEFT</th>
            </tr>

';
while ($row=mysqli_fetch_assoc($xec)) {
	$item=$row['item'];
	$tot=$row['total_amount'];
	$rec=$row['amount_received'];
	$left=$row['amount_left'];
	echo '
	<tr>
	     <td style="text-align:center">'.$item.'</td>
         <td style="text-align:center">'.$tot.'</td>
	     <td style="text-align:center">'.$rec.'</td>
	     <td style="text-align:center">'.$left.'</td>
	</tr>
	';

}

?>

<script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/material.min.js"></script>
 
 </body>
 </html>
 <?php } ?>