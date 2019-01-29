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
}, 800);
</script>
<link rel="stylesheet" type="text/css" href="index.css">
<?php
$con = mysql_connect("localhost","root","");
mysql_select_db('Myquizgame');
//CREATING TABLE FOR "easy" LEVEL
  $sql="CREATE TABLE EASY (
  id int(255) UNSIGNED PRIMARY KEY,
  que text NOT NULL,
  option1 varchar(222) NOT NULL,
  option2 varchar(222) NOT NULL,
  option3 varchar(222) NOT NULL,
  option4 varchar(222) NOT NULL,
  ans varchar(222) NOT NULL,
  userans text
) ENGINE=InnoDB DEFAULT CHARSET=latin1";


//INSERTING INTO "EASY" TABLE
$sql2 ="INSERT INTO EASY (`id`, `que`, `option1`, `option2`, `option3`, `option4`, `ans`, `userans`) VALUES
(1, 'Narendra Modi was the chief minister of which state ?', 'Uttar Pradesh', 'Maharashta', 'Andhra Pradesh', 'Gujarat', 'Gujarat', 'Gujarat'),
(2, 'First female astronaut ? ', 'Bachendri Pal', 'Kalpana Chawla', 'Meenakshi Khadge', 'Laxmi Sehgal', 'Kalpana Chawla', 'Kalpana Chawla'),
(3, 'Who was the inventor of light bulb ?', 'Thomas Edison', 'Isaac Newton', 'Aristotle', 'Nikola Tesla', 'Thomas Edison', 'Thomas Edison'),
(4, 'Lightest gas ?', 'Oxygen', 'Neon', 'Argon', 'Hydrogen', 'Hydrogen', 'Hydrogen'),
(5, 'First Indian to have won Nobel Prize ?', 'Rabindranath Tagore', 'Arndhati Roy', 'Harivansh Bachchan', 'Vikram Seth',-'Rabindranath Tagore', 'Rabindranath Tagore')";


?>
</head>
<body background="pexels-photo-1169754.jpeg";>
<div class="title">EASY-LEVEL</div>
<center>
<form action="" method="post">  				
		<table>
		<?php 
		if(isset($c)) 
		{ 
				$fetchqry = "SELECT * FROM EASY where id='$c'"; 
				
				/***********READ QUESTIONS FROM DATABSE FOR "easy" LEVEL **************************/
				
				$result=mysql_query($fetchqry,$con);
				$num=mysql_num_rows($result);
				$row = mysql_fetch_array($result,MYSQL_ASSOC); 
		}
		  ?>		</br></br><progress value="0" max="5" id="progressBar"></progress>
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
		<button class="button3" type="submit" name="click" >Next</button></td></tr>
		<?php } 
		
																	?> </table>
		</form>
		<?php if(@$_SESSION['clicks']>5){ 
			$qry3 = "SELECT ans, userans FROM EASY;";
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
				<?php echo $no ; 
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
</body>
</html>