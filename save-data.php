<?php
include 'database.php';

$obj = new Database();

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$age = $_POST['age'];
$scity = $_POST['scity'];


$value = ['stu_name' => $fname, 'last_name' => $lname, 'Age' => $age, 'City' => $scity];

if($obj->insert('student',$value)) {
  echo "<h2>Data Inserted Successfully.</h2>";
}else {
    echo "<h2>Data Not Inserted Successfully.</h2>";

}

?>
