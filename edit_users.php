<?php
include "db_connect.php";
$id = $_GET["id"];
$row = [];

if (isset($_POST["submit"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
  $sql = "UPDATE `users` SET `username`='$username',`password`='$password' WHERE id = $id";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: admin_only.php?msg=Data updated successfully");
  } else {
    echo "Failed: " . mysqli_error($conn);
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>EDIT USERS</title>
</head>

<body>
<nav class="navbar navbar-light justify-content-center fs-3 mb-5"  
   style=" margin: auto;
                width: 50%;
                border-bottom: 3px solid black;
                padding: 20px;
                padding-top: 30px;
                font-family: Lucida Sans Unicode, Lucida Grande;
               font-size: 25px;
               letter-spacing: 2px;
               word-spacing: 2px;
               color: black;
               font-weight: 900;
               text-align: center;"
               >
      SYAZ'S LIBRARY
   </nav>


  <div class="container">
    <div class="text-center mb-4">
      <h3>Edit Users Information</h3>
      <p class="text-muted">Click update after changing any information</p>
    </div>

    <?php
    $sql = "SELECT * FROM `users` WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">Username:</label>
            <input type="text" class="form-control" name="username" value="<?php echo $row['username'] ?>">
          </div>

          <div class="col">
            <label class="form-label">Password:</label>
            <input type="text" class="form-control" name="password" value="<?php echo $row['password'] ?>">
          </div>
        </div>
        
        <div>
          <button type="submit" class="btn btn-success" name="submit">Update</button>
          <a href="admin_only.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>