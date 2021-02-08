<?php

$dsn = "mysql:host=localhost;dbname=test";
$db_user = "root";
$db_pass = "";

try {
    $conn = new PDO($dsn, $db_user, $db_pass) or die("Connection faild");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connection Successfully<hr/><br/>";
} catch (PDOException $e) {
    echo $e->getMessage();
}
if ($_SERVER['REQUEST_METHOD']=="POST") {
    if (isset($_REQUEST['submit'])) {
       if (($_REQUEST['name']=="") || ($_REQUEST['roll']=="") || ($_REQUEST['address']=="")) {
           echo"Please all field's are required...!";
       }else{
           $sql="INSERT INTO student(name,roll,address) VALUES(:name,:roll,:address)";
           $result=$conn->prepare($sql);
           /* 
           //bindParam with nameed perametr
           $result->bindParam(':name',$name,PDO::PARAM_STR);
           $result->bindParam(':roll',$roll,PDO::PARAM_INT);
           $result->bindParam(':address',$address,PDO::PARAM_STR);

            //bindValue with named perameter
            $result->bindValue(':name',$name,PDO::PARAM_STR);
            $result->bindValue(':roll',$roll,PDO::PARAM_INT);
            $result->bindValue(':address',$address,PDO::PARAM_STR);
            */

           $name=$_REQUEST['name'];
           $roll=$_REQUEST['roll'];
           $address=$_REQUEST['address'];
           
           //execute array with named perameter
           $show=$result->execute(array(':name'=>$name,':roll'=>$roll,':address'=>$address));
           /* 
           $execute array with positional perameter
           $result->execute(array($name,$rol,$address));*/
           if ($show) {
               echo $result->rowCount()."Row inserted";
           }else{
               echo"Not inserted";
           }
           unset($result);
       }
    }    
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
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <div class="mb-3">
                            <label for="roll" class="form-label">Roll</label>
                            <input type="text" class="form-control" id="roll" name="roll">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
                </form>
            </div>
        </div>
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