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
      <div class="container">
        <div class="row">
            <div><p>Edit Your Info (leave blank or similar to leave info unchanged)</p></div>
            <form action='update.php' method="post">
                Name: <input type="text" maxLength="50" name="name"><br>
                About Me: <textarea type="text" maxLength="250" name="about_me" cols="50"></textarea><br>
                Biography: <textarea type="text" name="biography" rows="5" cols="50"></textarea><br>
                Superpower: <select name="ability">
        <?php
        $abilities = "SELECT * FROM abilities";
        $result = $conn->query($abilities);
        $conn->close();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>
                <option value="<?php echo $row['id'] ?>"><?php echo $row['ability'] ?></option>
                <?php
            }
        }
        ?>
    </select>
    <input type="submit">
</form>
</div>
</div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
