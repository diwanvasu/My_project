<?php

$dsn = "mysql:host=localhost; dbname=test";
$db_user = "root";
$db_pass = "";

try {
    $conn = new PDO($dsn, $db_user, $db_pass) or die("Connection Faild");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo"Connection successfully";
} catch (PDOException $e) {
    echo $e->getMessage();
}

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_REQUEST['submit'])) {
            if (($_REQUEST['name'] == "") || ($_REQUEST['roll'] == "") || ($_REQUEST['address'] == "")) {
                echo "<small>Please fill all field's</small>";
            } else {
                $sql = "INSERT INTO student(name,roll,address) VALUES(:name,:roll,:address)";
                $result = $conn->prepare($sql);
                $name = $_REQUEST['name'];
                $roll = $_REQUEST['roll'];
                $address = $_REQUEST['address'];
                if ($result->execute(array(':name' => $name, ':roll' => $roll, ':address' => $address))) {
                    echo $result->rowCount() . "Row inserted";
                } else {
                    echo "Row are not inserted";
                }
            }
            unset($result);
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_REQUEST['delete'])) {
            $sql = "DELETE FROM student WHERE id=:id";
            $result = $conn->prepare($sql);
            $id = $_REQUEST['id'];
            if ($result->execute(array(':id' => $id))) {
                echo $result->rowCount() . "Row has been deleted";
            } else {
                echo "Row are not deleted";
            }
            unset($result);
        }
    }

    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        if (isset($_REQUEST['update'])) {
            if (($_REQUEST['name']=="") || ($_REQUEST['roll']=="") || ($_REQUEST['address']=="")) {
                echo"<small>please fill the updated record</small>";
            }else{
                $sql="UPDATE student SET name=:name, roll=:roll,address=:address WHERE id=:id";
                $result=$conn->prepare($sql);
                
                $name=$_REQUEST['name'];
                $roll=$_REQUEST['roll'];
                $address=$_REQUEST['address'];
                $id=$_REQUEST['id'];
                if ($result->execute(array(':name'=>$name,':roll'=>$roll,':address'=>$address,':id'=>$id))) {
                    echo $result->rowCount()."Row has been updated";
                }else{
                    echo"Row are not updated";
                }
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
    <link href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet">
    <title>PDO_PRAC</title>
</head>

<body>
    <?php
    if (isset($_REQUEST['edit'])) {
        $sql = "SELECT *FROM student WHERE id=:id";
        $result = $conn->prepare($sql);

        $result->bindColumn('id', $id);
        $result->bindColumn('name', $name);
        $result->bindColumn('roll', $roll);
        $result->bindColumn('address', $address);
        $id = $_REQUEST['id'];
        $result->execute(array(':id' => $id));

        $result->fetch(PDO::FETCH_ASSOC);
    }
    ?>
    <div class="container my-5">
        <div class="row">
            <div class="col-sm-4">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php if (isset($name)) {
                                                                                                    echo $name;
                                                                                                } ?>">
                    </div>
                    <div class="mb-3">
                        <label for="roll" class="form-label">Roll</label>
                        <input type="text" class="form-control" id="roll" name="roll" value="<?php if (isset($roll)) {
                                                                                                    echo $roll;
                                                                                                } ?>">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php if (isset($address)) {
                                                                                                        echo $address;
                                                                                                    } ?>">
                    </div>
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit</button>
                    <input type="hidden" name="id" value="<?php if (isset($id)) {
                                                                echo $id;
                                                            } ?>">
                    <button type="submit" name="update" id="update" class="btn btn-warning">Update</button>
                </form>
            </div>
            <div class="col-sm-6 offset-sm-2 my-4">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Roll</th>
                            <th scope="col">Address</th>
                            <th scope="col">Aaction's</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT *FROM student";
                        $result = $conn->prepare($sql);

                        $result->bindColumn('id', $id);
                        $result->bindColumn('name', $name);
                        $result->bindColumn('roll', $roll);
                        $result->bindColumn('address', $address);
                        $result->execute();
                        if ($result->rowCount() > 0) {
                            $idd = 0;
                            while ($result->fetch(PDO::FETCH_ASSOC)) {
                                $idd++;
                                echo '<tr>
                                <th scope="row">' . $idd . '</th>
                                <td>' . $name . '</td>
                                <td>' . $roll . '</td>
                                <td>' . $address . '</td>
                                <td><form action="" method="POST"><input type="hidden" name="id" value=' . $id . '>
                                <input type="submit" name="delete" id="delete" class="btn btn-danger" value="Delete"> 
                                <input type="submit" name="edit" id="edit" class="btn btn-warning" value="Edit"></form></td>
                                </tr>';
                            }
                        }
                        unset($result);
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>


    <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>