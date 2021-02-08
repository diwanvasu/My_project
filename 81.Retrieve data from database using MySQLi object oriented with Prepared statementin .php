<?php
$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="test";

$conn=new mysqli($db_host,$db_user,$db_pass,$db_name);
//check connection
if($conn->connect_error){
die("Connection faild");
}else{
    echo"connection Successfully <hr/><br/>";
}

//Select All data
$sql="SELECT *FROM student WHERE id=?";
//Prepared Statement
$result=$conn->prepare($sql);

//Bind Parameter
$result->bind_param('i',$id);
$id=1;

//Bind Result set in variables
$result->bind_result($id,$name,$roll,$address);

//Execute Preapared Statement
$result->execute();

$result->fetch();
echo $id." ". $name. "  ".$roll."  ".$address;
//Close Prepared Statement
$result->close();

$conn->close();

// //Fetch Single Row Data
// while($result->fetch()){

// echo "<b>Id:-</b>".$id."  "."<b>Name:-</b>".$name." "."<b>Roll:-</b>".$roll ."  "."<b>Address:-</b>".$address."<br/><br/>";
// }





?>