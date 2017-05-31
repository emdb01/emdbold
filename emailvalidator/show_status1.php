<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
    border-spacing: 0;
    border-collapse: collapse; 
}
</style>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "emailvalid";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 

echo "0 = invalidemail; 1 = validemail;<br>";

$sql = "SELECT * FROM emails";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $rowcount=mysqli_num_rows($result);
    printf("Result set has %d rows.\n",$rowcount);
    echo "<table><tr><th>Email</th><th>Status</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["email"]. "</td><td>" . $row["status"]. "</td></tr>";
    }
    echo "</table>";
} else {
     echo "0 results";
}

$conn->close();
?>  

</body>
</html>