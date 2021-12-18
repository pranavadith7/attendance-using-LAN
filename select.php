<!DOCTYPE html>
<html>
<body>

<?php

// Create connection
//$conn = mysqli_connect('localhost', 'root', '','leave');
include_once('connection.php');
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT rollno, leavetype, l_from, l_to, reason FROM apply";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "Roll No: " . $row["rollno"]. " - Leave Type: - " . $row["leavetype"]. " - From - " . $row["l_from"]. " - To - ". $row["l_to"]. " - Reason - " . $row["reason"]. "<br>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>

</body>
</html>