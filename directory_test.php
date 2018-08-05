<!DOCTYPE html>
<html>

<head>
  <title>College Directory</title>
  <link rel="stylesheet" type="text/css" href="styles/styles.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type ="text/javascript" src="js/directory_test.js"></script>
</head>

<body>
  <!-- <form action="" method="post">
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
  <select multiple name="State">
    <option value="AK">Arkansas</option>
    <option value="CA">California</option>
    <option value="TX">Texas</option>
    <option value="All" selected="selected">All</option>
  </select><br />
  <input type="submit">
  </form> -->
  <?php
  require 'utilityFunctions.php';
  require 'DATA/data.php';
  $connection = connectToDatabase("localhost","root","","college");

  $filterQueryString = ""; //contains the filter information requested by user

  //create accordions for all states
  foreach($us_state_abbrevs as $state)
  {
    echo "<button class=\"accordion\">$state</button>";
    echo "<div class=\"panel\">";

    $sqlQuery = "SELECT idx, INSTNM, INSTURL FROM info WHERE STABBR='$state'";
    //echo $sqlQuery;
    $stateColleges = $connection->query($sqlQuery);
    printCollegesAsAnchors($stateColleges);

    echo "</div>";
  }
  ?>

</body>
</html>
