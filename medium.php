<?php 
session_start(); ?>
<!DOCTYPE>
<html>

<head>
<title>General Knowledge Quiz</title>
<script>var timeleft = 10;
var downloadTimer = setInterval(function(){
  document.getElementById("progressBar").value = 10 - timeleft;
  timeleft -= 1;
  if(timeleft <= 0)
    clearInterval(downloadTimer);
}, 3000);
</script>
<link rel="stylesheet" type="text/css" href="index.css">
<?php
$con = mysql_connect("localhost","root","");
mysql_select_db('Myquizgame');
//CREATING TABLE FOR "medium" LEVEL
  $sql="CREATE TABLE MEDIUM (
  id int(255) UNSIGNED PRIMARY KEY,
  que text NOT NULL,
  option1 varchar(222) NOT NULL,
  option2 varchar(222) NOT NULL,
  option3 varchar(222) NOT NULL,
  option4 varchar(222) NOT NULL,
  ans varchar(222) NOT NULL,
  userans text
) ENGINE=InnoDB DEFAULT CHARSET=latin1";


//INSERTING INTO "MEDIUM" TABLE
$sql2 ="INSERT INTO MEDIUM (`id`, `que`, `option1`, `option2`, `option3`, `option4`, `ans`, `userans`) VALUES
(1, 'Full form of HAL ?', 'Hindustan aeronautics Limited', 'Hindustan aerodrum Limited', 'Hindustan aeronautics Link', 'Hindu aeronautics Limited', 'Hindustan aeronautics Limited', 'Hindustan aeronautics Limited'),
(2, 'India has largets deposits of :', 'Gold', 'Copper', 'Mica', 'Silver', 'Mica', 'Mica'),
(3, 'India's first atomic reactor ?', 'zerlina', 'dhruv', 'Apsara', 'Kamini', 'Apsara', 'Apsara'),
(4, 'INS venduruthy is located in : ?', 'Kochi', 'Pune', 'Goa', 'Mumbai', 'Kochi', 'Kochi'),
(5, 'Indian Institute of Petroleum is in  ?', 'Pune', 'Goa', 'Delhi', 'Dehradun','Dehradun', 'Dehradun')";


?>
</head>
<body background="pic2.jpg">
<div class="title">MEDIUM-LEVEL</div>

<center>
<form action="" method="post">  				
		<table>
		<?php 
		if(isset($c)) 
		{ 
		
		 /***********READ QUESTIONS FROM DATABSE FOR "MEDIUM" LEVEL **************************/
				$fetchqry = "SELECT * FROM MEDIUM where id='$c'"; 
				$result=mysql_query($fetchqry,$con);
				$num=mysql_num_rows($result);
				$row = mysql_fetch_array($result,MYSQL_ASSOC); 
		}
		  ?>	</br></br>	<progress value="0" max="5" id="progressBar"></progress>
		<tr><td><h3><br>
		<?php 
		echo @$row['que'];
		?>
		</h3></td></tr> 
		<?php
		
		if(@$_SESSION['clicks'] > 0 && @$_SESSION['clicks'] < 6)
		{ ?>
		<tr><td>
		<input required type="radio" name="userans" value="<?php echo $row['option1'];?>">&nbsp;
		<?php echo $row['option1']; ?></td></tr>
		<tr><td>
		<input required type="radio" name="userans" value="<?php echo $row['option2'];?>">&nbsp;
		<?php echo $row['option2'];?>
		</td></tr>
		<tr><td>
		<input required type="radio" name="userans" value="<?php echo $row['option3'];?>">&nbsp;
		<?php echo $row['option3']; ?></td></tr>
		<tr><td>
		<input required type="radio" name="userans" value="<?php echo $row['option4'];?>">&nbsp;
		<?php echo $row['option4']; ?>
		<br><br><br></td></tr>
		<tr><td>
		<button class="button3" name="click" >Next</button></td></tr>
		<?php } 
		
																	?> </table>
		</form>
		<?php if(@$_SESSION['clicks']>5){ 
			$qry3 = "SELECT ans, userans FROM MEDIUM;";
			$result3 = mysql_query($qry3 , $con);
			$storeArray = Array();
			while ($row = mysql_fetch_array($result3, MYSQL_ASSOC))
			{
				// ********** MATCHING OF ANSWERS FROM DATABASE ************
				if($row['ans']==$row['userans'])
				{
						@$_SESSION['score'] += 1 ; //******* CALCULATING SCORES  ****************
				}		
			}
 
		?> 
 
 
		<h2>Result</h2>
		<span>No. of Correct Answer:&nbsp;
		<?php 
		echo $no = @$_SESSION['score']; 
					session_unset();	
					?>
				</span><br>
				<span>Your Score:&nbsp;
				<?php echo $no; 
				/****************** RESULT GENERATION ****************************/
				if($no==5)
				echo " VERY STRONG ";
				else if($no==4)
				echo " STRONG ";
				else if($no==3)
				echo " GOOD ";
				else if($no==2)
				echo " BAD ";
				else
				echo "POOR";
				?>
				</span>

				<?php } ?>
</center>