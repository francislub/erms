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
$title = "Batch | Online Examination Result Management System | SLGTI";
$description = "Online Examination Result  Management System (ERMS)-SLGTI";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../head.php"); ?>
    <?php include_once("../config.php"); ?>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
   .test:after {
  content: '\2807';
  font-size: 18px;
  font-weight:bold;
  }
  table.dataTable tbody tr:hover {
        background-color: #f1f1f1;
        cursor: pointer;
    }
    table.dataTable tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }
    table.dataTable tbody tr:nth-child(even) {
        background-color: #ffffff;
    }
    </style>
</head>

<body>
    <div class="page-wrapper toggled bg2 border-radius-on light-theme">
        <?php include_once("nav.php"); ?>
       <!-- card start -->
<div class="container">
<!-- delete -->
<?php
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $nv=$_GET['nvq'];
    $de=$_GET['dep'];
    $sql = "DELETE FROM `batches` WHERE `batches`.`batch_no` = '$id' and `batches`.`department_code` = '$de' and `batches`.`NVQ_level` = '$nv'";
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
<form action=""method="post">
<div class="card  mb-3" >
      <div class="card-header bg-transparent ">
      <div class="row">
      <div class="col"> <h4>Streams</h4> </div>
      <div class="col-auto"> 
      
      <a href="batch.php" class="btn btn-outline-primary">New</a> </div>
      </div>
      </div>
      <div class="card-body ">
         
      <div class="table-responsive-sm">
    <table id="batchesTable" class="table table-striped table-bordered">
    <thead class=" bg-primary text-white">
      <tr>
        <th scope="col">Stream</th>
        <th scope="col">Class</th>
        <th scope="col">Educational_level</th>
        <th scope="col">Academic_year</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
    if(isset($_GET['id']))
    {
        $academic=$_GET['id'];
        $sql = 'SELECT * FROM `batches` where Academic_year="'.$academic.'"';
    }
    else
    {
        $sql = 'SELECT * FROM `batches`';
    }

$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        echo '<tr>
            <td>',"batches".$row['batch_no'],'</td>
            <td>',$row['department_code'],'</td>
            <td>',$row['NVQ_level'],'</td>
            <td>',$row['Academic_year'],'</td>
            <td>
            <div class="row">
<div class="col"></div>
<div class="col-auto">
<div class="btn-group btn-sm" role="group" aria-label="Basic example">
            <a href="batch.php?edit=', $row['id'], '" class=" btn btn-sm" style="background-color: #ffaa00 ;" ><i class="far fa-edit" style="color: #ffffff;"></i> </a> 
            <a href="?delete=', $row['id'], '" class="btn btn-sm" style="background-color: #bf0502;"> <i class="far fa-trash-alt" style="color: #ffffff;"></i> </a>
            <a href="students.php?batch=', $row['batch_no'], '" class="btn btn-sm" style="background-color: #0097c4 ; color: #ffffff;" > student info </a>
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
      
      
    </tbody>
  </table>
  </div>   
                  


        
    </div>
       <!-- card end  -->
    </div>
    <?php include_once("../script.php"); ?>

    <script>
$(document).ready(function() {
    $('#batchesTable').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [5, 10, 25, 50, 100],
        "searching": true,
        "ordering": true,
        "info": true,
        "language": {
            "paginate": {
                "first": "<<",
                "last": ">>",
                "next": ">",
                "previous": "<"
            }
        }
    });
});
</script>

<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>





