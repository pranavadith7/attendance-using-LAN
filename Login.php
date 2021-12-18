<html>
<head>
 
    <link rel="stylesheet" href="LoginCs.css?<?= time()?>">
    <title>Login</title>
</head>

<?php
  session_start();
  if(isset($_SESSION['rollNo'])) {
    header('location: home.php');
  }
  if(isset($_POST['logout'])) {
    session_destroy();
  }
  
  include_once('connection.php');
	if (!$conn) {
    echo "Connection failed: " . mysqli_connect_error();
	}
	if(isset($_POST['log'])) {
		$name = htmlspecialchars($_POST['rollNo']);
    $pass = htmlspecialchars($_POST['psw']);
    $pass_hash = md5($pass);
    
    $sql = "SELECT * FROM students WHERE roll_no='$name' AND password='$pass_hash'";
    $result = mysqli_query($conn, $sql);
    // echo $sql;
    // echo mysqli_num_rows($result);

    if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        $_SESSION['rollNo'] = $row['roll_no'];
        $_SESSION['student_id'] = $row['id'];
        $_SESSION['name'] = $row['name'];

        header('location: home.php');
      }
    } else {
      echo "<script>alert('Invalid Rollno or Password')</script>";
    }
    
	}
?>

<body>
    <div>

  <form class="container" action="Login.php" method="post">
    <h1>Login</h1>

    <label for="Roll No"><b>Roll Number</b></label>
    <input type="text" placeholder="Enter Roll Number" name="rollNo" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
    <input type="submit" class="btn" value="Login" name="log">
    <!-- <button class="btn" type="submit">Login</button> -->
  </form>

  <script>
    
  </script>
  
</body>
</html>