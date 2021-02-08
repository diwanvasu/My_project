<?php

$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="test";

try {
    $conn= new mysqli($db_host,$db_user,$db_pass,$db_name);
    echo"Connection successfully<hr/><br/>";
} catch (Exeception $e) {
    echo"Connection faild".$e->getMessage();
}

//Update SQL Statement
$sql="UPDATE student SET name=? , roll=?, address=? WHERE id=?";

//Prepared Statement
$result=$conn->prepare($sql);

if ($result) {
    //Bind Variables to Prepares as Statements
    $result->bind_param('sisi',$name,$roll,$address,$id);
    //Variables and Values
    $name="Mukti";
    $roll=19032000;
    $address="Vejalpur";
    $id=31;

    //Execute Prepared Statement
    $result->execute();
    
    //Number of row affected
    echo $result->affected_rows."Rows affected";

}
$result->close();
$conn->close();

?>