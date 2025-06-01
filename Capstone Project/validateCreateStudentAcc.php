<?php
    include 'connection.php';

    ob_clean();
    header('Content-Type: text/plain'); 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $isValid = true;

        $name = $_POST['student-name'];
        $email = $_POST['student-email'];
        $id = $_POST['student-id'];
        $intake = $_POST['student-intake'];
        $dob = $_POST['student-dob'];
        $country = $_POST['student-country'];
        $gender = $_POST['student-gender'];
        $password = $_POST['student-password'];

        // Check if email exists
        $check_student_email = "SELECT * FROM student_details WHERE Email='$email'";
        $student_details = mysqli_query($connection, $check_student_email);

        if (mysqli_num_rows($student_details) >= 1) {
            echo "Email has already existed.";
            exit;
        }

        // Validate name
        if (!preg_match("/^(?=.*[A-Za-z])[A-Za-z\s]+$/", $name)) {
            $isValid = false;
        }

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $isValid = false;
        }

        // Validate id
        if (!preg_match("/^UMT\d{5}$/", $id)) {
            $isValid = false;
        }

        //Validate dob
        $dobDate = DateTime::createFromFormat('Y-m-d', $dob);
        $today = new DateTime();
        if (empty($dob)||!$dobDate || $dobDate > $today) {
            $isValid = false;
        }


        // Validate password
        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d])[A-Za-z\d\S]{8,12}$/", $password)) {
            $isValid = false;
        }

        if ($isValid) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO student_details 
                (`StudentID`, `Name`, `Email`, `Password`, `ProfilePic`, `Gender`, `DateOfBirth`, `Country`, `IntakeCode`)
                VALUES ('$id', '$name', '$email', '$hashedPassword', 'profile.png', '$gender', '$dob', '$country', '$intake')";

            if (mysqli_query($connection, $query)) {
                echo "success";
                exit;
            } else {
               die('Fail to update database.'. mysqli_error($connection));
               exit;
            }
        }
    }

    mysqli_close($connection);
?>
