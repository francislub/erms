<?php
$title = "View Students | Online Examination Result Management System | SLGTI";
$description = "Online Examination Result Management System (ERMS)-SLGTI";
?>
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: .././index.php');
}
?>

<?php 

if (isset($_GET['logout']) && isset($_SESSION['username']) ) {
    unset($_SESSION['username']);  
    header('Location: .././index.php');         
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../head.php"); ?>
    <?php include_once('../databases/config.php'); ?>
</head>

<body>
    <div class="page-wrapper toggled bg2 border-radius-on light-theme">
        <?php include_once("nav.php"); ?>
        <!-- delete start -->
        <?php
        if (isset($_GET['delete'])) {
            $student_id = $_GET['delete'];
            $sql_delete = "DELETE FROM `student` WHERE `student`.`id` = '$student_id'";
            if (mysqli_query($con, $sql_delete)) {
                echo '<div class="alert alert-success" role="alert">
                Successfully Deleted!
                </div>';
            } else {
                echo "Error deleting record: " . mysqli_error($con);
            }
        }
        ?>
        <!-- delete end -->

        <main class="">
            <div class="container-fluid p-5">
                <!-- #1 Insert Your Content-->
                <div class="container">

                    <!-- 1st row start -->
                    <div class="card">

                        <div class="card-header">
                            <div class="row">
                                <div class='col-8'>
                                    <h5><?php echo "$title" ?></h5>
                                </div>
                                <div class='col-1-sm'>
                                </div>
                                <div class='col-3'>
                                    <input class="form-control" id="myInput" onkeyup="myFunction()" type="search" placeholder="Registration No." aria-label="Search">
                                </div>
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </div>
                        </div>

                        <div class="card-body">
                            <h6 class="card-title">
                            </h6>

                            <div class="row">
                                <div class="form-group col-md-12 table-responsive">
                                    <table class='table align-middle ' id="myTable">
                                        <thead class='thead-dark'>
                                            <tr>
                                                <th scope='col'>Registration No</th>
                                                <th scope='col'>Student Name</th>
                                                <th scope='col'>Enrolled Class</th>
                                                <th scope='col'>Stream</th>
                                                <th scope='col'>Contact Number</th>
                                                <th scope='col'>ACTIONS</th>
                                            </tr>
                                            <?php
                                            if (isset($_GET['batch'])) {
                                                $b = $_GET['batch'];
                                                $sql = "SELECT 
                                                `student`.`id`,`student`.`full_name`,`student_enroll`.`course_code`,
                                                `student_enroll`.`batch_no`,`student`.`phone_no`
                                                FROM student 
                                                LEFT JOIN student_enroll
                                                ON `student`.`id` = `student_enroll`.`id` and `student_enroll`.`batch_no`=$b
                                                -- ORDER BY `id` ASC
                                                GROUP BY `id`";
                                            } else {
                                                $sql = "SELECT 
                                                `student`.`id`,`student`.`full_name`,`student_enroll`.`course_code`,
                                                `student_enroll`.`batch_no`,`student`.`phone_no`
                                                FROM student 
                                                LEFT JOIN student_enroll
                                                ON `student`.`id` = `student_enroll`.`id`
                                                -- ORDER BY `id` ASC
                                                GROUP BY `id`";
                                            }

                                            $result = mysqli_query($con, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <tr>
                                                    <td scope='col'>
                                                        <?php echo $row['id']; ?>
                                                    </td>
                                                    <td scope='col'>
                                                        <?php echo $row['full_name']; ?>
                                                    </td>
                                                    <td scope='col'>
                                                        <?php echo $row['course_code']; ?>
                                                    </td>
                                                    <td scope='col'>
                                                        <?php echo $row['batch_no']; ?>
                                                    </td>
                                                    <td scope='col'>
                                                        <?php echo $row['phone_no']; ?>
                                                    </td>
                                                    <td scope='col'>
                                                        <a class="btn btn-outline-info btn-sm" href="studentview.php?view=<?php echo $row['id']; ?>">Full View</a>
                                                    </td>
                                                <?php
                                            }
                                                ?>
                                                </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-muted">
                        </div>

                    </div>
                    <!-- 1st row end -->
                </div>
                <!-- #1 Insert Your Content" -->
        </main>
    </div>

    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

    <?php include_once("../script.php"); ?>
</body>

</html>