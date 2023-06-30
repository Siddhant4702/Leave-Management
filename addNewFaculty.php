<?php
session_start();
if (isset($_POST['submit'])) {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "leave_mangt";

    $conn = mysqli_connect($servername, $username, $password, $db);

    if (!$conn) {
        die("can not connected to database <br> due to " . mysqli_connect_error());
    } else {
        $id = $_POST['id'];
        $pass = $_POST['pass'];
        $email = $_POST['email'];
        $name = $_POST['name'];
        $file = $_POST['file'];
        $desg = $_POST['designation'];
        $qul = $_POST['Qualification'];
        $exp = $_POST['Experience'];
        $total_casual = $_POST['total_casual'];
        $rem_casual = $_POST['rem_casual'];
        $total_medical = $_POST['total_medical'];
        $rem_medical = $_POST['rem_medical'];

        $sql = "INSERT INTO `profile`( `id`, `pass`, `email`, `image`, `name`, `designation`, `qualification`, `experience`, `total_casual`, `rem_casual`, `total_medical`, `rem_medical`) VALUES ('$id','$pass','$email','$file','$name','$desg','$qul','$exp','$total_casual','$rem_casual','$total_medical','$rem_medical')";

        // echo $sql;

        if ($conn->query($sql) == true) {

            header("Location:./clerk_final.php");
        } else {

            echo "ERROR: $sql <br> $conn->error"; // used to access key object from $con.
        }
        $conn->close();
    }
    header("Location: ./clerk_final.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Member </title>
    <link rel="stylesheet" href="CSS/addNewMember.css">
    <script>
        function getBase64(file) {
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function() {
                document.getElementById("file").value=reader.result;
            };
            reader.onerror = function(error) {
                console.log('Error: ', error);
            };
        }

        function handleChange(e) {
            getBase64(e.target.files[0])
        }
    </script>
</head>

<body>
    <div id="container">
        <div id="head">
            <p class="header" style="color: white;">APPLICATION&nbsp;TO &nbsp;ADD NEW FACULTY</p>
        </div>
        <div id="body">
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST"><br>
                <label for="name">Name of the Faculty</label>
                <span>
                    <input name="name" id="name" type="text" style="margin-right: 30px; float: right;" required />
                </span><br>

                <label for="id">New ID for faculty</label>
                <span>
                    <input name="id" id="id" type="text" style="margin-right: 30px; float: right;" required />
                </span><br>

                <label for="pass">New Password for faculty</label>
                <span>
                    <input name="pass" id="pass" type="text" style="margin-right: 30px; float: right;" required />
                </span><br>

                <label for="email">Email for faculty</label>
                <span>
                    <input name="email" id="email" type="text" style="margin-right: 30px; float: right;" required />
                </span><br>

                <label for="file">Attach Photo </label>
                <span>
                    <input  onchange="handleChange(event)" type="file" style="margin-right: 30px; float: right;" />
                    <input type="hidden" name="file" id="file">
                </span><br>

                <label for="designation">Designation</label>
                <span>
                    <input name="designation" id="designation" type="text" style="margin-right: 30px; float: right;" required />
                </span><br>

                <label for="Qualification">Qualification</label>
                <span>
                    <input name="Qualification" id="Qualification" type="text" style="margin-right: 30px; float: right;" />
                </span><br>

                <label for="Experience">Experience</label>
                <span>
                    <input name="Experience" id="Experience" type="text" style="margin-right: 30px; float: right;" />
                </span><br><br><br>

                <label for="total_Casual">Total Casual Leave</label>
                <span>
                    <input name="total_casual" id="total_casual" type="text" value="15" readonly style="margin-right: 30px; float: right;" />
                </span><br>

                <label for="rem_Casual">Remaining Casual Leave</label>
                <span>
                    <input name="rem_casual" id="rem_casual" type="text" value="15" readonly style="margin-right: 30px; float: right;" />
                </span><br>

                <label for="total_medical">Total meadical Leave</label>
                <span>
                    <input name="total_medical" id="total_medical" type="text" value="15" readonly style="margin-right: 30px; float: right;" />
                </span><br>

                <label for="rem_medical">Remaining Medical Leave</label>
                <span>
                    <input name="rem_medical" id="rem_medical" type="text" value="15" readonly style="margin-right: 30px; float: right;" />
                </span><br>
                <input type="submit" value="Submit" name="submit" style="align-content: center; font-size: 15px;">
            </form>
        </div>
    </div>
</body>

</html>