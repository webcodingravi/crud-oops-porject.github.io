<?php
include 'database.php';

$obj = new Database();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
    
    <div class="container my-5">
    <h2 class="my-4 text-center">Add Information</h2>
    <form action="save-data.php" method="POST">
     <lable for="fname">First Name</lable>
     <input type="text" class="form-control" name="fname"><br>

     <lable for="lname">Last Name</lable>
     <input type="text" class="form-control" name="lname"><br>

     <lable for="age">Age</lable>
     <input type="number"  class="form-control" name="age"><br>

     <lable for="city">City</lable>
     <select class="form-select" name="scity" id="">
     <?php
       $obj->select('student');

       $result = $obj->getResult();
       foreach($result as list("City" => $city)) {
       echo "<option value='$city'>$city</option>";
       }
      ?>
     
     </select><br>
     <input type="submit" value="Save" class="btn btn-primary" />
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>