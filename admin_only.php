<?php
// Start the session
session_start();

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

// Registration logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $password]);
        $registrationSuccess = true;
    } catch (PDOException $e) {
        $registrationError = "Registration failed: " . $e->getMessage();
    }
}
// Admin view users logic
if (isset($_SESSION['admin']) && isset($_GET['action']) && $_GET['action'] === 'view_users') {
    try {
        // Assuming 'users' table for normal users and 'admin' table for admin users
        $table = ($_SESSION['admin']) ? 'admin' : 'users';
        $stmt = $pdo->query("SELECT * FROM $table");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $adminError = "Error fetching users: " . $e->getMessage();
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

  <title>Admin</title>
</head>
<br>
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
    <a href="add_books.php" class="btn btn-dark mb-3" style="background-color: #3cb371; color: white;  margin-left: 700px; border:none;">ADD NEW BOOKS</a>
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
            <td>
                <a href="edit_books.php?id=<?php echo $row["id"] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                <a href="delete.php?id=<?php echo $row["id"] ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
</tbody>
</body>

<body>
<tbody>
    <a href="add_users.php" class="btn btn-dark mb-3" style="background-color:#3cb371; color: white; margin-left: 700px; border:none;">ADD NEW USER</a>
<table class="table table-hover text-center">
      <thead class="table-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Username</th>
          <th scope="col">Password</th>
        </tr>
      </thead>
      <?php
    // Fetch and display list of users
    $stmt = $pdo->query("SELECT * FROM users");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    ?>
        <tr>
            <td><?php echo $row["id"] ?></td>
            <td><?php echo $row["username"] ?></td>
            <td><?php echo $row["password"] ?></td>
            <td>
                <a href="edit_users.php?id=<?php echo $row["id"] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                <a href="delete.php?id=<?php echo $row["id"] ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
          <a href="login_admin.php" class="GFG"> 
        Click here 
    </a> 
</tbody>
</body>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<style>
    table, th, td 
    {
    border: 1px solid black;
    border-collapse: collapse;
    background-color: white;
    }
    table
    {
     position: center;
    }

</style>
</body>

</html>