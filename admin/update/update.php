<?php

    session_start();

    if(!isset($_SESSION["adminID"])){
        header("location:admin-login.php");
    }

    include "../dbConnection.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include "header_admin_update.php";
    ?>
</head>
<body>
    <div class="main-content-add-picture">
        <div class="add-card">
            <div class="card-header text-center" >
                <h3>Update Picture</h3>
            </div>


            <!-- Update Data -->

            <?php

                if(isset($_POST['pid'])){
                    //Update New Data
                    $pid = $_POST['pid'];
                    $album = $_POST['category'];
                    $type = $_POST['type'];
                    $target_dir = "../../upload/";
                    $target_file_new = $target_dir.basename($_FILES['img']['name']);

                    $sql = "SELECT * FROM photography WHERE photography_id = {$pid}";
                    $res = $con->query($sql);

                    if($res->num_rows>0){
                        $row = $res->fetch_assoc();
                        $oldImage_url = $row['image_url'];
                    }

                    if($_FILES['img']['name'] == ''){
                        $target_file_new = $oldImage_url;
                    }else{
                        if(file_exists($target_file_new)){
                            echo "
                                <script>
                                    swal({
                                    title: 'Error',
                                    text: 'The File Already Exists, Please Rename The File & Upload!',
                                    icon: 'error',
                                    buttons: 'Ok',
                                    dangerMode: true
                                    })
                                    .then((willLogout) => {
                                        if (willLogout) {
                                            location.replace('../admin_dashboard.php');
                                        }
                                        });
                                </script>
                            ";

                        }else{
                            unlink($oldImage_url);
                        }

                    }

                    $sql = "UPDATE photography SET image_url = '{$target_file_new}', album = '{$album}' ,type = '{$type}'  WHERE photography_id = {$pid}";

                    if($_FILES['img']['name'] == ''){
                        $res = $con->query($sql);
                        $_SESSION['statusTitle'] = "Success";
                        $_SESSION['statusText'] = "Updated Successfully With Existing Image";
                        $_SESSION['statusIcon'] = "success";
                        header('Location: ../admin_dashboard.php');
                    }
                    else{
                        if(move_uploaded_file($_FILES['img']['tmp_name'],$target_file_new)){
                            $res = $con->query($sql);
                            $_SESSION['statusTitle'] = "Success";
                            $_SESSION['statusText'] = "Updated Successfully With New Image";
                            $_SESSION['statusIcon'] = "success";
                            header('Location: ../admin_dashboard.php');
                        }
                    }

                }else{

                    //Set old data to text boxes

                    $pid = $_GET['pid'];
                    $sql = "SELECT * FROM photography WHERE photography_id = {$pid}";
                    $res = $con->query($sql);

                    if($res->num_rows>0){
                        $row = $res->fetch_assoc();
                        $oldAlbum = $row['album'];
                        $oldType = $row['type'];
                        $oldImage_url = $row['image_url'];

                    }
                }
            ?>

            <form id="updateForm" action="update.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Choose Image to Upload</label>
                    <input class="form-control" name="img" type="file" id="formFile">
                    <label>View Old Image : <a href="<?php echo "../{$oldImage_url}"?>" target="_blank"><?php echo basename($oldImage_url)?></a></label>
                </div>
                <label>Album Type :</label>
                <select class="form-select" name="category">
                    <?php
                        $options = array('Wild Life','Landscape','Coastal Birds','Wedding','Portrait','Special Event','Maternity');

                        foreach($options as $option){
                            if($option == $oldAlbum){
                                echo "<option selected value = $oldAlbum >$oldAlbum</option>";
                            }else{
                                echo "<option value=$option >$option</option>";
                            }
                        }
                    ?>
                </select>
                <label>Picture Type :</label>
                <select class="form-select" name="type">
                    <?php
                        $options = array('wide','tall','big');

                        foreach($options as $option){
                            $upperCaseWord = ucfirst($option);
                            if($option == $oldType){
                                echo "<option selected value = $oldType >$upperCaseWord</option>";
                            }else{

                                echo "<option value=$option >$upperCaseWord</option>";
                            }
                        }
                    ?>
                </select>
                <input type="hidden" name ="pid" value = "<?php echo $pid ?>">
                <button id="updateBtn" class="btn btn-primary">Update Picture</button>
                <button class="btn btn-danger"><a href="../admin_dashboard.php">Back</a></button>
            </form>
        </div>
    </div>
    <script>

        const btn = document.getElementById("updateBtn");
        btn.addEventListener("click", (e)=>{
            e.preventDefault();
            swal({
            title: "Update Conformation",
            text: "Do you want to Update?",
            icon: "info",
            buttons: ['No','Yes']
            })
            .then((willInsert) => {
            if (willInsert) {
                const form = document.getElementById("updateForm");
                form.submit();
            }
            });
        });


    </script>
</body>
</html>