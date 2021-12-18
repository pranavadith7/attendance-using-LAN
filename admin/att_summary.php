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

if (!isset($_GET['roll_no'])) {
    header('location: index.php');
}

$roll_no = $_GET['roll_no'];

$student_rows = '';
$sql_select = "SELECT * FROM student_attendance WHERE roll_no='$roll_no' ORDER BY date DESC";
$result = mysqli_query($conn, $sql_select);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  $i = 1;
  while($row = mysqli_fetch_assoc($result)) {
    //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";

    $roll_no = $row['roll_no'];
    $att_date = $row['date'];
    $formatted_date = date("d M Y", strtotime($att_date));
    $name = '';

    $sql_select2 = "SELECT * FROM students WHERE roll_no='$roll_no'";
    $result2 = mysqli_query($conn, $sql_select2);
    if (mysqli_num_rows($result2) > 0) {
        while($row2 = mysqli_fetch_assoc($result2)) {
            $name = $row2['name'];
        }
    }

    $student_rows .= "
    <tr>
        <th scope='row'>$i</th>
        <td>$name</td>
        <td>$roll_no</td>
        <td>$formatted_date</td>
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
            <a class="navbar-brand" href="#">Navbar</a>
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
                        <a class="nav-link" href="#">Admin <span class="sr-only">(current)</span></a>
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
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Roll No</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?= $student_rows ?>
                </tbody>
            </table>

            <br>

            <a href="home.php" class="btn btn-primary">Back</a>
        </div>
        <br>
    </body>
</html>
