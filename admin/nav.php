<?php 
if (isset($_GET['logout']) && isset($_SESSION['username']) ) {
    unset($_SESSION['username']);  
    header('Location: .././index.php');         
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container-fluid ">
        <a class="navbar-brand" href="#">ERMS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-university"></i> Class
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="departments.php"> Classes</a>
                        <a class="dropdown-item" href="department.php">New Class</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="batches.php">Streams</a>
                        <a class="dropdown-item" href="batch.php">New Stream</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="Academicyears.php">Academic Years</a>
                        <a class="dropdown-item" href="Academicyear.php">New Academic year</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-book-open"></i> Subject
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="courses.php"> Subjects</a>
                        <a class="dropdown-item" href="course.php">New Subject</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="modules.php">Modules</a>
                        <a class="dropdown-item" href="module.php">New Module</a>

                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-tie"></i> Staff
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="lecturer.php">Teacher</a>
                        <a class="dropdown-item" href="Lecturer_enroll.php">Teacher Entrollment</a> 
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-graduate"></i> Students
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="student.php"> Add Student</a>
                        <a class="dropdown-item" href="students.php">Students View</a>
                        <!-- <a class="dropdown-item" href="studentview.php">Student Report</a> -->
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-book"></i> Assessment
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="assessments.php">Assessments</a>
                       
                        <!-- <a class="dropdown-item" href="#">Assessment Results</a> -->
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-calendar-alt"></i> Attendance
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <!-- <a class="dropdown-item" href="attendance.php">Attendance</a> -->
                        <a class="dropdown-item" href="attendances.php">Add Attendance </a>
                        <!-- <a class="dropdown-item" href="attendance_alert.php">Attendance Report</a> -->
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-trophy"></i> Grade
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        
                        <a class="dropdown-item" href="grades.php">Grades</a>
                        <a class="dropdown-item" href="grade.php">New Grade</a>
                        <div class="dropdown-divider"></div>
                    
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-graduation-cap"></i> Examinations
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <!-- <a class="dropdown-item" href="exams.php">Examinations</a> -->
                        <a class="dropdown-item" href="result.php">Exams Results</a>
                        <!-- <a class="dropdown-item" href="exam_report.php">INSTTITUTE Results</a> -->
                    </div>
                </li>

            </ul>
            <ul class="navbar-nav float-right">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <span class="badge badge-secondary"><?php echo $_SESSION['username']; ?></span>
                        <i class="fas fa-user-circle"></i>

                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">

                        </a>
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="?logout">Signout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
