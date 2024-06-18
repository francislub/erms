<?php
//fetch.php
if(isset($_POST["action"]))
{
 $connect = mysqli_connect("localhost", "root", "", "erms");
 $output = '';
 if($_POST["action"] == "department")
 {
  $query = "SELECT * FROM courses WHERE department_code = '".$_POST["query"]."'";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="" disabled selected>Select Subject</option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["code"].'">'.$row["name"].'</option>';
  }
 }
 if($_POST["action"] == "course")
 {
  $query = "SELECT * FROM modules WHERE Course_code = '".$_POST["query"]."'";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="" disabled selected>Select module</option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["id"].'">'.$row["id"].'</option>';
  }
 }
 if($_POST["action"] == "module")
 {
  $query = "SELECT * FROM modules WHERE id = '".$_POST["query"]."'";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="" disabled selected>Select Term</option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["Semester_Id"].'">'.$row["Semester_Id"].'</option>';
  }
 }
 
 echo $output;
}
