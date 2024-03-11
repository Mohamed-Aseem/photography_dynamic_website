<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conformation</title>
    <!--------------------------------------- Alert Box CDN --------------------------------------->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- GOOGLE FONT (Montserrat) -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Monstserrat', sans-serif;
        }
    </style>
</head>
<body>
    <?php
        include "dbConnection_customer.php"; 
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $contact = $_POST['contact_no'];
            $location = $_POST['location'];
            $message = $_POST['message'];

            $sql = "INSERT INTO enquiry VALUES('','{$name}','{$email}',NOW(),'{$location}','{$message}');";
            $res = $con->query($sql);
            if($res>0){
                echo "
                    <script>
                        swal({
                        title: 'Success',
                        text: 'Your Enquiry Sent Successfully. Please Be Patient for the Response!',
                        icon: 'success',
                        buttons: 'Ok'
                        })
                        .then((goMain) => {
                        if (goMain) {
                            location.replace('contact.php');
                        }
                        });
                    </script>
                ";
            }
        }


    ?>
</body>
</html>

