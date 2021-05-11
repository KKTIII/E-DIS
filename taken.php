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
	<title>List</title>
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
    font-size: 15px;
    font-style: italic;
    text-align: center;
    

  }
	</style>

	
</head>
<body class="">

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
            <li><a href="verify.php">Distribute Items</a></li>
             <li><a href="stock.php">Items Stock</a></li>
            <li><a href="addStudent.php">Add Student</a></li>
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
$idea="SELECT * FROM add_student";
$lat=mysqli_query($link,$idea);
$true = mysqli_num_rows($lat);
if ($true>=1) {
  echo '
  <table border="1" class="tb3">
          <tr>
            <th style="text-align:center">NAME</th>
            <th style="text-align:center">INDEX NUMBER</th>
            <th style="text-align:center">BOOKS</th>
            <th style="text-align:center">LACOSTE</th>
            <th style="text-align:center">TOILETRIES</th>
            <th style="text-align:center">PEN</th>
            
            
            </tr>
  ';
       while ($row=mysqli_fetch_assoc($lat)) {
         $inx=$row['id'];
         $fir=$row['f_name'];
         $las=$row['l_name'];

         $view="SELECT * FROM items WHERE (total<10 AND item='Books' AND id='$inx') OR (total<1 AND item='Lacoste' AND id='$inx') OR (total<2 AND item='Toiletries' AND id='$inx') OR (total<2 AND item='Pen' AND id='$inx')";
         $gen=mysqli_query($link,$view);
         $check=mysqli_num_rows($gen);
         
        if ($check>=1) {
          $awe="SELECT total FROM items WHERE id='$inx' AND item='Books' ";
          $some=mysqli_query($link,$awe);
          $awesome=mysqli_fetch_assoc($some);
          $bk=$awesome['total'];
          $nbk=10-$bk;

          $won="SELECT total FROM items WHERE id='$inx' AND item='Lacoste' ";
          $der=mysqli_query($link,$won);
          $wonder=mysqli_fetch_assoc($der);
          $lc=$wonder['total'];
          $nlc=1-$lc;

          $mar="SELECT total FROM items WHERE id='$inx' AND item='Toiletries' ";
          $vel=mysqli_query($link,$mar);
          $marvel=mysqli_fetch_assoc($vel);
          $tr=$marvel['total'];
          $ntr=2-$tr;

          $da="SELECT total FROM items WHERE id='$inx' AND item='Pen' ";
          $mn=mysqli_query($link,$da);
          $damn=mysqli_fetch_assoc($mn);
          $pn=$damn['total'];
          $npn=2-$pn;

          echo '
          <tr>
            <td>'.$fir.'&nbsp;'.$las.'</td>
            <td style="text-align:center">'.$inx.'</td>
            <td style="text-align:center">'.$nbk.'</td>
            <td style="text-align:center">'.$nlc.'</td>
            <td style="text-align:center">'.$ntr.'</td>
            <td style="text-align:center">'.$npn.'</td>
          ';


        }
         
       }
}
else{
          header("Refresh: 0; url=index.php");
          echo "<script> alert('NO STUDENT HAS TAKEN ITEM')</script>";
}

?>



<script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/material.min.js"></script>
</body>
</html>
<?php } ?>