<?php

$dsn = "mysql:host=localhost;dbname=test";
$db_user = "root";
$db_pass = "";


try {
    $conn = new PDO($dsn, $db_user, $db_pass) or die("Connection faild");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connection success";
} catch (PDOException $e) {
    echo $e->getMessage();
}


try{
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    if (isset($_REQUEST['delete'])) {
        $sql="DELETE FROM student WHERE id=:id";
        $result=$conn->prepare($sql);
        $id=$_REQUEST['id'];
        //$result->bindParam(':id',$id,PDO::PARAM_INT);
        //$result->bindValue(':id',$id,PDO::PARAM_INT);
        $delete=$result->execute(array(':id'=>$id));
        if ($delete) {
            echo $result->rowCount()."Row deleted";
        }else{
            echo"Row not deleted";
        }
    }
}

}catch(PDOException $e){
echo $e->getMessage();
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <div class="container my-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Roll</th>
                    <th scope="col">Address</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT *FROM student";
                $result = $conn->prepare($sql);
                $result->bindColumn('id', $id);
                $result->bindColumn('name',$name);
                $result->bindColumn('roll',$roll);
                $result->bindColumn('address', $address);
                $result->execute();
                if ($result->rowCount() > 0) {
                    $idd=0;
                    while ($result->fetch(PDO::FETCH_ASSOC)) {
                        $idd++;
                        echo '<tr>
                         <th scope="row">'.$idd.'</th>
                            <td>'.$name.'</td>
                                <td>'.$roll.'</td>
                                 <td>'.$address.'</td>
                                 <td><form action="" method="POST"><input type="hidden" name="id" value='.$id.'>
                                 <input type="submit" name="delete" id="delete" class="btn btn-danger" value="Delete"></form></td>
                                    </tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>

</html>