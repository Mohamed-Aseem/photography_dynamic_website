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
        include "header_admin.php";
    ?>
</head>
<body class="admin_dashboard-body">
    <div class="side-bar">
        <!-- header Section -->
        <header>
            <div>
                <img src="../imgs/profile.png" alt="Malcolm Lismore">
            </div>
            <h1>Malcolm Lismore</h1>
        </header>

        <div class="menu">
            <div class="menu-btn btn1 item active_btn" onclick="myFunction('btn1', 'div1')"><a><i class="fas fa-desktop"></i><span>Dashboard</span></a></div>

            <div class="item"><a class="sub-btn"><i class="fa-solid fa-image"></i><span>Albums</span>
                <!-- Dropdown -->
                <!-- Dropdown Arrow -->
                <i class="fas fa-angle-right dropdown"></i>
                </a>
                <!-- dropdown-sub-items -->
                <div class="sub-menu">
                    <a href="add-picture.php" class="sub-item">Add Picture</a>
                    <a class="menu-btn btn2 sub-item" onclick="myFunction('btn2', 'div2')">Manage Picture</a>
                </div>
            </div>

            <div class="menu-btn btn3 item" onclick="myFunction('btn3', 'div3')">
                <a>
                    <i class="fa-solid fa-envelope-open-text"></i>
                    <span>Enquiry</span>
                </a>
            </div>

            <div class="menu-btn item logout">
                <a>
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>

    </div>


    <div class="content-div div1 active_menu">

        <!---------------------------- Admin Dashboard ----------------------------->
        <div class="header-wrapper" data-aos="fade-in" data-aos-delay="150">
            <h2>Dashboard</h2>
            <div class="date">
            <h3>Date : <span class='currentDate'></span></h3>
            <h3>Time : <span class='currentTime'></span></h3>
            </div>
        </div>

        <?php
            //Function for retrieve data from database
            function getCountFromDatabase($sql){
                include "dbConnection.php";
                $res = $con->query($sql);
                return $res->num_rows;
            }

            //Count of Wedding Posts
            $sqlForWedding = "SELECT * FROM photography WHERE album = 'Wedding';";
            $countOfWedding = getCountFromDatabase($sqlForWedding);


            //Count of Portraits Posts
            $sqlForPortraits = "SELECT * FROM photography WHERE album = 'Portrait';";
            $countOfPort = getCountFromDatabase($sqlForPortraits);

            //Count of Special Event Posts
            $sqlForSpecial = "SELECT * FROM photography WHERE album = 'Special Event';";
            $countOfSpecial = getCountFromDatabase($sqlForSpecial);

             //Count of Maternity Posts
             $sqlForMaternity = "SELECT * FROM photography WHERE album = 'Maternity';";
             $countOfMaternity = getCountFromDatabase($sqlForMaternity);

        ?>
        <div class="card_container" data-aos="fade-in" data-aos-delay="300">
            <h3 class="main-title">Total Posts</h3>
            <div class="card-wrapper">
                <div class="post-card light-red">
                    <div class="box">
                        <h2><?php echo "{$countOfWedding}"; ?></h2>
                        <h3>Wedding</h3>
                    </div>
                    <div class="icon-case">
                        <img src="../imgs/icon_W_1.png" alt="Wedding">
                    </div>
                </div>

                <div class="post-card light-purple">
                    <div class="box">
                        <h2><?php echo "{$countOfPort}"; ?></h2>
                        <h3>Portraits</h3>
                    </div>
                    <div class="icon-case">
                        <img src="../imgs/icon_W_3.png" alt="Portraits">
                    </div>
                </div>

                <div class="post-card light-green">
                    <div class="box">
                        <h2><?php echo "{$countOfSpecial}"; ?></h2>
                        <h3>Special Event</h3>
                    </div>
                    <div class="icon-case">
                        <img src="../imgs/icon_W_4.png" alt="Special Event">
                    </div>
                </div>

                <div class="post-card light-blue">
                    <div class="box">
                        <h2><?php echo "{$countOfMaternity}"; ?></h2>
                        <h3>Maternity</h3>
                    </div>
                    <div class="icon-case">
                        <img src="../imgs/icon_W_5.png" alt="Maternity">
                    </div>
                </div>

            </div>
        </div>

        <!------------------------------------- Chart ----------------------------------------->

        <?php
            //Function for get data from enquiry table
            function getData($sql, $count){
                include "dbConnection.php";
                $res = $con->query($sql);

                if($res->num_rows>0){
                    while($row = $res->fetch_assoc()){
                        $rowsCount = $res->num_rows;
                        $rowsDate = $row['date'];
                        $result = [$rowsCount, $rowsDate];
                        return $result;

                    }
                }else if($count == 1){
                    $rowsCount = 0;
                    $sql1 = "SELECT CURRENT_DATE() AS DATE;";
                    $res = $con->query($sql1);

                    while($row = $res->fetch_assoc()){
                        $rowsDate = $row['DATE'];
                        $result = [$rowsCount, $rowsDate];
                        return $result;

                    }
                    return $rowsCount;

                }else if($count == 2){
                    $rowsCount = 0;
                    $sql1 = "SELECT DATE_SUB(CURRENT_DATE(), INTERVAL 1 DAY) AS DATE;";
                    $res = $con->query($sql1);

                    while($row = $res->fetch_assoc()){
                        $rowsDate = $row['DATE'];
                        $result = [$rowsCount, $rowsDate];
                        return $result;

                    }
                    return $rowsCount;

                }else if($count == 3){
                    $rowsCount = 0;
                    $sql1 = "SELECT DATE_SUB(CURRENT_DATE(), INTERVAL 2 DAY) AS DATE;";
                    $res = $con->query($sql1);

                    while($row = $res->fetch_assoc()){
                        $rowsDate = $row['DATE'];
                        $result = [$rowsCount, $rowsDate];
                        return $result;

                    }
                    return $rowsCount;

                }else if($count == 4){
                    $rowsCount = 0;
                    $sql1 = "SELECT DATE_SUB(CURRENT_DATE(), INTERVAL 3 DAY) AS DATE;";
                    $res = $con->query($sql1);

                    while($row = $res->fetch_assoc()){
                        $rowsDate = $row['DATE'];
                        $result = [$rowsCount, $rowsDate];
                        return $result;

                    }
                    return $rowsCount;

                }else if($count == 5){
                    $rowsCount = 0;
                    $sql1 = "SELECT DATE_SUB(CURRENT_DATE(), INTERVAL 4 DAY) AS DATE;";
                    $res = $con->query($sql1);

                    while($row = $res->fetch_assoc()){
                        $rowsDate = $row['DATE'];
                        $result = [$rowsCount, $rowsDate];
                        return $result;

                    }
                    return $rowsCount;

                }

            }
            //End getDate Function


            //Get data for today
            $sqlToday = "SELECT date FROM enquiry WHERE date = CURRENT_DATE();";
            $resultToday = getData($sqlToday,1);

            //Get data for Today - 1
            $sqlTodayMinus1 = "SELECT date FROM enquiry WHERE date < CURRENT_DATE() AND date >= DATE_SUB(CURRENT_DATE(), INTERVAL 1 DAY);";
            $resultTodayMinus1 = getData($sqlTodayMinus1,2);

            //Get data for Today - 2
            $sqlTodayMinus2 = "SELECT date FROM enquiry WHERE date < DATE_SUB(CURRENT_DATE(), INTERVAL 1 DAY) AND date >= DATE_SUB(CURRENT_DATE(), INTERVAL 2 DAY);";
            $resultTodayMinus2 = getData($sqlTodayMinus2,3);

            //Get data for Today - 3
            $sqlTodayMinus3 = "SELECT date FROM enquiry WHERE date < DATE_SUB(CURRENT_DATE(), INTERVAL 2 DAY) AND date >= DATE_SUB(CURRENT_DATE(), INTERVAL 3 DAY);";
            $resultTodayMinus3 = getData($sqlTodayMinus3,4);

            //Get data for Today - 4
            $sqlTodayMinus4 = "SELECT date FROM enquiry WHERE date < DATE_SUB(CURRENT_DATE(), INTERVAL 3 DAY) AND date >= DATE_SUB(CURRENT_DATE(), INTERVAL 4 DAY);";
            $resultTodayMinus4 = getData($sqlTodayMinus4,5);

            $dataPoints = array(
                array("y" => $resultTodayMinus4[0], "label" => $resultTodayMinus4[1] ),
                array("y" => $resultTodayMinus3[0], "label" => $resultTodayMinus3[1] ),
                array("y" => $resultTodayMinus2[0], "label" => $resultTodayMinus2[1] ),
                array("y" => $resultTodayMinus1[0], "label" => $resultTodayMinus1[1] ),
                array("y" => $resultToday[0], "label" => "Today")
            );

        ?>

        <div class="charts" data-aos="fade-in" data-aos-delay="300">
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        </div>

    </div>

    <!------------------------------------------- Albums ---------------------------------------->

    <div class="content-div div2" >
        <div class="header-wrapper" data-aos="fade-in">
            <h2>Albums</h2>
            <div class="date">
            <h3>Date : <span class='currentDate'></span></h3>
            <h3>Time : <span class='currentTime'></span></h3>
            </div>
        </div>

        <div class="card_container">
            <div class="container">
                <div class="row justify-content-center">
                    <div class = "col-md-12">
                        <div class = "card">
                            <div class = "card-body">
                                <a href="add-picture.php" class = "btn btn-md btn-outline-success">Add New Picture</a>
                                <br/><br/>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Album</th>
                                            <th>Type</th>
                                            <th>Update</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        //View All Data in Photography Dashboard
                                        $sql = "SELECT * FROM photography";
                                        $res = $con->query($sql);

                                        if($res->num_rows>0){
                                            $i = 0;

                                            while($row= $res->fetch_assoc()){
                                                $i++;
                                                $type = ucfirst($row["type"]);
                                                echo "  
                                                    <tr>
                                                        <td>{$i}</td>
                                                        <td><a href='{$row["image_url"]}' target='_blank' class='atag'>View</a></td>
                                                        <td>{$row["album"]}</td>
                                                        <td>{$type}</td>
                                                        <td><a href='update/update.php?pid={$row['photography_id']}' class='btn btn-success' name='update'>Update</a></td>
                                                        <td class = 'myBtn'><a class='btn btn-danger deleteBtn-img' data-value='{$row['photography_id']}'>Delete</a></td>
                                                    </tr>
                                                ";
                                            }
                                                echo "
                                                        </tbody>
                                                    </table>
                                                </div>
                                            ";
                                        }
                                        else{
                                            echo"   <div class='alert_message error'>
                                                        <p>No Images Available In Database</p>
                                                    </div>
                                                    </tbody>
                                                </table>
                                            </div>";
                                        }
                                        echo "
                                            <script>
                                                let btn = document.querySelectorAll('.deleteBtn-img');
                                                for (let i = 0; i < btn.length; i++){
                                                    const item = btn[i];
                                                    let valueOfBtn = item.dataset.value;
                                                    item.addEventListener('click', handleClick);
                                                }

                                                function handleClick() {
                                                    const item = this;
                                                    let valueOfBtn = item.dataset.value;
                                                    swal({
                                                        title: 'Delete Conformation',
                                                        text: 'Do you want to Delete?',
                                                        icon: 'warning',
                                                        buttons: ['No','Yes'],
                                                        dangerMode: true,
                                                    })
                                                    .then((willLogout) => {
                                                        if (willLogout) {
                                                            item.href = 'delete/delete-photography.php?pid='+valueOfBtn;
                                                            item.removeEventListener('click', handleClick);
                                                            item.click();
                                                        }
                                                    });
                                                }
                                            </script>";
                                    ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!------------------------------------------ Enquiry ----------------------------------->

    <div class="content-div div3" >
        <div class="header-wrapper" data-aos="fade-in">
            <h2>Enquiries</h2>
            <div class="date">
            <h3>Date : <span class='currentDate'></span></h3>
            <h3>Time : <span class='currentTime'></span></h3>
            </div>
        </div>

        <div class="card_container">
            <div class="row justify-content-center">
                <div class = "col-md-12">
                    <div class = "card">
                        <div class = "card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Location</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT * FROM enquiry ORDER BY date DESC;";
                                        $res = $con->query($sql);
                                        if($res->num_rows>0){
                                            $i = 0;
                                            while($row= $res->fetch_assoc()){
                                                $i++;
                                                echo "
                                                    <tr>
                                                        <td>{$i}</td>
                                                        <td>{$row['customer_name']}</td>
                                                        <td>{$row['email']}</td>
                                                        <td>{$row['location']}</td>
                                                        <td>{$row['message']}</td>
                                                        <td>{$row['date']}</td>
                                                        <td><a class='btn btn-danger deleteBtn-Enq' data-value='{$row['enquiry_id']}'>Delete</a></td>
                                                    </tr>
                                                ";
                                            }

                                            echo "
                                                    </tbody>
                                                </table>
                                            </div>
                                            ";

                                        }else{
                                            echo"   <div class='alert_message error'>
                                                        <p>No Enquiries Available In Database</p>
                                                    </div>
                                                    </tbody>
                                                </table>
                                            </div>";
                                        }

                                        echo "
                                            <script>
                                                let btnEnq = document.querySelectorAll('.deleteBtn-Enq');
                                                for (let i = 0; i < btnEnq.length; i++){
                                                    const item = btnEnq[i];
                                                    let valueOfBtn = item.dataset.value;
                                                    item.addEventListener('click', handleClick);
                                                }

                                                function handleClick() {
                                                    const item = this;
                                                    let valueOfBtn = item.dataset.value;
                                                    swal({
                                                        title: 'Delete Conformation',
                                                        text: 'Do you want to Delete?',
                                                        icon: 'warning',
                                                        buttons: ['No','Yes'],
                                                        dangerMode: true,
                                                    })
                                                    .then((willDelete) => {
                                                        if (willDelete) {
                                                            item.href = 'delete/delete-enquiry.php?eid='+valueOfBtn;
                                                            item.removeEventListener('click', handleClick);
                                                            item.click();
                                                        }
                                                    });
                                                }
                                            </script>";
                                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-------------------------- Alert Message Configuration ------------------------------------->
    <?php
        // 1.Alert Message wiht Ok Button
        if(isset($_SESSION['statusTitle']) && $_SESSION['statusTitle'] !== ''){
            echo "
                <script>
                    swal({
                    title: '{$_SESSION['statusTitle']}',
                    text: '{$_SESSION['statusText']}',
                    icon: '{$_SESSION['statusIcon']}',
                    buttons: 'Ok'
                    });
                </script>
            ";

            unset($_SESSION['statusTitle']);
            unset($_SESSION['statusText']);
            unset($_SESSION['statusIcon']);
        }
    ?>

    <script>
        // Scripts for chart
        window.onload = function() {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2",
                title:{
                    text: "Past 5 Days Enquiry Details"
                },
                axisY: {
                    title: "Total Counts"
                },
                data: [{
                    type: "column",
                    yValueFormatString: "#,##0.## Enquiries",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();
            //End of chart



            //Remove Watermark
            let waterMark = document.querySelector(".canvasjs-chart-credit");
            waterMark.textContent = "";


            AOS.init({
                duration: 1500,
                offset: 80
            });

            $(document).ready(function(){
                $('.sub-btn').click(function(){
                    $(this).next('.sub-menu').slideToggle();
                    $(this).find('.dropdown').toggleClass('rotate');
                })
            })
        };


        //Showing divs when button press function
        let variables = document.querySelectorAll(".content-div");
        let buttons = document.querySelectorAll(".menu-btn");

        function myFunction(x,y){
            buttons.forEach(item =>{
                item.classList.remove("active_btn");
                const classN  = item.classList[1];
                if(classN == x){
                    item.classList.add("active_btn");
                }
            })

            variables.forEach(item => {
                item.classList.remove("active_menu");
                const classN = item.classList[1];
                if(classN == y){
                    item.classList.add("active_menu");
                }
            });
        };

        //Logout Alert Message using Sweet Alert
        let logout = document.querySelector(".logout");
        logout.addEventListener('click',()=>{
            swal({
            title: "Logout Conformation",
            text: "Do you want to logout?",
            icon: "warning",
            buttons: ['No','Yes'],
            dangerMode: true,
            })
            .then((willLogout) => {
            if (willLogout) {
                location.replace("logout.php");
            }
            });
        });

    </script>

    <!--------------------------------------- Alert Box CDN --------------------------------------->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-------------------------------------- Canvas Chart CDN ------------------------------------->
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script src="../js/main_admin.js"></script>
</body>
</html>
