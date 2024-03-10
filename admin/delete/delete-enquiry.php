<?php
    session_start();

    if(!isset($_SESSION["adminID"])){
        header("location:admin-login.php");
    }
    include "../dbConnection.php";

    //Get Enquiry ID
    $eid = $_GET['eid'];
    
    $sql = "DELETE FROM enquiry WHERE enquiry_id = {$eid}";
    
    $res = $con->query($sql);
    
    $_SESSION['statusTitle'] = "Success";
    $_SESSION['statusText'] = "Enquiry Deleted Successfully";
    $_SESSION['statusIcon'] = "success";
    
    header('Location: ../admin_dashboard.php');


?>