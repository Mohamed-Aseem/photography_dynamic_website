<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include "header_gallery.php";
    ?>
</head>
<body>
    <nav>
        <?php
            include "nav_gallery.php";
        ?>
    </nav>

    <div class="container wild_life_container">
        <h3 class="album_title">Weddings</h3>
        <div class="grid-wrapper">
            
            <?php
                
                include "../admin/dbConnection.php";
                
                $sql = "SELECT * FROM `photography` WHERE album = 'Wedding';";
                $res = $con->query($sql);

                if($res->num_rows>0){

                    while($row= $res->fetch_assoc()){
                        $classType = $row['type'];

                        echo "  
                            <div class='{$classType}'>
                                <img src='{$row['image_url']}'>
                            </div> 
                        ";
                    }

                }
                else{
                    echo"   <div class='alert_message error'>
                                <p>No Images Available In Database</p>
                            </div>";
                }

            ?>

        </div>
    </div>


    <script src="../js/main.js"></script>
</body>
</html>