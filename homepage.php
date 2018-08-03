<form action="college_results.php" method="post">
    <?php //generates checkboxes for all states
    require 'DATA/data.php';
    for($i = 0; $i < count($us_state_abbrevs); $i++)
    {
      echo "$us_state_abbrevs[$i]<input type=\"checkbox\" name=\"$us_state_abbrevs[$i]\" value=\"STATE\"/>";

      if($i % 5 == 0)
          echo "<br />";
    }?>
    ACT Composite Score<input type="text" name="ACTCMScore"/>
    <input type="submit" name="formSubmit" value="Submit" />
</form>
