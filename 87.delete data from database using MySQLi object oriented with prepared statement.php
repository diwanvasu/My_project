<?php
$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="test";

try {
    $conn= new mysqli($db_host,$db_user,$db_pass,$db_name);
    echo"Connection Successfully<hr><br/>";
} catch (Exeception $e) {
    echo"Connection Faild".$e->getMessage();
}

//Delete SQL statement
$sql="DELETE FROM student WHERE id=?";

//Prepared Statement
$result=$conn->prepare($sql);

if($result){
    //Bind Variables to Prepared Statement as Paremeters
    $result->bind_param('i',$id);
    
    //Variables and values
    $id=20;
    
    //Execute Prepared Statement
    $result->execute();

    //Number of row affected
    echo $result->affected_rows;

}
$result->close();
$conn->close();


?>