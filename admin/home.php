<?php
session_start();
include_once 'connection.php';

if (isset($_POST['logout'])) {
    if (isset($_SESSION['rollNo'])) {
        session_destroy();
        header('location: index.php');
    }
}

if (!isset($_SESSION['rollNo'])) {
    header('location: index.php');
}

if (isset($_POST['student_form'])) {
    $name = htmlentities($_POST['name']);
    $roll_no = htmlentities($_POST['rollNo']);
    $password = htmlentities($_POST['password']);
    $password2 = htmlentities($_POST['password2']);
    $pass_hash = md5($password);

    if (strcmp($password, $password2)) {
        echo "<script>alert('Passwords do not match');window.location.href='home.php'</script>";
    }

    $sql_select2 = "SELECT * FROM students WHERE roll_no='$roll_no'";
    $result2 = mysqli_query($conn, $sql_select2);
    if (mysqli_num_rows($result2) > 0) {
        echo "<script>alert('Roll No already exists');window.location.href='home.php'</script>";
    } else {
        $sql_insert = "INSERT INTO students(name, roll_no, password) VALUES ('$name', '$roll_no', '$pass_hash')";
        if (mysqli_query($conn, $sql_insert)) {
            echo "<script>alert('Sucessfully added student');window.location.href='home.php'</script>";
        } else {
            echo "<script>alert('Something went wrong');window.location.href='home.php'</script>";
        }
    }
}

$student_rows = '';
$sql_select = "SELECT * FROM students ORDER BY roll_no";
$result = mysqli_query($conn, $sql_select);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  $i = 1;
  while($row = mysqli_fetch_assoc($result)) {
    //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    $name = $row['name'];
    $roll_no = $row['roll_no'];

    $student_rows .= "
    <tr>
        <th scope='row'>$i</th>
        <td>$name</td>
        <td>$roll_no</td>
        <td><a href='att_summary.php?roll_no=$roll_no'>View Attendance</a></td>
    </tr>
    ";
    $i += 1;
  }
}


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Admin Home</title>

        <!--Bootsrap 4 CDN-->
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

        <!--Fontawesome CDN-->
    	<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="home.php">Attendance LAN</a>
            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="home.php">Admin <span class="sr-only">(current)</span></a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false"> Dropdown </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li> -->
                </ul>
                <form class="form-inline my-2 my-lg-0" method="post">
                    <button class="btn btn-success my-2 my-sm-0" type="submit" name="logout">Logout</button>
                </form>
            </div>
        </nav>

        <br>

        <div class="container">
            <div class="card card-body bg-dark" style="width: 50rem; margin: 0 auto; color: white;">
                <h5 class="card-header bg-warning" style="color: black">Add new student</h5>
                <form action="home.php" method="POST">
                    <div class="form-group">
                        <label for="studentName">Name</label>
                        <input type="text" name="name" value="" id="studentName" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="rollNo">Roll No</label>
                        <input type="text" name="rollNo" value="" id="rollNo" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" value="" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" name="password2" value="" id="confirm_password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary" name="student_form">Submit</button>
                </form>
            </div>

            <br>

            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Roll No</th>
                        <th scope="col">View Attendance</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr> -->
                    <?= $student_rows ?>
                </tbody>
            </table>
        </div>
        <br>
    </body>
</html>
