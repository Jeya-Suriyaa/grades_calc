<?php
echo '<html>';
echo '<body style="background-color:bisque;">';


echo"
<div style='float: none; width:90%; height:75%; margin:5% 5% 1% 5%;background-color:#f6f5e1;text-align: center; border:solid'>
<b >ENTER YOUR DETAILS</b>
    <form action='' method='POST' style=' font-weight: bold ;'>
    <br><br>

    <label>NAME : </label>
    <input type='text' name='fn'><br><br>
    <label>REG. NUMBER : </label>
    <input type='text' name='uid'><br><br>


    <label>COURSE NAME  : </label>
    <select name='cn'>
    <option  value='OS'>OS</option>  
    <option  value='Network'>Network</option>  
    <option  value='DBMS'>DBMS</option>
    <option  value='IWP'>IWP</option>    
    <option  value='Microprocessor'>Microprocessor</option>  
    </select><br><br>
    <label>COURSE CODE : </label>
    <input type='text' name='cc'><br><br>
    <label>CAT1 : </label>
    <input type='text' name='c1'><br><br>
    <label>CAT2 : </label>
    <input type='text' name='c2'><br><br>
    <label>DA1 : </label>
    <input type='text' name='d1'><br><br>
    <label>DA2 : </label>
    <input type='text' name='d2'><br><br>
    <label>QUIZ : </label>
    <input type='text' name='qz'><br><br>


<br><br>
    <input type='submit' name='save' value='Submit' style=' font-size: larger ;'> 
    <br>
    <br>
    
   
</form>   
 ";

 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "practice";

 $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$db);
 if(!$conn)
 {
     die("Connect failed: " . mysqli_connect_error());
 }
 
 if(isset($_POST['save']))
 {
    $fn=$_POST['fn'];
    $uid =$_POST['uid'];
    $cn =$_POST['cn'];
    $cc =$_POST['cc'];
    $c1=$_POST['c1'];
    $c2 =$_POST['c2'];
    $d1 =$_POST['d1'];
    $d2 =$_POST['d2'];
    $qz=$_POST['qz'];
  
 


     $sql_query ="INSERT INTO marks(nname,reg,cname,ccode,cat1,cat2,da1,da2,quiz)
      VALUES ('$fn','$uid','$cn','$cc','$c1','$c2','$d1','$d2','$qz')";
      if($c1>30 || $c1<0 ||$c2>30  || $c2<0){echo '<script>alert("Invalid Marks")</script>';} 
      else if($c1<15 ||$c2<15){echo '<script>alert("Slow Learner and Do the Extra Assignment work")</script>';}
      $result = mysqli_query($conn, $sql_query);
if ($result)
{   
  echo "ENTRY SUCCESSFUL";
}
else{
  echo "Values not inserted"; 
}
 }
 ECHO'</div>';
 //-------------------------------------------------------
//-------------------------------------------------------------
echo"
<div style='float: none; width:90%; height:25%; margin:5% 5% 1% 5%;background-color:#f6f5e1;text-align: center; border:solid'>
<b > ENTER YOUR REGISTRATION NUMBER TO VIEW MARKS DETAILS</b>
    <form action='' method='GET' style=' font-weight: bold ;'>
    <br><br>
    <label>REG. NUMBER : </label>
    <input type='text' name='uid2'><br><br>
<br><br>
    <input type='submit' name='save2' value='Submit' style='  font-size: larger ;'> 
    <br>
    <br>
    </div>
   
</form>   
 ";
if(isset($_GET['save2']))
 {
    
    $uid2 =$_GET['uid2'];

 echo "
 <div style='float: none; width:90%; height:10%; margin:5% 0% 0% 5%;background-color:#f6f5e1;text-align: center; border:solid'>
<b > DETAILS FOR STUDENT ID : $uid2</b>
</div>
 <div style='float:left;width:30%;height:30%;background-color:#f6f5e1;border:solid;margin-left:5%'>
 <table border='1' style='margin:0 auto;'>
 <caption>Marks under each Subject</caption>
 <tr>
 <td>course name</td>
 <td>course code</td>
 <td>cat 1</td>
 <td>cat 2</td>
 <td>da 1</td>
 <td>da2</td>
 <td>quiz</td>
 </tr>
 ";
 $sql = "SELECT * FROM marks where reg='$uid2' ";
$result = $conn->query($sql);
$print_username = True;

if ( !empty($result->num_rows) && $result->num_rows > 0)  {

  while($row = $result->fetch_assoc()) {

 $vcn =  $row["cname"];
 $vcc =  $row["ccode"];
 $vc1 =  $row["cat1"];
 $vc2 =  $row["cat2"];
 $vd1  = $row["da1"];
 $vd2 =  $row["da2"];
 $vqz  = $row["quiz"];




  echo'<tr>';
  echo'<td>';
  echo $vcn;
  echo '</td>';
  echo'<td>';
  echo $vcc;
  echo '</td>';
  echo'<td>';
  echo $vc1;
  echo'</td>';
  echo'<td>';
  echo $vc2;
  echo'<td>';
  echo  $vd1;
  echo'</td>';
  echo'<td>';
  echo $vd2;
  echo'</td>';
  echo'<td>';
  echo $vqz;
  echo'</td>';

  echo'</tr>';

 



  
  }
} else {
  echo "0 results";
}

echo'</table>';
echo'</div>';


echo "

<div style='float:left;width:35%;height:30%;background-color:#f6f5e1;border:solid;'>
<table border='1' style='margin:0 auto;'>
<caption>Marks after conversin <br> (out of 60)</caption>
<tr>
<td>course name</td>
<td>Internal Marks</td>
</tr>
";
$avgsum=0;
echo"<tr>
<td>OS</td>";
$sql = "SELECT * FROM marks where reg='$uid2' AND cname='OS'";
$result = $conn->query($sql);
$print_username = True;
$total=0;
if ( !empty($result->num_rows) && $result->num_rows > 0)  {

 while($row = $result->fetch_assoc()) {

$v1cn =  $row["cname"];
$v1cc =  $row["ccode"];
$v1c1 =  $row["cat1"];
$v1c2 =  $row["cat2"];
$v1d1  = $row["da1"];
$v1d2 =  $row["da2"];
$v1qz  = $row["quiz"];

$int1=(15*($v1c1/30))+(15*($v1c2/30))+$v1d1+$v1d2+$v1qz;

$total=$total+$int1;

 
 }
} else {
 echo "0 results";
}
$avgsum=$avgsum+$total;
echo"<td>$total </td></tr>";
echo"<tr>
<td>Network</td>";
$sql = "SELECT * FROM marks where reg='$uid2' AND cname='Network'";
$result = $conn->query($sql);
$print_username = True;
$total=0;
if ( !empty($result->num_rows) && $result->num_rows > 0)  {

 while($row = $result->fetch_assoc()) {

$v1cn =  $row["cname"];
$v1cc =  $row["ccode"];
$v1c1 =  $row["cat1"];
$v1c2 =  $row["cat2"];
$v1d1  = $row["da1"];
$v1d2 =  $row["da2"];
$v1qz  = $row["quiz"];

$int1=(15*($v1c1/30))+(15*($v1c2/30))+$v1d1+$v1d2+$v1qz;

$total=$total+$int1;

 
 }
} else {
 echo "0 results";
}
$avgsum=$avgsum+$total;
echo"<td>$total </td></tr>";

echo"<tr>
<td>DBMS</td>";
$sql = "SELECT * FROM marks where reg='$uid2' AND cname='DBMS'";
$result = $conn->query($sql);
$print_username = True;
$total=0;
if ( !empty($result->num_rows) && $result->num_rows > 0)  {

 while($row = $result->fetch_assoc()) {

$v1cn =  $row["cname"];
$v1cc =  $row["ccode"];
$v1c1 =  $row["cat1"];
$v1c2 =  $row["cat2"];
$v1d1  = $row["da1"];
$v1d2 =  $row["da2"];
$v1qz  = $row["quiz"];

$int1=(15*($v1c1/30))+(15*($v1c2/30))+$v1d1+$v1d2+$v1qz;

$total=$total+$int1;

 
 }
} else {
 echo "0 results";
}
$avgsum=$avgsum+$total;
echo"<td>$total </td></tr>";

echo"<tr>
<td>IWP</td>";
$sql = "SELECT * FROM marks where reg='$uid2' AND cname='IWP'";
$result = $conn->query($sql);
$print_username = True;
$total=0;
if ( !empty($result->num_rows) && $result->num_rows > 0)  {

 while($row = $result->fetch_assoc()) {

$v1cn =  $row["cname"];
$v1cc =  $row["ccode"];
$v1c1 =  $row["cat1"];
$v1c2 =  $row["cat2"];
$v1d1  = $row["da1"];
$v1d2 =  $row["da2"];
$v1qz  = $row["quiz"];

$int1=(15*($v1c1/30))+(15*($v1c2/30))+$v1d1+$v1d2+$v1qz;

$total=$total+$int1;

 
 }
} else {
 echo "0 results";
}
$avgsum=$avgsum+$total;
echo"<td>$total </td></tr>";

echo"<tr>
<td>Microprocessor</td>";
$sql = "SELECT * FROM marks where reg='$uid2' AND cname='Microprocessor'";
$result = $conn->query($sql);
$print_username = True;
$total=0;
if ( !empty($result->num_rows) && $result->num_rows > 0)  {

 while($row = $result->fetch_assoc()) {

$v1cn =  $row["cname"];
$v1cc =  $row["ccode"];
$v1c1 =  $row["cat1"];
$v1c2 =  $row["cat2"];
$v1d1  = $row["da1"];
$v1d2 =  $row["da2"];
$v1qz  = $row["quiz"];

$int1=(15*($v1c1/30))+(15*($v1c2/30))+$v1d1+$v1d2+$v1qz;

$total=$total+$int1;

 
 }
} else {
 echo "0 results";
}
$avgsum=$avgsum+$total;
echo"<td>$total </td></tr>";
echo'</table>';
ECHO'</div>';
echo "

 <div style='float:left;width:25%;height:15%;background-color:#f6f5e1;border:solid;'>
 <table border='1' style='margin:0 auto;'>
 <caption>Average Marks of all subjects Combined</caption>
 <tr>
 <td>Average Marks </td>
 </tr>

 ";
$avg=$avgsum/5;
echo"<tr><td> $avg </td></tr>";
echo'</table>';
echo'</div>';

echo "

 <div style='float:left;width:25%;height:15%;background-color:#f6f5e1;border:solid;'>
 <table border='1' style='margin:0 auto;'>
 <caption>Overall CGPA</caption>
 <tr>
 <td>CGPA </td>
 </tr>

 ";
 
if($avg>=50){echo"<tr><td>10 </td></tr>";goto end;}
else if($avg>=40){echo"<tr><td> 9</td></tr>";goto end;}
else if($avg>=30){echo"<tr><td> 8</td></tr>";goto end;}
else if($avg>=20){echo"<tr><td> 7 </td></tr>";goto end;}
else if($avg>=10){echo"<tr><td> 6</td></tr>";goto end;}
else {echo"<tr><td> F </td></tr>";}


end:
echo'</table>';

echo'</div>';

 }
?>