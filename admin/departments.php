<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: .././index.php');
}
?>
<style>
    .table-hover tbody tr:hover {
        background-color: #f3f4f6; 
    }
</style>
<?php 

if (isset($_GET['logout']) && isset($_SESSION['username']) ) {
    unset($_SESSION['username']);  
    header('Location: .././index.php');         
}
?>
<?php
$title = "Add Class | Shining Stars Management System";
$description = "Online School Management System";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("./head.php"); ?>
    <?php include_once("../config.php"); ?>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="page-wrapper toggled bg2 border-radius-on light-theme">

        <?php include_once("nav.php"); ?>

        <!-- <main class="page-content pt-2"> -->
        <!-- 1st row start -->

        <div class="container">
            <!-- delete -->
<?php
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $sql = "select department_code from courses where department_code='$id';";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0)
    {
        ?>
       <div class='alert alert-warning' role='alert'>
       This Class already allocated so not delete this Class.
       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
           <span aria-hidden='true'>&times;</span>
        </button>
      </div>
        <?php
    }  
    else{
    $sql = "DELETE FROM `departments` WHERE `departments`.`code` = '$id'";
    if(mysqli_query($con,$sql)){
        echo 'Record was deleted';
    }else{
        echo 'Try again';
    }
}
}
?>
<!-- delete -->
            <br>
            <form action="">
                <div class="card  mb-3">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col">
                                <h4>Classes</h4>
                            </div>
                            <div class="col-auto">
                                <a href="department.php" class="btn btn-outline-primary">New</a>
                            </div>

                        </div>
                    </div>
                    <div class="card-body ">

                        <!-- select -->

                        <div class="w-full p-10">
                            <form method="POST">
                                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                                    <div class="p-3 mb-2 bg-primary text-white">
                                        <h2 class="text-center font-bold text-xl">Department List</h2>
                                    </div>
                                    <div class="p-3">
                                        <div class="flex justify-between items-center mb-4">
                                            <div class="w-1/3 relative">
                                                <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" placeholder="Search...">
                                                <button type="submit" class="absolute inset-y-0 right-0 px-3 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                                                    Search
                                                </button>
                                            </div>
                                            <div class="w-1/3 text-right">
                                                <label for="rowsPerPage" class="mr-2">Show:</label>
                                                <select name="rowsPerPage" id="rowsPerPage" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200">
                                                    <option value="10">10</option>
                                                    <option value="20">20</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="table-responsive-sm">
                                            <table class="table-auto w-full">
                                                <thead class="p-3 mb-2 bg-primary text-white">
                                                    <tr>
                                                        <th class="px-4 py-2">Code</th>
                                                        <th class="px-4 py-2">Name</th>
                                                        <th class="px-4 py-2 text-right">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-hover">
                                                    <?php
                                                    $sql = 'SELECT * FROM `departments`';
                                                    $result = mysqli_query($con, $sql);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo '<tr>
                                                                <td class="border px-4 py-2">', $row['code'], '</td>
                                                                <td class="border px-4 py-2">', $row['name'], '</td>
                                                                <td class="border px-4 py-2 text-right">
                                                                    <div class="btn-group btn-sm" role="group" aria-label="Basic example">
                                                                        <a href="department.php?edit=', $row['code'], '" class="btn btn-warning">
                                                                            <img src="https://img.icons8.com/android/18/000000/edit.png"/> 
                                                                        </a> 
                                                                        <a href="?delete=', $row['code'], '" class="btn btn-danger">
                                                                            <img src="https://img.icons8.com/windows/18/000000/delete-forever.png"/>
                                                                        </a>
                                                                        <a href="courses.php?view=', $row['code'], '" class="btn btn-success">
                                                                            <b>Subjects</b>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>';
                                                        }
                                                    } else {
                                                        echo '<tr><td colspan="3" class="border px-4 py-2 text-center">No departments found</td></tr>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="flex justify-between items-center mt-4">
                                            <div>
                                                <button type="button" class="px-3 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                                                 Previous
                                                </button>
                                                <button type="button" class="ml-2 px-3 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                                                    Next
                                                </button>
                                            </div>
                                            <div>
                                                <span class="text-sm text-gray-600">Showing 1-10 of 50 entries</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
                    <!-- 2 row end -->



                </div>





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
