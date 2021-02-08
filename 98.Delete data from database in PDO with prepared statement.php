<?php
$dsn="mysql:host=localhost;dbname=test";
$db_user="root";
$db_pass="";

try{
$conn=new PDO($dsn,$db_user,$db_pass)or die("Connection faild");
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
echo"Connection Success <br/>";
}catch(PDOException $e){
echo $e->getMessage();
}

//using named placeholder
$sql="DELETE FROM student WHERE id=:id";

//prepared statement
$result=$conn->prepare($sql);

//$result->execute(array(':id'=>$id));
//Bind parameter to prapared statement

$result->bindParam(':id',$id);
$id=3;
$result->execute();
echo $result->rowCount()."Row deleted <br/>";

?>