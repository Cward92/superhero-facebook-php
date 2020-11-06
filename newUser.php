<?php 
session_start();
function newUser(){
    // Create connection
    $conn = new mysqli('localhost', 'root', 'root', 'Heroes');
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $name = $conn->real_escape_string($_POST['name']);
    $about_me = $conn->real_escape_string($_POST['about_me']);
    $biography = $conn->real_escape_string($_POST['biography']);

    $sql = "INSERT INTO heroes (name, about_me, biography) VALUES ('$name', '$about_me', '$biography')";

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        $_SESSION['user'] = $last_id;
        header('Location: user.php?lastid='.$last_id);
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
      
      $conn->close();
}
newUser();
?>