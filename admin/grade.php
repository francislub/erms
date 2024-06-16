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
$title = "Grade | Online Examination Result Management System | SLGTI";
$description = "Online Examination Result  Management System (ERMS)-SLGTI";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("./head.php"); ?>
    <?php include_once("../config.php"); ?>
</head>

<body>
    <div class="page-wrapper toggled bg2 border-radius-on light-theme">
        <?php include_once("nav.php"); ?>
        <!-- card start -->
        <div class="container">
            <!-- insert start -->
            <?php

            $from = null;
            $to = null;
            $grade = null;
            $comment = null;
            $id = null;
            if (isset($_GET['edit'])) {
                $id = $_GET['edit'];

                $sql = "SELECT * FROM `grade` WHERE `grade_id`= '$id' ";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);
                    $from = $row['from'];
                    $to = $row['to'];
                    $grade = $row['grade'];
                    $comment = $row['comment'];
                }
            }


            if (
                isset($_POST['submit'])
                && !empty($_POST['from'])
                && !empty($_POST['to'])
                && !empty($_POST['grade'])
                && !empty($_POST['comment'])
            ) {

                $from = $_POST['from'];
                $to = $_POST['to'];
                $grade = $_POST['grade'];
                $comment = $_POST['comment'];

                $sql = "INSERT INTO grade (`from`, `to`, `grade`, `comment`)
                VALUES 
                ('$from',
                '$to', 
                '$grade', 
                '$comment')
                ";
                if (mysqli_query($con, $sql)) {
                    echo "
       <div class='alert alert-success' role='alert'>
       Grade inserted success fully 
       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
           <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($con);
                    echo "error";
                }
            }
            ?>
            <!-- insert end -->

            <!-- update -->
            <?php

            if (
                isset($_POST['save'])
                && !empty($_POST['from'])
                && !empty($_POST['to'])
                && !empty($_POST['grade'])
                && !empty($_POST['comment'])

            ) {

                $from = $_POST['from'];
                $to = $_POST['to'];
                $grade = $_POST['grade'];
                $comment = $_POST['comment'];

                $sql = "UPDATE `grade` SET `from` = '$from',`to` = '$to',`grade` = '$grade',`comment` = '$comment' WHERE `grade`.`grade_id` = '$id';";

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




            <form action="" method="post">
                <div class="card  mb-3">
                    <div class="card-header bg-transparent ">
                        <div class="row">
                            <div class="col">
                                <h4>Grade</h4>
                            </div>
                            <div class="col-auto"> <a href="grades.php" class="btn btn-outline-primary">Grades</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body ">

                        <div class="card  mb-3">

                            <div class="card-body ">
                                <!-- 1st row -->

                                <div class="row ">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            From <br>
                                            <div class="input-group input-group-sm mb-3">
                                                <?php
                                                if (isset($_GET['edit'])) {
                                                    ?>
                                                    <input type="number" name="from" class="form-control" value="<?php echo $from; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="validationServer01" required>
                                                <?php
                                            } else {
                                                ?>
                                                    <input type="number" name="from" class="form-control" value="<?php echo $from; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="validationServer01" required>
                                                <?php
                                            }
                                            ?>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            To <br>
                                            <div class="input-group input-group-sm mb-3">
                                                <?php
                                                if (isset($_GET['edit'])) {
                                                    ?>
                                                    <input type="number" name="to" class="form-control" value="<?php echo $to; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="validationServer01" required>
                                                <?php
                                            } else {
                                                ?>
                                                    <input type="number" name="to" class="form-control" value="<?php echo $to; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="validationServer01" required>
                                                <?php
                                            }
                                            ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 1st row -->

                                <!-- 2nd row -->
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            Grade <br>
                                            <div class="input-group input-group-sm mb-3">
                                                <?php
                                                if (isset($_GET['edit'])) {
                                                    ?>
                                                    <input type="text" name="grade" class="form-control" value="<?php echo $grade; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="validationServer01" required>
                                                <?php
                                            } else {
                                                ?>
                                                    <input type="text" name="grade" class="form-control" value="<?php echo $grade; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="validationServer01" required>
                                                <?php
                                            }
                                            ?>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        Comment <br>
                                        <div class="form-group">
                                            <div class="input-group input-group-sm mb-3">
                                                <?php
                                                if (isset($_GET['edit'])) {
                                                    ?>
                                                    <input type="text" name="comment" class="form-control" value="<?php echo $comment; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="validationServer01" required>
                                                <?php
                                            } else {
                                                ?>
                                                    <input type="text" name="comment" class="form-control" value="<?php echo $comment; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="validationServer01" required>
                                                <?php
                                            }
                                            ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 2nd row -->
                            </div>

                        </div>


                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-11 "></div>
                            <div class="col-1">
                                <?php
                                if (isset($_GET['edit'])) {
                                    ?>
                                    <button type="submit" name="save" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModal">
                                        Save
                                    </button>
                                <?php
                            } else {
                                ?>
                                    <button type="submit" name="submit" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModal">
                                        Add
                                    </button>

                                <?php
                            }
                            ?>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- card end  -->
    </div>
    <?php include_once("../script.php"); ?>
</body>

</html>
