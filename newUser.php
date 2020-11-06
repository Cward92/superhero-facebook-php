<?php
session_start();
function newUser()
{
    // Create connection
    $conn = new mysqli('localhost', 'root', 'root', 'Heroes');
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $name = $conn->real_escape_string($_POST['name']);
    $about_me = $conn->real_escape_string($_POST['about_me']);
    $biography = $conn->real_escape_string($_POST['biography']);
    $ability = $conn->real_escape_string($_POST['ability']);

    $sql = "INSERT INTO heroes (name, about_me, biography) VALUES ('$name', '$about_me', '$biography')";

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        $_SESSION['user'] = $last_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "INSERT INTO ability_hero (hero_id, ability_id) VALUES ('$last_id', '$ability')";
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
function uploads()
{
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            header('Location: user.php');
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $conn = new mysqli('localhost', 'root', 'root', 'Heroes');
            $last_id = $conn->insert_id;
            $file = $conn->real_escape_string((basename($_FILES['fileToUpload']['name'])));// this doesn't work, returns NULL
            $sql = "INSERT INTO heroes (image_url) VALUES ('uploads/$file') WHERE id=$last_id";
            $conn->query($sql);
            $conn->close();
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded."; // it doesn't
            header('Location: user.php');
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
newUser();
uploads();
?>