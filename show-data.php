<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP OOPS CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<h2 class="text-center my-5">PHP OOPS</h2>
<hr/>
<?php

include 'database.php';

$obj = new Database();

$obj->select('student','*',null,null,null,3);

$result = $obj->getResult();

echo '
<div class="container mt-5">
<table class="table table-bordered">
<thead>
<th>Id</th>
<th>First Name</th>
<th>Last Name</th>
<th>Age</th>
<th>City</th>
<th>Update</th>
</thead>';

foreach($result as list("id" => $id, "stu_name" => $fname, "last_name" => $lname, "Age" => $age, "City" => $city)) {
    echo "<tr>
          <td>$id</td>
          <td>$fname</td>
          <td>$lname</td>
          <td>$age</td>
          <td>$city</td>
          <td><a href='#' class='btn btn-primary btn-sm'>Update</a></td>
           
        </tr>";

}

echo '</table>

</div>';

$obj->pagination('student',null,null,3);



?>










<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>