<?php
$opt=$_GET['name'];
if($opt=="Y"){
    echo "
    <div hidden><h4 >Enter Month :<select  id=month name=month>
    <option selected value='01'>January</option>
    <option value='02'>February</option>
    <option value='03'>March</option>
    <option value='04'>April</option>
    <option value='05'>May</option>
    <option value='06'>June</option>
    <option value='07'>July</option>
    <option value='08'>August</option>
    <option value='09'>September</option>
    <option value='10'>October</option>
    <option value='11'>November</option>
    <option value='12'>December</option>
    </select></h4></div><br>
    <h4>Enter Year :
    <select name=year id=year>
      <option value='2021'>2021</option>
      <option value='2022'>2022</option>
      <option selected value='2023'>2023</option>
    </select>
  </h4>";
}
else if($opt=="M"){
    echo "<h4>Enter Month :<select  id=month name=month>
    <option value='01'>January</option>
    <option value='02'>February</option>
    <option value='03'>March</option>
    <option selected value='04'>April</option>
    <option value='05'>May</option>
    <option value='06'>June</option>
    <option value='07'>July</option>
    <option value='08'>August</option>
    <option value='09'>September</option>
    <option value='10'>October</option>
    <option value='11'>November</option>
    <option value='12'>December</option>
    </select></h4><br>
    <h4>Enter Year :
    <select name=year id=year>
    <option value='2021'>2021</option>
    <option value='2022'>2022</option>
    <option selected value='2023'>2023</option>
    </select>
    </h4>";
}
else if($opt=="Q"){
    echo "<h4>Enter Month :<select  id=month name=month>
    <option value='01'>January</option>
    <option value='02'>February</option>
    <option value='03'>March</option>
    <option selected value='04'>April</option>
    <option value='05'>May</option>
    <option value='06'>June</option>
    <option value='07'>July</option>
    <option value='08'>August</option>
    <option value='09'>September</option>
    <option value='10'>October</option>
    <option value='11'>November</option>
    <option value='12'>December</option>
    </select></h4><br><h4>Enter Year :
    <select name=year id=year>
    <option value='2021'>2021</option>
    <option value='2022'>2022</option>
    <option selected value='2023'>2023</option>
    </select>
    </h4>";
}
?>