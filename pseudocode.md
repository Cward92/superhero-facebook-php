DATA
Currently I'm working with 5 tables: (abilities, ability_hero, heroes, relationship_types, relationships)

    - ability_heroes
        - hero_id relates to -> id in heroes table
        - ability_id relates -> to id in ability table
    - relationships
        - hero1/2_id relates to -> id in heroes table
        - type_id relates to -> id in relationship_types table

    
ON LOAD:
Login Page
If new user, send to create user page



from Index.php
<?php
            if($_GET['state'] == 'profile'){
                include 'profile.php';
            } else {
                include 'heroesTable.php';
            };?>


Array ( [id] => 1 [ability] => Frost Breath [hero_id] => 1 [ability_id] => 5 [name] => Chill Man [about_me] => The coolest dude you'll ever meet. [biography] => In a freak industrial accident, Chill Man was dunked in toxic waste. After an agonizing transformation, he developed the ability to exhale sub-zero mist that freezes everything it touches. [image_url] => )

Check connection     
if ($conn->connect_error) {         
    die("Connection failed: " . $conn->connect_error);     
}     
if ($_SERVER['REQUEST_METHOD'] == 'POST') {         
    $name = $conn->real_escape_string($_POST['name']);                 
    var_dump($name);         
    $remove = "DELETE FROM heroes 
    WHERE name = '$name'";         
    echo $remove;         
    if ($conn->query($remove) === TRUE) {             
        echo 'Hero Removed';         
        } else {             
            echo 'Error: Hero Lives On';         
            }     
            }     
            ?>