<?php

$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="test";

try {
    $conn= new mysqli($db_host,$db_user,$db_pass,$db_name);
    echo"Connection Successfully<hr><br/>";
} catch (Exeception $e) {
    echo"Connection faild".$e->getMessage();
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
  $sql="SELECT *FROM student";
  $result=$conn->prepare($sql);
  $result->bind_result($id,$name,$roll,$address);
  $result->execute();
  $result->store_result();
  if($result->num_rows()>0){
      $idd=0;
   while($result->fetch()){  
       $idd++;
    echo'<tr>
      <th scope="row">'.$idd.'</th>
      <td>'.$name.'</td>
      <td>'.$roll.'</td>
      <td>'.$address.'</td>
    </tr>';
   }
   $result->free_result();
   $result->close();
  }else{
      echo"0 Result";
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
