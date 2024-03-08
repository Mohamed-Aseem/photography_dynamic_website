<?php
session_start();

if(!isset($_SESSION["adminID"])){
    header("location:admin-login.php");
}
include "dbConnection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include "header_admin_mange.php";
    ?>
</head>
<body>
    <div class="main-content-add-picture">
        <div class="add-card">
            <div class="card-header text-center" >
                <h3>Add New Picture</h3>
            </div>
            <?php
                if(isset($_POST['submit'])){
                    $target_dir = "../upload/";
                    $target_file = $target_dir.basename($_FILES['img']['name']);
                    
                    //Check the file exists
                    if(file_exists($target_file)){
                        echo "
                            <script>
                                swal({
                                title: 'Error',
                                text: 'The File Already Exists, Please Rename The File & Upload!',
                                icon: 'error',
                                buttons: 'Ok',
                                dangerMode: true
                                });
                            </script>
                        ";
                    }
                    else if($result = move_uploaded_file($_FILES['img']['tmp_name'],$target_file)){
                        $sql = "INSERT INTO photography VALUES ('','{$target_file}','{$_POST['category']}','{$_POST['type']}')";
                        $res = $con->query($sql);
                        
                        $_SESSION['statusTitle'] = "Success";
                        $_SESSION['statusText'] = "Insert Successfully";
                        $_SESSION['statusIcon'] = "success";
                        header('Location: admin_dashboard.php');
                    }
                    else{
                        echo"<script>
                        swal({
                            title: 'Error',
                            text: 'Please Contact The IT Department',
                            icon: 'error',
                            buttons: 'Ok'
                        </script>";
                    }
                }

            ?>
            <form action= "add-picture.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Choose Image to Upload</label>
                    <input class="form-control" name="img" type="file" id="formFile">
                </div>
                <select class="form-select" name="category">
                    <option selected>Choose The Album's Category</option>
                    <option value="Wedding">Wedding</option>
                    <option value="Natural">Natural</option>
                    <option value="Commercial">Commercial</option>
                    <option value="Social Media">Social Media</option>
                    <option value="Event">Event</option>
                    <option value="Personal">Personal</option>
                </select>
                <select class="form-select" name="type">
                    <option selected>Choose The Type of Image</option>
                    <option value="wide">Wide</option>
                    <option value="tall">Tall</option>
                    <option value="big">Big</option>
                </select>
                <button type="submit" name="submit" class="btn btn-primary">Add Picture</button>
                <button class="btn btn-danger"><a href="admin_dashboard.php">Back</a></button>
            </form>
        </div>
    </div>
</body>
</html>
