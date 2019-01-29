
<?php
  /****************************  DATABASE **********/
$con = mysql_connect("localhost","root","");

// Check connection
if (!$con)
  {
  echo "Failed to connect to MySQL: " . mysql_connect_error();
  }
  else
  {echo "happy";
  }
  
  //CREATE DATABASE
  $sq="CREATE DATABASE Myquizgame";

mysql_close();

?>