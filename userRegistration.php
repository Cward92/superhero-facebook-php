<?php
session_start();
$user = $_POST['user'];
if (!$user) {
    // Create connection
    $conn = new mysqli('localhost', 'root', 'root', 'Heroes');
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo 'NEW USER REGISTRATION:';
    $abilities = "SELECT * FROM abilities";
    $result = $conn->query($abilities);
    $conn->close();

?>
    <form autocomplete="off" action='newUser.php' method="post" enctype="multipart/form-data">
        Name: <input type="text" maxLength="50" name="name"><br>
        About Me: <textarea type="text" maxLength="250" name="about_me" cols="50"></textarea><br>
        Biography: <textarea type="text" name="biography" rows="5" cols="50"></textarea><br>
        Superpower: <select name="ability">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['ability'] ?></option>
            <?php
                }
            }
            ?>
        </select>
        Select image to upload for profile:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Submit All Info" name="submit">
    </form>
<?php
} else {
    $_SESSION['user'] = $_POST['user'];
    header('Location: profileSelect.php');
}
?>