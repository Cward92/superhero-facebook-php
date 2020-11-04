<?php
// get current user name
$processUser = posix_getpwuid(posix_geteuid());
?> 
<div><?php echo $processUser['name']; ?></div>

<?php
// change user name
$processUser['name'] = 'chillman';
?> 
<div><?php echo $processUser['name']; ?></div>

<?php
$heroes = "SELECT id, name, about_me, biography FROM heroes";
$result = $conn->query($heroes);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {?>
            <div class="col-6">
                <div class="card">
                    <div class="card-content center">
                        <h3><a href="index.php?state=profile&profileid=<?php echo $row['id'];?>"><?php echo $row['name']; ?></a></h3>
                        <p><?php echo $row['biography']; ?></p>
                    </div>
                </div>
            </div>

        <?php }
    } else {
        echo "0 results";
    }
?>