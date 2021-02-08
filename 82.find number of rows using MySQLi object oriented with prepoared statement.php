<?php

$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="test";

$conn= new mysqli($db_host,$db_user,$db_pass,$db_name);
//Check Connection
if($conn->connect_error){
    die("Connection Faild");
}else{
    echo"Connection Successfully<hr><br/>";
}

//Select all data
$sql="SELECT *FROM student";

//Prepared Statement
$result=$conn->prepare($sql);

//Execute Prepare Statement
$result->execute();

//Store Result
$result->store_result();

//Number of Rows
$result->num_rows();

//Free Result
$result->free_result();

//Close Prepared Statement
$result->close();

//Connection Close
$conn->close();


?>