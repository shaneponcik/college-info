<?php

//if user requests more information about a college
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  require 'utilityFunctions.php';
  $connection = connectToDatabase("localhost","root","","college");
  //retreives array with info about specific college(referenced via key index)
  $collegeInfo = getCollegeInfoArray($_POST['idx'],$connection);

  //print out the information about that colleges----------------
  echo "<p>Name: " . $collegeInfo['INSTNM'] . "</p>";
  echo "<p>City: " . $collegeInfo['CITY'] . "</p>";
  echo "<p>State: " . $collegeInfo['STABBR'] . "</p>";
  echo "<p>Website: " . $collegeInfo['INSTURL'] . "</p>";
  echo "<p>ACT Composite(Average): " . $collegeInfo['ACTCMMID'] . "</p>";
  echo "<p>SAT(Average): " . $collegeInfo['SAT_AVG'] . "</p>";
}

 ?>
