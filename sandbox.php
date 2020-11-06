<?php
$conn = new mysqli('localhost', 'root', 'root', 'Heroes');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sqlid = "SELECT id From heroes";
$resultid = $conn->query($sqlid);
if($resultid->num_rows > 0) {
    while($row = $resultid->fetch_assoc()) {
        $id = $conn->real_escape_string($row['id']);
        $sql = "SELECT * 
        FROM ((abilities 
        INNER JOIN ability_hero ON abilities.id = ability_hero.ability_id) 
        INNER JOIN heroes ON heroes.id = ability_hero.hero_id) 
        WHERE heroes.id=$id";
        $result = $conn->query($sql);
        $abilities = "";
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                if($row['ability']){
                    $abilities .="<li>" . $row['name'] . " has the power: " . $row["ability"] . "</li>";
                } else {
                    echo $row.['name'] . " has no abilities"; 
                }
            } echo $abilities;
        }
    }
}

// $sql = "SELECT * 
// FROM ((abilities 
// INNER JOIN ability_hero ON abilities.id = ability_hero.ability_id) 
// INNER JOIN heroes ON heroes.id = ability_hero.hero_id) 
// WHERE heroes.id='1'";
// $result = $conn->query($sql);
// print_r($result->fetch_assoc());