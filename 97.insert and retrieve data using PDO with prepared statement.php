<?php

$dsn = "mysql:host=localhost;dbname=test";
$db_user = "root";
$db_pass = "";
try {
    $conn = new PDO($dsn, $db_user, $db_pass) or die("Connnection Faild");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connection Successfully<hr/><br/>";
} catch (PDOException $e) {
    echo $e->getMessage();
}
try {
    $exit;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_REQUEST['submit'])) {
            if (($_REQUEST['name'] == "") || ($_REQUEST['roll'] == "") || ($_REQUEST['address'] == "") && $exit) {
                echo '<small> <center>All fields are required please fill it...</center></small>';
            } else {
                $sql = "INSERT INTO student(name,roll,address) VALUES (:name,:roll,:address)";
                $result = $conn->prepare($sql);
                $name = $_REQUEST['name'];
                $roll = $_REQUEST['roll'];
                $address = $_REQUEST['address'];
                $insert = $result->execute(array(':name' => $name, ':roll' => $roll, ':address' => $address));
                if ($insert) {
                    echo $result->rowCount() . "Row Inserted";
                } else {
                    echo "Row not inserted";
                }
                unset($result);
            }
        }
    }
} catch (PDOException $e) {
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

    <title>PHP_PDO</title>

</head>

<body>
    <div class="container my-5">
        <div class="row">
            <div class="col-sm-4">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="rolll" class="form-label">Roll</label>
                        <input type="text" class="form-control" id="roll" name="roll">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-sm-6 offset-sm-2 my-1">
                <table class="table">
                    <thead class="table table-dark">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Roll</th>
                            <th scope="col">Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT *FROM student ";
                        $result = $conn->prepare($sql);
                        $result->bindColumn('id', $id);
                        $result->bindColumn('name', $name);
                        $result->bindColumn('roll', $roll);
                        $result->bindColumn('address', $address);
                        $result->execute();
                        if ($result->rowCount() > 0) {
                            while ($result->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>
                            <th scope="row">'.$id.'</th>
                            <td>'.$name.'</td>
                            <td>'.$roll.'</td>
                            <td>'.$address.'</td>
                        </tr>';
                            }
                        }else{
                            echo"0 Result";
                        }
                        unset($result);
                        ?>
                    </tbody>
                </table>

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