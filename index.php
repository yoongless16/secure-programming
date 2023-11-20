<?php
// Connect to the database
$host = 'localhost';
$dbname = 'library_syaz';
$username = 'root';
$password = '';
$port = 3307;

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
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

  <title>SYAZ'S LIBRARY</title>
  <style>
    body{
      margin-right: 50px;
      margin-left: 50px;
    }
    </style>
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


<body>
  <tbody>
    <a href="login_user.php" class="btn btn-dark mb-3">Log Out</a>
    <table class="table table-hover text-center">
      <thead class="table-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Entry Number</th>
          <th scope="col">Book Name</th>
          <th scope="col">Author</th>
          <th scope="col">Publisher</th>
          <th scope="col">ISBN Number</th>
          <th scope="col">Version</th>  
          <th scope="col">Shelf</th>
        </tr>
      </thead>
      <?php
    // Fetch and display list of books
    $stmt = $pdo->query("SELECT * FROM books");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    ?>
        <tr>
            <td><?php echo $row["id"] ?></td>
            <td><?php echo $row["entry_number"] ?></td>
            <td><?php echo $row["book_name"] ?></td>
            <td><?php echo $row["author"] ?></td>
            <td><?php echo $row["publisher"] ?></td>
            <td><?php echo $row["isbn_number"] ?></td>
            <td><?php echo $row["version"] ?></td>
            <td><?php echo $row["shelf"] ?></td>
        </tr>
    <?php
    }
    ?>
</table>
</tbody>
</body>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>