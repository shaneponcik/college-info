<?php

function connectToDatabase($servername,$username, $password, $dbName){
  try {
    $connection = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
    // set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";

    return $connection;
  }
  catch(PDOException $e)
  {
    echo "Connection failed: " . $e->getMessage();
  }
}

function getCollegeInfoArray($idx,$db)
{
  //get all data about the indexed state
  $info = $db->query("SELECT * from info WHERE idx=$idx");
  //access the PDO and retrieve the associative array about that state
  return $info->fetchAll()[0];
}

function printMoreInfoOption($idx)
{
  echo "<form action=\"more_info.php\" method=\"post\">";
  echo "<input type = \"hidden\" name = \"idx\" value = \"$idx\" />";
  echo "<input type=\"submit\" name=\"formMoreInfo\" value=\"More Info\" />";
  echo "</form>";
}

 ?>
