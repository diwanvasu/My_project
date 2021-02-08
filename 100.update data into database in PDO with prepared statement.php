<?php

$dsn="mysql:host=localhost;dbname=test";
$db_user="root";
$db_pass="";

try{
    $conn=new PDO($dsn,$db_user,$db_pass)or die("Connection faild");
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    echo"Connection success<br/>";
}catch(PDOException $e){
echo $e->getMessage();
}

try{
    //Using named placeholder
    $sql="UPDATE student SET name=:name,roll=:roll,address=:address WHERE id=:id";
    
    //Prepared Statement
    $result=$conn->prepare($sql);

    //Bind Paremeter to Prepared Statement
    /* $result->bindParam(':name',$name,PDO::PARAM_STR);
    $result->bindParam(':roll',$roll,PDO::PARAM_INT);
    $result->bindParam(':address',$address,PDO::PARAM_STR);
    $result->bindParam(':id',$id,PDO::PARAM_INT); */

    //Bind value to prepared statement
   /*    $result->bindValue(':name','khushboo',PDO::PARAM_STR);
       $result->bindValue(':roll',2222,PDO::PARAM_INT);
       $result->bindValue(':address','Godhra',PDO::PARAM_STR);
       $result->bindValue(':id',11,PDO::PARAM_INT);  */            
    
    $name='Mukti';
    $roll=1903;
    $address='Vejalpur_Chora';
    $id=11; 
    //$result->execute();
    
    $result->execute(array(':name'=>$name,':roll'=>$roll,':address'=>$address,':id'=>$id));

    echo $result->rowCount()."Row updated";
}catch(PDOException $e){

}

unset($result);
$conn=null;
?>