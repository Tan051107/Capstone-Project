<?php
    include 'connection.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Schedule</title>
    <link rel="stylesheet" href="Initial.css">
    <link rel="stylesheet" href="BusSchedule.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    
</head>
<body class="lightmode">
    <div class="background-overlay"></div>
    <header class="header">
        <div class="left-group">
            <div class="Logo hideOnMobile">
                <div class="circle red"></div>
                <div class="circle green"></div>
                <div class="circle blue"></div>
                <div class="umt-text">UMT</div>
            </div>
            <nav class="navbar hideOnMobile">
                <a href="#">Timetable</a>
                <a href="#">Library</a>
                <a href="#">Facility Reservation</a>
                <a href="#">Transport Service</a>
                <a href="#">Feedback</a>
            </nav>
        </div>

        <div class="menu-btn" onclick="showSidebar('.sidebar')">
            <a href="#"><i class='bx bx-menu'></i></a>
        </div>

        <div class="right-group">
            <div class="icon-wrapper">
                <i class='bx bx-bell'></i>
            </div>
            <div class="icon-wrapper themeToggle">
                <i id="theme" class='bx bx-sun'></i> 
            </div>
            <a href="#" class="Profile icon-wrapper">
                <img src="img/profile.png" alt="User Profile">
            </a>
        </div>
    </header>

    <header class="sidebar">
        <div class="close" onclick="hideSidebar('.sidebar')">
            <i class='bx bx-x'></i>
        </div>
        <div class="Logo">
            <div class="circle red"></div>
            <div class="circle green"></div>
            <div class="circle blue"></div>
            <div class="umt-text">UMT</div>
        </div>
        <nav class="navbar">
            <a href="#">Timetable</a>
            <a href="#">Library</a>
            <a href="#">Facility Reservation</a>
            <a href="#">Transport Service</a>
            <a href="#">Feedback</a>
        </nav>
    </header>

    <div class="schedule-section">
        <div class="toggle-wrapper">
            <div class="toggle-container">
                <p>Show All</p>
                <label class="switch">
                    <input type="checkbox" id="showAllToggle"/>
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
        <div class="schedule-container">
            <div class="LRTtoUMT-schedule-container">
                <div class="schedule-head">
                    <h3><span class="material-icons">school</span> UMT &#9654; <span class="material-icons">train</span> LRT</h3>
                    <div class="countdown-container">
                        <p class="countdown-font">Countdown: <span id="countdown-lrt"></span></p>
                    </div>
                </div>
                <div class="schedule-body">
                    <p class="no-trip-message" id="no-trip-lrt">No Upcoming Trips</p>
                    <?php
                        $query = 'SELECT * from bus_schedule WHERE Origin = "UMT" and Destination = "LRT"';
                        $results = mysqli_query($connection,$query);
                        if ($results){
                            while ($row = mysqli_fetch_assoc($results)){
                                echo "<div>".  $row['Time']."</div>";
                            }
                        }
                        else{
                            echo "No schedule found";
                        }
                    ?>
                </div>
            </div>

            <div class="UMTtoLRT-schedule-container">
                <div class="schedule-head">
                    <h3><span class="material-icons">train</span> LRT  &#9654; <span class="material-icons">school</span> UMT </h3>
                    <div class="countdown-container">
                        <p class="countdown-font">Countdown: <span id="countdown-umt"></span></p>
                    </div>
                </div>
                <div class="schedule-body">
                    <p class="no-trip-message" id="no-trip-lrt">No Upcoming Trips</p>
                    <?php
                        $query = 'SELECT * from bus_schedule WHERE Origin = "LRT" and Destination = "UMT"';
                        $results = mysqli_query($connection,$query);
                        if ($results){
                            while ($row = mysqli_fetch_assoc($results)){
                                echo "<div>".  $row['Time']."</div>";
                            }
                        }
                        else{
                            echo "No schedule found";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="Initial.js"></script>
    <script src="BusSchedule.js"></script>

</body>

</html>
<?php
    mysqli_close($connection);
?>