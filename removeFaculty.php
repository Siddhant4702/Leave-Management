<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "leave_mangt";

    $conn = mysqli_connect($servername, $username, $password, $db);   
    if($conn){
     // echo"Connection succesfully";
    }
    else{
      echo" <script>alert('Not connected')</script>";
     
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete the record</title>
    <link rel="stylesheet" href="CSS/removeFaculty.css">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
 
    <form action="" method="POST">

  
    <input type="text" placeholder="Search Faculty" class="search" name="search">
    <button class="btn" name="submit" id="submit"> Search </button>
    </form>
    <div class="container1">
      <table class="table">
      <?php 
      if(isset($_POST['submit'])){
        $search =$_POST['search'];
        $sql="Select * from `profile` where id like '%$search%' or name like' %$search%' or email like '%$search%'";
        $result=mysqli_query($conn,$sql);
        if($result){
        if(mysqli_num_rows($result)>0){
          echo '<thead>
          <tr>
          <th>UserId </th>
          <th>Password</th>
          <th>Email</th>
          <th>Name</th>
          <th>Designation</th>
          <th>Qualification</th>
          <th>Experience</th>
          <th>Total Casual</th>
          <th>Rem.Casual </th>
          <th>Total Casual</th>
          <th>Rem.Medical</th>
          <th>Action</th>
          </tr>
          </thead>
          ';
          $i=1;
          while($row=mysqli_fetch_assoc($result)){
          echo'<tbody>
          <tr>
          <td>'.$row['id'].'</td>
          <td>'.$row['pass'].'</td>
          <td>'.$row['email'].'</td>
          <td>'.$row['name'].'</td>
          <td>'.$row['designation'].'</td>
          <td>'.$row['qualification'].'</td>
          <td>'.$row['experience'].'</td>
          <td>'.$row['total_casual'].'</td>
          <td>'.$row['rem_casual'].'</td>
          <td>'.$row['total_medical'].'</td>
          <td>'.$row['rem_medical'].'</td>
            <td>
            <div class="accept" style="display:flex;">
            <form action="./delete.php" method="post">
            <input type="hidden" value="'.$row['id'].'" name="record" class="remove">
              <button class="remove" type="submit">Remove</button>
            </form>
           
            </td>
          </tr>
          </tbody>'; 

          $i=$i+1;  
          }  
         
        }
        else{
          echo '<h2 class=text-danger> Data not Found</h2>';
        }
      
      }
      }

      ?>
      </table>
  </div>
    
</body>
</html>
<?php
//header("Location: ./clerk_final.php");


?>