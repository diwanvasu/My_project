<?php

$dsn="mysql:host=localhost;dbname=test";
$db_user="root";
$db_pass="";
try {
    $conn=new PDO($dsn,$db_user,$db_pass)or die("Connection faild");
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    echo"Connection Success <br/>";
} catch (PDOException $e) {
    echo $e->getMessage();
}

try{
    $sql="INSERT INTO student(name,roll,address) VALUES (:name,:roll,:address)";
    $result=$conn->prepare($sql);   
/* 
    $result->bindParam(1,$name,PDO::PARAM_STR);
    $result->bindParam(2,$roll,PDO::PARAM_INT);
    $result->bindParam(3,$address,PDO::PARAM_STR);

    $result->bindParam(':name',$name,PDO::PARAM_STR);
    $result->bindParam(':roll',$roll,PDO::PARAM_INT);
    $result->bindParam(':address',$address,PDO::PARAM_STR);
    $name='vasi';
    $roll=888;
    $address='Kaloll';

$result->execute(['vasiii',8788,'godhra']); */

//$result->execute(array(':name'=>'mukti',':roll'=>1903,':address'=>'chora'));
//positional perameter
//$result->execute(['mukti',1903,'vejalur']);


//name perameter
//$result->execute(array(':name'=>'miksha',':roll'=>8888,':address'=>'mum'));
$result->execute(['mukti',864,'kol']);


echo $result->rowCount()."inserted row";

}catch(PDOException $e){

}


?>