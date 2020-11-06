<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php
    $conn = new mysqli('localhost', 'root', 'root', 'Heroes');
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $conn->real_escape_string($_POST['id']);


    // $sql = "SELECT * FROM ((abilities 
    // INNER JOIN ability_hero ON abilities.id = ability_hero.ability_id) 
    // INNER JOIN heroes ON heroes.id = ability_hero.hero_id) 
    // WHERE heroes.id=$id";
    $sql = "SELECT * FROM heroes WHERE id = $id";
    $result = $conn->query($sql);
    // $conn->close();
    // echo $_SESSION['user'];
    //    print_r($result->fetch_assoc());
    // output data of each row
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) { ?>
            <div class="container">
                <div class="row mt-4">
                    <div class="col-5">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="..." alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-text"><?php echo $row['name'] ?></h4>
                                <form action="functions.php" method="post">
                                    <?php if (trim($_POST['id']) === trim($_SESSION['user'])) { ?>
                                        <button class='btn btn-primary' type="submit" name="edit" value="<?php echo $_POST['id'] ?>">Edit</button>
                                        <button class='btn btn-danger' type="submit" name="delete" value="<?php echo $_POST['id'] ?>">Delete</button>
                                        <?php } ?>
                                        <button class='btn btn-success' type="submit" name="back" value="<?php echo $_POST['id'] ?>">Back</button>
                                    </form>
                            </div>
                        </div>
                    </div>
                    <div class='col-6'>
                        <div class="card">
                            <h5 class="card-header">Info</h5>
                            <div class="card-body">
                                <h5 class="card-title">About Me:</h5>
                                <p class="card-text"><?php echo $row['about_me'] ?></p>
                                <hr>
                                <h5 class="card-title">Biography:</h5>
                                <p class="card-text"><?php echo $row['biography'] ?></p>
                                <hr>
                                <h5 class="card-title">Abilities:</h5>
                                <?php
                                $ability = "SELECT ability FROM ((abilities 
        INNER JOIN ability_hero ON abilities.id = ability_hero.ability_id) 
        INNER JOIN heroes ON heroes.id = ability_hero.hero_id) 
        WHERE heroes.id=$id";
                                $aResult = $conn->query($ability);
                                if ($aResult->num_rows > 0) {
                                    while ($row = $aResult->fetch_assoc()) { ?>

                                        <p class="card-text"><?php echo $row['ability'] ?></p>
                                <?php
                                    }
                                }

                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
    }
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>

<!-- $heroes = "SELECT id, name FROM heroes";
$result = $conn->query($heroes);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { ?>
        <div class="col-3">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="..." alt="Card image cap">
                <div class="card-body">
                    <p class="card-text"></p>
                </div>
            </div>
            <div class="card">
                <h5 class="card-header">Featured</h5>
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div> -->

<!-- echo $_POST['id'];
echo $_SESSION['user']; -->