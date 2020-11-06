<?php
session_start();
// Create connection
$conn = new mysqli('localhost', 'root', 'root', 'Heroes');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$id = $conn->real_escape_string($_SESSION['user']);

$sqlOrigH = "SELECT name, about_me, biography FROM heroes WHERE id='$id'";

$result = $conn->query($sqlOrigH);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) { 
            if(!($_POST['name'])) {
                $_POST['name'] = $row['name'];
            }
            if(!$_POST['about_me']) {
                $_POST['about_me'] = $row['about_me'];
            }
            if(!$_POST['biography']) {
                $_POST['biography'] = $row['biography'];
            }
        }
    }
$id = $conn->real_escape_string($_SESSION['user']);
$ability = $conn->real_escape_string($_POST['ability']);
$name = $conn->real_escape_string($_POST['name']);
$about_me = $conn->real_escape_string($_POST['about_me']);
$biography = $conn->real_escape_string($_POST['biography']);

$sql = "UPDATE heroes SET name='$name', about_me='$about_me', biography='$biography' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
  echo "Hero Info updated successfully<br>";
} else {
  echo "Error updating record: " . $conn->error;
}

// $sqlATable = "SELECT ability_id FROM ability_hero WHERE hero_id='$id'";
$sqlAbility = "UPDATE ability_hero SET hero_id='$id', ability_id='$ability' WHERE hero_id='$id'";

if ($conn->query($sqlAbility) === TRUE) {
    echo "Ability I updated successfully";
    header('Location: profileSelect.php');
  } else {
    echo "Error updating record: " . $conn->error;
  }

$conn->close();
