<style type="text/css">
	
		
	.tb{
		border-spacing: 20px;
		border-collapse: collapse;
		padding: 15px;
		border:10px solid #ddd;
		font-size: 15px;
		font-style: italic;
		
	}
	
	.head{
		text-align: center;
	}
	.tb1{
		border-spacing: 20px;
		border-collapse: collapse;
		border:8px solid #ddd;
		width: 95%;
		padding:15px;
		font-size: 15px;
		font-style: italic;
		text-align: center;
		

	}
	
		
	}
	
	
</style>
<?php 

	require 'config.php';
	

function admin_login(){
	global $link;

			if (isset($_POST['admin_login'])) {

			 $admin_user = mysqli_escape_string($link, trim($_POST['admin_user']));
			 $admin_pass = mysqli_escape_string($link, trim($_POST['admin_pass']));
			

			if (empty($admin_user) || empty($admin_pass)) {
				    header("Refresh: 0; url=login.php");
					echo "<script> alert('Field can not be empty')</script>";
					
				}	

			
                        $admin_pass = md5(md5($admin_pass) . md5($admin_user));
			
                         

			 $query = "SELECT * FROM login WHERE admin_user = '$admin_user' and admin_pass = '$admin_pass'";
			 $result = mysqli_query($link, $query);



			 if (mysqli_num_rows($result) >= 1) {

					 	$row =  mysqli_fetch_assoc($result);

						if ($row['admin_user'] == $admin_user && $row['admin_pass'] == $admin_pass) {
							

								
							session_start();
  								$_SESSION['admin_email'] = $row['admin_user'];
								
							
							
						}

					
					echo "<script> window.location ='index.php'</script>";
				// echo "<script> window.open('index.php', '_self');</script>";

			 }else{
			 	    header("Refresh: 0; url=login.php");
		 			echo "<script> alert('Wrong username and/or password ')</script>";
					
				}

		mysqli_close($link);
	}


}




function items() {
	global $link;
	$key=$_SESSION['student_index'];
	$query = "SELECT * FROM items WHERE id='$key' ";
	$result = mysqli_query($link, $query);
	$true = mysqli_num_rows($result);
	if ($true >= 1) {
		while ($row = mysqli_fetch_assoc($result)) {
			$item = $row['item'];
			$total = $row['total'];

			echo '
				<div class="list-group-item">'.$item.'<span class="badge text-right">'.$total.'</span>
				</div>
			';
			

		}
	}
	

}


function  addStudent(){
	global $link;
	if (isset($_POST['add-student'])) {
			
			
			 $f_name  = mysqli_real_escape_string($link,trim($_POST['fname']));
			 $l_name  = mysqli_real_escape_string($link,trim($_POST['lname']));
			 $program  = mysqli_real_escape_string($link,trim($_POST['program']));
			 $year  = mysqli_real_escape_string($link,trim($_POST['year']));
			 $id  = mysqli_real_escape_string($link,trim($_POST['id']));
			 $email  = mysqli_real_escape_string($link,trim($_POST['email']));
			 $contact  = mysqli_real_escape_string($link,trim($_POST['Contact']));
			 $gn  = mysqli_real_escape_string($link,trim($_POST['Guardian_Name']));
			 $interest  = mysqli_real_escape_string($link,trim($_POST['Interest']));
			 $room  = mysqli_real_escape_string($link,trim($_POST['Room']));
			 $gc  = mysqli_real_escape_string($link,trim($_POST['Guardian_Contact']));
			 $level  = mysqli_real_escape_string($link,trim($_POST['level']));
			 $gender  = mysqli_real_escape_string($link,trim($_POST['gen']));
                        
			   
			


			   $photo  = basename($_FILES['photo']['name']);
			   $photo_tmp  = $_FILES['photo']['tmp_name'];

			 // $img_thumb  = basename($_FILES['img_thumb']['name']);
			 // $img_thumb_tmp  = $_FILES['img_thumb']['tmp_name'];
			
			$search_id="SELECT * FROM add_student WHERE id='$id'";
			$verify=mysqli_query($link,$search_id);
			if (mysqli_num_rows($verify)>0) {
				header("Refresh: 0; url=addStudent.php");
				echo '<script type="">alert("STUDENT HAS ALREADY BEING REGISTERED");</script>';
			}

			else{
				$query = "INSERT INTO add_student (f_name,l_name, program,admission_year,id,email,contact,guardian,interest,room,g_phone,student_photo,level,sex)
					VALUES( '$f_name', '$l_name','$program','$year','$id','$email','$contact','$gn','$interest','$room', '$gc','$photo','$level','$gender' )
			;";

			
			$result = mysqli_query($link, $query);
			

			if ($result) {
				move_uploaded_file($photo_tmp, "images/Profile/$photo");
			    move_uploaded_file($img_thumb_tmp, "../images/Profile/$img_thumb");
				header("Refresh: 0; url=addStudent.php");

				echo '
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Great!</strong> Student has been Successfully added to System 
  
</div>
		 	';
				// echo '<script type="">alert("New Game Added Successfully");</script>';
				// echo '<script type="">window.open("view.php", "_self");</script>';
			}else{
				header("Refresh: 0; url=addStudent.php");
				echo '
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Danger!</strong> Student has not been Successfully added to System 
  
</div>
		 	';
			}
			}
		
	}
}

function verify(){
	global $link;
	if (isset($_POST['verify-me'])) {
		 $index_number = mysqli_escape_string($link, trim($_POST['index']));
	if(empty($index_number)){
		    header("Refresh: 0; url=verify.php");
			echo "<script>alert('Field cannot be empty')</script>";
			
	}


	else{
		$query="SELECT * fROM add_student WHERE id='$index_number'";
	    $result=mysqli_query($link,$query);
	    if (mysqli_num_rows($result) >= 1){
	    	$row =  mysqli_fetch_assoc($result);
	    	if ($row['id'] == $index_number ) {

	    		session_start();
  								$_SESSION['student_index'] = $row['id'];
  								
  								$old_query= "SELECT * FROM items WHERE id='$index_number'";
  								$result=mysqli_query($link,$old_query);
  								if (mysqli_num_rows($result)==0) {
  									$book_query= "INSERT into items(id,item,total) VALUES ('$index_number','Books',10)";
  									$lac_query= "INSERT into items(id,item,total) VALUES ('$index_number','Lacoste',1)";
  									$toi_query= "INSERT into items(id,item,total) VALUES ('$index_number','Toiletries',2)";
  									$pen_query= "INSERT into items(id,item,total) VALUES ('$index_number','Pen',2)";
  								mysqli_query($link,$book_query);
  								mysqli_query($link,$lac_query);
  								mysqli_query($link,$toi_query);
  								mysqli_query($link,$pen_query);
  								echo "<script> window.location ='items.php'</script>";

  								}
							    else	
							        header("Refresh: 0; url=items.php");
							
						}

					
					
				// echo "<script> window.open('index.php', '_self');</script>";

			 }
		else{
		 			echo "<script> alert(' Index Number Not in Database')</script>";
					echo "<script> window.location =''</script>";
				}

		mysqli_close($link);
	}

	    }


}

function item_dist(){
	global $link;
	if (isset($_POST['addItem'])) {
		$item_select = mysqli_escape_string($link, trim($_POST['it']));
	    $total = mysqli_escape_string($link, trim($_POST['tot']));
	    $serve=$_SESSION['student_index'];

	    if (empty($total)) {
	    	    header("Refresh: 0; url=items.php");
				echo "<script>alert('PLEASE ENTER NUMBER OF ITEM TO BE RECEIVED')</script>";
	    }
	    else if ($item_select=='Select Item') {
	    	header("Refresh: 0; url=items.php");
				echo "<script>alert('PLEASE SELECT ITEM TO BE RECEIVED')</script>";
	    }
	    else{
	    	if ($item_select=='Books') {
	    		if ($total>10||$total<1) {
	    			echo "<script> alert('NUMBER OF BOOKS CANNOT BE ASSIGNED')</script>";
					echo "<script> window.location =''</script>";
	    		}
	    		else{
	    		$find_book= "SELECT total fROM items where id='$serve' AND item='Books'";
	    		$result= mysqli_query($link,$find_book);
	    		$row=mysqli_fetch_assoc($result);
	    		$answer=$row['total'];
	    		$y=$answer-$total;
	    		$stock_use= "SELECT * FROM stock WHERE item='Books'";
	    		$stock_exe=mysqli_query($link,$stock_use);
	    		$fin=mysqli_fetch_assoc($stock_exe);
	    		$ar=$fin['amount_received'];
	    		$al=$fin['amount_left'];
	    		$x=$ar+$total;
	    		$z=$al-$total;
	    		if ($y<0) {
	    			header("Refresh: 0; url=items.php");
				echo "<script>alert('MAX NUMBER OF BOOKS HAS BEEN ASSIGNED')</script>";
	    		}
	    		else{
	    			$a_book= "UPDATE items SET total='$y' WHERE id='$serve' AND item='Books' ";
	    			$update=mysqli_query($link,$a_book);
	    			$update_stock="UPDATE stock SET amount_received='$x', amount_left='$z' WHERE item='Books'";
	    			$stock_update=mysqli_query($link,$update_stock);

	    			header("Refresh: 0; url=items.php");

	
	    		}
	    		}
	    	}
	    	elseif ($item_select=="Lacoste") {
	    		if ($total>1||$total<1) {
	    			header("Refresh: 0; url=items.php");
	    			echo "<script> alert('ONLY ONE LACOSTE CAN BE ASSIGNED')</script>";
	    		}
	    		else{
	    			$cos="SELECT total FROM items WHERE id='$serve' AND item='Lacoste'";
	    			$result=mysqli_query($link,$cos);
	    			$row=mysqli_fetch_assoc($result);
	    			$answer=$row['total'];
	    			$y=$answer-$total;
	    			$stock_use= "SELECT * FROM stock WHERE item='Lacoste'";
	    		    $stock_exe=mysqli_query($link,$stock_use);
	    		    $fin=mysqli_fetch_assoc($stock_exe);
	    		    $ar=$fin['amount_received'];
	    		    $al=$fin['amount_left'];
	    		    $x=$ar+$total;
	    		    $z=$al-$total;
	    			if ($y<0) {
	    				header("Refresh: 0; url=items.php");
				        echo "<script>alert('LACOSTE HAS ALREADY BEEN  ASSIGNED')</script>";
	    			}
	    			else{
	    				$coste= "UPDATE items SET total='$y' WHERE id='$serve' AND item='Lacoste' ";
	    			    $update=mysqli_query($link,$coste);

	    			    $update_stock="UPDATE stock SET amount_received='$x', amount_left='$z' WHERE item='Lacoste'";
	    			    $stock_update=mysqli_query($link,$update_stock);
	    			    header("Refresh: 0; url=items.php");
	    			}
	    		}
	    	}
	    	elseif ($item_select=="Toiletries") {
	    		if ($total>2||$total<1) {
	    			header("Refresh: 0; url=items.php");
	    			echo "<script> alert('NUMBER OF PACKS OF TOILETRY CANNOT BE ASSIGNED')</script>";
	    		}
	    		else{
	    			$tries="SELECT total FROM items WHERE id='$serve' AND item='Toiletries'";
	    			$result=mysqli_query($link,$tries);
	    			$row=mysqli_fetch_assoc($result);
	    			$answer=$row['total'];
	    			$y=$answer-$total;
	    			$stock_use= "SELECT * FROM stock WHERE item='Toiletries'";
	    		    $stock_exe=mysqli_query($link,$stock_use);
	    		    $fin=mysqli_fetch_assoc($stock_exe);
	    		    $ar=$fin['amount_received'];
	    		    $al=$fin['amount_left'];
	    		    $x=$ar+$total;
	    		    $z=$al-$total;
	    			if ($y<0) {
	    				header("Refresh: 0; url=items.php");
				        echo "<script>alert('MAX PACKS OF TOILETRY HAS BEEN ASSIGNED')</script>";
	    			}
	    			else{
	    				$toi= "UPDATE items SET total='$y' WHERE id='$serve' AND item='Toiletries' ";
	    			    $update=mysqli_query($link,$toi);

	    			    $update_stock="UPDATE stock SET amount_received='$x', amount_left='$z' WHERE item='Toiletries'";
	    			    $stock_update=mysqli_query($link,$update_stock);
	    			    header("Refresh: 0; url=items.php");
	    			}
	    		}
	    	}
	    	elseif ($item_select=="Pen") {
	    		if ($total>2||$total<1) {
	    			header("Refresh: 0; url=items.php");
	    			echo "<script> alert('NUMBER OF PENS CANNOT BE ASSIGNED')</script>";
	    		}
	    		else{
	    			$pen="SELECT total FROM items WHERE id='$serve' AND item='Pen'";
	    			$result=mysqli_query($link,$pen);
	    			$row=mysqli_fetch_assoc($result);
	    			$answer=$row['total'];
	    			$y=$answer-$total;
	    			$stock_use= "SELECT * FROM stock WHERE item='Pen'";
	    		    $stock_exe=mysqli_query($link,$stock_use);
	    		    $fin=mysqli_fetch_assoc($stock_exe);
	    		    $ar=$fin['amount_received'];
	    		    $al=$fin['amount_left'];
	    		    $x=$ar+$total;
	    		    $z=$al-$total;
	    			if ($y<0) {
	    				header("Refresh: 0; url=items.php");
				        echo "<script>alert('MAX NUMBER OF PENS HAS BEEN ASSIGNED')</script>";
	    			}
	    			else{
	    				$nep= "UPDATE items SET total='$y' WHERE id='$serve' AND item='Pen' ";
	    			    $update=mysqli_query($link,$nep);

	    			    $update_stock="UPDATE stock SET amount_received='$x', amount_left='$z' WHERE item='Pen'";
	    			    $stock_update=mysqli_query($link,$update_stock);
	    			    header("Refresh: 0; url=items.php");
	    			}
	    		}
	    	}
	    }

	    
	   
	}
	
}
function search_name(){
	global $link;
	if (isset($_POST['sumt'])) {
		$sea=mysqli_escape_string($link,trim($_POST['find']));
		$filt=mysqli_escape_string($link,trim($_POST['filter']));
		
		
			if ($filt=="Select Filter") {
				header("Refresh: 0; url=filter.php");
				echo "<script>alert('PLEASE SELECT FILTER')</script>";
			}
			elseif ($filt=="Name") {
				if (empty($sea)) {
			header("Refresh: 0; url=filter.php");
			echo "<script>alert('NO INPUT IN SEARCH BOX')</script>";
		}

		else{
				
				$pull="SELECT * FROM add_student where (f_name LIKE'%$sea%' OR l_name LIKE'%$sea%') OR CONCAT(f_name,' ',l_name) LIKE '%$sea%'";
				$result=mysqli_query($link,$pull);
				$value=mysqli_num_rows($result);
				if ($value>=1) {
					echo'
					<table border="1" class="tb" >
					<tr>
						<th style="text-align:center">NAME</th>
						<th>INDEX NUMBER</th>
						<th class="head">PROGRAMME</th>
						<th class="head">SEX</th>
						<th>LEVEL</th>
						<th>ADMISSION YEAR</th>
						<th class="head">EMAIL</th>
						<th>CONTACT</th>
						<th>GUARDIAN</th>
						<th>GUARDIAN CONTACT</th>
						<th>ROOM</th>
						<th>INTEREST</th>
						</tr>
						
						';
					while ($row=mysqli_fetch_assoc($result)) {
					$fname=$row['f_name'];
					$lname=$row['l_name'];
					$gender=$row['sex'];
					$prog=$row['program'];
					$ind=$row['id'];
					$ady=$row['admission_year'];
					$em=$row['email'];
					$cont=$row['contact'];
					$guard=$row['guardian'];
					$int=$row['interest'];
					$ro=$row['room'];
					$gp=$row['g_phone'];
					$lev=$row['level'];
					
						echo'
						
						
						<tr>
						<td>'.$fname.'&nbsp;'.$lname.'</td>
						<td>'.$ind.'</td>
						<td>'.$prog.'</td>
						<td style="text-align:center">'.$gender.'</td>
						<td style="text-align:center">'.$lev.'</td>
						<td style="text-align:center">'.$ady.'</td>
						<td>'.$em.'</td>
						<td>'.$cont.'</td>
						<td>'.$guard.'</td>
						<td>'.$gp.'</td>
						<td>'.$ro.'</td>
						<td>'.$int.'</td>
						</tr>
						
						';
						
						
					
					}
					
					}

					else{
						header("Refresh: 0; url=filter.php");
				        echo "<script>alert('STUDENT NOT IN DATABASE')</script>";
					}
				}

				}

					
				
								
				
			}
		}
	
	function search_index(){
		global $link;
	if (isset($_POST['sumt'])) {
		$sea=mysqli_escape_string($link,trim($_POST['find']));
		$filt=mysqli_escape_string($link,trim($_POST['filter']));
		
			if ($filt=="Index Number") {
				if (empty($sea)) {
			header("Refresh: 0; url=filter.php");
			echo "<script>alert('NO INPUT IN SEARCH BOX')</script>";
		}

		else{
				
				$pull="SELECT * FROM add_student where id LIKE'%$sea%'";
				$result=mysqli_query($link,$pull);
				$value=mysqli_num_rows($result);
				if ($value>=1) {
					echo'
					<table border="1" class="tb" >
					<tr>
					    <th>INDEX NUMBER</th>
						<th style="text-align:center">NAME</th>
						<th class="head">PROGRAMME</th>
						<th class="head">SEX</th>
						<th>LEVEL</th>
						<th>ADMISSION YEAR</th>
						<th class="head">EMAIL</th>
						<th>CONTACT</th>
						<th>GUARDIAN</th>
						<th>GUARDIAN CONTACT</th>
						<th>ROOM</th>
						<th>INTEREST</th>
						</tr>
						
						';
					while ($row=mysqli_fetch_assoc($result)) {
					$fname=$row['f_name'];
					$lname=$row['l_name'];
					$gender=$row['sex'];
					$prog=$row['program'];
					$ind=$row['id'];
					$ady=$row['admission_year'];
					$em=$row['email'];
					$cont=$row['contact'];
					$guard=$row['guardian'];
					$int=$row['interest'];
					$ro=$row['room'];
					$gp=$row['g_phone'];
					$lev=$row['level'];
					
						echo'
						
						
						<tr>
						<td>'.$ind.'</td>
						<td>'.$fname.'&nbsp;'.$lname.'</td>
						<td>'.$prog.'</td>
						<td style="text-align:center">'.$gender.'</td>
						<td style="text-align:center">'.$lev.'</td>
						<td style="text-align:center">'.$ady.'</td>
						<td>'.$em.'</td>
						<td>'.$cont.'</td>
						<td>'.$guard.'</td>
						<td>'.$gp.'</td>
						<td>'.$ro.'</td>
						<td>'.$int.'</td>
						</tr>
						
						';
						
						
					
					}
					
					}
					else{
						header("Refresh: 0; url=filter.php");
				        echo "<script>alert('INDEX NUMBER NOT IN DATABASE')</script>";
					}
				}

				}

					
				
								
				
			}

	}
	function search_program(){
		global $link;
	if (isset($_POST['sumt'])) {
		$sea=mysqli_escape_string($link,trim($_POST['find']));
		$filt=mysqli_escape_string($link,trim($_POST['filter']));
		
			
			if ($filt=="Program") {
				if (empty($sea)) {
			header("Refresh: 0; url=filter.php");
			echo "<script>alert('NO INPUT IN SEARCH BOX')</script>";
		}

		else{
				
				$pull="SELECT * FROM add_student where program LIKE'%$sea%'";
				$result=mysqli_query($link,$pull);
				$value=mysqli_num_rows($result);
				if ($value>=1) {
					echo'
					<table border="1" class="tb1" >
					<tr>
					    <th style="text-align:center">PROGRAM</th>
						<th style="text-align:center">NAME</th>
						<th style="text-align:center">INDEX NUMBER</th>
						<th style="text-align:center">SEX</th>
						<th style="text-align:center">LEVEL</th>
						<th style="text-align:center">CONTACT</th>
						<th style="text-align:center">ROOM</th>
						</tr>
						
						';
					while ($row=mysqli_fetch_assoc($result)) {
					$fname=$row['f_name'];
					$lname=$row['l_name'];
					$prog=$row['program'];
					$gender=$row['sex'];
					$ind=$row['id'];
					$cont=$row['contact'];
					$ro=$row['room'];
					$lev=$row['level'];
					
						echo'
						
						
						<tr>
						<td>'.$prog.'</td>
						<td>'.$fname.'&nbsp;'.$lname.'</td>
						<td>'.$ind.'</td>
					    <td style="text-align:center">'.$gender.'</td>
						<td style="text-align:center">'.$lev.'</td>
						<td>'.$cont.'</td>
						<td>'.$ro.'</td>
						</tr>
						
						';
						
						
					
					}
					
					}
					else{
						header("Refresh: 0; url=filter.php");
				        echo "<script>alert('PROGRAM NOT IN DATABASE')</script>";
					}
				}

				}

					
				
								
				
			}

	}
	function search_level(){
		global $link;
	if (isset($_POST['sumt'])) {
		$sea=mysqli_escape_string($link,trim($_POST['find']));
		$filt=mysqli_escape_string($link,trim($_POST['filter']));

			
			if ($filt=="Level") {
				if (empty($sea)) {
			header("Refresh: 0; url=filter.php");
			echo "<script>alert('NO INPUT IN SEARCH BOX')</script>";
		}

		else{
				
				$pull="SELECT * FROM add_student where level='$sea'";
				$result=mysqli_query($link,$pull);
				$value=mysqli_num_rows($result);
				if ($value>=1) {
					echo'
					<table border="1" class="tb1" >
					<tr>
						<th style="text-align:center">NAME</th>
						<th style="text-align:center">PROGRAM</th>
						<th style="text-align:center">SEX</th>
						<th style="text-align:center">CONTACT</th>
						<th style="text-align:center">ROOM</th>
						</tr>
						
						';
					while ($row=mysqli_fetch_assoc($result)) {
					$fname=$row['f_name'];
					$lname=$row['l_name'];
					$gender=$row['sex'];
					$prog=$row['program'];
					$cont=$row['contact'];
					$ro=$row['room'];
					
						echo'
						
						
						<tr>
						<td>'.$fname.'&nbsp;'.$lname.'</td>
						<td>'.$prog.'</td>
						<td>'.$gender.'</td>
						<td>'.$cont.'</td>
						<td>'.$ro.'</td>
						</tr>
						
						';
						
						
					
					}
					
					}
					else{
						header("Refresh: 0; url=filter.php");
				        echo "<script>alert('LEVEL NOT IN DATABASE')</script>";
					}
				}

				}

					
				
								
				
			}

	}

	function search_interest(){
		global $link;
	if (isset($_POST['sumt'])) {
		$sea=mysqli_escape_string($link,trim($_POST['find']));
		$filt=mysqli_escape_string($link,trim($_POST['filter']));

			
			if ($filt=="Interest") {
				if (empty($sea)) {
			header("Refresh: 0; url=filter.php");
			echo "<script>alert('NO INPUT IN SEARCH BOX')</script>";
		}

		else{
				
				$pull="SELECT * FROM add_student where interest LIKE'%$sea%'";
				$result=mysqli_query($link,$pull);
				$value=mysqli_num_rows($result);
				if ($value>=1) {
					echo'
					<table border="1" class="tb1" >
					<tr>
					    <th style="text-align:center">INTEREST</th>
						<th style="text-align:center">NAME</th>
						<th style="text-align:center">PROGRAM</th>
						<th style="text-align:center">SEX</th>
						<th style="text-align:center">CONTACT</th>
						<th style="text-align:center">ROOM</th>
						</tr>
						
						';
					while ($row=mysqli_fetch_assoc($result)) {
					$int=$row['interest'];	
					$fname=$row['f_name'];
					$lname=$row['l_name'];
					$gender=$row['sex'];
					$prog=$row['program'];
					$cont=$row['contact'];
					$ro=$row['room'];
					
						echo'
						
						
						<tr>
						<td>'.$int.'</td>
						<td>'.$fname.'&nbsp;'.$lname.'</td>
						<td>'.$prog.'</td>
						<td>'.$gender.'</td>
						<td>'.$cont.'</td>
						<td>'.$ro.'</td>
						</tr>
						
						';
						
						
					
					}
					
					}
					else{
						header("Refresh: 0; url=filter.php");
				        echo "<script>alert('LEVEL NOT IN DATABASE')</script>";
					}
				}

				}

					
				
								
				
			}

	}
	
	
	function search_gender(){
		global $link;
	if (isset($_POST['sumt'])) {
		$sea=mysqli_escape_string($link,trim($_POST['find']));
		$filt=mysqli_escape_string($link,trim($_POST['filter']));

			
			if ($filt=="Gender") {
				if (empty($sea)) {
			header("Refresh: 0; url=filter.php");
			echo "<script>alert('NO INPUT IN SEARCH BOX')</script>";
		}

		else{
				
				$pull="SELECT * FROM add_student where sex LIKE'$sea%'";
				$result=mysqli_query($link,$pull);
				$value=mysqli_num_rows($result);
				if ($value>=1) {
					echo'
					<table border="1" class="tb1" >
					<tr>
						<th style="text-align:center">NAME</th>
						<th style="text-align:center">PROGRAM</th>
						
						<th style="text-align:center">CONTACT</th>
						<th style="text-align:center">ROOM</th>
						</tr>
						
						';
					while ($row=mysqli_fetch_assoc($result)) {
					$fname=$row['f_name'];
					$lname=$row['l_name'];
					
					$prog=$row['program'];
					$cont=$row['contact'];
					$ro=$row['room'];
					
						echo'
						
						
						<tr>
						<td>'.$fname.'&nbsp;'.$lname.'</td>
						<td>'.$prog.'</td>
						
						<td>'.$cont.'</td>
						<td>'.$ro.'</td>
						</tr>
						
						';
						
						
					
					}
					
					}
					else{
						header("Refresh: 0; url=filter.php");
				        echo "<script>alert('GENDER NOT IN DATABASE')</script>";
					}
				}

				}

					
				
								
				
			}

	}

 ?>
 
 