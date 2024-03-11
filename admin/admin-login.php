<?php
    session_start();
    //Check Username password is correct
    if(isset($_POST['submit']))
    {   
        include "dbConnection.php";
        $aName = $_POST['username'];
        $aPassword = $_POST['password'];

        $sql = "SELECT * FROM admin WHERE username = '{$aName}' AND password = '{$aPassword}'; ";
        $res = $con->query($sql);

        if($res -> num_rows > 0){
            $row = $res -> fetch_assoc();
            $_SESSION['adminID'] = $row['admin_id'];
            echo "<script>location.replace('admin_dashboard.php')</script>";
        }
        else{
            $error = "<p class='error'>Invalid User Details!</p>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Malcolm Lismore</title>
    <link rel="stylesheet" href="../css/style_admin-login.css">
    <link rel="shortcut icon" href="../imgs/logo.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper">
        <form action="admin-login.php" method="POST">
            <h1>Login</h1>
            <!-- Display Error Message -->
            <?php
                if(isset($error)){
                    echo $error;
                }
            ?>
            <div class="input-box">
                <input type="text" placeholder= "Username" name="username" required>
                <i class='bx bxs-user' ></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder= "Password" name="password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <!-- <div class="forgot">
                <a href="password-reset.php">Forgot Password</a>
            </div> -->
            <button type="submit" name = "submit" class="btn">Login</button>
        </form>
    </div>
</body>
</html>
