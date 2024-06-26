<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: .././index.php');
}
?>
<?php
if (isset($_GET['logout']) && isset($_SESSION['username'])) {
    unset($_SESSION['username']);
    header('Location: .././index.php');
}
?>
<?php
$title = " Add Assessment| Online Examination Result Management System | SLGTI";
$description = "Online Examination Result  Management System (ERMS)-SLGTI";
?>
<?php include_once("./head.php"); ?>
<?php include_once("../config.php"); ?>
<?php
//departments
$department = '';
$query = "SELECT * FROM departments";
$result = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($result)) {
    $department .= '<option value="' . $row["code"] . '">' . $row["name"] . '</option>';
}
?>

<?php
//academic
$academic = '';
$query = "select distinct Academic_year from batches";
$result = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($result)) {
    $academic .= '<option value="' . $row["Academic_year"] . '">' . $row["Academic_year"] . '</option>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
    </script>
    <!-- department.course,module -->
    <script>
        $(document).ready(function() {
            $('.action').change(function() {
                if ($(this).val() != '') {
                    var action = $(this).attr("id");
                    var query = $(this).val();
                    var result = '';
                    if (action == "department") {
                        result = 'course';
                    } else if (action == "course") {
                        result = 'module';
                    } else if (action == "module") {
                        result = 'percenta';
                    } else if (action == "academic") {
                        result = 'batch';
                    }


                    $.ajax({
                        url: "result_ajax.php",
                        method: "POST",

                        data: {
                            action: action,
                            query: query
                        },
                        success: function(data) {
                            $('#' + result).html(data);
                        }
                    })
                }
            });
        });
    </script>


    <!-- batch -->
    <script>
        function getselectvalue() {
            var selectmodule = document.getElementById("module").value;
            var selectbatch = document.getElementById("batch").value;

            $.ajax({
                url: 'result_ajax.php',
                data: 'batch=' + selectbatch + '&' + 'module=' + selectmodule,
                success: function(data) {
                    $('#demo').html(data);
                }

            });
        }
    </script>
</head>

<body>

    <?php

    ?>

    <div class="page-wrapper toggled bg2 border-radius-on light-theme">

        <?php include_once("nav.php"); ?>

        <!-- <main class="page-content pt-2"> -->
        <!-- 1st row start -->

        <div class="container">
            <div class="card  mb-3">
                <div class="card-header ">
                    <div class="row">
                        <div class="col">
                            <h4>Assessment</h4>
                        </div>
                        <div class="col-auto">

                        </div>

                    </div>
                </div>
                <div class="card-body ">
                    <div class="card  mb-3">

                        <div class="card-body ">
                            <form action="" method="POST">
                                <div class="row">

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            Class <br>
                                            <div class="input-group input-group-sm mb-3">
                                                <select name="department" id="department" class="form-control action" required>
                                                    <option value="" disabled selected>Select Class</option>
                                                    <?php echo $department; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            Subject <br>
                                            <div class="input-group input-group-sm mb-3">
                                                <select name="course" id="course" class="form-control action" required>
                                                    <option value="" disabled selected>Select Subject</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- 2 row end   -->


                                <!-- 3 row start   -->
                                <div class="row">

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            Module <br>
                                            <div class="input-group input-group-sm mb-3">
                                                <select name="module" id="module" class="form-control action" required>
                                                    <option value="" selected disabled>Select module</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            Academic_year <br>
                                            <div class="input-group input-group-sm mb-3">
                                                <select class="form-control action" name="academic" id="academic" id="inputGroupSelect01" id="validationCustom04" required>
                                                    <option value="" disabled selected>Select Academic_year</option>
                                                    <?php echo $academic; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- 3 row end   -->


                                <!-- 4 row start   -->
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            Stream <br>
                                            <div class="input-group input-group-sm mb-3">

                                                <select class="custom-select" name="batch" id="batch" id="inputGroupSelect01" id="validationCustom04" required>

                                                    <option value="" disabled selected>Select Stream</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- 4 row end   -->
                                <div class="card-footer ">
                                    <div class="row">
                                        <div class="col-11 "></div>
                                        <div class="col-1">
                                            <?php
                                            $department = null;
                                            $module = null;
                                            if (isset($_POST['submit'])) {
                                                $department = $_POST['department'];
                                                $course = $_POST['course'];
                                                $module = $_POST['module'];
                                                $academic_year = $_POST['academic'];
                                                $batch = $_POST['batch'];

                                                echo'<a   href="viewresult.php?department=',$department,'& course=',$course,'& module=',$module,' &batch=',$batch ,'" class="btn btn-outline-success"> view </a>'
                                
                                            ?>


                                                <!-- <a  href="viewresult.php?department=' . $departments . ' && course=' . $course . '&& department=' . $department . '&& course=' . $course . '&& module=' . $module . '&& academic_year=' . $academic . '&& batch=' . $batch . ', " class="btn btn-outline-success"> view </a> 
                                                <input type="submit" name="submit" value="check" class="btn btn-outline-success">  -->
                                            

                                            <!-- <input type="submit" name="submit" value="check" class="btn btn-outline-success">  -->
                                            <!-- <input type="submit" href="viewresult.php?department=' . $departments . ' && course=' . $course . '&& department=' . $department . '&& course=' . $course . '&& module=' . $module . '&& academic_year=' . $academic . '&& batch=' . $batch . ', "  name="submit" value="check" class="btn btn-outline-success"> 
                                            
                                            <a  href="viewresult.php?department=' . $departments . ' && course=' . $course . '&& department=' . $department . '&& course=' . $course . '&& module=' . $module . '&& academic_year=' . $academic . '&& batch=' . $batch . ', " class="btn btn-outline-success"> view </a>   -->
                                            <?php
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- <a href="viewresult.php?department='.<?php  echo' $departments '?>. '&& course=' . $course . '&& department=' . $department . '&& course=' . $course . '&& module=' . $module . '&& academic_year=' . $academic . '&& batch=' . $batch . ', " class="btn btn-outline-success"> view </a>
                                 -->
                                <input type="submit" name="submit" value="check" class="btn btn-outline-success">
                                
                            </form>
                        </div>
                    </div>
                    <!-- #1 Insert Your Content" -->
                </div>
                </main>
            </div>
            <?php include_once("../script.php");

            ?>




</body>

</html>


<?php
// echo '<a href="viewresult.php?id=sumanan', '"class="btn btn-outline-success"  color: #ffffff;" > view </a>';
?>