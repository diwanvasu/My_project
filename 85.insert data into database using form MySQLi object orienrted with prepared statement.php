<?php
$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="test";

try {
    $conn= new mysqli($db_host,$db_user,$db_pass,$db_name);
    echo"Connection Successfully<hr><br/>";
} catch (Exeception $e) {
    echo"Connection Faild".$e->getMessage();
}

if($_SERVER['REQUEST_METHOD']){
    if (isset($_REQUEST['submit'])) {
       if (($_REQUEST['name']=="") || ($_REQUEST['roll']=="") || ($_REQUEST['address']=="") ) {
           echo"All field's are requiered...";
       }else{
           $sql="INSERT INTO student(name,roll,address) VALUES (?,?,?)";
           $resul=$conn->prepare($sql);           
           $resul->bind_param('sis',$name,$roll,$address);
           $name=$_REQUEST['name'];
           $roll=$_REQUEST['roll'];
           $address=$_REQUEST['address'];
           if($resul->execute()){
               echo $resul->affected_rows."Row has been inserted successfully ";
               
           }else{
               echo"Record are not inserted successfully";
           }
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

    <title>PHP</title>
  </head>
  <body>
<div class="container">
<div class="row">
<div class="col-sm-4">
<form action="" method="POST">
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name">    
  </div>
  <div class="mb-3">
    <label for="roll" class="form-label">Roll</label>
    <input type="text" class="form-control" id="roll" name="roll">
  </div>
  <div class="mb-3">
    <label for="address" class="form-label">Address</label>
    <input type="text" class="form-control" id="address" name="address">
  </div> 
  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
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
