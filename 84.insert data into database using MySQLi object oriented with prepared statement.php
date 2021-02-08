<?php
$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="test";

try {
    $conn= new mysqli($db_host,$db_user,$db_pass,$db_name);
    //Create Connection
    echo"Connection Successfully<hr><br/>";
} catch (Exeception $e) {
    echo"Connection Faild".$e->getMessage();
}

//INSERT SQL Statement
$sql="  INSERT INTO student(name,roll,address) VALUES(?,?,?)";


//Prepared Statement
$result=$conn->prepare($sql);
//Bind Variable to prepared Statement as Parameters
$result->bind_param('sis',$name,$roll,$address);

$name="Kshama";
$roll=7524;
$address="Wagodiya";
$result->execute();


echo $result->affected_rows;

//close prepared statement
$result->close();

//Close Connection 
$conn->close();




?>