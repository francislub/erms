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
<?php
$title = "Add Academic year";
$description = "Online Examination Result  Management System (ERMS)-SLGTI";

?>


<?php
include_once('../config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("./head.php"); ?>
    <script>
        $(".myselect").change(function() {
            var res = $(".myselect").find(":selected").map(function() {
                if ($(this).val() != "")
                    return $(this).text();
                else
                    return "";
            }).get().join(" ");

            $("#inputid").val(res);

        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>

<body>
    <div class="page-wrapper toggled bg2 border-radius-on light-theme">

        <?php include_once("nav.php"); ?>
        <?php 
        
        ?>

        <!-- <main class="page-content pt-2"> -->
        <!-- 1st row start -->

        <div class="container">

            <!-- update -->
            <?php

            if (
                isset($_POST['save'])
                && !empty($_POST['academicyear'])
                && !empty($_POST['status'])
                && !empty($_POST['semi1start'])
                && !empty($_POST['semi1end'])
                && !empty($_POST['semi2start'])
                && !empty($_POST['semi2end'])

            ) {

                $year = $_POST['academicyear'];
                $status = $_POST['status'];
                $semi1start = $_POST['semi1start'];
                $semi1end = $_POST['semi1end'];
                $semi2start = $_POST['semi2start'];
                $semi2end = $_POST['semi2end'];

                $sql = "UPDATE `academic_year` SET `academic_year_status` = '$status' WHERE `academic_year`.`academic_year` = '$year';";

                if (mysqli_query($con, $sql)) {
                    echo "
       <div class='alert alert-success' role='alert'>
       update success fully 
       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
           <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
                } else {

                    echo "
       <div class='alert alert-danger' role='alert'>
       This academic_year alredy submit 
       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
           <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
                }
            }
            ?>
            <!-- update -->




            <!-- insert stat -->
            <?php

            $year = $status = $semi1start = $semi1end = $semi2start = $semi2end = null;

            if (isset($_GET['edit'])) {
                $id = $_GET['edit'];

                $sql = "SELECT * FROM `academic_year` WHERE `academic_year`= '$id' ";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);
                    $year = $row['academic_year'];
                    $status = $row['academic_year_status'];
                    $semi1start = $row['1semi_startdate'];
                    $semi1end = $row['1semi_enddate'];
                    $semi2start = $row['2semi_startdate'];
                    $semi2end = $row['2semi_enddate'];
                }
            }


            if (
                isset($_POST['submit'])
                && !empty($_POST['academicyear'])
                && !empty($_POST['academicyear1'])
                && !empty($_POST['status'])
                && !empty($_POST['semi1start'])
                && !empty($_POST['semi1end'])
                && !empty($_POST['semi2start'])
                && !empty($_POST['semi2end'])

            ) {

                $year = $_POST['academicyear'];
                $year1 = $_POST['academicyear1'];
                $status = $_POST['status'];
                $semi1start = $_POST['semi1start'];
                $semi1end = $_POST['semi1end'];
                $semi2start = $_POST['semi2start'];
                $semi2end = $_POST['semi2end'];

                $sql = "INSERT INTO academic_year (academic_year,academic_year_status, 1semi_startdate, 1semi_enddate,2semi_startdate,2semi_enddate)
    VALUES 
    ('$year/$year1','$status', 
    '$semi1start', 
    '$semi1end','$semi2start','$semi2end')
    ";

                if (mysqli_query($con, $sql)) {
                    echo "
       <div class='alert alert-success' role='alert'>
       insert success fully 
       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
           <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
                } else {

                    echo "
       <div class='alert alert-danger' role='alert'>
       This academic_year alredy submit 
       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
           <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
                }
            }
            ?>
            <!-- insert end -->
            <br>
            <div class="card  mb-3">
                <div class="card-header ">
                    <div class="row">
                        <div class="col">
                            <h4>Academic Year</h4>
                        </div>
                        <div class="col-auto">
                            <a href="Academicyears.php" class="btn btn-outline-primary">Academic Years</a>
                        </div>

                    </div>
                </div>
                <div class="card-body ">
                    <div class="card  mb-3">
                        <div class="card-body ">
                            <form action="Academicyear.php" method="POST">
                                <?php
                                if (isset($_GET['edit'])) {
                                ?>

                                    <div class="row">
                                        <div class="col-sm">
                                            Academic Year <br>
                                            <div class="form-group">
                                                <div class="input-group input-group-sm mb-3">

                                                    <input type="text" value="<?php echo $year; ?>" name="academicyear" placeholder="2019/2020" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="validationServer01" required>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-sm">
                                            <div class="form-group">
                                                Year Status <br>
                                                <div class="input-group input-group-sm mb-3">

                                                    <select class="custom-select" name="status" id="inputGroupSelect01" id="validationCustom04" required>
                                                        <?php
                                                        if (isset($_GET['edit'])) {
                                                        ?>
                                                            <option selected value="<?php echo $status; ?>"><?php echo $status; ?></option>
                                                            <option disabled value="">Choose Year Status </option>
                                                            <option value="Active">Active</option>
                                                            <option value="Completed">Completed</option>
                                                            <option value="plan">plan</option>
                                                        <?php
                                                        } else {
                                                            echo '
                                                        <option disabled selected value="">Choose Year Status </option>
                                                        <option value="Active">Active</option>
                                                        <option value="Completed">Completed</option>
                                                        <option value="plan">plan</option>
                                                        ';
                                                        }
                                                        ?>


                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                    <!-- 2 row end -->


                                    <div class="row">
                                        <div class="col-sm">
                                            Term1 Start Date <br>
                                            <div class="form-group">
                                                <div class="input-group input-group-sm mb-3">
                                                    <input type="date" name="semi1start" class="form-control" value="<?php echo $semi1start; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="validationServer01" required>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-sm">
                                            <div class="form-group">
                                                Term1 End Date <br>
                                                <div class="input-group input-group-sm mb-3">
                                                    <input type="date" name="semi1end" class="form-control" value="<?php echo $semi1end; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="validationServer01" required>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                    </div>
                                    <!-- 3 row end -->


                                    <div class="row">
                                        <div class="col-sm">
                                            Term2 Start Date <br>
                                            <div class="form-group">
                                                <div class="input-group input-group-sm mb-3">
                                                    <input type="date" name="semi2start" class="form-control" value="<?php echo $semi2start; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="validationServer01" required>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-sm">
                                            <div class="form-group">
                                                Term2 End Date <br>
                                                <div class="input-group input-group-sm mb-3">
                                                    <input type="date" name="semi2end" class="form-control" value="<?php echo $semi2end; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="validationServer01" required>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                    </div>




                        </div>


                    </div>
                <?php
                                } else {

                ?>




                    <div class="row">
                        <div class="col-sm">
                            Academic Year <br>
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="text" name="academicyear" placeholder="Start year" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="validationServer01" required>
                                    <input type="text" name="academicyear1" placeholder="End year" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="validationServer01" required>
                                </div>


                            </div>

                        </div>


                        <div class="col-sm">
                            <div class="form-group">
                                Year Status <br>
                                <div class="input-group input-group-sm mb-3">

                                    <select class="custom-select" name="status" id="inputGroupSelect01" id="validationCustom04" required>
                                        <?php
                                        if (isset($_GET['edit'])) {
                                        ?>

                                            <option disabled value="">Choose Year Status </option>
                                            <option value="Active">Active</option>
                                            <option value="Completed">Completed</option>
                                            <option value="plan">plan</option>
                                        <?php
                                        } else {
                                            echo '
                                                        <option disabled selected value="">Choose Year Status </option>
                                                        <option value="Active">Active</option>
                                                        <option value="Completed">Completed</option>
                                                        <option value="plan">plan</option>
                                                        ';
                                        }
                                        ?>


                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    <!-- 2 row end -->


                    <div class="row">
                        <div class="col-sm">
                            Term1 Start Date <br>
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="date" name="semi1start" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="validationServer01" required>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm">
                            <div class="form-group">
                                Term1 End Date <br>
                                <div class="input-group input-group-sm mb-3">
                                    <input type="date" name="semi1end" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="validationServer01" required>
                                </div>
                            </div>
                        </div>
                        <br>

                    </div>
                    <!-- 3 row end -->


                    <div class="row">
                        <div class="col-sm">
                            Term2 Start Date <br>
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="date" name="semi2start" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="validationServer01" required>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm">
                            <div class="form-group">
                                Term2 End Date <br>
                                <div class="input-group input-group-sm mb-3">
                                    <input type="date" name="semi2end" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="validationServer01" required>
                                </div>
                            </div>
                        </div>
                        <br>

                    </div>




                </div>


            </div>

        <?php
                                }
        ?>

        <?php

        if (isset($_GET['edit'])) {
        ?>
            <div class="card-footer ">
                <div class="row">
                    <div class="col-11 "></div>
                    <div class="col-1">
                        <button type="submit" name="save" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="card-footer ">
                <div class="row">
                    <div class="col-10 "></div>
                    <div class="col-2">
                        <a href="Academicyear.php" class="btn btn-outline-info">Reset</a>
                        <button type="submit" name="submit" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModal">
                            Add
                        </button>
                    </div>
                </div>
            </div>
        <?php
        }

        ?>

        </div>
        </form>

    </div>
    <!-- #1 Insert Your Content" -->
    </div>
    </main>
    </div>
    <?php include_once("../script.php"); ?>
</body>

</html>