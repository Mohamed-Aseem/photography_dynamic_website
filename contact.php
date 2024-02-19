<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include "header.php";
    ?>
</head>
<body>
    <nav>
        <?php
            include "nav.php";
        ?>
    </nav>

    <div class="container contact_container">
        <h2>Contact Me</h2>
        <div class="contact_details">
            <div class="contact_left">
                <div class="contact_image">
                    <img src="imgs/contact_2.png" alt="Contact Me">
                </div>
                <ul class="contact_list">
                    <li><a href="mailto:ima7str@gmail.com" class="contact_list-item" target="_blank">
                        <i class="uil uil-envelope"></i></a>
                    </li>
                    <li><a href="https://whatsapp.com/" class="contact_list-item" target="_blank">
                        <i class="uil uil-whatsapp"></i></a>
                    </li>
                    <li><a href="tel:+94777777777" class="contact_list-item" target="_blank">
                        <i class="uil uil-mobile-android"></i></a>
                    </li>
                </ul>
            </div>
            <div class="contact_right">
                <p>Fill out the form and list the details of what you are looking for specifically in your photoshoot, and I will be in touch with you to finalize the details!</p>
                <form action="https://formsubmit.co/7a67bcb11677bd7b5e048a65f382448f" class="contact_form" method="post">
                    <input type="text" name="Name" placeholder="Full Name" onclick="myFunction()">
                    <input type="email" name="Email" placeholder="Email Address" onclick="myFunction()">
                    <input type="text" name="contact_no" placeholder="Contact No" onclick="myFunction()">
                    <input type="text" name="date" placeholder="Date" onclick="myFunction()">
                    <input type="text" name="location" placeholder="Location" onclick="myFunction()">
                    <textarea rows="7" name="Message" placeholder="Message" onclick="myFunction()"></textarea>
                    <button type="submit" class="primary_btn contact_btn">Send</button>
                </form>
            </div>
        </div>
        
        


    </div>
    <div class="container footer_copy-right">
        <p>2023 Malcolm Lismore &copy; All Rights Reserved.</p>
    </div>

    <script src="js/main.js"></script>
</body>
</html>