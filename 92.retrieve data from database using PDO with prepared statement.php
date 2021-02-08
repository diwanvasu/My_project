<?php
$dsn = "mysql:host=localhost; dbname=test";
$db_user = "root";
$db_pass = "";

try {
    $conn = new PDO($dsn, $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connection Successfully<br/>";
} catch (PDOException $e) {
    echo "Connection Faild" . $e->getMessage();
}

try {
    $sql = "SELECT *FROM student";

    //prepared statement
    $result = $conn->prepare($sql);

    //Execute prepared statement
    $result->execute();

    //     //Fetch data
    //     if($result->rowCount()>0){
    //     while($row=$result->fetch(PDO::FETCH_ASSOC)){
    //         echo $row['id'].$row['name'].$row['roll'].$row['address']."<br/>";
    //     }
    // }       

    //Bind by column number
    // $result->bindColumn(1,$id);
    // $result->bindColumn(2,$name);
    // $result->bindColumn(3,$roll);
    // $result->bindColumn(4,$address);
    // while ($result->fetch(PDO::FETCH_BOUND)) {
    //     echo"id".$id."Name".$name."Roll".$roll."Address".$address."<br/>";
    // }

    //Bind by column name
    $result->bindColumn('id', $id);
    $result->bindColumn('name', $name);
    $result->bindColumn('roll', $roll);
    $result->bindColumn('address', $address);
    while ($result->fetch(PDO::FETCH_COLUMN)) {
        echo $id . $name . $roll . $address . "<br/>";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
//close prepared statement
unset($result);

//close connection
$conn = null;
