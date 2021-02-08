<?php
$dsn="mysql: host=localhost; dbname=test";
$user="root";
$pass="";

try {
    $conn= new PDO ($dsn,$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    echo"Connetion Successfully<hr/><br/>";
} catch (PDOException  $e) {
    echo"Connection faild".$e->getMessage();
}
/* try {
    $sql="SELECT *FROM student";
    $result=$conn->prepare($sql);
    $result->execute();
    $result->bindColumn(1,$id);
    $result->fetch(PDO::FETCH_ASSOC);
    echo $id;
} catch (PDOException $e) {
    echo $e->getMessage();
}
 */
/* 
 try {
     $sql="SELECT *FROM student WHERE id=? && name=?";
     $result=$conn->prepare($sql);
     $result->bindParam(1,$id,PDO::PARAM_INT,1);
     $result->bindParam(2,$name);
     $id=7;
     $name='Vasim';
     $result->execute();
     $result->fetch(PDO::FETCH_ASSOC);
     echo $id.$name;
 } catch (PDOException $e) {
     $e->getMessage();
 } */


 try {
     if (isset($_REQUEST['submit'])) {
     $sql="SELECT *FROM student WHERE id=? || name=?";
     $result=$conn->prepare($sql);     
     $id=$_REQUEST['name'];
    $result->bindValue(1,$id);
    $name=$_REQUEST['name'];     
    $result->bindValue(2,$name); 
    $result->execute();

    $row=$result->fetch(PDO::FETCH_ASSOC);
    echo $row['id'].$row['name'].$row['roll'].$row['address'];   
     }else{
        echo "Not valid name";
     }
 } catch (PDOException $e) {
   $e->getMessage();
 }
 

?>

<html>
<head>
</head>
<body>
    <form action="" method="POST">
    Name:-<input type="text" name="name" autofocus>
    <input type="hidden" name="id" value='.$id.'>
    <button name="submit">Submit</button>
    </form>

</body>
</html>