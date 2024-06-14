<?php
$title ='STUDENT TRANSCRIPT';
$description = 'Online Examination Result  Management System (ERMS)-SLGTI';
?>
<!DOCTYPE html>
<html lang='en'>
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
<head>
  <link rel="stylesheet" type="text/css" href="print.css" media="print">
  <?php include_once('../head.php');

  ?>
  <?php include_once('../databases/config.php'); ?>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body >

  <script type='text/javascript'>
    function preview_image(event) {
      var reader = new FileReader();
      reader.onload = function() {
        var output = document.getElementById('output_image');
        output.src = reader.result;
      }
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>
  <style>
    #wrapper {
      text-align: center;
      margin: 0 auto;
      padding: 0px;
    }

    #output_image {
      width: 150px;
      height: 150px;
      border: 1px solid black;

    }
    .double-line::after {
      content: "";
      display: block;
      border-top: 3px double #000;
      width: 100%;
    }
    .border-outside {
        position: relative;
        display: inline-block;
    }
    
    .border-outside::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        border: 1px solid #000;
    }
    
    /* .card {
        background-image: url('../img/logo1.PNG');
        background-size: cover;
        background-position: center;
        filter: brightness(100%);
        
        
    } */
  </style>
  <!-- view  start -->
  <?php
  $student_id = $stitle = $full_name = $ini_name = $gender = $civil = $email = $nic = $dob = $phone = $address = $ds =
    $district = $province = $zip = $blood = $gname = $gaddress = $gphone = $grelation = $regno = $cid =
    $mode = $status = $enrolldate = $exitdate = null;
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // $sql_student = "SELECT * FROM student LEFT JOIN student_enroll
    //             ON `student`.`id` = `student_enroll`.`id`
    //             WHERE `student`.`id` = '$id'";

    $sql_student = "SELECT * FROM `student` LEFT JOIN `student_enroll`
    ON `student`.`id` = `student_enroll`.`id` LEFT JOIN `batches` ON 
    `student_enroll`.`batch_no` = `batches`.`batch_no` LEFT JOIN `courses` ON
    `student_enroll`.`course_code` = `courses`.`code` WHERE 
    `batches`.`department_code`=`courses`.`department_code` AND 
    `batches`.`NVQ_level`=`courses`.`NVQ_level` AND `student_enroll`.`id` = '$id'";


    $result_student = mysqli_query($con, $sql_student);
    $row = mysqli_fetch_assoc($result_student);
    if (mysqli_num_rows($result_student) == 1) {
      $full_name = $row['full_name'];
      $ini_name = $row['name_with_initials'];
      $nic = $row['nic'];
      $regno = $row['id'];
      $cid = $row['course_code'];
      $bid = $row['batch_no'];
      $ayear = $row['Academic_year'];
    }
  }
  ?>
  <!-- view  end -->

  <main class='page-content pt-2'>
    <?php include_once('nav.php'); ?>

    <div class='container-fluid p-5'>
      <!-- #1 Insert Your Content-->

      <div class="row cardback border-4 border-white-800 p-10">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-2">
                <h3> <?php echo " $title" ?> </h3>
                </div>
                <div class="col-9"></div>
                <div class='col-1'>
                  <a class='btn btn-outline-primary' href='./transcript.php' id="print-btn">ALL</a>
                </div>
              </div>
            </div>

            <div class="card-body border-4 border-gray-800 p-2">
              <div class='row'>
                <div class="col-md-6">
                </div>
              </div>

              <div class="card-body">
                <div class='row'>

                  <form>
                    <div class="flex justify-center text-center">
                       <h1 class="text-center font-bold mb-1" style="font-size: 30px;">SHINING STARS NURSERY AND PRIMARY SCHOOL - VVUMBA</h1>
                    </div>
                    <div class="row">

                    <div class="col-2 flex justify-center items-center">
                        <?php
                        // Path to the image
                        $imagePath = '../img/logo1.png';
                        ?>
                        <img src="<?php echo $imagePath; ?>" class="w-48 h-30 mt-1 mb-1 ml-5" alt="Image Description">
                    </div>

                      <div class="col-7">

                        <div class="flex justify-center text-center">
                          <h1 class="text-center font-bold mb-1 underline" style="font-size: 14px;">Mixed day and boarding</h1>
                        </div>
                        <div class="flex justify-center text-center">
                          <h1 class="text-center mb-1" style="font-size: 16px;">P.O.BOX 31007, TEL: 0753753179, 0773297951, 0772413164,</h1>
                        </div>
                        <div class="flex justify-center text-center">
                          <h1 class="text-center font-bold mt-2 mb-2" style="font-size: 14px;">"A rise and shine"</h1>
                        </div>
                        <div class="flex justify-center text-center">
                          <h1 class="text-center mb-1" style="font-size: 14px;"><b>Email:</b> shininostars.sch0012U22@grnail.com</h1>
                        </div>
                        <div class="flex justify-center text-center">
                          <h1 class="text-center font-bold mb-1" style="font-size: 14px;">"A Centre for Guaranteed excellence"</h1>
                        </div>


                      </div>
                      <div class='col-2'>

                        <div class="col-auto">
                          <?php
                          if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $result = $con->query("SELECT * FROM `student_image` WHERE id = '$id'");
                            if ($result->num_rows > 0) {
                              while ($row = $result->fetch_assoc()) {
                          ?>
                                <img id="output_image" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" />
                            <?php
                              }
                            }
                            ?>

                          <?php
                          } else {
                          ?>
                            <img id="output_image" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" />
                          <?php
                          }
                          ?>

                        </div>

                      </div>


                    </div>
                    <div class="col-12 mt-3 mb-4 double-line">

                    </div>

                    <div class="col-auto flex justify-center text-center">
                        <h1 class="text-center font-bold mt-2 mb-3 text-xl border-outside">END OF TERM II ASSESSMENT REPORT</h1>
                    </div>

                    <div class="col-12">

                        <div class="row">
                          <div class="col-8"> <label for="exampleInputEmail1" name="department" class="text-lg" style="font-size: 20px;">PUPIL'S NAME  :<b><?php echo $full_name; ?></b></label></div>
                          <div class="col-4"> <label for="exampleInputEmail1" name="batch" class="text-lg" style="font-size: 20px;">Student Id :<b><?php echo $regno; ?></b></label></div>
                          <div class="col-4"> <label for="exampleInputEmail1" name="batch" class="text-lg" style="font-size: 20px;">Name with Initial :-<b><?php echo $ini_name; ?></b></label></div>
                          <div class="col-8"> <label for="exampleInputEmail1" name="batch" class="text-lg" style="font-size: 20px;">NIC Number :-<b><?php echo $nic; ?></b></label></div>
                          <div class="col-4"> <label for="exampleInputEmail1" name="batch" class="text-lg" style="font-size: 20px;">Subject :-<b><?php echo $cid; ?></b></label></div>
                          <div class="col-4"> <label for="exampleInputEmail1" name="batch" class="text-lg" style="font-size: 20px;">STREAM :-<b><?php echo $bid; ?></b></label></div>
                          <div class="col-4"> <label for="exampleInputEmail1" name="batch" class="text-lg" style="font-size: 20px;">YEAR :-<b><?php echo $ayear; ?></b></label></div>
                        </div>
                      </div>

                    <?php


                    if (isset($_GET['view'])) {
                      $id = $_GET['view'];
                      $sql = "DELETE FROM `modules,exams_result` WHERE `id` = $id";
                      if (mysqli_query($con, $sql)) {
                        echo 'Record was view';
                      } else {
                        echo 'Try again';
                      }
                    }
                    ?>





                    <!-- <div class="row">
                      <div class="col-2"></div>
                      <div class="col-5">
                        <label for="exampleInputEmail1"><b>Full Name :- </b><?php echo $full_name; ?></label>
                      </div>
                      <div class="col-5">
                        <label for="exampleInputEmail1"><b> Student Id :- </b><?php echo $regno;
                                                                              ?></label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-2"></div>
                      <div class="col-5">
                        <label for="exampleInputEmail1"><b>Name with Initial :- </b><?php echo $ini_name; ?>
                                                                                    </label>
                      </div>
                      <div class="col-5">
                        <label for="exampleInputEmail1"><b> NIC Number :- </b><?php echo $nic; ?>
                                                                             </label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-2"></div>
                      <div class="col-5">
                        <label for="exampleInputEmail1"><b>Course :- </b><?php echo $cid; ?>
                                                                          </label>
                      </div>
                      <div class="col-5">
                        <label for="exampleInputEmail1"><b>Batch :- </b><?php echo $bid; ?></label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-2"></div>
                      <div class="col-6">
                        <label for="exampleInputEmail1"><b>Academic Year :- </b>2018/2020</label>
                      </div>
                    </div>

                </div>


              </div> -->

                  </form>
                  <!-- #1 Insert Your Content-->



                  <table class="table">
                    <thead class="thead-light">

                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Module Code</th>
                        <th scope="col">Module Name</th>
                        <th scope="col">Attempt</th>
                        <th scope="col">Result</th>

                      </tr>
                      <?php

                      // SQL query
                      $sql = "SELECT modules.id, modules.id, modules.Name, exams_result.Attempt, exams_result.marks 
                      FROM modules
                      INNER JOIN exams_result ON exams_result.course = modules.course_code
                      GROUP BY modules.id";

                      // Execute the query
                      $result = mysqli_query($con, $sql);

                      // Check for errors in the SQL query
                      if (!$result) {
                      die("Error in SQL query: " . mysqli_error($con));
                      }

                      // Check if there are any results
                      $i = 1;
                      if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>
                            <td type="1">', $i++, '</td>  
                            <td>', $row['Code'], '</td>
                            <td>', $row['Name'], '</td>
                            <td>', $row['Attempt'], '</td>
                            <td>', $row['marks'], '</td>
                            <td></td>
                            </tr>';
                      }
                      } else {
                      echo "No records found.";
                      }

                      // Close the database connection
                      mysqli_close($con);
                      ?>
                  </table>
                  <!-- #1 Insert Your Content-->
                </div>
                    <p class="font-bold mt-4 underline" style="text-align: center;"> PUPIL'S GENERAL CONDUCT</p>

                    <div class="row">
                      <table class="col-12">
                          <thead>
                              <tr>
                                  <th class="border px-4 py-2 text-center font-bold">DISCPLINE</th>
                                  <th class="border px-4 py-2 text-center font-bold">TIME MANAGEMENT</th>
                                  <th class="border px-4 py-2 text-center font-bold">SMARTNESS</th>
                                  <th class="border px-4 py-2 text-center font-bold">ATTENDANCE</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td class="border px-4 py-2 text-center">V.Good</td>
                                  <td class="border px-4 py-2 text-center"></td>
                                  <td class="border px-4 py-2 text-center"></td>
                                  <td class="border px-4 py-2 text-center"></td>
                              </tr>
                              
                          </tbody>
                      </table>
                    
                    </div>

                    <p class="font-bold mt-4 mb-4 underline" style="font-size:20px; text-align: center;">GRADING SCALE</p>

                    <div class="row">
                      <table class="col-12">
                          <thead>
                              <tr>
                                  <th class="border px-4 py-2 text-center">90-100</th>
                                  <th class="border px-4 py-2 text-center">80-89</th>
                                  <th class="border px-4 py-2 text-center">70-79</th>
                                  <th class="border px-4 py-2 text-center">60-69</th>
                                  <th class="border px-4 py-2 text-center">55-59</th>
                                  <th class="border px-4 py-2 text-center">50-54</th>
                                  <th class="border px-4 py-2 text-center">45-49</th>
                                  <th class="border px-4 py-2 text-center">40-44</th>
                                  <th class="border px-4 py-2 text-center">0-39</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td class="border px-4 py-2 text-center font-bold">D1</td>
                                  <td class="border px-4 py-2 text-center font-bold"></td>
                                  <td class="border px-4 py-2 text-center font-bold"></td>
                                  <td class="border px-4 py-2 text-center font-bold"></td>
                                  <td class="border px-4 py-2 text-center font-bold"></td>
                                  <td class="border px-4 py-2 text-center font-bold"></td>
                                  <td class="border px-4 py-2 text-center font-bold"></td>
                                  <td class="border px-4 py-2 text-center font-bold"></td>
                                  <td class="border px-4 py-2 text-center font-bold"></td>
                                  
                              </tr>
                              
                          </tbody>
                      </table>
                    
                    </div>

                    <div class="mt-4">
                      <div class="row">
                        <div class="col-8"> <label for="exampleInputEmail1" name="department" class="text-lg" style="font-size: 20px;">Next term Begins on: <b><?php echo $full_name; ?></b></label></div>
                        <div class="col-4"> <label for="exampleInputEmail1" name="batch" class="text-lg" style="font-size: 20px;">and ends on :<b><?php echo $regno; ?></b></label></div>
                        
                      </div>
                    </div>

            
                <!-- </div> -->
                <div class="mt-4">
                    <p style="text-align: center; font-size:20px;"> <b>THIS REPORT IS NOT VALID WITHOUT A SCHOOL STAMP</b></p>
                </div>
                <div class="row">
                  <div class="col-4"></div>
                  <div class="text-center col-4">
                    <button onclick="window.print();" class="btn btn-primary" id="print-btn">Print</button>
                  </div>
                  <div  class="col-4"></div>
                  
                </div>

              </div>
            </div>
            <!-- <p style="text-align: center;" type="hidden"> <b>For any error in the report card contact Eng. Francis</b></p> -->
          </div> <!-- #1 Insert Your Content" -->
        </div>
  </main>

  <?php include_once("../script.php");
  ?>
</body>

</html>