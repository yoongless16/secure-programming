<?php
// Database connection (replace with your database credentials)
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

// Admin Registration logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

    try {
        $stmt = $pdo->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $password]);
        $registrationSuccess = true;
    } catch (PDOException $e) {
        $registrationError = "Registration failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <title>Admin Registration</title>
</head>
<container>
<body style="background-color: #f0f0f0">
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


<h1>ADMIN REGISTER FORM</h1>

<?php if (isset($registrationSuccess)): ?>
    <p style="color: green;">Registration successful! You can now log in as an admin.</p>
<?php endif; ?>

<?php if (isset($registrationError)): ?>
    <p style="color: red;"><?php echo $registrationError; ?></p>
<?php endif; ?>

<!-- Admin Registration Form -->
<form method="post" action=""  >
    <label for="username">Username:</label>
    <input type="text" name="username" required><br>
    <br>
    <label for="password">Password:</label>
    <input type="password" name="password" required><br>
    <br>
    <button type="submit" name="register">Register</button>
    <a href="login_admin.php" class="btn btn-dark mb-3">Back</a>
    <br><br> <br><br>
</form>
</container>

<style>
      form 
         {
            margin-top: 50px;
            text-align: center;
         }
        h1
        {
            font-family: "Arial Black", Gadget, sans-serif;
            font-size: 25px;
            letter-spacing: 2px;
            word-spacing: 2px;
            color: black;
            font-weight: 700;
            text-align: center;
           
            
        }
    
</body>
</html>
