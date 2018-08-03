<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
////////////////////////////////////////////////////////////////////////////////
  //IMPORTS
  require 'utilityFunctions.php';
  require 'DATA/data.php';
  $connection = connectToDatabase("localhost","root","","college"); //make connection to DB
////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////
  //COLLECT information from form
  //add all selected state abbreviations to array
  $stateList = array();
  foreach($_POST as $name => $val)
  {
    if($val == "STATE")
      $stateList[] = $name;
  }
  //want to find out the user's inputted scores
  $ACTCMScore = $_POST['ACTCMScore'];
////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////
//GENERATE the SQL request to find all eligible colleges
  //sql fragment for state filtering
  $sqlQueryStates = "(";
  for($i = 0; $i < count($stateList); $i++)
  {
    if($i == count($stateList)-1)
      $sqlQueryStates .= "STABBR = '$stateList[$i]')";
    else $sqlQueryStates .= "STABBR = '$stateList[$i]' OR ";
  }
  //sql fragment for ACT Composite score filtering
  $sqlQueryACTCM = "AND ACTCM75<=$ACTCMScore";
  //generate the whole SQL query and submit to db
  $sqlQuery = "SELECT INSTNM, INSTURL FROM info WHERE $sqlQueryStates $sqlQueryACTCM";
  $collegeResults = $connection->query($sqlQuery);
////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////
  //RESULTS FROM SQL DB
  //output the results on screen in html via anchors with college url as hyperlink
  foreach($collegeResults as $college)
  {
    $url = $college['INSTURL'];
    $url = preg_replace('#^https?://#', '', $url); //removes http/https from beginning
    $name = $college['INSTNM'];
    echo "<a href=\"https://$url\">$name</a><br />";
  }
////////////////////////////////////////////////////////////////////////////////

}?>
