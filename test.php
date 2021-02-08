<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "test";

try {
  $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
  //echo"Connection Successfully<hr/><br/>";
} catch (Exception $e) {
  echo "Connection Faild" . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_REQUEST['submit'])) {
    if (($_REQUEST['name'] == "") || ($_REQUEST['roll'] == "") || ($_REQUEST['address'] == "")) {
      echo "<small>All fields's are required</small>";
    } else {
      $sql = "INSERT INTO student(name,roll,address) VALUES (?,?,?)";
      $result = $conn->prepare($sql);
      $result->bind_param('sis', $name, $roll, $address);
      $name = $_REQUEST['name'];
      $roll = $_REQUEST['roll'];
      $address = $_REQUEST['address'];
      if ($result->execute()) {
        echo "Record has been inserted successfully";
      } else {
        echo "Record are not inserted successfully";
      }
      $result->close();
    }
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_REQUEST['delete'])) {
    $sql = "DELETE FROM student WHERE id=?";
    $result = $conn->prepare($sql);
    $result->bind_param('i', $id);
    $id = $_REQUEST['id'];
    if ($result->execute()) {
      echo "Delete has been successfully";
    } else {
      echo "Delete are not successfully";
    }
    $result->close();
  }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_REQUEST['update'])) {
    if (($_REQUEST['name'] == "") || ($_REQUEST['roll'] == "") || ($_REQUEST['address'] == "")) {
      echo "<small>All field's are requiered</small>";
    } else {
      $sql = "UPDATE student SET name=?,roll=?,address=? WHERE id=?";
      $result = $conn->prepare($sql);
      $result->bind_param('sisi', $name, $roll, $address, $id);
      $name = $_REQUEST['name'];
      $roll = $_REQUEST['roll'];
      $address = $_REQUEST['address'];
      $id = $_REQUEST['id'];
      if ($result->execute()) {
        echo "Record has been updated successfully";
      } else {
        echo "Record are not updated successfully";
      }
      $result->close();
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

  <title>Practice</title>
</head>

<body>
<header>
<form action="" method="POST">
    <div align="right" class=" container my-3">
      <label for="Search" style="color:green; text-shadow: 2px 2px 5px black; font-size: 20px"> Search The Value's</label>
      <input type="search" name="info">

      <button name="search" name="search" class="btn btn-success">Search</button>
    </div>
    <?php
    if (isset($_REQUEST['search'])) {
      if (empty($_REQUEST['info'] == "")) {
        $sql = "SELECT *FROM student WHERE id=? || name=?";
        $show = $conn->prepare($sql);
        $show->bind_param('is', $id, $name);
        $name = $_REQUEST['info'];
        $id = $_REQUEST['info'];
        $show->bind_result($id, $name, $roll, $address);
        $show->execute();
        $show->store_result();
        if($show->num_rows()>0) {
        $show->fetch();
        echo $id . $name . $roll . $address;
      }else{
        echo "0 Result show";
      }
      $show->close();
    }
    }
   
    ?>
  </form>
</header>
      <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_REQUEST['edit'])) {
      $sql = "SELECT * FROM student WHERE id=?";
      $result = $conn->prepare($sql);
      $result->bind_param('i', $id);
      $id = $_REQUEST['id'];
      $result->bind_result($id, $name, $roll, $address);
      $result->execute();
      $result->fetch();
      $result->close();
    }
  }

  ?>

    <form action="" method="POST">
    <div class="container my-4">
      <div class="row">
        <div class="col-sm-4">


          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php if (isset($name)) { echo $name;} ?>">

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
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <button type="submit" class="btn btn-info" name="update">Update</button>
  </form>
  </div>
  <div class="col-sm-6 offset-sm-2 my-4">
    <table class="table">
      <thead class="" table table-dark>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Name</th>
          <th scope="col">Roll</th>
          <th scope="col">Address</th>
          <th scope="col">Action's</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT *FROM student";
        $result = $conn->prepare($sql);
        $result->bind_result($id, $name, $roll, $address);
        $result->execute();
        $result->store_result();
        if ($result->num_rows() > 0) {
          $idd = 0;
          while ($result->fetch()) {
            $idd++;
            echo '<tr>
      <th scope="row">' . $idd . '</th>
      <td>' . $name . '</td>
      <td>' . $roll . '</td>
      <td>' . $address . '</td>
      <td><form action="" method="POST"><input type="hidden" name="id" value=' . $id . '><input type="submit" name="delete" id="delete" class="btn btn-danger" value="Delete"> <input type="submit" name="edit" id="edit" class="btn btn-info" value="Edit"></form></td>
    </tr>';
          }
        }
        $result->close();
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