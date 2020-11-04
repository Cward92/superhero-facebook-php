<?php
            $hero = "SELECT name, about_me, biography FROM Heroes WHERE id = '" . $_GET['profileid'] . "'";
            $result = $conn->query($hero);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-content center">
                                <h3><?php echo $row['name']; ?></a></h3>
                                <p><?php echo $row['biography']; ?></p>
                            </div>
                        </div>
                    </div>
            <?php }
            } else {
                echo "0 results";
            }
            ?>