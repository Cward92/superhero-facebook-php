<?php 
session_start();
if($_POST['edit']){
    $conn = new mysqli('localhost', 'root', 'root', 'Heroes');
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $id = $conn->real_escape_string($_POST['edit']);

    include 'edit.php';
  
  $conn->close();
}
if($_POST['delete']){
    $conn = new mysqli('localhost', 'root', 'root', 'Heroes');
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $id = $conn->real_escape_string($_POST['delete']);
    
    // sql to delete a record
    $sql = "DELETE FROM heroes WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully"; 
        ?>
        <form action="index.php" method="post">
            <button name='user' value="" type="submit">Back to Login</button>
        </form>
    <?php
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}
if($_POST['back']){
    header('Location: profileSelect.php');
}
?>