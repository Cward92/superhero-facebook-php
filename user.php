<?php
echo 'Successfully created a your profile!<br>Click on the button to continue!';
$id = $_GET['lastid'];
// $conn = new mysqli('localhost', 'root', 'root', 'Heroes');
// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// $newid = "SELECT LAST_INSERT_ID() AS id;";
// $result = $conn->query($newid);
// $conn->close();
// $row = $result->fetch_assoc();
?>
<form action="profileSelect.php" method="post">
    <button name='user' value="<?php echo $id; ?>" type="submit">Continue</button>
</form>