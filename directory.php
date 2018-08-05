<form action="" method="post">
ACT Composite Range:
<select name="ACTCMLowerRange">
  <option value="18">18</option>
  <option value="24">24</option>
  <option value="30">30</option>
  <option value="36">36</option>
</select> -
<select name="ACTCMUpperRange">
  <option value="18">18</option>
  <option value="24">24</option>
  <option value="30">30</option>
  <option value="36" selected="selected">36</option>
</select><br />
Public, Private, For Profit, or All:
<select name="CollegePubOrPriv">
  <option value="1">Public</option>
  <option value="2">Private</option>
  <option value="3">For Profit</option>
  <option value="All" selected="selected">All</option>
</select><br />
State:
<select name="State">
  <option value="AK">Arkansas</option>
  <option value="CA">California</option>
  <option value="TX">Texas</option>
  <option value="All" selected="selected">All</option>
</select><br />
<input type="submit">
</form>

<?php
require 'utilityFunctions.php';
$connection = connectToDatabase("localhost","root","","college");

$filterCollegeQuery = ""; //if the user selects filters
if($_SERVER['REQUEST_METHOD'] == "POST") //if filters are selected, do this
{
  $filterCollegeQuery .= "(ACTCMMID >= ".$_POST['ACTCMLowerRange'];
  $filterCollegeQuery .= " AND ACTCMMID <= ".$_POST['ACTCMUpperRange'].")";
  //echo $filterCollegeQuery . "<br />";

  if($_POST['CollegePubOrPriv'] != "All")
    $filterCollegeQuery .= " AND CONTROL = " . $_POST['CollegePubOrPriv'];
  //echo $filterCollegeQuery . "<br />";

  if($_POST['State'] != "All")
    $filterCollegeQuery .= " AND STABBR = '" . $_POST['State'] . "'";
  //echo $filterCollegeQuery . "<br />";
}

//query the results from database
if(strlen($filterCollegeQuery) > 0){
  $results = $connection->query("SELECT idx, INSTNM, INSTURL, STABBR FROM info WHERE $filterCollegeQuery");
}
else {
  $results = $connection->query("SELECT idx, INSTNM, INSTURL, STABBR FROM info");
}

foreach($results as $college)
{
  $url = $college['INSTURL'];
  $url = preg_replace('#^https?://#', '', $url); //removes http/https from beginning
  $name = $college['INSTNM'];
  $idx = $college['idx'];
  echo "<a href=\"http://$url\">$name</a>";

  //also want to add a more info option incase that user wants to
  printMoreInfoOption($idx);
}



 ?>
