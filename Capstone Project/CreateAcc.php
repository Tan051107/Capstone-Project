<?php
    include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="Initial.css">
    <link rel="stylesheet" href="CreateAcc.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="ShowUserCreateAcc.js"></script>
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

    <div id="admin-create-acc-section">
        <div class="role-section">
            <a href="#" class="current" onclick="showAdminAcc()">Admin</a>
            <a href="#" onclick="showStudentAcc()">Student</a>
            <a href="#" onclick="showLecturerAcc()">Lecturer</a>
        </div>
        <div class="create-acc-form-container">
            <h2>Create Account</h2>
            <form id="create-admin-acc-form" action="validateCreateAdminAcc.php" method="POST">
                <div class="form-group">
                    <label for="admin-name">Full Name</label>
                    <input type="text" id="admin-name" name="admin-name">
                    <div id="admin-name-error" class="invalid-message"></div>
                </div>

                <div class="form-group">
                    <label for="admin-email">Email</label>
                    <input type="email" id="admin-email" name="admin-email" readonly>
                    <div id="admin-email-error" class="invalid-message"></div>
                </div>

                <div class="form-group">
                    <label for="admin-id">ID</label>
                    <input type="text" id="admin-id" name="admin-id" readonly>
                    <div id="admin-id-error" class="invalid-message"></div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="admin-password">Password</label>
                        <div class="password-input-wrapper">
                            <input type="password" id="admin-password" name="admin-password">
                            <span class="material-icons" id="admin-togglePassword" onclick="showHidePassword('admin-password','admin-togglePassword')">visibility_off</span>    
                        </div>
                        <div id="admin-password-error" class="invalid-message"></div>
                    </div>

                    <div class="form-group">
                        <label for="admin-confirmPassword">Confirm Password</label>
                        <div class="password-input-wrapper">
                            <input type="password" id="admin-confirmPassword" name="admin-confirmPassword">
                            <span class="material-icons" id="admin-toggleConfirmPassword" onclick="showHidePassword('admin-confirmPassword','admin-toggleConfirmPassword')">visibility_off</span>    
                        </div>
                        <div id="admin-confirmPassword-error" class="invalid-message"></div>
                    </div>
                </div>

                <button type="submit" class="submit-btn" name="admin-submit-btn">Create Account</button>
            </form>
        </div>
    </div>

    <div id="student-create-acc-section">
        <div class="role-section">
            <a href="#" onclick="showAdminAcc()">Admin</a>
            <a href="#" class="current" onclick="showStudentAcc()">Student</a>
            <a href="#" onclick="showLecturerAcc()">Lecturer</a>
        </div>
        <div class="create-acc-form-container">
            <h2>Create Account</h2>
            <form id="create-student-acc-form" action="validateCreateStudentAcc.php" method="POST">
                <div class="form-group">
                    <label for="student-name">Full Name</label>
                    <input type="text" id="student-name" name="student-name"> 
                    <div id="student-name-error" class="invalid-message"></div>
                </div>

                <div class="form-group">
                    <label for="student-email">Email</label>
                    <input type="email" id="student-email" name="student-email" readonly>
                    <div id="student-email-error" class="invalid-message"></div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="student-id">ID</label>
                        <input type="text" id="student-id" name="student-id" readonly>
                        <div id="student-id-error" class="invalid-message"></div>
                    </div>

                    <div class="form-group">
                        <label for="student-intake">Intake Code</label>
                        <select id="student-intake" name="student-intake">
                            <?php
                                $query = 'SELECT * from program_information';
                                $results = mysqli_query($connection,$query);
                                if ($results){
                                    while ($row = mysqli_fetch_assoc($results)){
                                        echo "<option>".  $row['IntakeCode']."</option>";
                                    }
                                }
                                else{
                                    echo "No schedule found";
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="student-dob">Date of Birth</label>
                        <input type="date" id="student-dob" name="student-dob">
                        <div id="student-dob-error" class="invalid-message"></div>
                    </div>

                    <div class="form-group">
                        <label for="student-gender">Gender</label>
                        <select id="student-gender" name = "student-gender">
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="student-country">Country of Origin</label>
                    <input list="countries" id="student-country" name="student-country" placeholder="Select Your Country"/>
                    <datalist id="countries"></datalist>
                    <div id="student-country-error" class="invalid-message"></div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="student-password">Password</label>
                        <div class="password-input-wrapper">
                            <input type="password" id="student-password" name="student-password">
                            <span class="material-icons" id="student-togglePassword" onclick="showHidePassword('student-password','student-togglePassword')">visibility_off</span>    
                        </div>
                        <div id="student-password-error" class="invalid-message"></div>
                    </div>

                    <div class="form-group">
                        <label for="student-confirmPassword">Confirm Password</label>
                        <div class="password-input-wrapper">
                            <input type="password" id="student-confirmPassword" name="student-confirmPassword">
                            <span class="material-icons" id="student-toggleConfirmPassword" onclick="showHidePassword('student-confirmPassword','student-toggleConfirmPassword')">visibility_off</span>    
                        </div>
                    <div id="student-confirmPassword-error" class="invalid-message"></div>
                    </div>
                </div>

                <button type="submit" class="submit-btn" name="student-submit-btn">Create Account</button>
            </form>

        </div>
    </div>

    <div id="lecturer-create-acc-section">
        <div class="role-section">
            <a href="#" onclick="showAdminAcc()">Admin</a>
            <a href="#" onclick="showStudentAcc()">Student</a>
            <a href="#" class="current" onclick="showLecturerAcc()">Lecturer</a>
        </div>
        <div class="create-acc-form-container">
            <h2> Create Account</h2>
            <form id="create-lecturer-acc-form" action="validateCreateLecturerAcc.php" method="POST">
                <div class="form-group">
                    <label for="lecturer-name">Full Name</label>
                    <input type="text" id="lecturer-name" name="lecturer-name">
                    <div id="lecturer-name-error" class="invalid-message"></div>
                </div>

                <div class="form-group">
                    <label for="lecturer-email">Email</label>
                    <input type="email" id="lecturer-email" name="lecturer-email" readonly>
                    <div id="lecturer-email-error" class="invalid-message"></div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="lecturer-id">ID</label>
                        <input type="text" id="lecturer-id" name="lecturer-id" readonly>
                        <div id="lecturer-id-error" class="invalid-message"></div>
                    </div>

                    <div class="form-group">
                        <label for="lecturer-job-title">Job Title</label>
                        <select id="lecturer-job-title" name="lecturer-job-title">
                            <option>Lecturer</option>
                            <option>Part Time Lecturer</option>
                            <option>Senior Lecturer</option>
                            <option>Associate Professor</option>
                            <option>Professor</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="lecturer-department">Select Department</label>
                    <select id="lecturer-department" name="lecturer-department">
                        <option>Faculty of Technology</option>
                        <option>Faculty of Computing</option>
                        <option>Faculty of Language</option>
                        <option>Faculty of Academic Research</option>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="lecturer-password">Password</label>
                        <div class="password-input-wrapper">
                            <input type="password" id="lecturer-password" name="lecturer-password">
                            <span class="material-icons" id="lecturer-togglePassword" onclick="showHidePassword('lecturer-password','lecturer-togglePassword')">visibility_off</span>    
                        </div>
                        <div id="lecturer-password-error" class="invalid-message"></div>
                    </div>

                    <div class="form-group">
                        <label for="lecturer-confirmPassword">Confirm Password</label>
                        <div class="password-input-wrapper">
                            <input type="password" id="lecturer-confirmPassword" name="lecturer-confirmPassword">
                            <span class="material-icons" id="lecturer-toggleConfirmPassword" onclick="showHidePassword('lecturer-confirmPassword','lecturer-toggleConfirmPassword')">visibility_off</span>    
                        </div>
                        <div id="lecturer-confirmPassword-error" class="invalid-message"></div>
                    </div>
                </div>

                <button type="submit" class="submit-btn" name="lecturer-submit-btn">Create Account</button>
            </form>
        </div>
    </div>
    <script src="Initial.js"></script>
    <script src="ShowUserCreateAcc.js"></script>
    <script src="SearchCountry.js"></script>
    <script src="ValidateCreateAdminAcc.js"></script>
    <script src="ValidateCreateStudentAcc.js"></script>    
    <script src="ValidateCreateLecturerAcc.js"></script>  
    <script src="ShowHidePassword.js"></script>
    <script>
        window.onload = function () {
        showAdminAcc();
        };
    </script>
</body>
</html>
<?php
    mysqli_close($connection);
?>