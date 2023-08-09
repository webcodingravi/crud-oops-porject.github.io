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

<div class="container">
 <div class="table table-bordered">




</div>

</div>
    
<?php

include 'database.php';

$obj = new Database();

/********INSERT DATA******** */
// $obj->insert('student', ['stu_name' => 'Tarun', 'last_name' => 'Kumar', 'Age' => 36, 'City' => 'pune']);

// echo "Insert result is : ";

/********UPDATE DATA******** */
// $obj->update('student', ['stu_name' => 'Tarun', 'Age' => '23'], 'id="39"');

// echo "update result is : ";

/********DELETE DATA******** */
// $obj->delete('student','id = "38"');

// echo "delete result is : ";

// echo "<pre>";
// print_r($obj->getResult());
// echo "</pre>";

/********SELECT DATA******** */
// $obj->sql('SELECT * FROM student');

// echo "Sql result is : ";

// echo "<pre>";
// print_r($obj->getResult());
// echo "</pre>";


$obj->select('student','*',null,null,null,2);

echo "Select result is : ";

echo "<pre>";
print_r($obj->getResult());
echo "</pre>";

    
$obj->pagination('student',null,null,2);






?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>