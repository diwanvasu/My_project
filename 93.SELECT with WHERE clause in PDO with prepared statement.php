<?php
$dsn = "mysql:host=localhost; dbname=test";
$db_user = "root";
$db_pass = "";

try {
    $conn = new PDO($dsn, $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connection successfully<hr/><br/>";
} catch (PDOException $e) {
    echo "Connection faild" . $e->getMessage();
}
try {
    $sql = "SELECT *FROM student WHERE id=:id && name=:name";
    //Prepared Statement
    $result = $conn->prepare($sql);
    //Bind parameters

    //$result->bindParam(1,$id);->positional perameter
    //$result->bindParam(':id',$id);->name perameter
    //$id=17;

    //  $result->bindValue(':id', 7 ,PDO::PARAM_INT);


    //Execute Prepared Statement
    $result->execute(array(':id' => 7, ':name' => 'vasim'));

    $row = $result->fetch(PDO::FETCH_ASSOC);

    echo $row['id'] . $row['name'] . $row['roll'] . $row['address'];
} catch (PDOException $e) {
    echo "faild" . $e->getMessage();
}
unset($result);

$conn = null;
