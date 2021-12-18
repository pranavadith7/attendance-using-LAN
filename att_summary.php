<?php
session_start();
if(!isset($_SESSION['rollNo'])) {
  header('location: Login.php');
}
// Connection
//$conn= mysqli_connect('localhost', 'root', '','leave');
include_once('connection.php');

$attendance_row = '';

$roll_no = $_SESSION['rollNo'];
$name = $_SESSION['name'];

$sql_select = "SELECT * FROM `student_attendance` WHERE roll_no='$roll_no' ORDER BY date DESC";

$result = mysqli_query($conn, $sql_select);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    $date = $row["date"];
    $formatted_date = date("d M Y", strtotime($date));
    $attendance_row .= "<tr>
    <td>$roll_no</td>
    <td>$name</td>
    <td>$formatted_date</td>
    </tr>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            background: url("logo.jpg");
            /* background-position: center; */
            background-repeat: no-repeat;
            background-size: 100% 300%;
        }
        body::before {
            opacity: 0.5;
        }
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
            color: black;
        }

        .main-content {
            margin: 0 auto;
            width: 50rem;
        }
        .main-content table {
            color: white;
            background-color: black;
        }
    </style>
</head>

<body>
    <div class="main-content">
        <h2 align="center">Attendance Summary</h2>
        <table>
            <tr>
                <th>Roll No</th>
                <th>Name</th>
                <th>Attendance Date</th>
            </tr>
            <?= $attendance_row ?>
        </table>
    </div>
</body>
</html>