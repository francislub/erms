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
$title = "Add Department | Online Examination Result Management System | SLGTI";
$description = "Online Examination Result  Management System (ERMS)-SLGTI";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("./head.php"); ?>
    <?php include_once("../config.php"); ?>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>
    <div class="page-wrapper toggled bg2 border-radius-on light-theme">
        
            <?php include_once("nav.php"); ?>
       
        
            <div class="container"> 
                     <!-- delete -->
<?php

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $sql = "DELETE FROM `modules` WHERE `modules`.`code` = '$id'";
    if(mysqli_query($con,$sql)){
        echo "
       <div class='alert alert-success' role='alert'>
       delete success fully 
       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
           <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
    }else{
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}
?>
<!-- delete -->
             <br>
         <form action=""> 
            <div class="card  mb-3" >
                <div class="card-header ">
                <div class="row">
                <div class="col"><h4>Modules</h4></div>
                <div class="col-auto">
                <a href="module.php" class="btn btn-outline-primary">New</a>
                </div>

                </div>
                </div>
            <div class="card-body ">
                


                    <form method="POST">
                <div class="row">
                    <div class="form-group col-md-12">
                    <div class="table-responsive">
                    
                    <table class='table align-middle'>
                        <thead class='bg-primary text-light'>
                            <tr class="h6">
                                <th scope='col'>code</th>
                                <th scope='col'>Name</th>
                                <th scope='col'>Semester_Id</th>
                                <th scope='col'>Course_Name</th>
                                <th scope='col'>Action</th>

                            </tr>
                            
                        </thead>
                        <tbody>
                        <?php
if(isset($_GET['view']))
{
    $view=$_GET['view'];
    $sql = "SELECT * FROM `modules` where course_code='$view'";
}
else
{
    $sql = 'SELECT * FROM `modules`';
}
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        echo '<tr>
            <td>',$row['id'],'</td>
            <td>',$row['Name'],'</td>
            <td>',$row['Semester_Id'],'</td>
            <td>',$row['Course_code'],'</td>
            

            
            <td>
            <div class="row">
            <div class="col"></div>
            <div class="col-auto">
            <div class="btn-group btn-sm" role="group" aria-label="Basic example">
            <a href="module.php?edit=', $row['id'], '" class="btn btn-warning" > <img src="https://img.icons8.com/android/18/000000/edit.png"/> </a> 
            <a href="?delete=', $row['code'], '" class="btn btn-danger"><img src="https://img.icons8.com/windows/18/000000/delete-forever.png"/> </a>
            
            </div>
            </div>
          </div>
            </td>
        </tr>';
    }
}
else{
    echo 'no rows';
}
?>  


                       
            
           

                        
</div>
</td>
                        </tbody>
                    </table>
                    
                    </div>
                    </div>
                </div>
                </form>
                    
                     </div>
                     <br>
                     <!-- 2 row end -->
                    </div>
                   
                   
                
                <!-- 1st row end -->
            <!-- <div id="overlay" class="overlay"></div>
            <div class="container-fluid p-5"> -->
                <!-- #1 Insert Your Content-->
                <!-- <div class="container"> -->
                    <!-- 2 row start -->
                    
                     
                     
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

































