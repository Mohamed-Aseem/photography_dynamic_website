<?php
    session_start();

    if(!isset($_SESSION["adminID"])){
        header("location:admin-login.php");
    }
    include "../dbConnection.php";

    $pid = $_GET['pid'];
    $sqlGet = "SELECT * FROM photography WHERE photography_id = {$pid}";
    $resGet = $con->query($sqlGet);

    if($resGet->num_rows>0){
        $row= $resGet->fetch_assoc();
        $oldImg = $row['image_url'];
    }
    
    $sql = "DELETE FROM photography WHERE photography_id = {$pid}";
    
    //Delete Old Image From Upload Folder
    $res = $con->query($sql);
    if($res){
        unlink('../'.$oldImg);
    }
    //Set SESSION Variable to get Success Message in admin dashboard
    $_SESSION['statusTitle'] = "Success";
    $_SESSION['statusText'] = "Image Deleted Successfully";
    $_SESSION['statusIcon'] = "success";
    
    header('Location: ../admin_dashboard.php');
?>
